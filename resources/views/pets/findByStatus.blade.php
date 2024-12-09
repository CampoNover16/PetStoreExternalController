@extends('base')

@section('content')
    <div>Find pets by status</div>
    <form action="{{ route('pets.findByStatus') }}" method="GET">
        <div>
            <label for="status">Status</label>
            <select id="status" name="status[]" multiple required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
    <hr />
    @if ($pets)
    <table>
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
            @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet['name'] ?? 'No pet name'}}</td>
                    <td>
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
                            No tags
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
                        <form action="{{ route('pets.delete', $pet['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
@endsection
