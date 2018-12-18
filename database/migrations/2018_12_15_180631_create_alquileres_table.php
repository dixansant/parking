<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquileresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /* FOTOS O VIDEOS, LA UBICACION Y BARRIO, TELEFONO HORARIO DE CONTACTO Y DESPUES LA DESCRIPCION */
    public function up()
    {
        Schema::create('alquileres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario');
            $table->string('clasif',40);
            $table->string('handler',32)->nullable();
            $table->string('tipo',40);
            $table->string('nombre',100);
            $table->string('imagen',100);
            $table->text('descripcion');
            $table->string('barrio',255);
            $table->string('telefono',50);
            $table->string('horarios',20)->nullable();
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
        Schema::dropIfExists('alquileres');
    }
}
