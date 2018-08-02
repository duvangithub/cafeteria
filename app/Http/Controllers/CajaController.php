<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use cafeteria\Http\Requests\VentasRequest;
use cafeteria\Orden;
use cafeteria\DetalleOrden;
use cafeteria\Ventas;
use cafeteria\Pago;
use cafeteria\Categorias;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
     public function __construct(){

         $this->middleware('auth');

    }
    // Index

    public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$ordenes=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
    		->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa','o.Usuario', DB::raw('sum(do.Costo) as total'))
    		->where('o.Nombre','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','=','6')
            ->where(DB::raw('DATE(o.Fecha)'),'=',DB::raw('curdate()'))
    		->Orwhere('o.Orden','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','=','6')
            ->where(DB::raw('DATE(o.Fecha)'),'=',DB::raw('curdate()'))
    		->orderBy('idOrden', 'DESC')
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion','o.Usuario')
    		->paginate(7);
    		return view('Back.PuntoVenta.index',["ordenes"=>$ordenes,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	
        $categorias=Categorias::all();
        $folio=DB::table('orden')->max('idOrden');
    	return view("Back.PuntoVenta.create",["folio"=>$folio,"categorias"=>$categorias]);

    }
    public function store(Request $request){
    	
        try{
            DB::beginTransaction();
            $orden = new Orden;
            $orden->idMesas="6";
            $mytime = Carbon::now('America/Cancun');
            $orden->Fecha=$mytime->toDateTimeString();
            $orden->Nombre=$request->get('Nombre');
            $orden->Estado='1';
            $orden->Usuario=Auth::user()->name;
            $orden->Eliminar='1';
            $orden->Orden=$request->get('Orden');
            $orden->save();

            $idProductos = $request->get('idProductos');
            $Cantidad = $request->get('Cantidad');
            $Costo = $request->get('Costo');
            $cont = 0;

            while ($cont < count($idProductos)) {
                $detalle = new DetalleOrden();
                $detalle->idOrden=$orden->idOrden;
                $detalle->idProductos=$idProductos[$cont];
                $detalle->Cantidad=$Cantidad[$cont];
                $detalle->Costo=$Costo[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            $venta = new Ventas();
            $venta->idOrden=$orden->idOrden;
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
            
        return Redirect::to('Back/PuntoVenta');
        }
    
     public function show($id){

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

    	return view("Back.PuntoVenta.show",["orden"=>$orden, "detalle"=>$detalle,"venta"=>$venta]);

    }

}