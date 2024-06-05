<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCoinsTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('coins', function (Blueprint $table) {
       $table->id();
       $table->string('name')->comment('');
       $table->string('description')->comment('');
       $table->string('country')->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->timestamps();
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('coins');
   }
};
