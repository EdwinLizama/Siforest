<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioCreado;

class UsuariosController extends Controller
{
    /**
     * Método privado para verificar si el usuario es administrador.
     */
    private function verificarAdmin()
    {
        if (Auth::user()->rol !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Acceso denegado.');
        }
    }

    /**
     * Mostrar la lista de usuarios.
     */
    public function index()
    {
        // Verificar si es admin
        if ($redireccion = $this->verificarAdmin()) {
            return $redireccion;
        }

        // Listar todos los usuarios
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }

    /**
     * Mostrar el formulario de edición de un usuario.
     */
    public function edit($id)
    {
        // Verificar si es admin
        if ($redireccion = $this->verificarAdmin()) {
            return $redireccion;
        }

        // Editar usuario
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar un usuario existente.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:15',
            'region' => 'required|string|max:255',
        ]);

        // Buscar el usuario
        $usuario = User::findOrFail($id);

        // Actualizar los datos
        $usuario->update([
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'region' => $request->input('region'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy($id)
    {
        // Verificar si es admin
        if ($redireccion = $this->verificarAdmin()) {
            return $redireccion;
        }

        // Eliminar usuario
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Cambiar el rol de un usuario.
     */
    public function cambiarRol(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->rol = $request->input('rol');
        $usuario->save();

        return redirect()->route('admin.usuarios')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        // Verificar si es admin
        if ($redireccion = $this->verificarAdmin()) {
            return $redireccion;
        }

        return view('admin.crear_usuario');
    }

    /**
     * Almacenar un nuevo usuario y enviar las credenciales por correo.
     */
    public function store(Request $request)
    {
        // Validar datos con mensajes personalizados
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string|max:15',
            'region' => 'required|string|max:255',
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]);

        // Generar código de usuario (primeras letras del nombre + número aleatorio)
        $codigoUsuario = strtoupper(substr($request->name, 0, 2)) . rand(100, 999);

        // Generar contraseña temporal
        $passwordTemporal = Str::random(8);

        // Crear el usuario con el campo 'usuario' en lugar de 'user_code'
        $usuario = User::create([
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'region' => $request->input('region'),
            'password' => Hash::make($passwordTemporal),
            'usuario' => $codigoUsuario, // Cambiado para usar el campo 'usuario' en la tabla
        ]);

        // Enviar correo con las credenciales
        Mail::to($request->email)->send(new UsuarioCreado($usuario, $passwordTemporal));

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado y correo enviado correctamente.');
    }
}
