<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });


        //DATA COMPLEMENT
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->text('descrip');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->timestamps();
        });

        Schema::create('gestions', function (Blueprint $table) {
            $table->id();
            $table->text('anio');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->timestamps();
        });

        Schema::create('institucions', function (Blueprint $table) {
            $table->id();
            $table->text('descrip');
            $table->text('ciudad');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->timestamps();
        });
        
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->text('descrip');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->timestamps();
        });

        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->text('grado');
            $table->text('apell_pat');
            $table->text('apell_mat');
            $table->text('nombres');
            $table->text('direccion');
            $table->text('telefono');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->unsignedBigInteger('unidades_id')->nullable();
            $table->unsignedBigInteger('cargos_id')->nullable();
            $table->timestamps();

            $table->foreign('unidades_id')->references('id')->on('unidades');
            $table->foreign('cargos_id')->references('id')->on('cargos');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            #$table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('personas_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('personas_id')->references('id')->on('personas');
        });
        
        Schema::create('categorias_doc', function (Blueprint $table) {
            $table->id();
            $table->text('descrip');
            $table->text('sigla');
            $table->enum('estado', ['A', 'B'])->default('A');
            $table->unsignedBigInteger('unidades_id')->nullable();
            $table->timestamps();

            $table->foreign('unidades_id')->references('id')->on('unidades');
        });

        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_doc');
            $table->text('codigo');
            $table->text('identificador');
            $table->text('referencia');
            $table->enum('tipo_doc', ['INTERNA', 'EXTERNA']);
            $table->text('cargo');
            $table->date('fecha_reg');
            $table->text('archivo');
            $table->text('gestion');
            $table->unsignedBigInteger('institucions_id')->nullable();
            $table->unsignedBigInteger('unidades_id')->nullable();
            $table->unsignedBigInteger('categorias_id')->nullable();
            $table->unsignedBigInteger('personas_id')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->timestamps();

            $table->foreign('institucions_id')->references('id')->on('institucions');
            $table->foreign('unidades_id')->references('id')->on('unidades');
            $table->foreign('categorias_id')->references('id')->on('categorias_doc');
            $table->foreign('personas_id')->references('id')->on('personas');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('categorias_doc');
        Schema::dropIfExists('unidades');
        Schema::dropIfExists('institucions');
        Schema::dropIfExists('gestions');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('personas');
    }
};
