<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;
 return new class extends Migration
 {
   /**
   * Run the migrations.
   */
   public function up(): void
   {
      Schema::create('permission_roles', function (Blueprint $table) { 
       $table->id();
      $table->char('create',1)->default("A")->comment("A o I"); 
$table->char('read',1)->default("A")->comment("A o I"); 
$table->char('write',1)->default("A")->comment("A o I"); 
$table->char('delete',1)->default("A")->comment("A o I"); 
$table->char('append',1)->default("A")->comment("A o I"); 
$table->bigInteger('role_id')->unsigned()->comment("A o I"); 
$table->bigInteger('permission_id')->unsigned()->comment("A o I"); 
$table->foreign('role_id')
->references('id')
->on('roles')
->onDelete('cascade'); 
$table->foreign('permission_id')
->references('id')
->on('permissions')
->onDelete('cascade'); 
      });
   }
   /**
   * Reverse the migrations.
   */
   public function down(): void
   {
     Schema::dropIfExists('permission_roles');
   }
};
