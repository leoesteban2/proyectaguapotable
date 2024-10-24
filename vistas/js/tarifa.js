/*=============================================
EDITAR TARIFA
=============================================*/
$(document).on("click", ".btnEditarTarifa", function(){

	var idTarifa = $(this).attr("idTarifa");
	
	var datos = new FormData();
	datos.append("idTarifa", idTarifa);

	$.ajax({

		url:"ajax/tarifa.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
            $("#idtarifa").val(respuesta["idtarifa"]);
			$("#editarDescripcionTarifa").val(respuesta["descripcion"]);
			$("#editarRangoConsumoMinimo").val(respuesta["rango_consumo_min"]);
            $("#editarRangoConsumoMaximo").val(respuesta["rango_consumo_max"]);
            $("#editarTarifaBase").val(respuesta["tarifa_metro_cubico"]);
            $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
			$("#editarFechaFin").val(respuesta["fecha_fin"]);

			

		}

	});



});

/*=============================================
ELIMINAR TARIFA
=============================================*/
$(document).on("click", ".btnEliminarTarifa", function(){

	var idTarifa = $(this).attr("idTarifa");
  
	swal({
	  title: '¿Está seguro de borrar la tarifa?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar tarifa!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=tarifas&idTarifa="+idTarifa;
  
	  }
  
	})
  
  });

	
