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
      Schema::create('peoples', function (Blueprint $table) { 
       $table->id();
      $table->string('name')->comment("Nombres");
$table->string('lastname')->comment("Apellidos");
$table->string('address')->comment("Dirección");
$table->string('landline')->nullable()->comment("Telefono fijo");
$table->string('birthdate')->nullable()->comment("Fecha de nacimiento");
$table->char('gender',1)->nullable()->comment("Fecha de nacimiento");
$table->string('main_phone')->nullable()->comment("Telefono principal");
$table->string('secondary_phone')->nullable()->comment("telefono secundario");
$table->bigInteger('document_types_id')->unsigned()->comment("Tipo de documento");
$table->string('document_number')->comment("numero de documento");
$table->char('status',1)->default("A")->comment("A o I"); 
$table->foreign('document_types_id')
->references('id')
->on('document_types')
->onDelete('cascade'); 
$table->timestamps();
      });
   }
   /**
   * Reverse the migrations.
   */
   public function down(): void
   {
     Schema::dropIfExists('peoples');
   }
};
