<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class Tamaños extends Model
{
     protected $table='tamaños';

    protected $primaryKey='idTamaños';

    public $timestamps=false;

    protected $fillable = [
    	'Tamaño',
    	
    ];
    protected $guarded=[
    ];

}
