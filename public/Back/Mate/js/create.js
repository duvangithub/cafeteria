$(function(){

	$('#select-cate').on('change', onSelectProjectChange);

	

});

function onSelectProjectChange(){
	var cate_id = $(this).val();
	
	
	//ajax

	$.get('/api/Back/Categorias/'+cate_id+'/Productos', function (data) {
		var html_select = '<label>Elige un producto</label>'+'<br>';
		

		for(var i=0; i<data.length; ++i)
			html_select += '&nbsp;'+'<input type="radio" class="pidProductos" id="'+data[i].idProductos+'" value="'+data[i].idProductos+
		'"name="pidProductos"/>'
		    +'<label for="'+data[i].idProductos+'">'+data[i].Descripcion+'</label>'+'<br>'
		    +'<img src="/Imagenes/Productos/'+data[i].Imagen+'" height="150px" width="200px" class="center">'+'<br>';

		
		$('.pro').html(html_select);

		$( '.pidProductos' ).on( 'click', function() {
    if( $(this).is(':checked') ){
        var producto = $(this).val();
        $.get('/api/Back/Productos/'+producto+'/Productos', function (data2) {
        	var html = '<i class="material-icons prefix">attach_money</i>';
        	var html_nombre = '<i class="material-icons prefix">local_dining</i>';
          var html_id = '<i class="material-icons prefix"></i>';
        	var html_num = '<i class="material-icons prefix">confirmation_number</i>';
          var html_stock = '<i class="material-icons prefix"></i>';
        	for(var i=0; i<data2.length; ++i)
			html+='<input disabled name="Precio" value="'+data2[i].Precio+'" id="disabled" type="text" class="validate pPrecio">';

			for(var i=0; i<data2.length; ++i)
			html_nombre+='<input disabled  name="pProducto" value="'+data2[i].Descripcion+'" id="disabled" type="text" class="validate pProducto">';

			for(var i=0; i<data2.length; ++i)
			html_id+='<input disabled  name="pID" value="'+data2[i].idProductos+'" id="disabled" type="hidden" class="validate pID">';

      for(var i=0; i<data2.length; ++i)
      html_num+='<input disabled  name="pNum" value="'+data2[i].NumProducto+'" id="disabled" type="text" class="validate pNum">';

      for(var i=0; i<data2.length; ++i)
      html_stock+='<input disabled  name="pStock" value="'+data2[i].Stock+'" id="pStock" type="hidden" class="validate pStock">';

      


		console.log(html_id)

		$('.precio').html(html);
		$('.proNombre').html(html_nombre);
		$('.proID').html(html_id);
    $('.proNum').html(html_num);
    $('.proStock').html(html_stock);
   

        });

    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        alert("El checkbox con valor " + $(this).val() + " ha sido deseleccionado");
    }
     });

		
	});


}
  function multiplica(form){
          var resultado;
          var x=0;
          var y=0;
          x = parseFloat (form.Precio.value);
          y = parseFloat (form.Cantidad.value);

          resultado = x * y;

            form.Costo.value=resultado;
            }
            
function resta(form){
          var resultado;
          var x=0;
          var y=0;
          x = parseFloat (form.Pagado.value);
          y = parseFloat (form.Total.value);

          resultado = x - y;

            form.Cambio.value=resultado;

         if(x < y){
         	 $('.opera').attr("disabled", true);
         }else{
         	$('.opera').attr("disabled", false);
         }
  }








		