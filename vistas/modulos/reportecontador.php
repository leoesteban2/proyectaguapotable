<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reporte Asignanción
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reporte Asignanción</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">


      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Apellidos</th>
           <th>No_Contador</th>
           <th>Fecha de Asignación</th>
           <th>Fecha de Actualización</th>
           <th>Fecha de Desasignacion</th>
           <th>Estado</th>

         </tr> 

        </thead>

        <tbody>

        <?php
         $item = null;
         $valor = null;

         $usuario_contador_historial = ControladorReporteContador::ctrMostrarReporteContador ($item, $valor);

         foreach ($usuario_contador_historial as $key => $value){

        echo'<tr>
          
        <td>'.($key+1).'</td>
        <td>'.$value["nombres"].'</td>
        <td>'.$value["apellidos"].'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["fecha_asignacion"].'</td>
        <td>'.$value["fecha_cambio"].'</td>
        <td>'.$value["fecha_desasignacion"].'</td>
        <td>'.$value["estado"].'</td>


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


      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

        </div>

      </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

        </div>

  </form>

    </div>

  </div>

</div>