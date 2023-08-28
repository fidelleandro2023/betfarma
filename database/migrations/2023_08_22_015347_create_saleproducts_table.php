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
        Schema::create('saleproducts', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned()->nullable()->comment("Producto adquirido");
            $table->integer('purchase_id')->unsigned()->nullable()->comment("Relación de venta");
            $table->bigInteger('user_id')->unsigned()->nullable()->comment("Usuario que creó la venta");
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saleproducts');
    }
};
