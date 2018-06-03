<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('herramientas', function (Blueprint $table) {
            $table->foreign('caja_id')->references('id')->on('caja_herramientas');
        });
        Schema::table('caja_herramientas', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id2')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('herramientas', function (Blueprint $table) {
            $table->dropForeign('herramientas_caja_id_foreign');
        });
        Schema::table('caja_herramientas', function (Blueprint $table) {
            $table->dropForeign('caja_herramientas_user_id_foreign');
            $table->dropForeign('caja_herramientas_user_id2_foreign');
        });
    }
}
