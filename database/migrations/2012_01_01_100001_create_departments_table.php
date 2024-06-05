<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDepartmentsTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('departments', function (Blueprint $table) {
       $table->id();
       $table->string('name')->comment('');
       $table->string('description')->nullable()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->bigInteger('country_id')->unsigned()->nullable();
       $table->timestamps();
       $table->foreign('country_id')
             ->references('id')
             ->on('countries')
             ->onDelete('cascade')
             ->onUpdate('cascade');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('departments');
   }
};
