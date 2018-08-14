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

         // $this->middleware('auth');

    }

      public function index(Request $request){

    	if($request){
    		$query=trim($request->get('SearchText'));
    		$productos=DB::table('productos as p')
    		->join('categorias as c','p.idCategorias','=','c.idCategorias')
            ->join('tamaños as t','p.idTamaños','=','t.idTamaños')
    		->select('p.idProductos','p.Descripcion','p.Imagen','p.Precio','p.Stock','p.Estado','p.Eliminar','p.NumProducto','c.Descripcion as cate','t.Tamaño as tamanio')
    		->where('p.Descripcion','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
    		->Orwhere('p.Estado','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
    		->Orwhere('c.Descripcion','LIKE','%'.$query.'%')
    		->where('p.Eliminar','=','1')
            ->Orwhere('t.Tamaño','LIKE','%'.$query.'%')
            ->where('p.Eliminar','=','1')
            ->Orwhere('p.NumProducto','LIKE','%'.$query.'%')
            ->where('p.Eliminar','=','1')
    		->orderBy('idProductos', 'DESC')
    		->paginate(5);
    		return view('Back.Productos.index',["productos"=>$productos,"SearchText"=>$query]);

    	}

    }

    public function byCate($id){

       return Productos::where('idCategorias', $id)
       ->where('Estado','=','1')
       ->where('Eliminar','=','1')
       ->get();

    }

    public function byPro($id){
       return Productos::where('idProductos', $id)
       ->where('Estado','=','1')
       ->where('Eliminar','=','1')
       ->get();
    }

     public function create(){

    	$categorias=DB::table('categorias')
        ->where('Eliminar','=','1')
        ->get();
        $tamanio=DB::table('tamaños')->get();


    	return view("Back.Productos.create",["categorias"=>$categorias,"tamanio"=>$tamanio]);

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
        $producto->Numero='0';
        $producto->idTamaños=$request->get('idTamaños');
        $producto->NumProducto=$request->get('NumProducto');
    	$producto->save();
    	return Redirect::to('Back/Productos');

    }
     public function show($id){

    	return view("Back.Productos.show",["producto"=>Productos::findOrFail($id)]);

    }


     public function edit($id){
    	$producto=Productos::findOrFail($id);
    	$categorias=DB::table('categorias')->get();
         $tamanio=DB::table('tamaños')->get();
    	return view(" Back.Productos.edit",["producto"=>$producto, "tamanio"=>$tamanio, 'categorias'=>$categorias]);
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
        $producto->idTamaños=$request->get('idTamaños');
        $producto->NumProducto=$request->get('NumProducto');
    	$producto->update();
    	return Redirect::to('Back/Productos');
    }


     public function destroy($id){

    	$producto = Productos::find($id);
    	$producto->Eliminar='0';
    	$producto->update();
        return Redirect::to('Back/Productos');

    }

    public function grafica(){
        return view('Back.Graficas.GraficaP');

    }

    public function getProductosVendidos(){
        $productos_mas_vendidos = DB::table('detalleorden as dp')
                                    ->select('p.idProductos as id','p.Descripcion as descripcion',DB::raw('sum(dp.Cantidad) as numero_vendido'))
                                    ->join('productos as p','p.idProductos','=','dp.idProductos')
                                    ->groupBy('p.idProductos','p.Descripcion')
                                    ->orderBy('numero_vendido','DESC')->take(3)->get();
        return $productos_mas_vendidos;
    }

     public function getVentasDiarias(){
        $ventas_diarias = DB::table('orden as o')
                            ->select(DB::raw('DATE_FORMAT(Fecha,"%d-%m-%Y") as fecha_sola'),DB::raw('count(o.idOrden) as ventas_realizadas'))
                            ->groupBy('fecha_sola')
                            ->orderBy('fecha_sola','ASC')
                            ->get();
        return $ventas_diarias;
    }

    public function getMesasSolicitadas(){
       $ventas_diarias = DB::table('orden as o')
                           ->select(DB::raw('count(o.idMesas) as solicitado'),'m.Descripcion')
                           ->join('mesas as m','o.idMesas','=','m.idMesas')
                           ->whereBetween('Fecha',[date('Y-m-d').' 00:00:00',date('Y-m-d').' 23:59:59'])
                           ->groupBy('o.idMesas','m.Descripcion')
                           ->get();
       return $ventas_diarias;
   }
}
