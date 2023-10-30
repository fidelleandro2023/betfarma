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
        Schema::create('staffies_companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staff_id')->unsigned()->nullable()->comment("");
            $table->bigInteger('company_id')->unsigned()->nullable()->comment("");
            $table->timestamps();
            $table->foreign('staff_id')
                       ->references('id')
                       ->on('staffies')
                       ->onCascade('delete');
            $table->foreign('company_id')
                       ->references('id')
                       ->on('companies')
                       ->onCascade('delete');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffies_companies');
    }
};
