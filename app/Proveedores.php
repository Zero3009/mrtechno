<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'provs';
	protected $primaryKey = 'id';
    //Definimos los campos que se pueden llenar con asignación masiva
    protected $fillable = ['nombre', 'tel','estado'];
    public $timestamps = false;

    public function setNombreAttribute($value)
	{
	    $this->attributes['nombre'] = strtoupper($value);
	}
}
