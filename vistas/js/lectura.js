document.addEventListener("DOMContentLoaded", function () {
    // Inicializar select2 para el select con id nuevoUsuarioA
    $('#nuevoUsuarioA').select2({
        placeholder: "Seleccionar Usuario",
        allowClear: true,
        width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
    });

    // Capturar el evento change de select2
    $('#nuevoUsuarioA').on('select2:select', function (e) {
        // Obtener la opción seleccionada
        const selectedOption = e.params.data.element;
        
        // Comprobación de los valores obtenidos
        console.log("Opción seleccionada: ", selectedOption); // Verificar la opción seleccionada
        console.log("data-no-contador: ", selectedOption.getAttribute("data-no-contador"));
        console.log("data-lectura-actual: ", selectedOption.getAttribute("data-lectura-actual"));

        // Extraer los valores de los atributos data-* de la opción seleccionada
        const noContador = selectedOption.getAttribute("data-no-contador");
        const lecturaActual = selectedOption.getAttribute("data-lectura-actual");

        // Asignar los valores a los campos de entrada correspondientes
        document.getElementById("editarNo_contadorA").value = noContador || "";
        document.getElementById("nuevoLecturaAnteriorA").value = lecturaActual || "";
    });

    // Escuchar el evento "clear" para cuando se elimina la selección
    $('#nuevoUsuarioA').on('select2:clear', function () {
        // Limpiar los campos cuando se deselecciona un usuario
        document.getElementById("editarNo_contadorA").value = "";
        document.getElementById("nuevoLecturaAnteriorA").value = "";
    });
});

/*=============================================
EDITAR Lectura
=============================================*/
$(document).on("click", ".btnEditarLectura", function(){

	var idLectura = $(this).attr("idLectura");
	
	var datos = new FormData();
	datos.append("idLectura", idLectura);

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
ELIMINAR Lectura
=============================================*/
$(document).on("click", ".btnEliminarLectura", function(){

	var idLectura = $(this).attr("idLectura");
  
	swal({
	  title: '¿Está seguro de borrar la lectura?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar lectura!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=lectura&idLectura="+idLectura;
  
	  }
  
	})
  
  });

