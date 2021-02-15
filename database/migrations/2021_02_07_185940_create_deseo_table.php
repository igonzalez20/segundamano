<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeseoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deseo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idusuario')->unsigned();
            $table->bigInteger('idproducto')->unsigned();
            $table->timestamps();

            $table->foreign('idusuario')->references ('id')->on('users');
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
        Schema::dropIfExists('deseos');
    }
}
