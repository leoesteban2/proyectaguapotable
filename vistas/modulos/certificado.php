<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Certificados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Certificados</li>
    
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
           <th>DPI</th>
           <th>No. Contador</th>
           <th>No. Titulo</th>
           <th>Fecha Titulo</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $Certificado = ControladorCertificado::ctrMostrarCertificado ($item, $valor);

        foreach ($Certificado as $key => $value){

          echo' <tr>
          
        <td>'.($key+1).'</td>
        <td>'.$value["nombres"].'</td>
        <td>'.$value["apellidos"].'</td>
        <td>'.$value["dpi"].'</td>
        <td>'.$value["no_contador"].'</td>
        <td>'.$value["no_titulo"].'</td>
        <td>'.$value["fecha"].'</td>
        <td>'.$value["estado"].'</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning btnEditarCertificado" data-toggle="modal" 
          data-target="#modalEditarCertificado" idTitulo="'.$value["idtitulo"].'">
          <i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger btnEliminarCertificado" idTitulo="'.$value["idtitulo"].'">
            <i class="fa fa-times"></i></button>';
            
        echo '<a href="extensiones/basico_un_certificado.php?idTitulo=' . $value["idtitulo"] . '
        " target="_blank" class="btn btn-primary">';
        echo '<i class="fa fa-file-pdf-o"></i></a>';


         echo' </div>
          
        </td>

        </tr>

          ';

        }

        ?>

<!-- onClick="Titulo('.$row["idTitulo"].');" 
 data-toggle="modal" data-target="#modalImprimir"-->

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
<div id="modalEditarCertificado" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Certificado</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

        <!-- NOMBRE -->
        <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

        <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre"
         value="" readonly>

         <input type="hidden" name="idtitulo" id="idtitulo" require>
              </div>

            </div>

            <!-- Apellido -->
        <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

        <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido"
         value="" readonly>

              </div>

            </div>

             <!-- ENTRADA PARA EL NUMERO DE DPI -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDPI"
                id="editarDPI" value="" pattern="[0-9]{13}" maxlength="13" readonly>

              </div>

            </div>



            <!-- ENTRADA PARA EL NO. DE CONTADOR-->

                <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-dashboard"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNo_contador"
                        id="editarNo_contador" minlength="8" 
                        maxlength="20" readonly>
              </div>

              </div>


          <!-- ENTRADA PARA EL NO. DE Titulo-->

          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNo_titulo"
                        id="editarNo_titulo" minlength="1" 
                        maxlength="20" value="" required>
              </div>

              </div>

            <!-- ENTRADA PARA LA FECHA DE TITULO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFecha" id="editarFecha" 
                 required>

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
          <button type="submit" class="btn btn-primary">Editar Titulo</button>

        </div>

        <?php

$editarCertificado = new ControladorCertificado();
$editarCertificado -> ctrEditarCertificado();

?>

  </form>

    </div>

  </div>

</div>
<?php

  $borrarCertificado = new ControladorCertificado();
  $borrarCertificado -> ctrBorrarCertificado();

?> 


<!-- MODAL IMPRIMIR CERTIFICADO -->
<div id="moda4lImprimir" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- FORMULARIO DEL MODAL -->
      <form role="form" method="post" action="../extensiones/basico_un_certificado.php" enctype="multipart/form-data">
        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Imprimir Certificado</h4>
        </div>
        <!-- CUERPO DEL MODAL -->
        <div class="modal-body">
          <div class="box-body">
            <p>¿Está seguro de que desea imprimir el certificado?</p>
            <input type="hidden" id="idTitulo" name="idTitulo" value="">
          </div>
        </div>
        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Imprimir</button>
        </div>
      </form>
    </div>
  </div>
</div>
