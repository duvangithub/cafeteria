<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Productos extends Model
{
     protected $table='productos';

    protected $primaryKey='idProductos';

    public $timestamps=false;

    protected $fillable = [
    	'Descripcion',
    	'Imagen',
    	'Precio',
    	'Stock',
    	'Estado',
    	'idCategorias',
    	'Eliminar'
    ];

    protected $guarded=[
    ];

}
