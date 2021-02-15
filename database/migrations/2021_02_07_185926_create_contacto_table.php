<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idusuario1')->unsigned();
            $table->bigInteger('idusuario2')->unsigned();
            $table->bigInteger('idproducto')->unsigned();
            $table->text('textocontacto');
            $table->timestamps();

            $table->foreign('idusuario1')->references ('id')->on('users');
            $table->foreign('idusuario2')->references ('id')->on('users');
            $table->foreign('idproducto')->references ('id')->on('producto');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
}
