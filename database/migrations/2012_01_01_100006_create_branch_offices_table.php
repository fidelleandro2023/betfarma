<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBranchofficesTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('branch_offices', function (Blueprint $table) {
       $table->id();
       $table->string('ruc')->comment('');
       $table->string('business_name')->nullable()->comment('Razon social');
       $table->string('tradename')->nullable()->comment('Nombre comercial');
       $table->string('tax_domain')->nullable()->comment('Dominio fiscal');
       $table->bigInteger('coin_id')->unsigned()->nullable();
       $table->bigInteger('country_id')->unsigned()->nullable();
       $table->bigInteger('dpto_id')->unsigned()->nullable();
       $table->bigInteger('prov_id')->unsigned()->nullable();
       $table->bigInteger('dist_id')->unsigned()->nullable();
       $table->char('status',1)->default('A')->comment('');
       $table->timestamps();
       $table->foreign('coin_id')
            ->references('id')
            ->on('coins')
            ->onCascade('delete');
       $table->foreign('country_id')
            ->references('id')
            ->on('countries')
            ->onCascade('delete');
       $table->foreign('dpto_id')
            ->references('id')
            ->on('departments')
            ->onCascade('delete');
       $table->foreign('prov_id')
            ->references('id')
            ->on('provinces')
            ->onCascade('delete');
       $table->foreign('dist_id')
             ->references('id')
             ->on('districts')
             ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('branch_offices');
   }
};
