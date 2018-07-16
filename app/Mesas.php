<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class Mesas extends Model
{
    protected $table='mesas';

    protected $primaryKey='idMesas';

    public $timestamps=false;

    protected $fillable = [
    	'Descripcion',
    	'Estado',
    	'Eliminar'
    ];

    protected $guarded = [
    ];
}
