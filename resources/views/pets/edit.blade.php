@extends('base')

@section('content')
    <div class='text-xl'>Edit pet</div>
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Pet Name</label>
            <input type="text" id="name" name="name" placeholder="Enter pet name" value="{{ old('name', $pet['name'] ?? '') }}" required>
        </div>
        <div>
            <label for="photourl">Photo URL</label>
            <input type="text" id="photourl" name="photourl" placeholder="Enter photo path" value="{{ old('photourl', $pet['photoUrls'][0] ?? '') }}" required>
        </div>
        <div>
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" disabled {{ !isset($pet) ? 'selected' : '' }}>Select a category</option>
                <option value="cat" {{ (old('category', $pet['category']['name'] ?? '') == 'cat') ? 'selected' : '' }}>Cat</option>
                <option value="dog" {{ (old('category', $pet['category']['name'] ?? '') == 'dog') ? 'selected' : '' }}>Dog</option>
                <option value="mouse" {{ (old('category', $pet['category']['name'] ?? '') == 'mouse') ? 'selected' : '' }}>Mouse</option>
            </select>
        </div>
        <div>
            <label for="tags">Tags</label>
            <select id="tags" name="tags[]" multiple required>
                <option value="tag1" {{ in_array('tag1', old('tags', array_column($pet['tags'] ?? [], 'name'))) ? 'selected' : '' }}>Tag1</option>
                <option value="tag2" {{ in_array('tag2', old('tags', array_column($pet['tags'] ?? [], 'name'))) ? 'selected' : '' }}>Tag2</option>
                <option value="tag3" {{ in_array('tag3', old('tags', array_column($pet['tags'] ?? [], 'name'))) ? 'selected' : '' }}>Tag3</option>
                <option value="tag4" {{ in_array('tag4', old('tags', array_column($pet['tags'] ?? [], 'name'))) ? 'selected' : '' }}>Tag4</option>
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="" disabled {{ !isset($pet) ? 'selected' : '' }}>Select a status</option>
                <option value="available" {{ (old('status', $pet['status'] ?? '') == 'available') ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ (old('status', $pet['status'] ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ (old('status', $pet['status'] ?? '') == 'sold') ? 'selected' : '' }}>Sold</option>
            </select>
        </div>
        <button type="submit" class="px-2 my-2 bg-slate-200">Submit</button>
    </form>
@endsection
