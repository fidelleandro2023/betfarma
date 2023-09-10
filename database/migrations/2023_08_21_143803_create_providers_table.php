<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * La funcion de esta tabla es registrar los proveedores
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Nombre del proveedor");
            $table->string('website')->comment("Sitio web del proveedor");
            $table->string('email')->comment("Correo corporativo de proveedor");
            $table->string('cellphone1')->comment("Numero de celular 1");
            $table->string('cellphone2')->nullable()->comment("Numero de celular 2");
            $table->string('whastapp')->nullable()->comment("Numero de whatapp (opcional)");
            $table->string('fanpage')->nullable()->comment("Direccion de fanpage del proveedor (opcional)");
            $table->string('instagram')->nullable()->comment("");
            $table->string('description')->comment("");
            $table->char('status',1)->comment("A = ACTIVE, I= INACTIVE");
            $table->string('address')->comment("Direccion fisica del proveedor");
            $table->bigInteger('stakeholder')->unsigned()->nullable()->comment("Persona de referencia del proveedor");
            $table->integer('qualification')->comment("Calificacion del proveedor");
            $table->bigInteger('user_id')->unsigned()->nullable()->comment("Usuario que creó el proveedor");
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('stakeholder')
            ->references('id')
            ->on('people')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
