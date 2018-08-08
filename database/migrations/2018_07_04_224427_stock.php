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
            $table->string('serial', 100)->unique()->nullable();
            $table->decimal('precioEntrada',8,0);
            $table->decimal('precioSalida',8,0)->nullable();
            $table->date('fechaEntrada');
            $table->date('fechaSalida')->nullable();
            $table->boolean('disponible')->default(true);
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
        Schema::dropIfExists('stock');
    }
}
