<div class="content-wrapper">
  <section class="content-header">
    <h1>Reportes de Pagos</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Filtros de búsqueda</h3>
      </div>

      <div class="box-body">
        <form method="post" action="">
          <div class="row">
            <div class="col-md-4">
              <label>Fecha Inicio:</label>
              <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Fecha Fin:</label>
              <input type="date" name="fecha_fin" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Tipo de Pago:</label>
              <select name="tipo_pago" class="form-control">
                <option value="todos">Todos</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
                <option value="unico">Único</option>
              </select>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
      </div>
    </div>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Resultados del filtro</h3>
      </div>

      <div class="box-body">
        <?php
          if (isset($_POST["fecha_inicio"]) && isset($_POST["fecha_fin"])) {
              $fecha_inicio = $_POST["fecha_inicio"];
              $fecha_fin = $_POST["fecha_fin"];
              $tipo_pago = $_POST["tipo_pago"];

              // Botón para imprimir con los filtros
              echo '<a href="extensiones/imprimir_pagos_pdf.php?fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin . '&tipo_pago=' . $tipo_pago . '" target="_blank" class="btn btn-success">';
              echo '<i class="fa fa-print"></i> Imprimir PDF</a><br><br>';

              // Llamar al controlador para obtener los resultados filtrados
              $resultados = ControladorPagos::ctrMostrarPagosF(null, null, $fecha_inicio, $fecha_fin, $tipo_pago);

              if (!empty($resultados)) {
                  echo '<div class="table-responsive">';
                  echo '<table class="table table-bordered table-striped dt-responsive tablas" width="100%">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>No. Pago</th>';
                  echo '<th>Nombre del Usuario</th>';
                  echo '<th>No Contador</th>';
                  echo '<th>No.Cobro Exceso</th>';
                  echo '<th>No.Cobro</th>';
                  echo '<th>Detalle</th>';
                  echo '<th>Monto Pagado</th>';
                  echo '<th>Tipo de Pago</th>';
                  echo '<th>Fecha de Pago</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';
                  foreach ($resultados as $row) {
                      echo '<tr>';
                      echo '<td>' . $row["idpago"] . '</td>';
                      echo '<td>' . $row["nombre_usuario"] . '</td>';
                      echo '<td>' . $row["no_contador"] . '</td>';
                      echo '<td>' . $row["idcobro"] . '</td>';
                      echo '<td>' . $row["idcobro_base"] . '</td>';
                      echo '<td>' . $row["detalle"] . '</td>';
                      echo '<td>Q ' . number_format($row["monto_pagado"], 2) . '</td>';
                      echo '<td>' . $row["tipo_pago"] . '</td>';
                      echo '<td>' . date('d/m/Y', strtotime($row["fecha_pago"])) . '</td>';
                      echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
              } else {
                  echo '<p>No se encontraron resultados para el rango de fechas y tipo de pago seleccionados.</p>';
              }
          }
        ?>
      </div>
    </div>
  </section>
</div>
