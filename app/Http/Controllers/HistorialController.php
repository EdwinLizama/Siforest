<?php
namespace App\Http\Controllers;

use App\Models\HistorialCambio;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    // Método para mostrar el historial de cambios
    public function index()
    {
        // Obtener el historial completo o paginado
        $historialCambios = HistorialCambio::with(['usuario', 'documento', 'solicitud'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Puedes cambiar el número de elementos por página

        // Retornar la vista con los datos
        return view('admin.historial', compact('historialCambios'));
    }

    // Método para mostrar un detalle específico del historial
    public function show($id)
    {
        // Encontrar el cambio por su ID
        $historialCambio = HistorialCambio::with(['usuario', 'documento', 'solicitud'])->findOrFail($id);

        // Retornar la vista del detalle
        return view('admin.historialEspecifico', compact('historialCambio'));
    }
}
