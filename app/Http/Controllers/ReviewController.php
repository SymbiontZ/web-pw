<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'libro_id' => 'required|exists:libros,id_libro', 
            'usuario' => 'required|string|max:255',
            'review' => 'required|string|max:1000', 
            'puntuacion' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'libro_id' => $validated['libro_id'],
            'usuario' => $validated['usuario'],
            'review' => $validated['review'], 
            'puntuacion' => $validated['puntuacion'], 
        ]);

        return back()->with('success', '¡Gracias por tu reseña!');
    }
}