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
      Schema::create('roles', function (Blueprint $table) { 
       $table->id();
      $table->string('name')->comment("Nombre de rol");
$table->string('description')->comment("Descripción de rol");
$table->char('status',1)->default("A")->comment("A o I"); 
      });
   }
   /**
   * Reverse the migrations.
   */
   public function down(): void
   {
     Schema::dropIfExists('roles');
   }
};
