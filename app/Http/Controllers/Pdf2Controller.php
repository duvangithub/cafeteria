<?php

namespace cafeteria\Http\Controllers;

use Illuminate\Http\Request;
use cafeteria\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use cafeteria\Http\Requests\VentasRequest;
use cafeteria\Orden;
use cafeteria\DetalleOrden;
use cafeteria\Ventas;
use cafeteria\Pago;
use cafeteria\Categorias;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PDF;

class Pdf2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden=DB::table('orden as o')
            ->join('mesas as m','o.idMesas','=','m.idMesas')
            ->join('detalleorden as do','o.idOrden','=','do.idOrden')
            ->select('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion as mesa','o.Usuario', DB::raw('sum(do.Costo) as total'))
            ->where('o.idOrden','=',$id)
            ->groupBy('o.idOrden','o.Fecha','o.Nombre','o.Estado','o.Orden','m.Descripcion','o.Usuario')
            ->first();

        $detalle=DB::table('detalleorden as d')
                ->join('productos as p', 'd.idProductos','=','p.idProductos')
                ->select('p.Descripcion as producto','p.Precio as precio','d.Cantidad','d.Costo')
                ->where('d.idOrden','=',$id)->get();

        $pdf = PDF::loadView('Back.PDF2.vista2',["orden"=>$orden, "detalle"=>$detalle]);
    return $pdf->stream('Recibo.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
