<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Compra;
use App\Models\Libro;
use App\Models\User;

class CarroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
        $carrito = session('cart', []); // Obtiene el carrito de la sesión
        return view('carro', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        $producto = $request->input('producto'); // Datos del producto (id, nombre, precio, etc.)
        $carrito = session('cart', []);

        // Verificar si producto en carrito
        $productoId = $producto['id'];
        if (isset($carrito[$productoId])) {
            // Aumenta cantidad si existe
            $carrito[$productoId]['cantidad'] += 1;
        } else {
            // Agregar el producto nuevo
            $producto['cantidad'] = 1;
            $carrito[$productoId] = $producto;
        }

        // Guardar el carrito actualizado
        session(['cart' => $carrito]);
        return back()->with('success', 'Producto agregado al carro.');
    }

    public function eliminar(Request $request)
    {
        $productoId = $request->input('producto_id'); // ID del producto a eliminar
        $carrito = session('cart', []);

        if (isset($carrito[$productoId])) {
            if ($carrito[$productoId]['cantidad'] > 1) {
                // Reduce cantidad
                $carrito[$productoId]['cantidad'] -= 1;
            } else {
                // Eliminar producto
                unset($carrito[$productoId]);
            }
        }

        // Guardar el carrito
        session(['cart' => $carrito]);
        return back()->with('success', 'Producto eliminado del carro correctamente.');
    }

    public function vaciar()
    {
        session()->forget('cart');
        return back()->with('success', 'Carrito vaciado.');
    }

    public function completar(Request $request)
    {
        $carrito = session('cart', []);
        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        $userId = $request->user()->id;
        if (!$userId or User::where('id', $userId)->doesntExist()) {
            return back()->with('error', 'Debes iniciar sesión para completar la compra.');
        }

        foreach ($carrito as $producto) {
            if (!isset($producto['cantidad']) || $producto['cantidad'] < 1) {
                return back()->with('error', "La cantidad del libro con ID {$producto['id']} no es válida.");
            }

            if (Libro::where('id_libro', $producto['id'])->doesntExist())
                return back()->with('error', "El libro con ID {$producto['id']} no existe.");

            Compra::create([
                'id_libro' => $producto['id'],
                'id_usuario' => $userId,
                'cantidad' => $producto['cantidad'],
                'fecha' => now()
            ]);
        }

        session()->forget('cart'); // Vaciar el carrito después comprar
        return back()->with('success', 'Compra completada con éxito.');
    }
}
