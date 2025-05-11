<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

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
            'usuario' => Auth::user()->nombre,
            'review' => $validated['review'], 
            'puntuacion' => $validated['puntuacion'], 
        ]);

        return back()->with('success', '¡Gracias por tu reseña!');
    }
}