<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyhasdashboardsTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('company_has_dashboards', function (Blueprint $table) {
       $table->id();
       $table->string('name')->comment('');
       $table->string('description')->nullable()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->bigInteger('company_id')->unsigned()->comment('');
       $table->bigInteger('dashboard_id')->unsigned()->comment('');
       $table->timestamps();
       $table->foreign('company_id')
             ->references('id')
             ->on('companies')
             ->onCascade('delete');
       $table->foreign('dashboard_id')
             ->references('id')
             ->on('dashboards')
             ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('company_has_dashboards');
   }
};
