<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialCambiosTable extends Migration
{
    public function up()
    {
        Schema::create('historial_cambios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_cambio'); // 'creación', 'actualización', 'eliminación', etc.
            $table->text('descripcion_cambio'); // Detalle del cambio
            $table->unsignedBigInteger('user_id'); // Usuario que hizo el cambio
            $table->unsignedBigInteger('documento_id')->nullable(); // Relacionado con un documento
            $table->unsignedBigInteger('solicitud_id')->nullable(); // Relacionado con una solicitud
            $table->timestamps();
            
            // Llaves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_cambios');
    }
}
