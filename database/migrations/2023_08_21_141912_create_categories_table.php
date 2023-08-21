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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("");
            $table->string("description")->comment("Descripción larga");
            $table->string("short")->comment("Descripción corta");
            $table->integer("parent_id")->nullable()->comment("id recursivo");
            $table->string('reference')->comment("Referencia de la categoría");
            $table->integer('user_id')->unsigned()->nullable()->comment("Usuario que creó la categoria");
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
        Schema::dropIfExists('categories');
    }
};
