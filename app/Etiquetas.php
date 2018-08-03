<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiquetas extends Model
{
    protected $table = 'tags';
	protected $primaryKey = 'id';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['nombre', 'tipo','estado'];
    public $timestamps = false;
}
