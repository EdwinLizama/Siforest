<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ActividadReciente;


class UserController extends Controller
{
    public function perfil()
    {
        // Obtener al usuario autenticado
        $user = Auth::user();
        return view('user.perfil', compact('user'));
    }

    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'telefono' => 'required|string|max:15',

        ]);

        // Actualizar información del usuario
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->save();

        // Registrar actividad reciente
        ActividadReciente::create([
            'descripcion' => 'Perfil actualizado por: ' . $user->name,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }
    public function cambiarContrasena()
    {
        return view('user.cambiar_contrasena');
    }

    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        // Cambiar la contraseña
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
