<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class ProductosOrden extends Model
{
    protected $table='productosorden';

     protected $primaryKey='idOrden';

    public $timestamps=false;

    protected $fillable = [
    	'idProductos',
    	'idOrden',
    	'Cantidad',
    	'Costo',
    	
    ];

    protected $guarded=[
    ];
}
