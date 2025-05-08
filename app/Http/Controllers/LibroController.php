<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;


class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function filter(Request $request)
    {  
        $query = Libro::disponibles();
        $busqueda = $request->input('busqueda');

        if (!empty($busqueda)) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', "{$busqueda}%")
                  ->orWhere('autor', 'LIKE', "{$busqueda}%");
            });
        }

        switch ($request->orden) {
            case 'abc':
                $query->orderBy('titulo');
                break;
            case 'fecha':
                $query->orderBy('fecha', 'desc');
            case 'compras':
                $query->withSum('compras', 'cantidad')
                ->orderByDesc('compras_sum_cantidad');
                break;
            default:
                
                break;
        }

        $libros = $query->get();

        return view('libros.filter', compact('busqueda', 'libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $libro = Libro::disponibles()->findOrFail($id);  
        
        return view('libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
