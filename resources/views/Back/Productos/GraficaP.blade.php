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
<div class="row">

  <h4>Hola</h4>
   
  </div>
  </div>
   </div>
    </div>
    </div>
@else
 @include('/Error/error')
@endif

@endsection