<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::get('/libro/{id}', [LibroController::class, 'show'])->name('libros.show');

Route::get('/libro', [LibroController::class, 'filter'])->name('libros.filter');
