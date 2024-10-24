<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Usuarios del sistema
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Usuarios del sistema</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

      </div>
      <!-- cuerpo de la pagina-->
      <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Email</th>
           <th>Perfil</th>
           <th>Fecha creacion</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <tr>
          
        <td>1</td>
        <td>Leonardo</td>
        <td>admin</td>
        <td>Administrador</td>
        <td>2024-12-11 12:05:32</td>
        <td><button class="btn btn-success btn-xs">Activo</button></td>
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

<!-- MODAL AGREGAR USUARIO -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data">
    <!-- CABEZA DEL MODAL -->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Agregar Usuarios del Sistema</h4>

      </div>

      <!-- CUERPO DEL MODAL -->

      <div class="modal-body">

        <div class="box-body">

          <!-- ENTRADA PARA EL NOMBRE -->
            
          <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CORREO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Correo" id="nuevoEmail" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

        <div class="form-group">

        <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Tesorero">Tesorero</option>

                  <option value="Fontanero">Fontanero</option>

                  <option value="Secretario">Secretari@</option>

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