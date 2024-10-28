<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCambio extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_cambio',
        'descripcion_cambio',
        'user_id',
        'documento_id',
        'solicitud_id',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'documento_id');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud_id');
    }
}
