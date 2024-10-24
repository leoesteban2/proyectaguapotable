/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarCertificado", function(){

	var idTitulo = $(this).attr("idTitulo");
	
	var datos = new FormData();
	datos.append("idTitulo", idTitulo);

	$.ajax({

		url:"ajax/certificado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
            $("#idtitulo").val(respuesta["idtitulo"]);
			$("#editarNombre").val(respuesta["nombres"]);
			$("#editarApellido").val(respuesta["apellidos"]);
            $("#editarDPI").val(respuesta["dpi"]);
            $("#editarNo_contador").val(respuesta["no_contador"]);
            $("#editarNo_titulo").val(respuesta["no_titulo"]);
            $("#editarFecha").val(respuesta["fecha"]);
			$("#editarEstado").html(respuesta["estado"]);
			$("#editarEstado").val(respuesta["estado"]);

			

		}

	});
    
	
})

/*=============================================
ELIMINAR CERTIFICADO
=============================================*/
$(document).on("click", ".btnEliminarCertificado", function(){

	var idTitulo = $(this).attr("idTitulo");
  
	swal({
	  title: '¿Está seguro de borrar este Certificado?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar Certificado!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=certificado&idTitulo="+idTitulo;
       
	  }
  
	})
  
  })




  
