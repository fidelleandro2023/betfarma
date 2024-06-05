<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCountriesTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('countries', function (Blueprint $table) {
       $table->id();
       $table->string('description', 50);
       $table->boolean('active')->default(true);
       $table->timestamps();
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('countries');
   }
};
