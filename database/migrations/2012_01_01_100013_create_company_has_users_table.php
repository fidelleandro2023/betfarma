<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyhasusersTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('company_has_users', function (Blueprint $table) {
       $table->id();
       $table->string('name')->nullable();
       $table->string('username')->unique()->index();
       $table->string('email')->unique()->index();
       $table->timestamp('email_verified_at')->nullable();
       $table->rememberToken();
       $table->timestamps();
       $table->bigInteger('company_id')->unsigned()->nullable();
       $table->bigInteger('users_id')->unsigned()->nullable();
       $table->foreign('company_id')
            ->references('id')
            ->on('companies')
            ->onCascade('delete');
       $table->foreign('users_id')
            ->references('id')
            ->on('users')
            ->onCascade('delete');
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('company_has_users');
   }
};
