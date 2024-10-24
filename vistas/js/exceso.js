/*=============================================
ELIMINAR COBRO
=============================================*/
$(document).on("click", ".btnEliminarCobro", function(){

	var idCobro = $(this).attr("idCobro");
  
	swal({
	  title: '¿Está seguro de borrar el exceso?',
	  text: "¡Si no lo está puede cancelar la accíón!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar exceso!'
	}).then(function(result){
  
	  if(result.value){
  
		window.location = "index.php?ruta=exceso&idCobro="+idCobro;
  
	  }
  
	})
  
  });
