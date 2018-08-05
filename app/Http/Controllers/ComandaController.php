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
use cafeteria\Pago;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ComandaController extends Controller
{
      public function __construct(){

         $this->middleware('auth');

    }
    public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$detalles=DB::table('detalleorden as d')
            ->join('productos as p', 'd.idProductos','=','p.idProductos')
            ->join('orden as o','d.idOrden','=','o.idOrden')
    		->select('d.idDetalleorden','p.Descripcion as producto','d.Cantidad','o.Orden as orden','o.Nombre as nombre','o.Fecha as fecha')
    		->where('o.Orden','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('d.Comanda','=','1')
    		->Orwhere('p.Descripcion','LIKE','%'.$query.'%')
            ->where('o.Eliminar','=','1')
            ->where('d.Comanda','=','1')
    		->orderBy('idDetalleorden', 'DESC')
    		->paginate(10);
    		return view('Back.Comanda.index',["detalles"=>$detalles,"SearchText"=>$query]);
            
    	}

    }

    public function destroy($id){
    	
    	$detalle=DetalleOrden::findOrFail($id);
        $detalle->Comanda='0';
        $detalle->update();
        return Redirect::to("Back/Comanda");


    }
}
