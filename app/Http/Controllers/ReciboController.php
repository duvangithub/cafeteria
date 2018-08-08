<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use cafeteria\Http\Requests\OrdenRequest;
use cafeteria\Orden;
use cafeteria\DetalleOrden;
use cafeteria\Categorias;
use cafeteria\Ventas;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use Response;
use PDF;
use Illuminate\Support\Collection;

class ReciboController extends Controller
{
      public function index(Request $request){

    }
     public function create(){
    	

    }
    public function store(OrdenRequest $request){
    	

        }
    
     public function show($id){

 
    }


     public function destroy($id){


    }

    public function recibo($id){
    	 $orden=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
            ->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa','o.Usuario', DB::raw('sum(do.Costo) as total'))
            ->where('o.idOrden','=',$id)
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion','o.Usuario')
            ->first();

        $detalle=DB::table('detalleorden as d')
                ->join('productos as p', 'd.idProductos','=','p.idProductos')
                ->select('p.Descripcion as producto','p.Precio as precio','d.Cantidad','d.Costo')
                ->where('d.idOrden','=',$id)->get();

        $venta=DB::table('venta as v')
                ->join('pago as pa', 'v.idVenta','=','pa.idVenta')
                ->select('v.Total as total','pa.Pagado as pagado','pa.Cambio as cambio','pa.Estado as estado','pa.Tarjeta as tipo')
                ->where('v.idOrden','=',$id)->get();

         $pdf = PDF::loadView('Back.Recibo.show',compact('orden','detalle','venta'));
         return $pdf->download('Orden.pdf');
    }
}
