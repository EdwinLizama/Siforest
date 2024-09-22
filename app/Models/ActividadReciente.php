<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadReciente extends Model
{
    use HasFactory;

    protected $table = 'actividad_reciente';

    protected $fillable = ['descripcion', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
