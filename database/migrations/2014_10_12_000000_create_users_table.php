<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta línea define una nueva clase anónima que extiende la clase Migration
return new class extends Migration
{
    // Método up() es utilizado para definir las operaciones a realizar cuando se aplica la migración (creación de la tabla)
    public function up(): void
    {
        // Utiliza el Schema de Laravel para crear la tabla 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Crea una columna autoincremental 'id'
            $table->string('name'); // Crea una columna 'name' de tipo string
            $table->string('email')->unique(); // Crea una columna 'email' de tipo string y único
            $table->timestamp('email_verified_at')->nullable(); // Crea una columna 'email_verified_at' de tipo timestamp que puede ser nula
            $table->string('password'); // Crea una columna 'password' de tipo string
            $table->string('api_token', 100)->unique()->nullable(); // Crea una columna 'api_token' de tipo string, único y con longitud máxima de 100, que puede ser nula
            $table->rememberToken(); // Crea una columna 'remember_token' utilizada por el sistema de autenticación de Laravel
            $table->timestamps(); // Crea dos columnas 'created_at' y 'updated_at' para control de fechas de creación y actualización de registros
        });
    }

    // Método down() es utilizado para definir las operaciones a realizar cuando se revierte la migración (eliminación de la tabla)
    public function down(): void
    {
        // Utiliza el Schema de Laravel para eliminar la tabla 'users'
        Schema::dropIfExists('users');
    }
};
