<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Libro;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $usuarios = User::all();


        $libroOrdAbc = Libro::orderBy('titulo')->get();
        $libroOrdFecha = Libro::orderByDesc('fecha')->get();

        $libroOrdCompras = Libro::with('comprasTotal')
                            ->get()
                            ->sortByDesc(function ($libro) {
                                return optional($libro->comprasTotal->first())->total ?? 0;
                            });

        
        // Return the view with the products
        return view('home', compact(
            'usuarios', 
            'libroOrdAbc', 
            'libroOrdFecha', 
            'libroOrdCompras',
            ));
    }
}
