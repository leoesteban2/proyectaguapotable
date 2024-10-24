/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
/*  $.ajax({

url: "ajax/datatable-usuariosproyecto.ajax.php",
success:function(respuesta){
		
console.log("respuesta", respuesta);
	}

})

$('.tablaUsuariosProyecto').DataTable( {
    "ajax": "ajax/datatable-usuariosproyecto.ajax.php"

	 } ); */
	 $('.tablaUsuariosProyecto').DataTable( {
		"ajax": "ajax/datatable-usuariosproyecto.ajax.php",
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		 "language": {
	
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
	
		}
	
	} );
	


/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarUsuarioProyecto", function(){

	var idUsuarioProyecto = $(this).attr("idUsuarioProyecto");
	
	var datos = new FormData();
	datos.append("idUsuarioProyecto", idUsuarioProyecto);

	$.ajax({

		url:"ajax/usuariosproyecto.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#idusuario").val(respuesta["idusuario"]);
			$("#editarOrden").val(respuesta["no_orden"]);
			$("#editarNombreProyecto").val(respuesta["nombres"]);
			$("#editarApellidoProyecto").val(respuesta["apellidos"]);
			$("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDPI").val(respuesta["dpi"]);
            $("#editarDireccion").val(respuesta["direccion"]);
			$("#editarEstado").html(respuesta["estado"]);
			$("#editarEstado").val(respuesta["estado"]);

			

		}

	});

	
})

/*=============================================
ELIMINAR USUARIO PROYECTO
=============================================*/
$(document).on("click", ".btnEliminarUsuarioProyecto", function(){

	var idUsuarioProyecto = $(this).attr("idUsuarioProyecto");
  
	swal({
	  title: '¿Está seguro de borrar el usuario del proyecto?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario del proyecto!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=usuariosproyecto&idUsuarioProyecto="+idUsuarioProyecto;
  
	  }
  
	})
  
  })

  $('#nuevoUsuario').select2({
	placeholder: "Seleccionar Usuario",
	allowClear: true,
	width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
});

$('#editarUsuario').select2({
	placeholder: "Seleccionar Usuario",
	allowClear: true,
	width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
});



