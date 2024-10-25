<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('expediente_r')->nullable();
            $table->integer('expediente_ano')->nullable(); // Año del expediente
            $table->date('fecha_solicitud')->nullable();

            // Datos generales del solicitante
            $table->string('nombre');
            $table->string('nit')->nullable();
            $table->string('dui')->nullable();
            $table->string('emitido_en')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->string('departamento_solicitante')->nullable();
            $table->string('municipio_solicitante')->nullable();
            $table->string('canton')->nullable();
            $table->string('caserio')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();

            // Detalle de árboles solicitados
            $table->string('especie')->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('total', 8, 2)->nullable(); // Total con tipo decimal para precisión

            // Árboles adicionales
            $table->string('especie_adicional1')->nullable();
            $table->integer('cantidad_adicional1')->nullable();
            $table->decimal('total_adicional1', 8, 2)->nullable();

            $table->string('especie_adicional2')->nullable();
            $table->integer('cantidad_adicional2')->nullable();
            $table->decimal('total_adicional2', 8, 2)->nullable();

            $table->string('especie_adicional3')->nullable();
            $table->integer('cantidad_adicional3')->nullable();
            $table->decimal('total_adicional3', 8, 2)->nullable();

            // Ubicación de la propiedad
            $table->string('departamento_propiedad')->nullable();
            $table->string('municipio_propiedad')->nullable();
            $table->string('canton_prop')->nullable();
            $table->string('caserio_prop')->nullable();
            $table->string('acceso')->nullable();

            // Justificación
            $table->string('justificacion')->nullable();

            // Estado de la solicitud
            $table->string('estado')->default('en proceso'); // Campo 'estado' con valor predeterminado

            // Timestamps de Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
