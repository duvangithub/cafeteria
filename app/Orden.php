<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
     protected $table='orden';

    protected $primaryKey='idOrden';

    public $timestamps=false;

    protected $fillable = [
    	'Fecha',
    	'idMesas',
    	'Nombre',
        'Estado',
        'Orden',
        'Eliminar',
        'Usuario'
    ];

    protected $guarded=[
    ];

}
