<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Mostrar la página de configuración del administrador
    public function showConfig()
    {
        // Verificar que sea un usuario administrador
        if (Auth::user()->rol !== 'admin') {
            return redirect()->route('user.dashboard');
        }
        $admin = Auth::user();
        return view('admin.configuracion', compact('admin'));
    }

    // Actualizar el perfil del administrador
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $admin = Auth::user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    // Actualizar la contraseña del administrador
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::user();

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // Actualizar la nueva contraseña
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
    }

    // Actualizar el idioma del sistema
    /*public function updateLanguage(Request $request)
    {
        $admin = Auth::user();
        $admin->language = $request->input('language');
        $admin->save();

        return redirect()->back()->with('success', 'Idioma actualizado correctamente.');
    }*/
}
