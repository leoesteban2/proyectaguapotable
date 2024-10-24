/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarContador", function(){

	var idContador = $(this).attr("idContador");
	
	var datos = new FormData();
	datos.append("idContador", idContador);

	$.ajax({

		url:"ajax/contador.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
            $("#idcontador").val(respuesta["idcontador"]);
			$("#editarNo_contador").val(respuesta["no_contador"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarFecha_instalacion").val(respuesta["fecha_instalacion"]);
            $("#editarUltimo_mantenimiento").val(respuesta["ultimo_mantenimiento"]);
            $("#editarLecturaActual").val(respuesta["lectura_actual"]);
			$("#editarEstado").html(respuesta["estado"]);
			$("#editarEstado").val(respuesta["estado"]);

			

		}

	});


    
	
})

/*=============================================
ELIMINAR CONTADOR
=============================================*/
$(document).on("click", ".btnEliminarContador", function(){

	var idContador = $(this).attr("idContador");
  
	swal({
	  title: '¿Está seguro de borrar el contador?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar contador!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=contadores&idContador="+idContador;
  
	  }
  
	})
  
  });






  
  $('#nuevoContador').select2({
	placeholder: "Seleccionar Contador",
	allowClear: true,
	width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
});

$('#editarContador').select2({
	placeholder: "Seleccionar Contador",
	allowClear: true,
	width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
});

/* $(document).ready(function() {
	$('#editarContador').select2({
	  placeholder: "Seleccionar Contador",
	  allowClear: true,
	  width: '100%'
	});
  
	// Si necesitas realizar alguna acción adicional cuando se carga la página
	var contadorActual = '<?php echo $contadorActual; ?>';
	if (contadorActual) {
	  $('#editarContador').val(contadorActual).trigger('change');
	}
  });
 */

