<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDashboardsTable extends Migration
{
/**
* Run the migrations.
*/
   public function up(): void
   {
     Schema::create('dashboards', function (Blueprint $table) {
       $table->id();
       $table->string('title');
       $table->string('slug')->unique();
       $table->boolean('featured')->default(false);
       $table->enum('purpose', ['sale', 'rent']);
       $table->enum('type', ['house', 'apartment']);
       $table->string('image')->nullable();
       $table->string('theme');
       $table->string('class');
       $table->double('profile');
       $table->double('fixed_head');
       $table->double('fixed_sidebar');
       $table->double('search');
       $table->timestamps();
     });
   }
/**
* Reverse the migrations.
*/
   public function down(): void
   {
     Schema::dropIfExists('dashboards');
   }
};
