<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\SolicitudPendiente;
use Barryvdh\DomPDF\Facade\Pdf;

class FormularioController extends Controller
{
    public function formulario()
    {
        $departamentos = [
            'Ahuachapán',
            'Cabañas',
            'Chalatenango',
            'Cuscatlán',
            'La Libertad',
            'La Paz',
            'La Unión',
            'Morazán',
            'San Miguel',
            'San Salvador',
            'San Vicente',
            'Santa Ana',
            'Sonsonate',
            'Usulután'
        ];

        return view('user.formulario', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expediente_r' => 'nullable|string',
            'fecha_solicitud' => 'nullable|date',
            'nombre' => 'required|string',
            'nit' => 'nullable|string',
            'dui' => 'required|string',
            'emitido_en' => 'nullable|string',
            'fecha_emision' => 'nullable|date',
            'departamento_solicitante' => 'nullable|string',
            'municipio_solicitante' => 'nullable|string',
            'canton' => 'nullable|string',
            'caserio' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefono_fijo' => 'nullable|string',
            'celular' => 'nullable|string',
            'correo' => 'nullable|email',
            'especie' => 'nullable|string',
            'cantidad' => 'nullable|integer',
            'total' => 'nullable|string',
            'especie_adicional1' => 'nullable|string',
            'cantidad_adicional1' => 'nullable|integer',
            'total_adicional1' => 'nullable|string',
            'especie_adicional2' => 'nullable|string',
            'cantidad_adicional2' => 'nullable|integer',
            'total_adicional2' => 'nullable|string',
            'especie_adicional3' => 'nullable|string',
            'cantidad_adicional3' => 'nullable|integer',
            'total_adicional3' => 'nullable|string',
            'departamento_propiedad' => 'nullable|string',
            'municipio_propiedad' => 'nullable|string',
            'canton_prop' => 'nullable|string',
            'caserio_prop' => 'nullable|string',
            'acceso' => 'nullable|string',
            'justificacion' => 'nullable|string',
        ]);

        // Guardar la solicitud en la base de datos
            Solicitud::create($validated);

        return redirect()->route('solicitudes')->with('success', 'Solicitud enviada y está en revisión.');
    }

    public function show(Solicitud $solicitud)
    {
        return view('user.show', compact('solicitud'));
    }

    public function edit(Solicitud $solicitud)
    {
        $departamentos = [
            'Ahuachapán',
            'Cabañas',
            'Chalatenango',
            'Cuscatlán',
            'La Libertad',
            'La Paz',
            'La Unión',
            'Morazán',
            'San Miguel',
            'San Salvador',
            'San Vicente',
            'Santa Ana',
            'Sonsonate',
            'Usulután'
        ];

        return view('user.edit', compact('solicitud', 'departamentos'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $validated = $request->validate([
            'expediente_r' => 'nullable|string',
            'fecha_solicitud' => 'nullable|date',
            'nombre' => 'required|string',
            'nit' => 'nullable|string',
            'dui' => 'required|string',
            'emitido_en' => 'nullable|string',
            'fecha_emision' => 'nullable|date',
            'departamento_solicitante' => 'nullable|string',
            'municipio_solicitante' => 'nullable|string',
            'canton' => 'nullable|string',
            'caserio' => 'nullable|string',
            'direccion' => 'nullable|string',
            'telefono_fijo' => 'nullable|string',
            'celular' => 'nullable|string',
            'correo' => 'nullable|email',
            'especie' => 'nullable|string',
            'cantidad' => 'nullable|integer',
            'total' => 'nullable|string',
            'especie_adicional1' => 'nullable|string',
            'cantidad_adicional1' => 'nullable|integer',
            'total_adicional1' => 'nullable|string',
            'especie_adicional2' => 'nullable|string',
            'cantidad_adicional2' => 'nullable|integer',
            'total_adicional2' => 'nullable|string',
            'especie_adicional3' => 'nullable|string',
            'cantidad_adicional3' => 'nullable|integer',
            'total_adicional3' => 'nullable|string',
            'departamento_propiedad' => 'nullable|string',
            'municipio_propiedad' => 'nullable|string',
            'canton_prop' => 'nullable|string',
            'caserio_prop' => 'nullable|string',
            'acceso' => 'nullable|string',
            'justificacion' => 'nullable|string',
        ]);

        $solicitud->update($validated);

        return redirect()->route('solicitudes')->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return redirect()->route('solicitudes')->with('success', 'Solicitud eliminada exitosamente.');
    }
}
