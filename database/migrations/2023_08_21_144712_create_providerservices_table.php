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
        Schema::create('providerservices', function (Blueprint $table) {
            $table->id();
            $table->double('price')->comment("Precio del producto adquirido");
            $table->bigInteger('product_id')->unsigned()->comment("");
            $table->bigInteger('service_id')->unsigned()->comment("");
            $table->bigInteger('user_id')->unsigned()->nullable()->comment("Usuario que creó el proveedor");
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
            $table->foreign('service_id')
            ->references('id')
            ->on('services')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providerservices');
    }
};
