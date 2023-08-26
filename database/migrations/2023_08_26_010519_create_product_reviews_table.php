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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->string("title")->comment("");
            $table->chart("rating",1)->comment("");
            $table->text("content")->comment("");
            $table->chart("published",1)->comment("P(Publicado) o B (Borrador");
            $table->datetime("published_at")->comment("");
            $table->bigInteger("parent_id");
            $table->integer('user_id')->unsigned()->comment("Id de usuario");
            $table->integer('product_id')->unsigned()->comment("Id de producto");
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
