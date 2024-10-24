<?php
    $totalUsuarios = ControladorUsuariosProyecto::ctrContarUsuarios();
    $totalContadores = ControladorContador::ctrContarContadores();
    $totalCertificados = ControladorCertificado::ctrContarCertificados();
    $totalLecturas = ControladorLectura::ctrContarLecturas();



?>



<div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <h3><?php echo $totalUsuarios['total']; ?></h3>

              <p>USUARIOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="usuariosproyecto" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <h3><?php echo $totalContadores['total']; ?></h3>

              <p>CONTADORES</p>
            </div>
            <div class="icon">
              <i class="ion ion-settings"></i>
            </div>
            <a href="contadores" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <h3><?php echo $totalCertificados['total']; ?></h3>

              <p>CERTIFICADO</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="certificado" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <h3><?php echo $totalLecturas['total']; ?></h3>


              <p>LECTURAS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="lectura" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
      </div>