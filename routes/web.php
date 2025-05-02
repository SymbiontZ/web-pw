<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/libro/{id}', [LibroController::class, 'show'])->name('libros.show');

Route::get('/libro', [LibroController::class, 'index'])->name('libros.index');

