<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function index()
    {
        // Aquí puedes implementar la lógica para mostrar el carro de compras
        return view('carro.index');
    }

    public function agregar(Request $request)
    {
        // Aquí puedes implementar la lógica para agregar un producto al carro
        return back()->with('success', 'Producto agregado al carro.');
    }

    public function eliminar(Request $request)
    {
        // Aquí puedes implementar la lógica para eliminar un producto del carro
        return back()->with('success', 'Producto eliminado del carro.');
    }
}
