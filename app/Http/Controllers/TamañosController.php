<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;

use cafeteria\Http\Requests;

use cafeteria\Tamaños;
use Illuminate\Support\Facades\Redirect;
use cafeteria\Http\Requests\TamañosRequest;

use DB;

class TamañosController extends Controller
{
     public function __construct(){

         $this->middleware('auth');

    }


      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$tamanios=DB::table('tamaños as t')
    		->select('t.idTamaños','t.Tamaño')
    		->where('t.Tamaño','LIKE','%'.$query.'%')
    		->orderBy('idTamaños', 'DESC')
    		->paginate(5);
    		return view('Back.Tamaños.index',["tamanios"=>$tamanios,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	return view("Back.Tamaños.create");

    }
    public function store(Request $request){
    	$tamanio = new Tamaños;
    	$tamanio->Tamaño=$request->get('Tamaño');
    	$tamanio->save();
    	return Redirect::to('Back/Tamaños');

    }
     public function show($id){

    	return view("Back.Tamaños.show",["tamanio"=>Tamaños::findOrFail($id)]);

    }


     public function destroy($id){
    	
    	$tamanio = Tamaños::find($id);
        
        if (is_null ($tamanio))
        {
            App::abort(404);
        }
        
        $tamanio->delete();

        return Redirect::to('Back/Tamaños');

    }
}
