
<div class="login-box">

  <div class="login-logo">
  <img src="vistas/img/plantilla/proyecto_agua.png" 
  class="img-responsive" style="padding:30px 100px 0px 100px">

  </div>

  <!-- /.login-logo -->
<div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

      <input type="text" class="form-control" placeholder="Correo" name="ingEmail" required autocomplete="username">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

      <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" require autocomplete="current-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>
        
      </div>


      <?php

     $login = new ControladorUsuarios();
      $login -> ctrIngresoUsuario();

      ?>



    </form>

 <!--    <a href="#">Olvide mi contraseña?</a><br> -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->