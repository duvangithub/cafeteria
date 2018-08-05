{!! Form::open(array('url'=>'Back/Comanda','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
	<div class="input-group">
		<div class="col l9 m9 s7">
		<input type="text" class="form-control" name="SearchText" placeholder="Buscar..." value="{{$SearchText}}">
	    </div>
	    <div class="col l3 m3 s2">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar
				<i class="material-icons right">search</i>
			</button>
			
		</span>
	</div>
</div>

{{Form::close()}}


