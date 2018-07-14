<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('descripcion')->nullable();
            $table->float('costo');
            $table->string('moneda');
            
            $table->integer('motor_id')->unsigned()->nullable();
            $table->integer('cantidadMotor')->nullable();

            $table->integer('transmision_id')->unsigned()->nullable();
            $table->integer('cantidadTransmision')->nullable();

            $table->integer('autoparte_id')->unsigned()->nullable();
            $table->integer('cantidadAutoparte')->nullable();
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
        Schema::dropIfExists('ventas');
    }
}
