<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cobros
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Cobros</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCobro">
          
          Crear Cobros

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre del Usuario</th>
           <th>No Contador</th>
           <th>Detalle</th>
           <th>Monto A PAGAR</th>
           <th>Tipo Cobro</th>
           <th>Fecha Cobro</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php
        $item = null;
        $valor = null;

        $Cobro = ControladorCobro::ctrMostrarCobro ($item, $valor);

        foreach ($Cobro as $key => $value){

          echo'<tr>
          
        <td>'.$value["idcobro_base"].'</td>
        <td>'.$value["nombres"].' '.$value["apellidos"].'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["detalle"].'</td>
        <td>Q'.$value["monto_base"].'</td>
        <td>'.$value["tipo_cobro"].'</td>
        <td>'.$value["fecha_cobro"].'</td>
        <td>'.$value["estado_cobro"].'</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning btnEditarCobro" idCobro="'.$value["idcobro_base"].'
          " data-toggle="modal" data-target="#modalEditarCobro"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btnEliminarCobroS" 
            idCobro="'.$value["idcobro_base"].'">
            <i class="fa fa-times"></i></button>
          
           <button class="btn btn-primary btnImprimirTicketC "  
            idCobro="'.$value["idcobro_base"].'"><i class="fa fa-file-text-o"></i></button>
          </div>

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

<!-- MODAL AGREGAR COBRO -->
<div id="modalAgregarCobro" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Cobro</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">






<!-- INGRESAR TARIFA -->
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
    <select class="form-control input-lg" id="nuevoTarifaA" name="nuevoTarifaA" required>
      <option value="">Agregar Tarifa a Cobrar</option>
      <?php
      $item = null;
      $valor = null;
      $UsuariosProyectoA = ControladorTarifa::ctrMostrarTarifa($item, $valor);
      foreach ($UsuariosProyectoA as $key => $value) {
          echo '<option value="'.$value["idtarifa"].'" 
                        data-descripcion="'.$value["descripcion"].'" 
                        data-monto="'.$value["tarifa_metro_cubico"].'">
                '.$value["descripcion"].'</option>';
      }
      ?>
    </select>
  </div>
</div>

<!-- Campo oculto para el detalle de la tarifa -->
<input type="hidden" name="nuevoDetalle" id="nuevoDetalle" value="">

<!-- Campo de monto -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
        <input type="text" class="form-control input-lg" name="nuevoMontoB" id="nuevoMontoB" value="" placeholder="Total a Pagar" required readonly>
    </div>
</div>


         <!-- ENTRADA DEL usuario_contador -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
        <select class="form-control input-lg" name="nuevoUsuarioC" id="nuevoUsuarioC" >
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

<!-- Checkbox para cobrar a todos los usuarios -->
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" id="cobrarTodos" name="cobrarTodos" value="1">
            Cobrar a todos los usuarios
        </label>
    </div>
</div>


 <!-- ENTRADA PARA SELECCIONAR TIPO DE COBRO -->

 <div class="form-group">

<div class="input-group">
      
        <span class="input-group-addon"><i class="fa fa-check-square-o"></i></span> 

        <select class="form-control input-lg" name="nuevoTipoCobro">
          
          <option value="">Selecionar Tipo de Cobro</option>

          <option value="mensual">mensual</option>

          <option value="anual">anual</option>

          <option value="unico">unico</option>

        </select>

      </div>

</div>

            <!-- ENTRADA PARA LA FECHA DE COBRO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaCobro" required>

              </div>

            </div>


        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <!-- BOTONES GENERICOS -->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <!-- BOTON DE ENVIO -->
          <button type="submit" class="btn btn-primary">Realizar Cobro</button>

        </div>

  </form>
  
  <?php

$crearCobro = new ControladorCobro();
$crearCobro -> ctrCrearCobroBase();

?>
    </div>

  </div>

</div>

<!-- MODAL EDITAR COBRO -->
<div id="modalEditarCobro" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Cobro</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">


<input type="hidden" name="idcobro_base" id="idcobro_base" require>

<!-- Campo oculto para el id tarifa -->
<input type="hidden"  name="editarTarifaA" id="editarTarifaA" value="">

<!-- Campo oculto para el detalle usuario_contador-->
<input type="hidden" name="editarUsuarioC" id="editarUsuarioC" value="">


<!-- Campo de detalle -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
        <input type="text" class="form-control input-lg" name="editarDetalle" id="editarDetalle" value="" required readonly>
    </div>
</div>

<!-- Campo de monto -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-money"></i></span>
        <input type="text" class="form-control input-lg" name="editarMontoB" id="editarMontoB" value="" required readonly>
    </div>
</div>


<!-- Campo de usuario -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control input-lg" name="mostrarUsuarioC" id="mostrarUsuarioC" value="" required readonly>
    </div>
</div>



 <!-- ENTRADA PARA SELECCIONAR TIPO DE COBRO -->

 <div class="form-group">

<div class="input-group">
      
        <span class="input-group-addon"><i class="fa fa-check-square-o"></i></span> 

        <select class="form-control input-lg" name="editarTipoCobro">
          
        <option value="" id="editarTipoCobro"></option>

          <option value="mensual">mensual</option>

          <option value="anual">anual</option>

          <option value="unico">unico</option>

        </select>

      </div>

</div>

            <!-- EDITAR LA FECHA DE COBRO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFechaCobro" id="editarFechaCobro"
                value="" required>

              </div>

            </div>


        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <!-- BOTONES GENERICOS -->
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <!-- BOTON DE ENVIO -->
          <button type="submit" class="btn btn-primary">Editar Cobro</button>

        </div>

  </form>
<?php

$editarCobro = new ControladorCobro();
$editarCobro -> ctrEditarCobroBase();

?>
  
    </div>

  </div>

</div>

<?php

$borrarCobro= new ControladorCobro();
$borrarCobro -> ctrBorrarCobroBase();
?>