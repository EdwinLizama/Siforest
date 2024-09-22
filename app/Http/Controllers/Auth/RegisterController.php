<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Mostrar la vista de registro.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Registrar un nuevo usuario.
     */
    public function register(Request $request)
    {
        // Depurar para ver qué datos están llegando
      //  dd($request->all());
    
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:users',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'region' => 'required',
        ]);
    
        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'usuario' => $request->usuario,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'region' => $request->region,
            'rol' => 'user',
        ]);
    
        // Redirigir al login con mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario registrado correctamente');
    }

}

      


