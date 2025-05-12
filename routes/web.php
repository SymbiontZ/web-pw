<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/libro/{id}', [LibroController::class, 'show'])->name('libros.show');

Route::get('/libro', [LibroController::class, 'filter'])->name('libros.index');

Route::post('libro/disponibilidad/{id}', [LibroController::class, 'toggle'])
    ->middleware('auth')
    ->name('libros.toggle');

// Ruta para mostrar el formulario de login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// Ruta para procesar el login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Ruta para cerrar sesión
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/carrito', [CarroController::class, 'index'])
    ->middleware('auth')
    ->name('carro');

Route::post('/carrito/agregar', [CarroController::class, 'agregar'])->name('carro.agregar');

Route::post('/carrito/eliminar', [CarroController::class, 'eliminar'])->name('carro.eliminar');

Route::post('/carrito/vaciar', [CarroController::class, 'vaciar'])->name('carro.vaciar');

Route::post('/carrito/completar', [CarroController::class, 'completar'])
    ->middleware('auth')
    ->name('carro.completar');

Route::post('/reviews', [ReviewController::class, 'guardar'])->name('reviews.guardar');

Route::get('/perfil/{id}', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('perfil.index');

Route::get('/autor/{id}', [ProfileController::class, 'index'])->name('autor');

Route::post('/usuario/disponibilidad/{id}', [UserController::class, 'toggle'])->name('usuarios.toggle');