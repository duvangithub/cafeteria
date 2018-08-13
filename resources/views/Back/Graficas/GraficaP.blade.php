@extends ('layouts.Menu')
@section ('contenido')

@if(Auth::user()->tipo==1)

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Graficas</h4>
</div>
</div>
</div>
</div>

<div class="card darken-1">
  <div class="card-content">
    <button class="btn" onclick="materialesVendidos()">Productos más vendidos</button>
    <div class="row">
       <canvas id="masVendidos" width="400" height="400"></canvas>
    </div>
  </div>
</div>

<div class="card darken-1">
  <div class="card-content">
    <button class="btn" onclick="materialesVendidos()">Venta del día</button>
    <div class="row">
       <canvas id="masVendidos" width="400" height="400"></canvas>
    </div>
  </div>
</div>


</div>
    </div>
@else
 @include('/Error/error')
@endif
@push('grafica')
<script type="text/javascript">

  function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}


  function materialesVendidos(){
    $.get('/api/Back/ProductosVendidos', function (response) {
      var labels = [];
      var data = [];
      var background = [];
      for(var i=0; i<response.length;i++){
        labels.push(response[i].descripcion);
        data.push(parseInt(response[i].numero_vendido));
        background.push(random_rgba());
      }

      var ctx = document.getElementById('masVendidos');

      var data = {
        labels : labels,
        datasets: [{
          label: 'Productos mas vendidos',
          data: data,
          backgroundColor: background,

        }]
      }
      var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: ""
      });

    });

  }
</script>
@endpush

@endsection
