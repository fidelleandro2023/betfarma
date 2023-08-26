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
            $table->chart('status',1)->default("A")->comment("A o I");
            $table->string('description')->comment("");
            $table->double("Suggestedprice")->comment("Precio sugerido al publico por unidad");
            $table->double("suggested_price_box")->comment("Precio sugerido al publico por caja");
            $table->double('sale_price')->comment("Precio de venta");
            $table->double('purchase_price')->comment("Precio de compra");
            $table->double('product_type')->comment("Tipo de producto");
            $table->double('stock')->comment("Cantidad de producto por unidad");
            $table->double('stockbox')->comment("Cantidad de producto por caja");
            $table->double('pricebox')->comment("precio por caja");
            $table->date('expirationdate')->comment("Fecha de vencimiento");
            $table->string('short')->comment("Descripción corta");
            $table->string('data')->comment("Datos adicionales del producto");
            $table->string('reference')->comment("Referencia del producto");
            $table->integer('user_id')->unsigned()->nullable()->comment("Usuario que creó el producto");
            $table->foreign('user_id')
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
