<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;
use cafeteria\Http\Requests\ProductosRequest;
use cafeteria\Mesas;
use Illuminate\Support\Facades\Redirect;

use DB;

class BMesasController extends Controller
{
    public function __construct(){
         $this->middleware('auth');

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('SearchText'));
    		$mesas=DB::table('mesas as m')
    		->select('m.idMesas','m.Descripcion','m.Eliminar')
    		->where('m.Descripcion','LIKE','%'.$query.'%')
    		->where('m.Eliminar','=','1')
    		->orderBy('idMesas', 'DESC')
    		->paginate(7);
    		return view('Back.Mesas.index',["mesas"=>$mesas,"SearchText"=>$query]);
    	}

    }

    public function create(){
    	return view("Back.Mesas.create");

    }

    public function store(Request $request){
    	$mesa= new Mesas;
    	$mesa->Descripcion=$request->get('Descripcion');
        $mesa->Numero='0';
    	$mesa->Eliminar='1';
    	$mesa->save();
    	return Redirect::to('Back/Mesas')->with('status','Your Job details saved successfully');
    	
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
