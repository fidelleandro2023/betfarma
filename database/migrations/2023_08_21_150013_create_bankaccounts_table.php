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
        Schema::create('bankaccounts', function (Blueprint $table) {
            $table->id(); 
            $table->string("numberacount")->comment("Número de cuenta");
            $table->string("balance")->comment("Saldo de cuenta");
            $table->string("cardnumber")->comment("Numero de tarjeta");
            $table->integer('user_id')->unsigned()->nullable()->comment("Usuario que creó la cuenta bancaria");
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
        Schema::dropIfExists('bankaccounts');
    }
};
