<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Excesos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Excesos</li>
    
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
           <th>No de Lectura</th>
           <th>Nombre del Usuario</th>
           <th>No de contador</th>
           <th>Detalle</th>
           <th>Exceso Menor</th>
           <th>Exceso Mayor</th>
           <th>Total Exceso</th>
           <th>Total A PAGAR</th>
           <th>Tipo de Cobro</th>
           <th>Fecha de Cobro</th>
           <th>ESTADO</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $Exceso = ControladorExceso::ctrMostrarExceso ($item, $valor);

        foreach ($Exceso as $key => $value){
          
        echo'        <tr>
          
        <td>'.$value["idcobro"].'</td>
        <td>'.$value["idlectura"].'</td>
        <td>'.$value["nombres"].'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["detalle"].'</td>
        <td>'.$value["exceso_menor"].'</td>
        <td>'.$value["exceso_mayor"].'</td>
        <td>'.$value["total_exceso"].'</td>
        <td>'.$value["total_a_pagar"].'</td>
        <td>'.$value["tipo_cobro"].'</td>
        <td>'.$value["fecha_cobro"].'</td>
        <td>'.$value["estado_cobro"].'</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-danger btnEliminarCobro" 
            idCobro="'.$value["idcobro"].'">
            <i class="fa fa-times"></i></button>';

         echo '<a href="extensiones/ticketcobro.php?idCobro=' . $value["idcobro"] . '" target="_blank" 
         class="btn btn-primary">';
        echo '<i class="fa fa-file-text-o"></i></a>';
         echo' </div>
          
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

<!-- MODAL EDITAR EXCESO -->
<div id="modalAgregarContador" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Exceso</h4>

      </div>

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
<?php

  $borrarExceso = new ControladorExceso();
  $borrarExceso -> ctrBorrarExceso();

?> 
