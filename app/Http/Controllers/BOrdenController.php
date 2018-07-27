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
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class BOrdenController extends Controller
{
     public function __construct(){

    }

      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$ordenes=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
    		->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa', DB::raw('sum(do.Costo) as total'))
    		->where('o.Nombre','LIKE','%'.$query.'%')
            ->where('o.Estado','=','1')
    		->Orwhere('m.Descripcion','LIKE','%'.$query.'%')
            ->where('o.Estado','=','1')
    		->Orwhere('o.Orden','LIKE','%'.$query.'%')
            ->where('o.Estado','=','1')
    		->orderBy('idOrden', 'DESC')
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion')
    		->paginate(7);
    		return view('Back.Orden.index',["ordenes"=>$ordenes,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	$mesas=DB::table('mesas')->where('Eliminar','=','1')->get(); 
        $categorias=Categorias::all();
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
            $orden->Orden=$request->get('Orden');
            $orden->save();

            $idProductos = $request->get('idProductos');
            $Cantidad = $request->get('Cantidad');
            $Costo = $request->get('Costo');
            $Descuento = $request->get('Descuento');

            $cont = 0;

            while ($cont < count($idProductos)) {
                $detalle = new DetalleOrden();
                $detalle->idOrden=$orden->idOrden;
                $detalle->idProductos=$idProductos[$cont];
                $detalle->Cantidad=$Cantidad[$cont];
                $detalle->Costo=$Costo[$cont];
                $detalle->Descuento=$Descuento[$cont];
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
            ->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa', DB::raw('sum(do.Costo) as total'))
            ->where('o.idOrden','=',$id)
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion')
            ->first();

        $detalle=DB::table('detalleorden as d')
                ->join('productos as p', 'd.idProductos','=','p.idProductos')
                ->select('p.Descripcion as producto','p.Precio as precio','d.Cantidad','d.Costo','d.Descuento')
                ->where('d.idOrden','=',$id)->get();

    	return view("Back.Orden.show",["orden"=>$orden, "detalle"=>$detalle]);

    }



     public function destroy($id){
    	
    	$orden = Orden::find($id);
        
        if (is_null ($orden))
        {
            App::abort(404);
        }
        
        $orden->delete();

        return Redirect::to('Back/Orden');

    }
}
