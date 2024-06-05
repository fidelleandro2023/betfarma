<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDashboardhasmenusTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('dashboard_has_menus', function (Blueprint $table) {
       $table->id();
$table->string('name')->comment('');
$table->string('description')->nullable()->comment('');
$table->char('status',1)->default('A')->comment('');
$table->bigInteger('dashbaord_id')->unsigned();
$table->bigInteger('menu_id')->unsigned();
$table->timestamps();
$table->foreign('dashbaord_id')
      ->references('id')
      ->on('dashboards')
      ->onCascade('delete');
$table->foreign('menu_id')
      ->references('id')
      ->on('menus')
      ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('dashboard_has_menus');
   }
};
