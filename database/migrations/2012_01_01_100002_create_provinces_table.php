<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProvincesTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('provinces', function (Blueprint $table) {
       $table->id();
       $table->string('name')->comment('');
       $table->string('description')->nullable()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->bigInteger('department_id')->unsigned();
       $table->timestamps();
       $table->foreign('department_id')
             ->references('id')
             ->on('departments')
             ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('provinces');
   }
};
