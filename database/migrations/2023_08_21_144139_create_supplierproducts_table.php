<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Esta tabla registra todos los productos adquiridos de los proveedores
     */
    public function up(): void
    {
        Schema::create('supplierproducts', function (Blueprint $table) {
            $table->id();
            $table->double('price')->comment("Precio del producto adquirido");
            $table->integer('product_id')->unsigned()->comment("");
            $table->integer('provider_id')->unsigned()->comment("");
            $table->integer('user_id')->unsigned()->nullable()->comment("Usuario que creó el proveedor");
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
            $table->foreign('provider_id')
            ->references('id')
            ->on('providers')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplierproducts');
    }
};
