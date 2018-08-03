<?php

use Illuminate\Database\Seeder;

use App\Etiquetas;

class tagInit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$arrayNombres = array ('marca','modelo', 'tipo');

    	for($i = 0;$i < 3;$i++){
	        $tag = new Etiquetas;
	        $tag->nombre = $arrayNombres[$i];
	        $tag->tipo = 'defaulttag';
	        $tag->save();
	    }
    }
}
