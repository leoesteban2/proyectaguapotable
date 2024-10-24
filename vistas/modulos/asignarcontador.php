<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Asignar Contador
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Asignar Contador</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarContador">
          
          Asignar Contador

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Apellidos</th>
           <th>Telefono</th>
           <th>No. Contador</th>
           <th>Fecha de asignacion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

      <?php
              $item = null;
              $valor = null;
      
              $usuario_contador = ControladorAsignacion::ctrMostrarAsignacion ($item, $valor);

              foreach ($usuario_contador as $key => $value){

                echo' <tr>
          
       <td>'.($key+1).'</td>
          <td>'.$value["nombres"].'</td>
          <td>'.$value["apellidos"].'</td>
          <td>'.$value["telefono"].'</td>
          <td>'.$value["no_contador"].'</td>
          <td>'.$value["fecha_asignacion"].'</td>
        <td>
          <div class="btn-group">
<button class="btn btn-warning btneditarAsignacion" idUsuario_Contador="'.$value["idusuario_contador"].'" 
data-toggle="modal" data-target="#modaleditarAsignacion"><i class="fa fa-pencil"></i></button>
             <button class="btn btn-danger btnEliminarAsignacion" 
            idUsuario_Contador="'.$value["idusuario_contador"].'"><i class="fa fa-times"></i></button>

          </div>
          
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

<!-- MODAL AGREGAR CONTADOR -->
<div id="modalAsignarContador" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Contador</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">


<!-- ENTRADA DEL usuario -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
        <select class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" require>
            <option value="">Seleccionar Usuario</option>
            <?php
            $item = null;
            $valor = null;

            // Obtener la lista de usuarios del proyecto
            $UsuariosProyecto = ControladorUsuariosProyecto::ctrMostrarUsuariosProyecto($item, $valor);

            // Recorrer cada usuario y generar opciones
            foreach ($UsuariosProyecto as $key => $value) {
                echo '<option value="'.$value["idusuario"].'">
                '.$value["no_orden"].' - '.$value["nombres"].' '.$value["apellidos"].'</option>';
            }
            ?>
        </select>
    </div>
</div>

            <!-- ENTRADA PARA EL NO. DE CONTADOR fa fa-sort-numeric-asc-->

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
        <select class="form-control input-lg" name="nuevoContador" id="nuevoContador" require>
            <option value="">Seleccionar Contador</option>
            <?php
            $item = null;
            $valor = null;

            // Obtener la lista de contadores
            $contador = ControladorContador::ctrMostrarContador ($item, $valor);

            // Recorrer cada usuario y generar opciones
            foreach ($contador as $key => $value) {
                echo '<option value="'.$value["idcontador"].'">
                '.$value["no_contador"].' - '.$value["estado"].'</option>';
            }
            ?>
        </select>
    </div>
</div>
                     

            <!-- ENTRADA PARA LA FECHA DE INSTALACION-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevofecha_Asignacion" id="nuevofecha_Asignacion"
                placeholder="Ingresar Fecha de Asignación" required>

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
          <button type="submit" class="btn btn-primary">Asignar Contador</button>

        </div>
        <?php

        $crearAsignacion = new ControladorAsignacion();
        $crearAsignacion -> ctrCrearAsignacion();


        ?>

  </form>

    </div>

  </div>

</div>

<!-- MODAL EDITAR ASIGNACION -->
<div id="modaleditarAsignacion" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Asignacion</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">


<!-- ENTRADA DEL usuario -->
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
        <select class="form-control input-lg" id="editarUsuario" name="editarUsuario"  >
            <option value="" disabled selected >Seleccionar Usuario</option>
            <?php
            $item = null;
            $valor = null;

            // Obtener la lista de usuarios del proyecto
            $UsuariosProyecto = ControladorUsuariosProyecto::ctrMostrarUsuariosProyecto($item, $valor);

            // Recorrer cada usuario y generar opciones
            foreach ($UsuariosProyecto as $key => $value) {
                echo '<option value="'.$value["idusuario"].'">
                '.$value["no_orden"].' - '.$value["nombres"].' '.$value["apellidos"].'</option>';
            }
            ?>
        </select>
    </div>
</div>

            <!-- ENTRADA PARA EL NO. DE CONTADOR fa fa-sort-numeric-asc-->

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
        <select class="form-control input-lg" id="editarContador" name="editarContador" >
            <option value="" disabled selected>Seleccionar Contador</option>
            <?php
            $item = null;
            $valor = null;

            // Obtener la lista de contadores desde el controlador
            $contador = ControladorContador::ctrMostrarContador($item, $valor);

            // Generar opciones dinámicas
            foreach ($contador as $key => $value) {
                echo '<option value="'.$value["idcontador"].'">
                '.$value["no_contador"].' - '.$value["estado"].'</option>';
            }
            ?>
        </select>
    </div>
</div>
                     

            <!-- ENTRADA PARA LA FECHA DE INSTALACION-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarfecha_Asignacion" 
                id="editarfecha_Asignacion" valvue="" required>

                <input type="hidden" name="idusuario_contador" id="idusuario_contador" require>

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
          <button type="submit" class="btn btn-primary">Editar Asignacion</button>

        </div>
        
<?php

$editarAsignacion = new ControladorAsignacion();
$editarAsignacion -> ctrEditarAsignacion();

?>

  </form>

    </div>

  </div>

</div>
<?php

  $borrarAsignacion = new ControladorAsignacion();
  $borrarAsignacion -> ctrBorrarAsignacion();

?> 