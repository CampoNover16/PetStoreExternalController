@extends('base')

@section('content')
    <div>Add pet</div>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <div>
            <label for="text-input">Pet name</label>
            <input type="text" id="name" name="text" placeholder="Enter pet name" required>
        </div>
        <div>
            <label for="text-input">Photo Url</label>
            <input type="text" id="photourl" name="photourl" placeholder="Enter photo path" required>
        </div>
        <div>
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="cat">Cat</option>
                <option value="dog">Dog</option>
                <option value="mouse">Mouse</option>
            </select>
        </div>
        <div>
            <label for="tags">Tags</label>
            <select id="tags" name="tags[]" multiple required>
                <option value="tag1">Tag1</option>
                <option value="tag2">Tag2</option>
                <option value="tag3">Tag3</option>
                <option value="tag4">Tag4</option>
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="" disabled selected>Select a status</option>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection