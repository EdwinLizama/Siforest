<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del usuario
            $table->string('apellido'); // Apellido del usuario
            $table->string("usuario")->unique(); // Nombre de usuario único
            $table->string('telefono'); // Teléfono del usuario
            $table->string('email')->unique(); // Correo único
            $table->string('region'); // Región del usuario
            $table->enum('rol', ['admin', 'user'])->default('user'); // Rol de usuario
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); // Contraseña encriptada
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
