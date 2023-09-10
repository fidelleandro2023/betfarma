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
        Schema::create('supplier_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("Nombre de tipo de proveedor");
            $table->string('description')->comment("descripción de tipo de proveedor");
            $table->char('status',1)->comment("A = ACTIVE, I= INACTIVE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_types');
    }
};
