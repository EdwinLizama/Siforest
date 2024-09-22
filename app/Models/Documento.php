<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_documento', 'archivo', 'descripcion', 'region', 'categoria', 'usuario_subio', 'nombreusuario'];	

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
