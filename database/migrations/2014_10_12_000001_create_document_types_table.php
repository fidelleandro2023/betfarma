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
      Schema::create('document_types', function (Blueprint $table) { 
       $table->id();
      $table->string('name')->comment("nombre corto");
$table->string('control')->comment("Tipo de dato");
$table->string('description')->comment("");
$table->string('type')->comment("");
$table->string('max')->nullable()->comment("Máximo de caracteres");
$table->timestamps();
      });
   \App\Models\DocumentType::insert([     ['name' => 'RUC','control' => 'number','description' => 'RUC','type' =>'6','max' =>11],
   ]);   }
   /**
   * Reverse the migrations.
   */
   public function down(): void
   {
     Schema::dropIfExists('document_types');
   }
};
