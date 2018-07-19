<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Categorias extends Model
{
    protected $table='categorias';

    protected $primaryKey='idCategorias';

    public $timestamps=false;

    protected $fillable = [
    	'Descripcion',
    	'Estado',
    	'Imagen',
    	'Eliminar'
    ];

    protected $guarded=[
    ];


}
