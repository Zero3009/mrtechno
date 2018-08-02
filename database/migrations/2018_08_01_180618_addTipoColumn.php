<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prods', function(Blueprint $table){
            $table->string('tipo', 80);
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
        Schema::table('prods', function(Blueprint $table){
            $table->dropColumn('tipo');
            $table->dropColumn('estado');
        });
    }
}
