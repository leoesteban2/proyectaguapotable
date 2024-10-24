<div class="content-wrapper">
  <section class="content-header">
    <h1>Buscar Estado de Cuenta</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Ingrese el No. Orden del Usuario</h3>
      </div>

      <div class="box-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="noOrden">No. Orden</label>
            <input type="text" class="form-control" id="noOrden" name="noOrden" placeholder="Ingresar No. Orden" required>
          </div>
          <button type="submit" class="btn btn-primary">Buscar Estado de Cuenta</button>
        </form>
      </div>

      <div class="box-body">
        <?php
          if (isset($_POST["noOrden"])) {
              $noOrden = $_POST["noOrden"];
              $estadoCuenta = ControladorEstadoCuenta::ctrMostrarEstadoCuenta($noOrden);

              // Si encontramos registros, mostramos la tabla
              if ($estadoCuenta) {
                  echo '<div class="table-responsive">'; // Clase para hacer la tabla responsive
                  echo '<table class="table table-bordered table-striped dt-responsive tablas" width="100%">'; // Clase para hacerla responsive y con las clases sugeridas
                  echo '<thead><tr><th>No. Orden</th><th>Nombre</th><th>No. Contador</th><th>Fecha</th><th>No. Documento</th><th>Detalle</th><th>Cargo</th><th>Abono</th><th>Saldo</th></tr></thead>';
                  echo '<tbody>';
                  foreach ($estadoCuenta as $row) {
                      echo '<tr>';
                      echo '<td>' . $row['no_orden'] . '</td>';
                      echo '<td>' . $row['nombre'] . '</td>';
                      echo '<td>' . $row['no_contador'] . '</td>';
                      echo '<td>' . date('d/m/Y', strtotime($row['fecha'])) . '</td>';
                      echo '<td>' . $row['No.Documento'] . '</td>';
                      echo '<td>' . $row['detalle'] . '</td>';
                      echo '<td>Q ' . number_format($row['cargo'], 2) . '</td>';
                      echo '<td>Q ' . number_format($row['abono'], 2) . '</td>';
                      echo '<td>Q ' . number_format($row['saldo'], 2) . '</td>';
                      echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>'; // Cierre del div table-responsive
                  
                  // Botón para imprimir el estado de cuenta
                  echo '<a href="extensiones/imprimirEstadoCuenta.php?noOrden=' . $noOrden . '" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Imprimir Estado de Cuenta</a>';
              } else {
                  echo '<p>No se encontró el estado de cuenta para el No. Orden: ' . $noOrden . '</p>';
              }
          }
        ?>
      </div>
    </div>
  </section>
</div>
