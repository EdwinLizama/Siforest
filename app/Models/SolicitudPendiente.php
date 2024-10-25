<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPendiente extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_pendientes';

    protected $fillable = [
        'expediente_r',
        'expediente_ano',
        'fecha_solicitud',
        'nombre',
        'nit',
        'dui',
        'emitido_en',
        'fecha_emision',
        'departamento_solicitante',
        'municipio_solicitante',
        'canton',
        'caserio',
        'direccion',
        'telefono_fijo',
        'celular',
        'correo',
        'especie',
        'cantidad',
        'total',
        'especie_adicional1',
        'cantidad_adicional1',
        'total_adicional1',
        'especie_adicional2',
        'cantidad_adicional2',
        'total_adicional2',
        'especie_adicional3',
        'cantidad_adicional3',
        'total_adicional3',
        'departamento_propiedad',
        'municipio_propiedad',
        'canton_prop',
        'caserio_prop',
        'acceso',
        'justificacion',
        'estado'
    ];
}
