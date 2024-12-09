<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PetStoreExternalController</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <li class="list-none mx-4">
            <a class="mx-2" href="{{ route('pets.create') }}">Add New Pet</a> |
            <a class="mx-2" href="{{ route('pets.find') }}">Find Pet by ID</a> |
            <a class="mx-2" href="{{ route('pets.findByStatus') }}">Find Pets by status</a> |
            <a class="mx-2" href="{{ route('pets.partialEdit') }}">Change Pet Data by ID</a> |
            <a class="mx-2" href="{{ route('pets.uploadImage') }}">Upload image to pet</a>
        </li>
        <hr />
        @if ($errors->any())
            <div class="text-red-600 font-bold text-xl m-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </body>
</html>
