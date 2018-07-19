<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use cafeteria\Orden;
use Illuminate\Support\Facades\Redirect;

use DB;

class BOrdenController extends Controller
{
     public function __construct(){

    }

      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$ordenes=DB::table('orden as o')
    		->join('mesas as m','o.idMesas','=','m.idMesas')
    		->select('o.idOrden','o.Fecha','o.Nombre','m.Descripcion as mesa')
    		->where('o.Nombre','LIKE','%'.$query.'%')
    		->Orwhere('m.Descripcion','LIKE','%'.$query.'%')
    		->Orwhere('o.Fecha','LIKE','%'.$query.'%')
    		->orderBy('idOrden', 'DESC')
    		->paginate(5);
    		return view('Back.Orden.index',["ordenes"=>$ordenes,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	$mesas=DB::table('mesas')
       ->where('Eliminar','=','1')
       ->get();
    	

    	return view("Back.Orden.create",["mesas"=>$mesas]);

    }
    public function store(Request $request){
    	$orden = new Orden;
    	$orden->Fecha=NOW();
    	$orden->idMesas=$request->get('idMesas');
    	$orden->Nombre=$request->get('Nombre');
    	$orden->save();
    	return Redirect::to('Back/Orden');

    }
     public function show($id){

    	return view("Back.Orden.show",["orden"=>Orden::findOrFail($id)]);

    }

     public function edit($id){
    	$orden=Orden::findOrFail($id);
    	$mesas=DB::table('mesas')
        ->where('Eliminar','=','1')
        ->get();
    	return view(" Back.Orden.edit",["orden"=>$orden, 'mesas'=>$mesas]);
    }


     public function update(Request $request, $id){

     
     	$orden=Orden::findOrFail($id);
    	$orden->idMesas=$request->get('idMesas');
    	$orden->Nombre=$request->get('Nombre');
    	$orden->update();
    	return Redirect::to('Back/Orden');
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
