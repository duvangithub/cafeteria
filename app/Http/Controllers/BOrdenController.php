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
// use cafeteria\Categorias;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class BOrdenController extends Controller
{
     public function __construct(){

         $this->middleware('auth');

    }

      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$ordenes=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
    		->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa','o.Usuario', DB::raw('sum(do.Costo) as total'))
    		->where('o.Nombre','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','!=','6')
    		->Orwhere('m.Descripcion','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','!=','6')
    		->Orwhere('o.Orden','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','!=','6')
            ->Orwhere(DB::raw('DATE(o.Fecha)'),'LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('o.idMesas','!=','6')
    		->orderBy('idOrden', 'DESC')
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion','o.Usuario')
    		->paginate(12);
    		return view('Back.Orden.index',["ordenes"=>$ordenes,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	$mesas=DB::table('mesas')
        ->where('Eliminar','=','1')
        ->where('idMesas','!=','6')
        ->get(); 
        $categorias=DB::table('categorias')
        ->where('Estado','=','1')
        ->where('Eliminar','=','1')
        ->get();
        $folio=DB::table('orden')->max('idOrden');
    	return view("Back.Orden.create",["mesas"=>$mesas,"folio"=>$folio,"categorias"=>$categorias]);

    }
    public function store(OrdenRequest $request){
    	
        try{
            DB::beginTransaction();
            $orden = new Orden;
            $orden->idMesas=$request->get('idMesas');
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
                $detalle->Comanda='1';
                $detalle->save();
                $cont=$cont+1;
            }
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

        return view("Back.Orden.show",["orden"=>$orden, "detalle"=>$detalle,"venta"=>$venta]);

    }


     public function destroy($id){
    	
    	$orden=Orden::findOrFail($id);
        $orden->Eliminar='0';
        $orden->Estado='2';
        $orden->update();

        $detalle=DetalleOrden::findOrFail($id);
        $detalle->Comanda='0';
        $detalle->update();

        return Redirect::to("Back/Orden");


    }
}
