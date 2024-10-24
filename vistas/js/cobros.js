$(document).ready(function() {
  // Inicializar select2 para el select con id nuevoUsuarioC
  if ($('#nuevoUsuarioC').length > 0) {
      $('#nuevoUsuarioC').select2({
          placeholder: "Seleccionar Usuarios",
          allowClear: true,
          width: '100%'  // Hace que el select ocupe el 100% del ancho disponible
      });
  }

  // Comprobar si el elemento con id nuevoTarifaA existe antes de agregar el event listener
  var nuevoTarifaA = document.getElementById('nuevoTarifaA');
  if (nuevoTarifaA) {
      nuevoTarifaA.addEventListener('change', function() {
          var selectedOption = this.options[this.selectedIndex];
          var descripcion = selectedOption.getAttribute('data-descripcion');
          var monto = selectedOption.getAttribute('data-monto');
          document.getElementById('nuevoMontoB').value = monto || ''; 
          document.getElementById('nuevoDetalle').value = descripcion || '';
      });
  }

  // Comprobar si el elemento con id editarTarifaA existe antes de agregar el event listener
  var editarTarifaA = document.getElementById('editarTarifaA');
  if (editarTarifaA) {
      editarTarifaA.addEventListener('change', function() {
          var selectedOption = this.options[this.selectedIndex];
          var descripcion = selectedOption.getAttribute('data-descripcionA');
          var monto = selectedOption.getAttribute('data-montoA');
          document.getElementById('editarMontoB').value = monto || ''; 
          document.getElementById('editarDetalle').value = descripcion || '';
      });
  }

  // Manejar el evento para el checkbox "Cobrar a todos"
  var cobrarTodos = document.getElementById('cobrarTodos');
  if (cobrarTodos) {
      cobrarTodos.addEventListener('change', function() {
          var selectUsuarios = $('#nuevoUsuarioC');
          if (this.checked) {
              var allOptions = selectUsuarios.find('option').map(function() {
                  return $(this).val();
              }).get();
              selectUsuarios.val(allOptions).trigger('change');
          } else {
              selectUsuarios.val(null).trigger('change');
          }
      });
  }
});

/*=============================================
EDITAR COBRO
=============================================*/
$(document).on("click", ".btnEditarCobro", function() {
  var idCobro = $(this).attr("idCobro");
  var datos = new FormData();
  datos.append("idCobro", idCobro);

  $.ajax({
      url: "ajax/cobro.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
          $("#idcobro_base").val(respuesta["idcobro_base"]);
          $("#mostrarUsuarioC").val(respuesta["nombres"] + " " + respuesta["apellidos"]);
          $("#editarUsuarioC").val(respuesta["idusuario_contador"]);
          $("#editarTarifaA").val(respuesta["idtarifa"]);
          $("#editarDetalle").val(respuesta["detalle"]);
          $("#editarMontoB").val(respuesta["monto_base"]);
          $("#editarTipoCobro").html(respuesta["tipo_cobro"]);
          $("#editarTipoCobro").val(respuesta["tipo_cobro"]);
          $("#editarFechaCobro").val(respuesta["fecha_cobro"]);
      }
  });
});

/*=============================================
ELIMINAR COBROS
=============================================*/
$(document).on("click", ".btnEliminarCobroS", function(){
  var idCobro = $(this).attr("idCobro");

  swal({
      title: '¿Está seguro de borrar el exceso?',
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar exceso!'
  }).then(function(result){
      if(result.value){
          window.location = "index.php?ruta=crear-cobros&idCobro="+idCobro;
      }
  });
});

/*=============================================
IMPRIMIR TICKET
=============================================*/
$(document).on("click", ".btnImprimirTicketC", function() {
  var idCobro = $(this).attr("idCobro"); 
  window.location = "http://localhost/proyecto_agua1/extensiones/ticketcobroC.php?idCobro=" + idCobro;
});
