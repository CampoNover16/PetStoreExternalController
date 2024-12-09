@extends('base')

@section('content')
<div>
    <div>Upload image to pet</div>
    <form action="{{ route('pets.storeImage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="text-input">Pet ID</label>
            <input type="text" id="petId" name="petId" placeholder="Enter pet ID" required>
        </div>
        <div>
            <label for="text-input">Additional Meta data</label>
            <input type="text" id="additionalMetadata" name="additionalMetadata" placeholder="Enter meta data" required>
        </div>
        <div>
            <input type="file" id="myFile" name="file">
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@endsection