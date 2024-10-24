<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Usuarios del Proyecto
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Usuarios del Proyecto</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuarioProyecto">
          
          Agregar usuarios del proyecto

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablaUsuariosProyecto" id="tablaUsuariosProyecto"
       width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Apellidos</th>
           <th>Telefono</th>
           <th>DPI</th>
           <th>Dirección</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>



      </table>

      </div>

    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL AGREGAR USUARIOS DEL PROOYECTO-->
<div id="modalAgregarUsuarioProyecto" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" >
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Usuarios del Proyecto</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">
          
                    <!-- ENTRADA PARA EL NO. DE ORDEN-->

                    <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoOrden" placeholder="Ingresar No. de orden" id="nuevoOrden" min="1" max="1000" required>

              </div>

            </div>
          <!-- ENTRADA PARA EL NOMBRE -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

        <input type="text" class="form-control input-lg" name="nuevoNombreProyecto" placeholder="Ingresar Nombre"
         style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" required>

              </div>

            </div>

                      <!-- ENTRADA PARA EL Apellido -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApellidoProyecto" placeholder="Ingresar Apellidos"
                style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL NUMERO DE TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="tel" class="form-control input-lg" name="nuevoTelefono" 
                placeholder="Ingresar Número de Telefono" pattern="[0-9]{8,10}" maxlength="10" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL NUMERO DE DPI -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDPI" placeholder="Ingresar Número de DPI" pattern="[0-9]{13}" maxlength="13" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Dirección"
                style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" maxlength="100" required>

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
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>

        </div>


        <?php

        $crearUsuarioProyecto = new ControladorUsuariosProyecto();
        $crearUsuarioProyecto -> ctrCrearUsuarioProyecto();

        ?>

    </form>

    </div>

  </div>

</div>

<!-- MODAL EDITAR USUARIOS DEL PROOYECTO-->
<div id="modaleditarUsuarioProyecto" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" >
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar Usuario del Proyecto</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">
          
                    <!-- ENTRADA PARA EDITAR EL NO. DE ORDEN-->

                    <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 

                <input type="number" class="form-control input-lg" name="editarOrden" 
                 id="editarOrden" value="" min="1" max="1000" required>

              </div>

            </div>
          <!-- ENTRADA PARA EDITAR EL NOMBRE -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

        <input type="text" class="form-control input-lg" name="editarNombreProyecto" id="editarNombreProyecto"
         value=""
         style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" required>

              </div>

            </div>

                      <!-- ENTRADA PARA Editar EL Apellido -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarApellidoProyecto"
                 id="editarApellidoProyecto" value=""
                style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" required>

              </div>

            </div>


            <!-- ENTRADA PARA EDITAR EL NUMERO DE TELEFONO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="tel" class="form-control input-lg" name="editarTelefono" 
                id="editarTelefono" value="" pattern="[0-9]{8,10}" maxlength="10" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EDITAR EL NUMERO DE DPI -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDPI"
                id="editarDPI" value="" pattern="[0-9]{13}" maxlength="13" required>

              </div>

            </div>

            <!-- ENTRADA PARA EDITAR LA DIRECCION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" 
                id="editarDireccion"  value="" 
                style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase();" maxlength="100" required>

                <input type="hidden" name="idusuario" id="idusuario" require>
                
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
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>

        </div>

        <?php

          $editarUsuarioProyecto = new ControladorUsuariosProyecto();
          $editarUsuarioProyecto -> ctrEditarUsuarioProyecto();

          ?>


    </form>

    </div>

  </div>

</div>
<?php

  $borrarUsuarioProyecto = new ControladorUsuariosProyecto();
  $borrarUsuarioProyecto -> ctrBorrarUsuarioProyecto();

?> 