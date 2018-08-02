<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Stock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('prods_id')->unsigned();
            $table->foreign('prods_id')->references('id')->on('prods')->onDelete('restrict')->onUpdate('restrict');

            $table->integer('provs_id')->unsigned();
            $table->foreign('provs_id')->references('id')->on('provs')->onDelete('restrict')->onUpdate('restrict');

            $table->decimal('precioEntrada',8,2);
            $table->decimal('precioSalida',8,2)->nullable();
            $table->boolean('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
