<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('index');
Route::get('/pets/create', [PetController::class, 'create'])->name('create');
Route::post('/pets', [PetController::class, 'store'])->name('store');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('update');
Route::delete('/pets/{id}', [PetController::class, 'delete'])->name('delete');
