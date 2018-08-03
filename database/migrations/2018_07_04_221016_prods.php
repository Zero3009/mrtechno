<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Prods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('marca_id')->unsigned();
            $table->foreign('marca_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('restrict');
            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('tags')->onDelete('restrict')->onUpdate('restrict');
            $table->string('codbarras', 80)->unique();
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prods');
    }
}
