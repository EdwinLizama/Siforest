<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar el usuario y la contraseña
        $credentials = $request->validate([
            'usuario' => ['required', 'string', 'exists:users,usuario'], // Cambia 'usuario' a 'string' y 'exists'
            'password' => ['required'],
        ]);
        
        // Intentar el login con el campo 'usuario' en lugar de 'email'
        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            $request->session()->regenerate();
    
            // Redirigir según el rol del usuario
            if (Auth::user()->rol === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
    
        // Si las credenciales son incorrectas
        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }
    


    /**
     * Redirigir según el rol del usuario después del login.
     */
    protected function authenticated(Request $request, $user)
    {
        // Verificar el rol del usuario
        dd('Redirigiendo al dashboard', $user->rol);

        if ($user->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
