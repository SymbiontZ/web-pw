<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Libro;
use App\Models\Compra;  
use App\Models\Autor;

class ProfileController extends Controller
{

    public function index(int $id)
    {
        $sessionUser = Auth::user();
        $requestUser = User::activo()->find($id); // Usuario solicitado por ID

        if (!$requestUser) {
            return redirect('/')->with('error', 'Usuario no encontrado.');
        }

        // Si usuario solicitado es el mismo que el de sesion
        if ($sessionUser->id === $requestUser->id) {
            switch ($sessionUser->rol) {
                case 'admin':
                    $libros = Libro::with('autor')->get();
                    $compras = Compra::with('libro')->with('usuario')->get();
                    $usuarios = User::with('autor')->get();

                    return view('perfil.admin', compact('libros', 'compras', 'usuarios'));

                case 'autor':
                    $autor = Autor::where('id_autor', $sessionUser->id)->first();
                    $libros = Libro::where('id_autor', $sessionUser->id)->get(); // Asumiendo que hay una relación con libros
                    return view('perfil.autor', compact('autor', 'libros'));

                case 'user':
                    $compras = Compra::where('id_usuario', $sessionUser->id)->with('libro')->get();
                    return view('perfil.usuario', [
                        'compras' => $compras,
                        'usuario' => $requestUser,
                    ]);
                default:
                    return redirect('/')->with('error', 'Rol no reconocido.');
            }
        }

        // Si el usuario solicitado no es el mismo que el de sesion
        if ($requestUser->rol === 'autor') {
            $autor = Autor::where('id_usuario', $requestUser->id)->first();
            $libros = Libro::disponibles()->where('id_autor', $requestUser->id)->get(); // Asumiendo que hay una relación con libros
            return view('autor', ['autor' => $autor, 'libros' => $libros]);
        }

        // SIno redrigir a inicio
        return redirect('/')->with('error', 'Acceso no autorizado.');
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
