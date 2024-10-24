<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Lectura Contador
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Lectura Contador</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarContador">
          
          Agregar Lectura

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>No de Orden</th>
           <th>No_Contador</th>
           <th>Fecha de Lectura</th>
           <th>Lectura Anterior</th>
           <th>Lectura Actual</th>
           <th>Consumo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
$item = null;
$valor = null;

$Lectura = ControladorLectura::ctrMostrarLectura($item, $valor);

foreach ($Lectura as $key => $value) {
    echo '<tr>
        <td>' . $value["idlectura"] . '</td>
        <td>' . $value["no_orden"] . '</td>
        <td>' . $value["no_contador"] . '</td>
        <td>' . $value["fecha_lectura"] . '</td>
        <td>' . $value["lectura_anterior"] . '</td>
        <td>' . $value["lectura_actual"] . '</td>';
    echo '<td style="color:' . ($value["consumo"] > 40 ? 'red' : ($value["consumo"] < 40 ? 'green' : 'black')) . ';">' . $value["consumo"] . '</td>';
    
    echo '<td>
        <div class="btn-group">
                        <button class="btn btn-danger btnEliminarLectura" 
            idLectura="'.$value["idlectura"].'">
            <i class="fa fa-times"></i></button>';

    // Verificamos si hay cobro de exceso
    $cobroExceso = ControladorExceso::ctrMostrarExceso('idlectura', $value["idlectura"]);

    // Si existe un cobro de exceso, mostramos el botón de imprimir ticket
    if ($cobroExceso) {
        echo '<a href="extensiones/ticketcobro.php?idCobro=' . $cobroExceso["idcobro"] . '" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a>';

        // Botón que redirige a la página de pagos
        echo '<a href="pagos" class="btn btn-success"><i class="fa fa-money"></i> Pagar</a>';
    }

    echo '</div>
        </td>
    </tr>';
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

<!-- MODAL AGREGAR LECTURA -->
<div id="modalAgregarContador" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Contenido del Modal -->
    <div class="modal-content">
      <!-- Formulario -->
      <form role="form" method="post" enctype="multipart/form-data">
        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Lectura</h4>
        </div>
        
        <!-- CUERPO DEL MODAL -->
        <div class="modal-body">
          <div class="box-body">

            <!-- EDITAR DEL USUARIO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" id="nuevoUsuarioA" name="nuevoUsuarioA" required>
                  <option value="">Seleccionar Usuario</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $UsuariosProyectoA = ControladorAsignacion::ctrMostrarAsignacion($item, $valor);
                  foreach ($UsuariosProyectoA as $key => $value) {
                      echo '<option value="'.$value["idusuario_contador"].'" 
                              data-no-contador="'.$value["no_contador"].'" 
                              data-lectura-actual="'.$value["lectura_actual"].'">
                              '.$value["no_orden"].' - '.$value["nombres"].' '.$value["apellidos"].'</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            
            <!-- ENTRADA PARA EL NO. DE CONTADOR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                <input type="text" class="form-control input-lg" name="editarNo_contadorA" id="editarNo_contadorA" value="" minlength="8" maxlength="20" placeholder="Número de Contador" required readonly>
              </div>
            </div>

            <!-- ENTRADA PARA EL NÚMERO DE LECTURA ANTERIOR -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
                <input type="number" class="form-control input-lg" id="nuevoLecturaAnteriorA" name="nuevoLecturaAnteriorA" placeholder="Número de Lectura Anterior" min="0" step="1" required readonly>
                </div>
            </div>

            <!-- ENTRADA PARA LA FECHA DE LECTURA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <input type="date" class="form-control input-lg" name="nuevoFecha_Lectura" placeholder="Ingresar Fecha de Lectura" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NUMERO DE LECTURA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tachometer"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoLecturaActual" placeholder="Ingresar Número de Lectura Actual"  min="0" step="1" required>
              </div>
            </div>

          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Lectura</button>
        </div>

        <?php
        // Llamada al controlador para crear la lectura
        $crearLectura = new ControladorLectura();
        $crearLectura->ctrCrearLectura();
        ?>

      </form>
    </div>
  </div>
</div>

<?php

$borrarLectura= new ControladorLectura();
$borrarLectura -> ctrBorrarLectura();
?>