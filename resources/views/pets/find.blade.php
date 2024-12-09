@extends('base')

@section('content')
    <div>Find pet by ID</div>
    <form action="{{ route('pets.find') }}" method="GET">
        <div>
            <label for="text-input">Pet ID</label>
            <input type="number" name="petId" id="petId" placeholder="Enter pet ID" value="{{ request('pet_id') }}" required>
        </div>
        <button type="submit">Submit</button>
    </form>
    <hr />
    @if ($pet)
    <table class="table-fixed w-full text-center">
        <thead>
            <tr>
                <th>Name</th>
                <th>PhotoUrls</th>
                <th>Category</th>
                <th>Status</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pet['name'] ?? 'No pet name'}}</td>
                <td class="overflow-x-auto">
                    @if(!empty($pet['photoUrls']))
                        @foreach($pet['photoUrls'] as $pu)
                            <span>{{ $pu }}</span>
                        @endforeach
                    @else
                        No photo urls
                    @endif
                </td>
                <td>{{ $pet['category']['name'] ?? 'No category name' }}</td>
                <td>{{ $pet['status'] }}</td>
                <td>
                    @if(!empty($pet['tags']) && isset($pet['tags']['name']))
                        @foreach($pet['tags'] as $tag)
                            <span>{{ $tag['name'] }}</span>
                        @endforeach
                    @else
                        No tags available
                    @endif
                </td>
                <td>
                    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
                    <form action="{{ route('pets.delete', $pet['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    @elseif(request('pet_id'))
        <div>
            Pet with given ID not found
        </div>
    @endif
@endsection
