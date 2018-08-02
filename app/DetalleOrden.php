<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
     protected $table='detalleorden';

    protected $primaryKey='idDetalleorden';

    public $timestamps=false;

    protected $fillable = [
    	'cantidad',
    	'Costo',
    	'idOrden',
        'idProductos',
        'Descuento'
    ];

    protected $guarded=[
    ];
}
