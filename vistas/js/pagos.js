    // Inicializar select2 para el select con id nuevoUsuarioA
    $('#nuevoUsuarioP').select2({
        placeholder: "Seleccionar Usuario",
        allowClear: true,
        width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
    });


/**
 * Carga los cobros pendientes para un usuario seleccionado.
 */
function cargarCobrosPendientes() {
    var idUsuarioContador = document.getElementById("nuevoUsuarioP").value;
    
    console.log("ID Usuario Contador:", idUsuarioContador);

    if (idUsuarioContador) {
        $.ajax({
            url: "ajax/cargar_cobros.ajax.php",
            method: "POST",
            data: { idUsuarioContador: idUsuarioContador },
            success: function(response) {
                console.log("Contenido recibido:", response);
                
                // Limpiar el contenedor de checkboxes antes de cargar nuevos
                $("#cobrosPendientes").html(response);

                // Agregar comportamiento para que solo se pueda seleccionar un checkbox
                $('#cobrosPendientes input[type="checkbox"]').on('change', function() {
                    // Si se selecciona un checkbox, deseleccionar los demás
                    $('#cobrosPendientes input[type="checkbox"]').not(this).prop('checked', false);

                    // Actualizar el monto cuando se selecciona o deselecciona
                    actualizarMonto();
                });
            },
            error: function() {
                console.error("Error al cargar los cobros pendientes.");
            }
        });
    } else {
        console.warn("No se ha seleccionado ningún usuario.");
        $("#cobrosPendientes").html('<p>Por favor, seleccione un usuario.</p>');
    }
}

/**
 * Actualiza el monto total a pagar basado en el checkbox seleccionado.
 */
function actualizarMonto() {
    var total = 0;

    // Obtener el valor del único checkbox seleccionado
    var checkboxSeleccionado = $('#cobrosPendientes input[type="checkbox"]:checked');
    if (checkboxSeleccionado.length > 0) {
        total = parseFloat(checkboxSeleccionado.data('monto'));

        var tipoCobro = checkboxSeleccionado.data('type');  // 'base' o 'servicio'
        var detalleCobro = checkboxSeleccionado.data('detalle');  // Detalle del cobro
        var tipo_cobro = checkboxSeleccionado.attr('data-tipo-cobro');  // Capturar el tipo de cobro

        // Mostrar el detalle y el tipo para ver cuál está seleccionado
        console.log('Tipo de Cobro:', tipoCobro);
        console.log('Detalle del Cobro:', detalleCobro);
        console.log('Tipo Cobro:', tipo_cobro);

        // Actualizar los campos del formulario
        $('#detalle_pago').val(detalleCobro);  // Setear el detalle en el campo del modal
        $('#tipoCobroSeleccionado').val(tipo_cobro);  // Mostrar el tipo de cobro seleccionado

        // También puedes establecer el idcobro o idcobro_base en un input oculto
        if (tipoCobro === 'base') {
            $('#idcobro_base').val(checkboxSeleccionado.val());  // Guardar el idcobro_base
            $('#idcobro').val('');  // Limpiar idcobro si no es aplicable
        } else {
            $('#idcobro').val(checkboxSeleccionado.val());  // Guardar el idcobro
            $('#idcobro_base').val('');  // Limpiar idcobro_base si no es aplicable
        }
    }

    // Actualizar el campo de monto total con el valor calculado
    $('#montoPagado').val(total.toFixed(2));
}




/*=============================================
EDITAR PAGO
=============================================*/
$(document).on("click", ".btnEditarPago", function(){
    var idPago = $(this).attr("idPago");
    
    var datos = new FormData();
    datos.append("idPago", idPago);
  
    $.ajax({
      url: "ajax/pago.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {

        $("#idpago").val(respuesta["idpago"]);  // Rellenar el ID del pago
        $("#mostrarUsuarioE").val(respuesta["nombres"] + " " + respuesta["apellidos"]);
        $("#editarNo_contadorE").val(respuesta["no_contador"]);
        $("#detalle_pagoE").val(respuesta["detalle"]);
        $("#montoPagadoE").val(respuesta["monto_pagado"]);
        $("#tipo_pago").val(respuesta["tipo_pago"]);  // Rellenar el tipo de pago
        $("#fecha_pagoE").val(respuesta["fecha_pago"]);  // Rellenar la fecha de pago
      }
    });
  });
  
/*=============================================
ELIMINAR PAGOS
=============================================*/
$(document).on("click", ".btnEliminarPago", function(){
    var idPago = $(this).attr("idPago");
  
    swal({
        title: '¿Está seguro de borrar el pago?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar pago!'
    }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=pagos&idPago="+idPago;
        }
    });
  });

/*=============================================
IMPRIMIR PAGO
=============================================*/
$(document).on("click", ".btnImprimirPago", function() {
    var idPago = $(this).attr("idPago"); 
    window.location = "../extensiones/ticketpago.php?idPago=" + idPago;
  });
  
    
