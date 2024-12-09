<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::get('/pets/find', [PetController::class, 'find'])->name('pets.find');
Route::get('/pets/findByStatus', [PetController::class, 'findByStatus'])->name('pets.findByStatus');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');
Route::get('/pets/partialedit', [PetController::class, 'partialEdit'])->name('pets.partialEdit');
Route::post('/pets/partialUpdate', [PetController::class, 'partialUpdate'])->name('pets.partialUpdate');
Route::get('/pets/uploadImage', [PetController::class, 'uploadImage'])->name('pets.uploadImage');
Route::post('/pets/storeImage', [PetController::class, 'storeImage'])->name('pets.storeImage');
Route::delete('/pets/{id}', [PetController::class, 'delete'])->name('pets.delete');