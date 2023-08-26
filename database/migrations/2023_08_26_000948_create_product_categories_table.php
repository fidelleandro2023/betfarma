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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment("titulo de revisión");
            $table->string('rating')->comment("Calificación de revisión");
            $table->string('published')->comment("Fue publicada la revisión");
            $table->datetime('publishedAt')->comment("Fue publicada la revisión");
            $table->string('content')->comment("Contenido de revisión");
            $table->integer('parent_id')->unsigned()->comment("Parent de revisión");
            $table->integer('product_id')->unsigned()->comment("Id de producto");
            $table->integer('category_id')->unsigned()->comment("Id de categoria");
            $table->integer('user_id')->unsigned()->comment("Id de usuario");
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
