<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDistrictsTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('districts', function (Blueprint $table) {
       $table->id();
       $table->string('name')->comment('');
       $table->string('description')->nullable()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->bigInteger('province_id')->unsigned();
       $table->timestamps();
       $table->foreign('province_id')
            ->references('id')
            ->on('provinces')
            ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('districts');
   }
};
