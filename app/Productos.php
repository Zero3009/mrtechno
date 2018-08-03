<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'prods';
	protected $primaryKey = 'id';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['tipo', 'marca','modelo','codbarras','estado'];
    public $timestamps = false;

	public function setTipoAttribute($value)
	{
	    $this->attributes['tipo'] = strtoupper($value);
	}
	public function setMarcaAttribute($value)
	{	
    	$this->attributes['marca'] = strtoupper($value);
	}
	public function setModeloAttribute($value)
	{	
    	$this->attributes['modelo'] = strtoupper($value);
	}
}
