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

        <tr>
          
        <td>1</td>
        <td>1815013286</td>
        <td>Contador principal en Barrio Central</td>
        <td>2023-12-11</td>
        <td>2024-12-11</td>
        <td>144</td>
        <td>ACTIVO</td>
        <td>
          <div class="btn-group">
            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger"><i class="fa fa-times"></i></button>

          </div>
          
        </td>

        </tr>

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

                <input type="text" class="form-control input-lg" name="nuevoNombre" 
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
                placeholder="Ingresar Número de Lectura Actual"  min="0" step="1" required>

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

       <option value="INACTIVO">MANTENIMIENTO</option>

       <option value="INACTIVO">RETIRADO</option>

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
          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

  </form>

    </div>

  </div>

</div>