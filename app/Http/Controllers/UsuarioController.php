<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;

use cafeteria\Http\Requests;

use cafeteria\User;
use Illuminate\Support\Facades\Redirect;
use cafeteria\Http\Requests\UsuarioRequest;
use cafeteria\Http\Requests\EditUsuarioRequest;
use Illuminate\Support\Facades\Input;
use Storage;
use DB;

class UsuarioController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        

    }

    public function index(Request $request){
    	if($request){
    		$query=trim($request->get('SearchText'));
    		$usuarios=DB::table('users')
    		->where('name','LIKE','%'.$query.'%')
    		->orderBy('id', 'DESC')
    		->paginate(7);
    		return view('Back.Usuarios.index',["usuarios"=>$usuarios,"SearchText"=>$query]);
    	}

    }
     public function create(){
    	return view("Back.Usuarios.create");

    }

    public function store(UsuarioRequest $request){
    	$usuario= new User;
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
        $img = $request->file('imagen');
        $file_route = time().'_'.$img->getClientOriginalName();
        Storage::disk('ImgUs')->put($file_route, file_get_contents($img->getRealPath()));
        $usuario->imagen=$file_route;
        $usuario->tipo=$request->get('tipo');
    	$usuario->password=bcrypt($request->get('password'));
    	$usuario->save();
    	return Redirect::to('Back/Usuarios');
    	
    }

     public function edit($id){
    	return view("Back.Usuarios.edit",["usuario"=>User::findOrFail($id)]);
    }

     public function update(EditUsuarioRequest $request, $id){

    	$usuario=User::findOrFail($id);
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
        $usuario->imagen=$request->get('imagen');
        $usuario->tipo=$request->get('tipo');
    	$usuario->password=bcrypt($request->get('password'));
    	$usuario->update();
    	return Redirect::to("Back/Usuarios");
    	
    }

    public function destroy($id){
    	$usuario=User::findOrFail($id);
    	$usuario->delete();
    	return Redirect::to("Back/Usuarios");

    }
}
