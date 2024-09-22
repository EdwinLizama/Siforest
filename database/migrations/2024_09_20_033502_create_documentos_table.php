<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_documento');
            $table->text('descripcion')->nullable();
            $table->string('archivo'); // Guardar la ruta del archivo
            $table->string('categoria')->nullable(); // Este campo es opcional
            $table->string('region'); // La región del usuario
            $table->foreignId('usuario_subio')->nullable()->constrained('users')->onDelete('set null'); // Establecer en NULL al eliminar usuario
            $table->timestamps(); // Incluye fecha de creación y actualización
            $table->string('nombreusuario')->nullable(); // Nombre del usuario que subió el documento
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}


