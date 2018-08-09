<html>
<head>
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #FFE4E1;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
      padding-left: 10px;
    }
    
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }

    table {
    border-collapse: collapse;
    width:100%;
    
}

/*Estilos de la tabla */
th, td {
    text-align: center;
    padding: 8px;
}
h3{
  text-align: center;
}

.encabezado{
  text-align:center;
}

.titulo{
  font-size: 20px;
  color: #008080;
}
  </style>
<body>
  <header>
    <h1>Recibo</h1>
    <h2>Coffee Market</h2>
    
  </header>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Cafeteria
            </p>
        </td>
        <td>
          <p class="page">
            Proyecto
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
<p style="text-align:Center; font-size:20px;"><span class="titulo">Orden:</span> {{$orden->Orden}}</p>
<p style="text-align:Center; font-size:20px;"><span class="titulo">Cliente:</span> {{$orden->Nombre}}</p>
<p style="text-align: right;">Fecha: {{$orden->Fecha}} </p>
<hr style="border:1px dotted black; width:100%"/>
<table>
  <tr>
    <th>Productos</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Subtotal</th>
    
  </tr>
  
  @foreach($detalle as $det)
  <tr>
    <td>{{$det->producto}}</td>
    <td>{{$det->precio}}</td>
    <td>{{$det->Cantidad}}</td>
    <td>{{$det->Cantidad*$det->precio}}</td>
  </tr>
  @endforeach
  
</table>
<hr style="border:1px dotted black; width:100%"/>


@foreach($venta as $ven)
<table>
<tr>
  <td style="text-align: center; padding-right:20px; font-weight:normal;">Pagado: ${{$ven->pagado}}</td>
  <td>Total: ${{$orden->total}}</td>
  <td>Cambio: ${{$ven->cambio}}</td>
</tr>
</table>
@endforeach
          
<hr style="border:1px dotted black; width:100%"/>

<p class="encabezado">Dirección: Carretera Cancún-Aeropuerto</p>
<p class="encabezado"> Km. 11.5, S.M. 299, Mz. 5, Lt 1, 77565 Cancùn </p>
<p class="encabezado">Estado de Quintana Roo</p>

<p style="text-align:right;"> <span class="titulo">Mesa: </span> {{$orden->mesa}}</p>
<p style="text-align:right;"> <span class="titulo">Le atendio: </span> {{$orden->Usuario}}</p>

  </div>
</body>
</html>