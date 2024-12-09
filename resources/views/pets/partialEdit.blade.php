@extends('base')

@section('content')
<div class="m-2">
    <div class='text-xl'>Edit pet with partial data</div>
    <form action="{{ route('pets.partialUpdate') }}" method="POST">
        @csrf
        <div>
            <label for="name">Pet ID</label>
            <input type="number" id="petId" name="petId" placeholder="Enter pet ID" required>
        </div>
        <div>
            <label for="name">Pet Name</label>
            <input type="text" id="name" name="name" placeholder="Enter pet name" required>
        </div>
        <div>
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="" disabled>Select a status</option>
                <option value="available" >Available</option>
                <option value="pending" >Pending</option>
                <option value="sold" >Sold</option>
            </select>
        </div>
        <button type="submit" class="px-2 my-2 bg-slate-200">Submit</button>
    </form>
</div>
@endsection
