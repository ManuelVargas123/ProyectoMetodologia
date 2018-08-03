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
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('modelo');
            $table->integer('cantidad');
            $table->string('marca');
<<<<<<< HEAD
            $table->float('precio');
=======
            $table->float('costo');
<<<<<<< HEAD
>>>>>>> ManuelInputsDinamicos
=======
            $table->string('moneda');
>>>>>>> ManuelInputsDinamicos
            $table->text('descripcion')->nullable();
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
