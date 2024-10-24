<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" >
    <?php
// Verificar si el perfil contiene alguna de las palabras clave
if(strpos($_SESSION["perfil"], "Administrador") !== false || 
   strpos($_SESSION["perfil"], "Secretari@") !== false || 
   strpos($_SESSION["perfil"], "Tesorero") !== false){

    // Incluir el archivo del tablero superior
    include "inicio/tablero-superior.php";

} else {
    // Si el perfil no coincide, mostrar mensaje de bienvenida
    echo '<h1>Bienvenido '.$_SESSION["nombre"].'</h1>';
}
?>
    </div>

    <div class="row">

    <div class="col-lg-12">

    <?php
    include "inicio/grafico-consumo.php";

    ?>

    </div>

    </div>


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->