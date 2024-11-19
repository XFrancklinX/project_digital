<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $datos = Unidad::all();
            return response()->json(['redirect' => route('dashboard')]); // Devuelve la ruta de redirección
        }

        return response()->json(['error' => 'Credenciales incorrectas.'], 401); // Devuelve un error si la autenticación falla
    }
}
