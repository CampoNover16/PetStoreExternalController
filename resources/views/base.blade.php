<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PetStoreExternalController</title>
    </head>
    <body>
        <li>
            <a href="{{ route('pets.create') }}">Add New Pet</a> |
            <a href="{{ route('pets.find') }}">Find Pet by ID</a> |
            <a href="{{ route('pets.findByStatus') }}">Find Pets by status</a> |
            <a href="{{ route('pets.partialEdit') }}">Change Pet Data by ID</a> |
            <a href="{{ route('pets.uploadImage') }}">Upload image to pet</a>
        </li>
        <hr />
        @yield('content')
    </body>
</html>
