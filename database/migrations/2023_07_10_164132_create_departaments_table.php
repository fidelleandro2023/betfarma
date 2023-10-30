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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment(''); 
            $table->string('description')->nullable()->comment(''); 
            $table->char('status',1)->default('A')->comment('');
            $table->bigInteger('country_id')->unsigned();
            $table->timestamps();
            $table->foreign('country_id')
            ->references('id')
            ->on('countries')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        \App\Models\Department::insert([
            ['id' => '01', 'name' => 'AMAZONAS', 'country_id' => 168],
            ['id' => '02', 'name' => 'ÁNCASH', 'country_id' => 168],
            ['id' => '03', 'name' => 'APURIMAC', 'country_id' => 168],
            ['id' => '04', 'name' => 'AREQUIPA', 'country_id' => 168],
            ['id' => '05', 'name' => 'AYACUCHO', 'country_id' => 168],
            ['id' => '06', 'name' => 'CAJAMARCA', 'country_id' => 168],
            ['id' => '07', 'name' => 'CALLAO', 'country_id' => 168],
            ['id' => '08', 'name' => 'CUSCO', 'country_id' => 168],
            ['id' => '09', 'name' => 'HUANCAVELICA', 'country_id' => 168],
            ['id' => '10', 'name' => 'HUÁNUCO', 'country_id' => 168],
            ['id' => '11', 'name' => 'ICA', 'country_id' => 168],
            ['id' => '12', 'name' => 'JUNÍN', 'country_id' => 168],
            ['id' => '13', 'name' => 'LA LIBERTAD', 'country_id' => 168],
            ['id' => '14', 'name' => 'LAMBAYEQUE', 'country_id' => 168],
            ['id' => '15', 'name' => 'LIMA', 'country_id' => 168],
            ['id' => '16', 'name' => 'LORETO', 'country_id' => 168],
            ['id' => '17', 'name' => 'MADRE DE DIOS', 'country_id' => 168],
            ['id' => '18', 'name' => 'MOQUEGUA', 'country_id' => 168],
            ['id' => '19', 'name' => 'PASCO', 'country_id' => 168],
            ['id' => '20', 'name' => 'PIURA', 'country_id' => 168],
            ['id' => '21', 'name' => 'PUNO', 'country_id' => 168],
            ['id' => '22', 'name' => 'SAN MARTIN', 'country_id' => 168],
            ['id' => '23', 'name' => 'TACNA', 'country_id' => 168],
            ['id' => '24', 'name' => 'TUMBES', 'country_id' => 168],
            ['id' => '25', 'name' => 'UCAYALI', 'country_id' => 168]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
