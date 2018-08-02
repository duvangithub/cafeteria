<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;

use cafeteria\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
// use cafeteria\Http\Requests\VentasRequest;
use cafeteria\Orden;
use cafeteria\DetalleOrden;
use cafeteria\Ventas;
use cafeteria\Pago;
use cafeteria\Categorias;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class VentasController extends Controller
{
    public function __construct(){

         $this->middleware('auth');

    }

    public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		 $ventas=DB::table('venta as v')
                ->join('pago as pa', 'v.idVenta','=','pa.idVenta')
                ->join('orden as o','v.idOrden','=','o.idOrden')
                ->select('v.idVenta','v.Total as total','pa.Pagado as pagado','pa.Cambio as cambio','o.Estado as estado','pa.Tarjeta as tipo','o.idOrden as idorden','o.Orden as orden','o.Nombre as nombre')
            ->where('o.Orden','LIKE','%'.$query.'%')
            ->Orwhere('pa.Tarjeta','LIKE','%'.$query.'%')
            ->orderBy('idVenta', 'DESC')
    		->paginate(7);
    		return view('Back.Venta.index',["ventas"=>$ventas,"SearchText"=>$query]);
            
    	}

    }

     public function create(){
    	
    	return view("Back.Venta.create");

    }

    public function store(Request $request){
    	
        try{
            DB::beginTransaction();
           
            $venta = new Ventas();
            $venta->idOrden=$request->get('idOrden');
            $venta->Total=$request->get('Total');
            $venta->save();

            $pago = new Pago();
            $pago->idVenta=$venta->idVenta;
            $pago->Pagado=$request->get('Pagado');
            $pago->Cambio=$request->get('Cambio');
            $pago->Estado="1";
            $pago->Tarjeta=$request->get('Tarjeta');
            $pago->save();

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
            
        return Redirect::to('Back/Orden');
        }

         public function show($id){

        $orden=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
            ->join('venta as ve','o.idOrden','=','ve.idOrden')
            ->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa', 've.idVenta as venta','o.Usuario', DB::raw('sum(do.Costo) as total'))
            ->where('o.idOrden','=',$id)
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion','ve.idVenta','o.Usuario')
            ->first();

             $detalle=DB::table('detalleorden as d')
                ->join('productos as p', 'd.idProductos','=','p.idProductos')
                ->join('orden as or', 'd.idOrden','=','or.idOrden')
                ->select('p.Descripcion as producto','p.Precio as precio','d.Cantidad','d.Costo')
                ->where('or.idOrden','=',$id)->get();

         $venta=DB::table('venta as v')
                ->join('pago as pa', 'v.idVenta','=','pa.idVenta')
                ->select('v.Total as total','pa.Pagado as pagado','pa.Cambio as cambio','pa.Estado as estado','pa.Tarjeta as tipo')
                ->where('v.idOrden','=',$id)->get();

    	return view("Back.Venta.show",["orden"=>$orden,"venta"=>$venta,"detalle"=>$detalle]);

    }

     public function destroy($id){
    	
    	$venta=Ventas::findOrFail($id);
        $venta->delete();
        return Redirect::to("Back/Venta");


    }

}
