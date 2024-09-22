<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Documento;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        // Verificar que sea un usuario administrador
        if (Auth::user()->rol !== 'admin') {
            return redirect()->route('user.dashboard');
        }

        // Contar usuarios activos
        $usuariosActivos = User::count();

        // Contar el total de documentos subidos
        $documentosSubidos = Documento::count();

        // Contar nuevos usuarios registrados en los últimos 7 días
        $nuevosUsuarios = User::where('created_at', '>=', now()->subDays(7))->count();

        // Calcular el tamaño total de archivos subidos
        $totalSize = 0;
        $documentos = Documento::all();
        foreach ($documentos as $documento) {
            if (Storage::exists($documento->archivo)) {
                $totalSize += Storage::size($documento->archivo);
            }
        }
        $totalSizeInMB = round($totalSize / (1024 * 1024), 2); // Convertir a MB

        // Obtener actividades recientes (últimos 7 días)
        $actividadesRecientes = collect([]);

        // Agregar documentos subidos recientemente
        $documentosRecientes = Documento::where('created_at', '>=', now()->subDays(7))->get();
        foreach ($documentosRecientes as $documento) {
            $actividadesRecientes->push([
                'tipo' => 'documento',
                'mensaje' => "El usuario {$documento->nombreusuario} subió el documento '{$documento->nombre_documento}'",
                'fecha' => $documento->created_at->format('d/m/Y H:i'),
            ]);
        }

        // Agregar usuarios creados recientemente
        $usuariosRecientes = User::where('created_at', '>=', now()->subDays(7))->get();
        foreach ($usuariosRecientes as $usuario) {
            $actividadesRecientes->push([
                'tipo' => 'usuario',
                'mensaje' => "Se creó el usuario '{$usuario->name}'",
                'fecha' => $usuario->created_at->format('d/m/Y H:i'),
            ]);
        }

        // Ordenar las actividades por fecha
        $actividadesRecientes = $actividadesRecientes->sortByDesc('fecha');

        // Pasar los datos a la vista del dashboard de administrador
        return view('admin.dashboard', compact('usuariosActivos', 'documentosSubidos', 'nuevosUsuarios', 'totalSizeInMB', 'actividadesRecientes'));
    }

    public function userDashboard()
    {
        // Verificar que no sea un administrador
        if (Auth::user()->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Obtener todos los documentos
        $documentos = Documento::all();

        // Contar el total de documentos
        $totalDocumentos = Documento::count();

        // Pasar los datos a la vista del dashboard de usuario
        return view('user.dashboardUser', compact('documentos', 'totalDocumentos'));
    }
}
