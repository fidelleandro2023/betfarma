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
        Schema::create('staffies', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("");
            $table->string("description")->comment("Descripción larga");
            $table->string("short")->comment("Descripción corta");
            $table->string("salary")->comment("Salario");
            $table->string("position")->comment("");
            $table->bigInteger("parent_id")->nullable()->comment("id recursivo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffies');
    }
};
