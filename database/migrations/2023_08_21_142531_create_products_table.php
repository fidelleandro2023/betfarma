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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("");
            $table->string('description')->comment("");
            $table->double('price')->comment("Precio del producto");
            $table->string('short')->comment("Descripción corta");
            $table->string('data')->comment("Datos adicionales del producto");
            $table->string('reference')->comment("Referencia del producto");
            $table->integer('user_id')->unsigned()->nullable()->comment("Usuario que creó el producto");
            $table->integer('category_id')->unsigned()->comment("Categoria del producto");
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('category_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
