<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Tarifas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Tarifas</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTarifa">
          
          Agregar Tarifa

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Descripción</th>
           <th>Rango Consumo Minimo</th>
           <th>Rango Consumo Maximo</th>
           <th>Tarifa por metro cubico</th>
           <th>Fecha de Inicio</th>
           <th>Fecha de Fin</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;


        $tarifa = ControladorTarifa::ctrMostrarTarifa ($item, $valor);
        
        foreach ($tarifa as $key => $value){
        echo'<tr>
          
        <td>'.$value["idtarifa"].'</td>
        <td>'.$value["descripcion"].'</td>
        <td>'.$value["rango_consumo_min"].'</td>
        <td>'.$value["rango_consumo_max"].'</td>
        <td>'.$value["tarifa_metro_cubico"].'</td>
        <td>'.$value["fecha_inicio"].'</td>
        <td>'.$value["fecha_fin"].'</td>
        <td>
          <div class="btn-group">
          <button class="btn btn-warning btnEditarTarifa" idTarifa="'.$value["idtarifa"].'
          " data-toggle="modal" data-target="#modalEditarTarifa"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger btnEliminarTarifa" 
            idTarifa="'.$value["idtarifa"].'">
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

<!-- MODAL AGREGAR TARIFA -->
<div id="modalAgregarTarifa" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Tarifa</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

                    <!-- ENTRADA PARA DESCRIPCION DE TARIFA-->
            
                    <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDescripcionTarifa" 
                placeholder="Ingresar Descripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL RANGO CONSUMO MINIMO-->

                <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoRangoConsumoMinimo"
                        placeholder="Ingresar Rango Consumo Minimo"  minlength="8" 
                        maxlength="20" required>
              </div>

              </div>


            <!-- ENTRADA PARA EL RANGO CONSUMO MAXIMO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoRangoConsumoMaximo"
                        placeholder="Ingresar Rango Consumo Maximo"  minlength="8" 
                        maxlength="20" >
              </div>

              </div>


                        <!-- ENTRADA PARA TARIFA DE CONSUMO BASE-->

              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoTarifaBase"
                placeholder="Ingresar Tarifa de Consumo" min="0" max="1000" step="0.01" >


              </div>

              </div>


          


            <!-- ENTRADA PARA LA FECHA DE INICIO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaInicio" 
                placeholder="Ingresar Fecha de Inicio" required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA FECHA FINAL-->

                        <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaFin" 
                placeholder="Ingresar Fecha Fin" required>

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
          <button type="submit" class="btn btn-primary">Guardar Tarifa</button>

        </div>

        <?php

$crearTarifa = new ControladorTarifa();
$crearTarifa -> ctrCrearTarifa();

?>

  

  </form>

    </div>

  </div>

</div>

<!-- MODAL EDITAR TARIFA -->
<div id="modalEditarTarifa" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Tarifa</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

                    <!-- ENTRADA PARA EDITAR DESCRIPCION DE TARIFA-->
            
                    <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcionTarifa" id="editarDescripcionTarifa" 
                value="" required>

                <input type="hidden" name="idtarifa" id="idtarifa" require>
              </div>

            </div>

            <!-- ENTRADA PARA EL RANGO CONSUMO MINIMO-->

                <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" id="editarRangoConsumoMinimo" name="editarRangoConsumoMinimo"
                        value=""  minlength="8" 
                        maxlength="20" required>


              </div>

              </div>


            <!-- ENTRADA PARA EL RANGO CONSUMO MAXIMO-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" name="editarRangoConsumoMaximo" id="editarRangoConsumoMaximo"
                        value=""  minlength="8" 
                        maxlength="20" >
              </div>

              </div>


                        <!-- ENTRADA PARA TARIFA DE CONSUMO BASE-->

              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="number" class="form-control input-lg" id="editarTarifaBase" name="editarTarifaBase"
                value="" min="0" max="1000" step="0.01" >


              </div>

              </div>


            <!-- ENTRADA PARA LA FECHA DE INICIO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" id="editarFechaInicio" name="editarFechaInicio" 
                value="" required>

              </div>

            </div>

                        <!-- ENTRADA PARA LA FECHA FINAL-->

                        <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" id="editarFechaFin" name="editarFechaFin" 
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
          <button type="submit" class="btn btn-primary">Editar Tarifa</button>

        </div>
<?php

$editarTarifa = new ControladorTarifa();
$editarTarifa -> ctrEditarTarifa();

?>
  </form>

    </div>

  </div>

</div>

<?php

  $borrarTarifa = new ControladorTarifa();
  $borrarTarifa -> ctrBorrarTarifa();

?> 