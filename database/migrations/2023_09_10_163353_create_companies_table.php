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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('ruc')->nullable()->comment('');
            $table->string('business_name')->nullable()->comment('Razon social');
            $table->string('tradename')->nullable()->comment('Nombre comercial');
            $table->string('tax_domain')->nullable()->comment('Dominio fiscal');
            $table->bigInteger('dpto_id')->nullable()->constrained()->comment('');
            $table->bigInteger('prov_id')->nullable()->constrained()->comment('');
            $table->bigInteger('dist_id')->nullable()->constrained()->comment('');
            $table->bigInteger('coin_id')->nullable()->constrained()->comment('');
            $table->string('taxpaying_state')->nullable()->comment('')->comment('');
            $table->string('taxpayer_condition')->nullable()->comment('')->comment('');
            $table->bigInteger('parent')->comment('');
            $table->timestamps();
            $table->foreign('coin_id')
                       ->references('id')
                       ->on('coin_types')
                       ->onCascade('delete');
            $table->foreign('dpto_id')
                       ->references('id')
                       ->on('departments')
                       ->onCascade('delete');
            $table->foreign('prov_id')
                       ->references('id')
                       ->on('provinces')
                       ->onCascade('delete');
            $table->foreign('dist_id')
                        ->references('id')
                        ->on('districts')
                        ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
