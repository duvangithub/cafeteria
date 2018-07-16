<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use cafeteria\Mesas;
use Illuminate\Support\Facades\Redirect;
use cafeteria\Http\Request\MesasRequest;
use DB;

class BMesasController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('SearchText'));
    		$mesas=DB::table('mesas as m')
    		->select('m.idMesas','m.Descripcion','m.Estado','m.Eliminar')
    		->where('m.Descripcion','LIKE','%'.$query.'%')
    		->where('m.Eliminar','=','1')
    		->Orwhere('m.Estado','LIKE','%'.$query.'%')
    		->where('m.Eliminar','=','1')
    		->orderBy('idMesas', 'DESC')
    		->paginate(4);
    		return view('Back.Mesas.index',["mesas"=>$mesas,"SearchText"=>$query]);
    	}

    }

    public function create(){
    	return view("Back.Mesas.create");

    }

    public function store(MesasRequest $request){
    	$mesa= new Mesas;
    	$mesa->Descripcion=$request->get('Descripcion');
    	$mesa->Estado='1';
    	$mesa->Eliminar='1';
    	$mesa->save();
    	return Redirect::to('Back/Mesas');
    	
    }

    public function show($id){

    	return view("Back.Mesas.show",["mesa"=>Mesas::findOrFail($id)]);
    	
    }

    public function edit($id){
    	return view("Back.Mesas.edit",["mesa"=>Mesas::findOrFail($id)]);
    }

    public function update(Request $request, $id){

    	$mesa=Mesas::findOrFail($id);
    	$mesa->Descripcion=$request->get('Descripcion');
    	$mesa->Estado=$request->get('Estado');
    	$mesa->Eliminar='1';
    	$mesa->update();
    	return Redirect::to("Back/Mesas");
    	
    }

    public function destroy($id){

    	$mesa=Mesas::findOrFail($id);
    	$mesa->Eliminar='0';
    	$mesa->update();
    	return Redirect::to("Back/Mesas");

    }
}
