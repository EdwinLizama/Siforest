<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el intento de login
    public function login(Request $request)
    {
        // Validar los datos ingresados
        $credentials = $request->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Intentar iniciar sesión con 'usuario' y 'password'
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            // Regenerar la sesión para evitar fijación de sesión
            $request->session()->regenerate();
    
            // Redirigir según el rol del usuario
            if (Auth::user()->rol === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
    
        // Si las credenciales no coinciden, regresar con un mensaje de error
        return back()->withErrors([
            'usuario' => 'Las credenciales no son correctas.',
        ]);
    }

    // Método para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout(); // Cerrar sesión

        // Invalida la sesión y regenera el token de sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir al login
        return redirect('/login');
    }
}
