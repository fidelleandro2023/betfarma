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
        Schema::create('product_shelves', function (Blueprint $table) {
            $table->id();
            $table->string("letter")->comment("Letra de anaquel");
            $table->string("number")->comment("Numero de anaquel");
            $table->bigInteger('user_id')->unsigned()->comment("Id de usuario");
            $table->bigInteger('shelf_id')->unsigned()->comment("Id de anaquel");
            $table->bigInteger('product_id')->unsigned()->comment("Id de producto");
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
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
        Schema::dropIfExists('product_shelves');
    }
};
