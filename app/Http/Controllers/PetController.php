<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index()
    {
        $response = Http::withOptions(['verify' => false])->get("https://petstore.swagger.io/v2/pet/findByStatus?status=available");

        if ($response->successful()) {
            $pets = $response->json();
        }
        return view('index', compact('pets'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {           
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

        return redirect()->route('index');
    }

    public function edit($id)
    {
        $response = Http::withOptions(['verify' => false])->get("https://petstore.swagger.io/v2/pet/{$id}");

        if ($response->successful()) {
            $pet = $response->json();
            return view('edit', compact('pet'));
        } else {
            return redirect()->route('index');
        }
    }

    public function update(Request $request, $id)
    {
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

        $response = Http::withOptions(['verify' => false])->accept('application/json')->put("https://petstore.swagger.io/v2/pet", $formData);

        if ($response->successful()) {
            return redirect()->route('index');
        }
    }

    public function delete($id)
    {
        $response = Http::withOptions(['verify' => false])->delete("https://petstore.swagger.io/v2/pet/{$id}");

        if (!$response->ok()) {
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}
