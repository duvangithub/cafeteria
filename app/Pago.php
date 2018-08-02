<?php

namespace cafeteria;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table='pago';

    protected $primaryKey='idPago';

    public $timestamps=false;

    protected $fillable = [
    	'Pagado',
    	'Cambio',
    	'Estado',
        'Tarjeta',
        'idVenta'
    ];

    protected $guarded=[
    ];
}
