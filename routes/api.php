<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/Back/Categorias/{id}/Productos', 'ProductosController@byCate');
Route::get('/Back/Productos/{id}/Productos', 'ProductosController@byPro');
Route::get('/Back/Orden/{id}/Orden', 'BOrdenController@byOrden');

Route::get('/Back/ProductosVendidos/', 'ProductosController@getProductosVendidos');
Route::get('/Back/VentasDiarias/', 'ProductosController@getVentasDiarias');
Route::get('/Back/MesasSolicitadas/', 'ProductosController@getMesasSolicitadas');
Route::get('/Back/TotalVentas/', 'ProductosController@getTotalVentasDiarias');
