/*=============================================
EDITAR ASIGNACION
=============================================*/
$(document).on("click", ".btneditarAsignacion", function() {
    var idUsuario_Contador = $(this).attr("idusuario_contador");
    
    var datos = new FormData();
    datos.append("idUsuario_Contador", idUsuario_Contador);

    $.ajax({
        url: "ajax/asignarcontador.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#idusuario_contador").val(respuesta["idusuario_contador"]);

            $("#editarUsuario").val(respuesta["idusuario"]);

            $("#editarContador").val(respuesta["idcontador"]);
            $("#editarfecha_Asignacion").val(respuesta["fecha_asignacion"]);
        }
    });
});

/*=============================================
ELIMINAR USUARIO PROYECTO
=============================================*/
$(document).on("click", ".btnEliminarAsignacion", function(){

	var idUsuario_Contador = $(this).attr("idUsuario_Contador");
  
	swal({
	  title: '¿Está seguro de borrar esta Asignacion?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar Asignacion!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=asignarcontador&idUsuario_Contador="+idUsuario_Contador;
       
	  }
  
	})
  
  })