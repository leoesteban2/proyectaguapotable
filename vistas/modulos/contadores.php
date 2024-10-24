<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Contador
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Contador</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarContador">
          
          Agregar Contador

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>No_Contador</th>
           <th>Descripcion</th>
           <th>Fecha de Instalacion</th>
           <th>Fecha de Ultimo Mantenimiento</th>
           <th>Lectura Acual</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $contador = ControladorContador::ctrMostrarContador ($item, $valor);

        foreach ($contador as $key => $value){


           echo'<tr>
          
        <td>'.($key+1).'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["descripcion"].'</td>
        <td>'.$value["fecha_instalacion"].'</td>
        <td>'.$value["ultimo_mantenimiento"].'</td>
        <td>'.$value["lectura_actual"].'</td>
        <td>'.$value["estado"].'</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning btnEditarContador" idContador="'.$value["idcontador"].'
          " data-toggle="modal" data-target="#modaleditarContador"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger btnEliminarContador" 
            idContador="'.$value["idcontador"].'">
            <i class="fa fa-times"></i></button>

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

<!-- MODAL AGREGAR CONTADOR -->
<div id="modalAgregarContador" class="modal fade" role="dialog">

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

            <!-- ENTRADA PARA EL NO. DE CONTADOR-->

                <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNo_contador"
                        placeholder="Ingresar No. de contador" id="nuevoNo_contador" minlength="8" 
                        maxlength="20" required>
              </div>

              </div>


          <!-- ENTRADA PARA EL DESCRIPCION -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDescripcion" 
                placeholder="Ingresar Descripción" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE INSTALACION-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFecha_instalacion" 
                placeholder="Ingresar Fecha de Instalacion" required>

              </div>

            </div>

          <!-- ENTRADA PARA LA FECHA DE ULTIMO MANTENIMIENTO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoUltimo_mantenimiento" 
                placeholder="Ingresar Fecha del Ultimo Mantenimiento" required>

              </div>

            </div>

            
            <!-- ENTRADA PARA EL NUMERO DE LECTURA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tachometer"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoLecturaActual" 
                placeholder="Ingresar Lectura Actual"  min="0" step="1" required>

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
          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

  </form>


  <?php

    $crearContador = new ControladorContador();
    $crearContador -> ctrCrearContador();

?>

    </div>

  </div>

</div>

<!-- MODAL EDITAR CONTADOR -->
<div id="modaleditarContador" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Contador</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

            <!-- ENTRADA PARA EL NO. DE CONTADOR-->

                <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNo_contador"
                        id="editarNo_contador" value="" minlength="8" 
                        maxlength="20" required>
              </div>

              </div>


          <!-- ENTRADA PARA EL DESCRIPCION -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" 
                id="editarDescripcion" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE INSTALACION-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFecha_instalacion" 
                id="editarFecha_instalacion" value="" required>

              </div>

            </div>

          <!-- ENTRADA PARA LA FECHA DE ULTIMO MANTENIMIENTO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="editarUltimo_mantenimiento" 
                id="editarUltimo_mantenimiento" value="" required>

              </div>

            </div>

            
            <!-- ENTRADA PARA EL NUMERO DE LECTURA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tachometer"></i></span> 

                <input type="number" class="form-control input-lg" name="editarLecturaActual" 
                id="editarLecturaActual" value=""  min="0" step="1" required>

                <input type="hidden" name="idcontador" id="idcontador" require>

              </div>

            </div>

            <!-- EDITAR ESTADO -->
            <div class="form-group">

            <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-check"></i></span> 

            <select class="form-control input-lg" name="editarEstado">

            <option value="" id="editarEstado"></option>

            <option value="ACTIVO">ACTIVO</option>

            <option value="INACTIVO">INACTIVO</option>

            <option value="MANTENIMIENTO">MANTENIMIENTO</option>

            <option value="RETIRADO">RETIRADO</option>

            <option value="CANDELA">CANDELA</option>

            </select>

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
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

  </form>

  <?php

    $editarContador = new ControladorContador();
    $editarContador -> ctrEditarContador();

  ?>

    </div>

  </div>

</div>
<?php

  $borrarContador = new ControladorContador();
  $borrarContador -> ctrBorrarContador();

?> 
