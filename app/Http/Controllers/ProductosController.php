<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use cafeteria\Productos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Storage;
use DB;

class ProductosController extends Controller
{
     public function __construct(){

    }

      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$productos=DB::table('productos as p')
    		->join('categorias as c','p.idCategorias','=','c.idCategorias')
    		->select('p.idProductos','p.Descripcion','p.Imagen','p.Precio','p.Stock','p.Estado','p.Eliminar','c.Descripcion as cate')
    		->where('p.Descripcion','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
    		->Orwhere('p.Estado','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
    		->Orwhere('c.Descripcion','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
    		->orderBy('idProductos', 'DESC')
    		->paginate(5);
    		return view('Back.Productos.index',["productos"=>$productos,"SearchText"=>$query]);
            
    	}

    }
     public function create(){
    	
    	$categorias=DB::table('categorias')->get();
    	

    	return view("Back.Productos.create",["categorias"=>$categorias]);

    }
    public function store(Request $request){
    	$producto = new Productos;
    	$producto->Descripcion=$request->get('Descripcion');
    	$img = $request->file('Imagen');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('ImgP')->put($file_route, file_get_contents($img->getRealPath()));
        $producto->Imagen=$file_route;
    	$producto->Precio=$request->get('Precio');
    	$producto->Stock=$request->get('Stock');
    	$producto->Estado="1";
    	$producto->idCategorias=$request->get('idCategorias');
    	$producto->Eliminar='1';
    	$producto->save();
    	return Redirect::to('Back/Productos');

    }
     public function show($id){

    	return view("Back.Productos.show",["producto"=>Productos::findOrFail($id)]);

    }


     public function edit($id){
    	$producto=Productos::findOrFail($id);
    	$categorias=DB::table('categorias')->get();
    	return view(" Back.Productos.edit",["producto"=>$producto, 'categorias'=>$categorias]);
    }


     public function update(Request $request, $id){

     	$producto=Productos::findOrFail($id);
    	$producto->Descripcion=$request->get('Descripcion');
    	$producto->Imagen=$request->get('Imagen');
    	$producto->Precio=$request->get('Precio');
    	$producto->Stock=$request->get('Stock');
    	$producto->Estado=$request->get('Estado');
    	$producto->idCategorias=$request->get('idCategorias');
    	$producto->Eliminar='1';
    	$producto->update();
    	return Redirect::to('Back/Productos');
    }


     public function destroy($id){
    	
    	$producto = Productos::find($id);
    	$producto->Eliminar='0';
    	$producto->update();
        return Redirect::to('Back/Productos');

    }
}