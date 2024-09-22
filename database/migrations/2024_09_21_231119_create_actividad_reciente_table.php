<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadRecienteTable extends Migration
{
    public function up()
    {
        Schema::create('actividad_reciente', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion'); // Descripción de la actividad
            $table->foreignId('user_id')
                  ->nullable() // Permitir que el campo sea NULL
                  ->constrained('users')
                  ->onDelete('set null'); // Establecer el valor de user_id a NULL al eliminar el usuario
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('actividad_reciente');
    }
}


