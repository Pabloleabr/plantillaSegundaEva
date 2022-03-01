<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',6)->unique();
            $table->foreignId('aeropuerto_origen')->constrained('aeropuertos');
            $table->foreignId('aeropuerto_destino')->constrained('aeropuertos');
            $table->foreignId('companyia_id')->constrained();
            $table->timestamp('llegada');
            $table->timestamp('salida');
            $table->float('precio',6,2);
            $table->integer('plazas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
};
