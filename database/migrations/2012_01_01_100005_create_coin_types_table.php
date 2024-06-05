<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCointypesTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('coin_types', function (Blueprint $table) {
       $table->id();
       $table->string('code')->comment('');
       $table->string('description')->comment('');
       $table->bigInteger('country_id')->unsigned()->comment('');
       $table->bigInteger('coin_id')->unsigned()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->timestamps();
       $table->foreign('country_id')
             ->references('id')
             ->on('countries')
             ->onCascade('delete');
       $table->foreign('coin_id')
             ->references('id')
             ->on('coins')
             ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('coin_types');
   }
};
