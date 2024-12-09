@extends('base')

@section('content')
<div class="m-2">
    <div class='text-xl'>Upload image to pet</div>
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
        <button type="submit" class="px-2 my-2 bg-slate-200">Submit</button>
    </form>
</div>
@endsection