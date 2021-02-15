<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idusuario')->unsigned();
            $table->bigInteger('idcategoria')->unsigned();
            $table->string('nombre', 80)->unique();
            $table->text('descripcion')->nullable();
            $table->integer('uso');
            $table->decimal('precio', 6, 2);
            $table->date('fecha');
            $table->integer('estado');
            $table->json('imagen');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idusuario')->references ('id')->on('users');
            $table->foreign('idcategoria')->references ('id')->on('categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
