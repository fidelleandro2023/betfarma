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
        Schema::create('departaments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment(''); 
            $table->string('description')->nullable()->comment(''); 
            $table->char('status',1)->default('A')->comment('');
            $table->char('country_id', 2);
            $table->timestamps();
            $table->foreign('country_id')
            ->references('id')
            ->on('countries')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
        \App\Models\Department::insert([
            ['id' => '01', 'name' => 'AMAZONAS', 'country_id' => 'PE'],
            ['id' => '02', 'name' => 'ÁNCASH', 'country_id' => 'PE'],
            ['id' => '03', 'name' => 'APURIMAC', 'country_id' => 'PE'],
            ['id' => '04', 'name' => 'AREQUIPA', 'country_id' => 'PE'],
            ['id' => '05', 'name' => 'AYACUCHO', 'country_id' => 'PE'],
            ['id' => '06', 'name' => 'CAJAMARCA', 'country_id' => 'PE'],
            ['id' => '07', 'name' => 'CALLAO', 'country_id' => 'PE'],
            ['id' => '08', 'name' => 'CUSCO', 'country_id' => 'PE'],
            ['id' => '09', 'name' => 'HUANCAVELICA', 'country_id' => 'PE'],
            ['id' => '10', 'name' => 'HUÁNUCO', 'country_id' => 'PE'],
            ['id' => '11', 'name' => 'ICA', 'country_id' => 'PE'],
            ['id' => '12', 'name' => 'JUNÍN', 'country_id' => 'PE'],
            ['id' => '13', 'name' => 'LA LIBERTAD', 'country_id' => 'PE'],
            ['id' => '14', 'name' => 'LAMBAYEQUE', 'country_id' => 'PE'],
            ['id' => '15', 'name' => 'LIMA', 'country_id' => 'PE'],
            ['id' => '16', 'name' => 'LORETO', 'country_id' => 'PE'],
            ['id' => '17', 'name' => 'MADRE DE DIOS', 'country_id' => 'PE'],
            ['id' => '18', 'name' => 'MOQUEGUA', 'country_id' => 'PE'],
            ['id' => '19', 'name' => 'PASCO', 'country_id' => 'PE'],
            ['id' => '20', 'name' => 'PIURA', 'country_id' => 'PE'],
            ['id' => '21', 'name' => 'PUNO', 'country_id' => 'PE'],
            ['id' => '22', 'name' => 'SAN MARTIN', 'country_id' => 'PE'],
            ['id' => '23', 'name' => 'TACNA', 'country_id' => 'PE'],
            ['id' => '24', 'name' => 'TUMBES', 'country_id' => 'PE'],
            ['id' => '25', 'name' => 'UCAYALI', 'country_id' => 'PE']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departaments');
    }
};
