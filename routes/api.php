<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cafeteria/public/Back/Categorias/{id}/Productos', 'ProductosController@byCate');
Route::get('/cafeteria/public/Back/Productos/{id}/Productos', 'ProductosController@byPro');
Route::get('/cafeteria/public/Back/Orden/{id}/Orden', 'BOrdenController@byOrden');