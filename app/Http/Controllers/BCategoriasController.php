<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use cafeteria\Categorias;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Storage;
use DB;

class BCategoriasController extends Controller
{
     public function __construct(){

    }

     public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$categorias=DB::table('categorias as c')
    		->select('c.idCategorias','c.Descripcion','c.Estado','c.Imagen','c.Eliminar')
    		->where('c.Descripcion','LIKE','%'.$query.'%')
            ->where('c.Eliminar','=','1')
    		->Orwhere('c.Estado','LIKE','%'.$query.'%')
    		->where('c.Eliminar','=','1')
    		->orderBy('idCategorias', 'DESC')
    		->paginate(5);
    		return view('Back.Categorias.index',["categorias"=>$categorias,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	return view("Back.Categorias.create");

    }
    public function store(Request $request){
    	$categoria = new Categorias;
    	$categoria->Descripcion=$request->get('Descripcion');
    	$categoria->Estado="1";
    	$img = $request->file('Imagen');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('ImgC')->put($file_route, file_get_contents($img->getRealPath()));
        $categoria->Imagen=$file_route;
    	$categoria->Eliminar='1';
    	$categoria->save();
    	return Redirect::to('Back/Categorias');

    }
     public function show($id){

    	return view("Back.Categorias.show",["categoria"=>Categorias::findOrFail($id)]);

    }


     public function edit($id){
    	$categoria=Categorias::findOrFail($id);
    	return view(" Back.Categorias.edit",["categoria"=>$categoria]);
    }


     public function update(Request $request, $id){

    	$categoria=Categorias::findOrFail($id);
    	$categoria->Descripcion=$request->get('Descripcion');
    	$categoria->Estado=$request->get('Estado');
        $categoria->Imagen=$request->get('Imagen');
    	$categoria->update();
    	return Redirect::to('Back/Categorias');

    }


     public function destroy($id){
    	
    	$categoria = Categorias::find($id);
    	$categoria->Eliminar='0';
    	$categoria->update();
        return Redirect::to('Back/Categorias');

    }
}
