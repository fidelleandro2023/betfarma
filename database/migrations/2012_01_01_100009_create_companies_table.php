<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompaniesTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('companies', function (Blueprint $table) {
       $table->id();
       $table->string('ruc')->nullable()->comment('');
       $table->string('business_name')->nullable()->comment('Razon social');
       $table->string('tradename')->nullable()->comment('Nombre comercial');
       $table->string('tax_domain')->nullable()->comment('Dominio fiscal');
       $table->bigInteger('country_id')->unsigned()->nullable();
       $table->bigInteger('dpto_id')->unsigned()->nullable();
       $table->bigInteger('prov_id')->unsigned()->nullable();
       $table->bigInteger('dist_id')->unsigned()->nullable();
       $table->string('logo')->nullable()->comment('');
       $table->string('taxpaying_state')->nullable()->comment('');
       $table->string('taxpayer_condition')->nullable()->comment('');
       $table->bigInteger('operat_id')->unsigned()->nullable();
       $table->bigInteger('coin_id')->unsigned()->nullable();
       $table->decimal('IGV',10,2)->nullable(10)->comment();
       $table->decimal('IR',10,2)->nullable(8)->comment();
       $table->bigInteger('regimen_id')->unsigned()->nullable();
       $table->string('retent_agent')->nullable()->comment('');
       $table->string('retent_agent_resol')->nullable()->comment('');
       $table->string('good_taxpayer')->nullable()->comment('');
       $table->string('good_taxpayer_resol')->nullable()->comment('');
       $table->string('perception_agent')->nullable()->comment('');
       $table->string('perception_agent_resol')->nullable()->comment('');
       $table->string('excepted_igv_1')->nullable()->comment('');
       $table->string('excepted_igv_2')->nullable()->comment('');
       $table->char('status',1)->default('A')->comment('');
       $table->integer('parent')->comment('');
       $table->timestamps();
       $table->foreign('regimen_id')
             ->references('id')
             ->on('regimens')
             ->onCascade('delete');
       $table->foreign('coin_id')
            ->references('id')
            ->on('coin_types')
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
     Schema::dropIfExists('companies');
   }
};
