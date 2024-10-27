<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class AdminSolicitudController extends Controller
{
    // Mostrar lista de solicitudes en revisión
    public function index()
    {
        $solicitudesPendientes = Solicitud::where('estado', 'en revision')->get();
        $solicitudesAprobadas = Solicitud::where('estado', 'aprobado')->get();
        $solicitudesRechazadas = Solicitud::where('estado', 'rechazado')->get();
    
        $totalPendientes = $solicitudesPendientes->count();
        $totalAprobadas = $solicitudesAprobadas->count();
        $totalRechazadas = $solicitudesRechazadas->count();
    
        return view('admin.admin_solicitudes', compact(
            'solicitudesPendientes',
            'solicitudesAprobadas',
            'solicitudesRechazadas',
            'totalPendientes',
            'totalAprobadas',
            'totalRechazadas'
        ));
    }
    

    // Aprobar una solicitud
    public function aprobar($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'aprobado';  // O cualquier otro estado que definas para aprobado
        $solicitud->save();

        return redirect()->route('admin.solicitudes')->with('success', 'Solicitud aprobada con éxito');
    }

    // Rechazar una solicitud con motivo
    public function rechazar(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = 'rechazado';
        $solicitud->motivo_rechazo = $request->input('motivo_rechazo');  
        $solicitud->save();

        return redirect()->route('admin.solicitudes')->with('success', 'Solicitud rechazada con éxito');
    }
    public function showAdmin($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        return view('admin.admin_show', compact('solicitud'));
    }
}
