<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index()
    {
        return view('pets.index');
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {           
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required',
                'photourl' => 'required',
            ]);

            $formData = [
                'category' => [
                    'name' => $request->input('category')
                ],
                'name' => $request->input('name'),
                'photoUrls' => [
                    $request->input('photourl')
                ],
                'tags' => array_map(function ($tag) {
                    return ['name' => $tag];
                }, $request->input('tags')),
                'status' => $request->input('status')
            ];

            $response = Http::withOptions(['verify' => false])->accept('application/json')->post("https://petstore.swagger.io/v2/pet", $formData);

            if (!$response->successful()) {
                return back()->withErrors(['error' => 'Failed to add pet!']);
            }

            return redirect()->route('pets.index');
        }
    }

    public function find(Request $request)
    {
        $pet = null;

        if ($request->has('petId')) {
            $request->validate([
                'petId' => 'required|integer',
            ]);

            $petId = $request->input('petId');
            $response = Http::withOptions(['verify' => false])->get("https://petstore.swagger.io/v2/pet/{$petId}");

            if ($response->successful()) {
                $pet = $response->json();
            } else {
                return back()->withErrors(['error' => 'Failed to fetch pet!']);
            }
        }

        return view('pets.find', compact('pet'));
    }

    public function findByStatus(Request $request)
    {
        $pets = null;

        if ($request->has('status')) {
            $request->validate([
                'status' => 'required',
            ]);
            $petsStatus = $request->input('status');
            $query = http_build_query(['status' => $petsStatus]);
            $queryParts = [];
            foreach ($petsStatus as $status) {
                $queryParts[] = 'status=' . urlencode($status);
            }
            $query = implode('&', $queryParts);

            $response = Http::withOptions(['verify' => false])->accept('application/json')->get("https://petstore.swagger.io/v2/pet/findByStatus?" . $query);
            if ($response->successful()) {
                $pets = $response->json();
            } else {
                return back()->withErrors(['error' => 'Failed to fetch pets by status!']);
            }
        }

        return view('pets.findByStatus', compact('pets'));
    }

    public function edit($id)
    {
        $response = Http::withOptions(['verify' => false])->get("https://petstore.swagger.io/v2/pet/{$id}");

        if ($response->successful()) {
            $pet = $response->json();
            return view('pets.edit', compact('pet'));
        } else {
            return back()->withErrors(['error' => 'Failed to edit pet!']);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->has('name')){
            $request->validate([
                'name' => 'required',
                'photourl' => 'required',
            ]);

            $formData = [
                'category' => [
                    'name' => $request->input('category')
                ],
                'name' => $request->input('name'),
                'photoUrls' => [
                    $request->input('photourl')
                ],
                'tags' => array_map(function ($tag) {
                    return ['name' => $tag];
                }, $request->input('tags')),
                'status' => $request->input('status')
            ];

            $response = Http::withOptions(['verify' => false])->put("https://petstore.swagger.io/v2/pet", $formData);

            if ($response->successful()) {
                return redirect()->route('pets.index');
            } else {
                return back()->withErrors(['error' => 'Failed to edit pet!']);
            }
        }
    }

    public function partialEdit()
    {
        return view('pets.partialEdit');
    }

    public function partialUpdate(Request $request)
    {
        if($request->has('name')){
            $request->validate([
                'petID' => 'required|integer',
                'photourl' => 'required',
                'name' => 'required',
            ]);

            $petId = $request->input('petId');
            $formData = [
                'petID' => $request->input('petId'),
                'name' => $request->input('name'),
                'status' => $request->input('status')
            ];

            $response = Http::asForm()->withOptions(['verify' => false])->accept('application/json')->post("https://petstore.swagger.io/v2/pet/{$petId}", $formData);

            if ($response->successful()) {
                return redirect()->route('pets.index');
            } else {
                return back()->withErrors(['error' => 'Failed to edit pet!']);
            }
        }
    }

    public function uploadImage()
    {
        return view('pets.uploadImage');
    }

    public function storeImage(Request $request)
    {
        if($request->has('petId')){
            $request->validate([
                'petID' => 'required|integer',
                'additionalMetadata' => 'string',
                'file' => 'required',
            ]);
            $file = $request->file('file');
            $petId = $request->input('petId');
            $formData = [
                'additionalMetadata' => $request->input('additionalMetadata'),
            ];

            $response = Http::attach('file', file_get_contents($file), $file->getClientOriginalName())->withOptions(['verify' => false])->accept('application/json')->post("https://petstore.swagger.io/v2/pet/{$petId}/uploadImage", $formData);

            if ($response->successful()) {
                return redirect()->route('pets.index');
            } else {
                return back()->withErrors(['error' => 'Failed to add image!']);
            }
        }
    }

    public function delete($id)
    {
        $response = Http::withOptions(['verify' => false])->delete("https://petstore.swagger.io/v2/pet/{$id}");

        if ($response->successful()) {
            return redirect()->route('pets.index');
        } else {
            return back()->withErrors(['error' => 'Failed to delete pet!']);
        }
    }
}
