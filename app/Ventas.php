<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='venta';

    protected $primaryKey='idVenta';

    public $timestamps=false;

    protected $fillable = [
    	'Total',
    	'idOrden'
    ];

    protected $guarded=[
    ];
}
