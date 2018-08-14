<?php

namespace cafeteria\Http\Controllers\Auth;

use cafeteria\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    public function authenticated($request , $user){
    if($user->tipo=='1'){
       return Redirect::to('Back/Graficas');
    }elseif($user->tipo=='2'){
        return Redirect::to('Back/Mesero');
    }elseif($user->tipo=='3'){
        return Redirect::to('Back/PuntoVenta');
    }elseif($user->tipo=='4'){
        return Redirect::to('Back/Comanda');
    }
}
   

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
