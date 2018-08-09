<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Route::resource('Back/Mesas', 'BMesasController');
Route::resource('Back/Categorias', 'BCategoriasController');
Route::resource('Back/Productos', 'ProductosController');
Route::resource('Back/Tamaños', 'TamañosController');


Route::resource('Back/Orden', 'BOrdenController');
Route::resource('Back/Mesero', 'MeseroController');
Route::resource('Back/Compra','OrdenVentaController');
Route::resource('Back/PuntoVenta','CajaController');
Route::resource('Back/Venta','VentasController');
Route::resource('Back/Comanda','ComandaController');
Route::resource('PDF', 'PdfController');
Route::resource('PDF', 'Pdf2Controller');
Route::resource('Back/Usuarios','UsuarioController');

Route::get('Back/Graficas', 'ProductosController@getProductosVendidos');

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('pdf', function(){

//     $pdf = PDF::loadView('vista');
//     return $pdf->stream('Recibo.pdf');
// });

Route::resource('Vista/PDF', 'OrdenVentaController');