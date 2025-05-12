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
        $query = Libro::disponibles()->with('autor');
        $busqueda = $request->input('busqueda');

        if (!empty($busqueda)) {
            $query->where(function ($q) use ($busqueda) {
                $q->where('titulo', 'LIKE', "{$busqueda}%")
                  ->orWhereHas('autor', function ($q) use ($busqueda) {
                  $q->where('nombre', 'LIKE', "{$busqueda}%");
                });
            });
        }

        switch ($request->orden) {
            case 'abcAsc':
                $query->orderBy('titulo');
                break;
            case 'abcDesc':
                $query->orderBy('titulo', 'desc');
                break;
            
            case 'fechaAsc':
                $query->orderBy('fecha', 'desc');
                break;
            case 'fechaDesc':
                $query->orderBy('fecha');
                break;
            case 'precioAsc':
                $query->orderBy('precio');
                break;
            case 'precioDesc':
                $query->orderBy('precio', 'desc');
                break;
            case 'comprasAsc':
                $query->withSum('compras', 'cantidad')
                ->orderByDesc('compras_sum_cantidad');
                break;
            case 'comprasDesc':
                $query->withSum('compras', 'cantidad')
                ->orderBy('compras_sum_cantidad');
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
        $libro = Libro::disponibles()->with('autor')->findOrFail($id);  
        
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

    public function toggle($id)
    {
        $libro = Libro::findOrFail($id); // Buscar el libro por ID
        $libro->disponible = !$libro->disponible; // Alternar el estado de disponibilidad
        $libro->save(); // Guardar los cambios en la base de datos

        return redirect()->back()->with('success', 'Disponibilidad del libro actualizada correctamente.');
    }
}
