<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Pagos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Pagos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalRealizarPago">
          
          Realizar Pagos

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>No_Orden</th>
           <th>Nombre</th>
           <th>No_Contador</th>
           <th>Detalle</th>
           <th>No.Cobro Exceso</th>
           <th>No.Cobro</th>
           <th>Monto Pagado</th>
           <th>Fecha Pagado</th>
           <th>Tipo de Pago</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
            $item = null;
            $valor = null;
        
            $Pagos = ControladorPagos::ctrMostrarPagos ($item, $valor);

            foreach ($Pagos as $key => $value){

                echo' <tr>
          
        <td>'.$value["idpago"].'</td>
        <td>'.$value["no_orden"].'</td>
        <td>'.$value["nombres"].' '.$value["apellidos"].'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["detalle"].'</td>
        <td>'.$value["idcobro"].'</td>
        <td>'.$value["idcobro_base"].'</td>
        <td>Q'.$value["monto_pagado"].'</td>
        <td>'.$value["fecha_pago"].'</td>
        <td>'.$value["tipo_pago"].'</td>
        <td>
          <div class="btn-group">
        <button class="btn btn-warning btnEditarPago" idPago="'.$value["idpago"].'" data-toggle="modal" 
        data-target="#modalEditarPago">
         <i class="fa fa-pencil"></i></button>

            <button class="btn btn-danger btnEliminarPago" 
            idPago="'.$value["idpago"].'">
            <i class="fa fa-times"></i></button>';

          echo '<a href="extensiones/ticketpago.php?idPago=' . $value["idpago"] . '
          " target="_blank" class="btn btn-success">';
          echo '<i class="fa fa-file-text-o"></i></a>';
          echo '</div>

          </div>
          
        </td>

        </tr>
                
                
                ';
            }

        ?>

        </tbody>

      </table>

      </div>

    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL REALIZAR PAGO -->
<div id="modalRealizarPago" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" method="post" enctype="multipart/form-data">
        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Realizar Pago</h4>
        </div>

<!-- CUERPO DEL MODAL -->
<div class="modal-body">
    <div class="box-body">
        <!-- SELECCIONAR USUARIO DEL PROYECTO -->
        <div class="form-group">
            <label for="nuevoUsuarioC">Seleccionar Usuario</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="nuevoUsuarioP" id="nuevoUsuarioP" onchange="cargarCobrosPendientes()">
                    <option value="">Seleccionar Usuarios</option>
                    <?php
                    $item = null;
                    $valor = null;

                    // Obtener la lista de usuarios del proyecto
                    $Usuarios_Proyecto = ControladorAsignacion::ctrMostrarAsignacion($item, $valor);

                    // Recorrer cada usuario y generar opciones
                    foreach ($Usuarios_Proyecto as $key => $value) {
                        echo '<option value="'.$value["idusuario_contador"].'">
                        '.$value["no_orden"].' - '.$value["nombres"].' '.$value["apellidos"].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

<!-- LISTA DE COBROS PENDIENTES (DINÁMICAMENTE CARGADA) -->
<div class="form-group">
    <label for="cobrosPendientes">Cobros Pendientes</label>
    <div id="cobrosPendientes" name="cobrosPendientes"  class="checkbox-group" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
        <!-- Los checkboxes se cargarán aquí usando AJAX -->
    </div>
</div>

<!-- CAMPO PARA DETALLE DEL PAGO -->
<div class="form-group">
    <label for="detalle_pago">Detalle del Pago</label>
    <textarea class="form-control" name="detalle_pago" id="detalle_pago" rows="3" placeholder="Ingrese el detalle del pago"></textarea>
</div>
            

<!-- ENTRADA PARA EL MONTO A PAGAR -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
        <input type="number" class="form-control input-lg" name="monto_pagado" id="montoPagado" placeholder="Monto a Pagar" min="0" step="0.01" required readonly>
    </div>
</div>

<!-- Inputs ocultos para guardar el idcobro y el idcobro_base -->
<input type="hidden" name="idcobro" id="idcobro" value="">
<input type="hidden" name="idcobro_base" id="idcobro_base" value="">



<!-- CAMPO PARA TIPO DE COBRO SELECCIONADO -->
<div class="form-group">
    <label for="tipoCobroSeleccionado">Tipo de Cobro</label>
    <textarea class="form-control" name="tipoCobroSeleccionado" id="tipoCobroSeleccionado" rows="1" placeholder="Tipo de Cobro" readonly></textarea>
</div>



            <!-- FECHA DE PAGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control input-lg" name="fecha_pago" required>
              </div>
            </div>
          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <!-- BOTONES GENERICOS -->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <!-- BOTON DE ENVIO -->
          <button type="submit" class="btn btn-primary">Realizar Pago</button>
        </div>
      </form>

      <?php

$crearPago = new ControladorPagos();
$crearPago -> ctrCrearPagos();

?>
    </div>
  </div>
</div>

<!-- MODAL EDITAR PAGO -->
<div id="modalEditarPago" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Pago</h4>
        </div>

        <!-- CUERPO DEL MODAL -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Campo de usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="mostrarUsuarioE" id="mostrarUsuarioE" value="" required readonly>
              </div>
            </div>

            <!-- Campo oculto para el ID del pago -->
            <input type="hidden" name="idpago" id="idpago" required>


            <!-- ENTRADA PARA EL NO. DE CONTADOR-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa  fa-dashboard"></i></span> 
                <input type="text" class="form-control input-lg" name="editarNo_contadorE" id="editarNo_contadorE" minlength="8" maxlength="20" readonly>
              </div>
            </div>

            <!-- CAMPO PARA DETALLE DEL PAGO -->
            <div class="form-group">
              <label for="detalle_pago">Detalle del Pago</label>
              <textarea class="form-control" name="detalle_pagoE" id="detalle_pagoE" rows="3" placeholder="Ingrese el detalle del pago" readonly></textarea>
            </div>

            <!-- ENTRADA PARA EL MONTO A PAGAR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="number" class="form-control input-lg" name="monto_pagadoE" id="montoPagadoE" placeholder="Monto a Pagar" min="0" step="0.01" required readonly>
              </div>
            </div>

            <!-- SELECCIÓN DE TIPO DE PAGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select class="form-control input-lg" name="tipo_pagoE" id="tipo_pago" required>
                  <option value="mensual">Mensual</option>
                  <option value="anual">Anual</option>
                  <option value="unico">Único</option>
                  <option value="exceso">Exceso</option>
                </select>
              </div>
            </div>

            <!-- FECHA DE PAGO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control input-lg" name="fecha_pagoE" id="fecha_pagoE" required>
              </div>
            </div>
          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Pago</button>
        </div>
      </form>

      <?php

        $editarPago = new ControladorPagos();
        $editarPago -> ctrEditarPagos();
    ?>
    </div>
  </div>
</div>

<?php

$borrarPago= new ControladorPagos();
$borrarPago -> ctrBorrarPago();
?>