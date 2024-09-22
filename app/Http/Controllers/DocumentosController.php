<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ActividadReciente;
use Barryvdh\DomPDF\Facade as DomPDF;

class DocumentosController extends Controller
{
    public function index()
    {
        // Verificar que sea un usuario administrador
        if (Auth::user()->rol !== 'admin') {
            return redirect()->route('user.dashboard');
        }
        $documentos = Documento::with('user')->get(); // Obtener todos los documentos junto con los usuarios
        return view('admin.admindocumentos', compact('documentos'));
    }

    // Subir un nuevo documento
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'required|mimes:pdf,doc|max:30720',
        ]);


        $path = $request->file('archivo')->store('public/documentos');


        Documento::create([
            'nombre_documento' => $request->nombre,
            'descripcion' => $request->descripcion,
            'archivo' => $path, // Aquí deberías estar almacenando la ruta del archivo subido
            'region' => Auth::user()->region, // Usar la región del usuario logeado
            'usuario_subio' => Auth::user()->id, // Guardar el nombre del usuario logueado.
            'nombreusuario' => Auth::user()->name, // Guardar el nombre del usuario logueado.
        ]);
        // Registrar actividad reciente
        ActividadReciente::create([
            'descripcion' => 'Documento subido: ' . $request->nombre,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Documento subido exitosamente.');
    }

    // Descargar documento
    public function download($id)
    {
        $documento = Documento::findOrFail($id);
        return Storage::download($documento->archivo);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'nullable|mimes:pdf,doc|max:30720', // El archivo es opcional, solo si se quiere actualizar
        ]);

        $documento = Documento::findOrFail($id);

        // Actualizar los campos
        $documento->nombre_documento = $request->nombre;
        $documento->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            // Eliminar el archivo antiguo si se sube uno nuevo
            Storage::delete($documento->archivo);
            // Guardar el nuevo archivo
            $documento->archivo = $request->file('archivo')->store('public/documentos');
        }

        $documento->save(); // Guardar los cambios

        return redirect()->back()->with('success', 'Documento actualizado correctamente.');
    }
    public function edit($id)
    {
        $documento = Documento::findOrFail($id); // Buscar el documento por su ID
        return response()->json($documento); // Devolver los datos del documento en formato JSON
    }


    // Eliminar documento
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        Storage::delete($documento->archivo);
        $documento->delete();

        return redirect()->route('user.dashboard')->with('success', 'Documento eliminado correctamente.');
    }
    
    public function destroyAdmin($id)
    {
        $documento = Documento::findOrFail($id);
        Storage::delete($documento->archivo);
        $documento->delete();

        return redirect()->route('admin.admindocumentos')->with('success', 'Documento eliminado correctamente.');
    }

    //mostrar documento
    public function show(Documento $documento)
    {
        $fileUrl = Storage::url($documento->archivo); // Genera la URL pública
        return response()->json(['url' => $fileUrl]);
    }
}
