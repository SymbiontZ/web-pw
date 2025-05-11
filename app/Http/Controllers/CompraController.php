<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para mostrar las compras
        return view('compras.index');
    }
}
