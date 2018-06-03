<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransmisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transmisiones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('modelo');
            $table->integer('cantidad');
            $table->string('marca');
            $table->text('descripcion');
            $table->text('modelosDisponibles');
            $table->string('palancaCambios');
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
        Schema::dropIfExists('transmisiones');
    }
}