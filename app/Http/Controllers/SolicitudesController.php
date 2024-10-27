<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;

class SolicitudesController extends Controller
{
    public function Solicitudes(Request $request)
    {
        
        $query = Solicitud::query();
    
        // Filtro de búsqueda por nombre
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }
    
        // Filtro de búsqueda por fecha
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_solicitud', [$request->fecha_inicio, $request->fecha_fin]);
        }
    
        // Filtro de búsqueda por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
    
        // Paginación
        $solicitudes = $query->paginate(10); // Cambié get() a paginate()
    
        return view('user.solicitudes', compact('solicitudes'));
    }
    
}
