<div class="content-wrapper">
  <section class="content-header">
    <h1>Reportes de Lecturas</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Filtros de búsqueda</h3>
      </div>

      <div class="box-body">
        <form method="post" action="">
          <div class="row">
            <div class="col-md-6">
              <label>Fecha Inicio:</label>
              <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Fecha Fin:</label>
              <input type="date" name="fecha_fin" class="form-control" required>
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
          // Verificar si los datos fueron enviados por POST
          if (isset($_POST["fecha_inicio"]) && isset($_POST["fecha_fin"])) {
              $fecha_inicio = $_POST["fecha_inicio"];
              $fecha_fin = $_POST["fecha_fin"];

              // Mostrar el botón para imprimir solo si se enviaron los filtros
              echo '<a href="extensiones/imprimir_lecturas_pdf.php?fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin . '" target="_blank" class="btn btn-success">';
              echo '<i class="fa fa-print"></i> Imprimir PDF</a>';
              echo '<br><br>';

              // Llamar al controlador para obtener los resultados filtrados
              $resultados = ControladorLectura::ctrMostrarLecturasF(null, null, $fecha_inicio, $fecha_fin);

              // Si hay resultados, mostrar la tabla
              if (!empty($resultados)) {
                  echo '<div class="table-responsive">';
                  echo '<table class="table table-bordered table-striped dt-responsive tablas" width="100%">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>No. Lectura</th>';
                  echo '<th>No. Orden</th>';
                  echo '<th>Nombre del Usuario</th>';
                  echo '<th>No Contador</th>';
                  echo '<th>Lectura Anterior</th>';
                  echo '<th>Lectura Actual</th>';
                  echo '<th>Consumo</th>';
                  echo '<th>Fecha de Lectura</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';
                  foreach ($resultados as $row) {
                      echo '<tr>';
                      echo '<td>' . $row["idlectura"] . '</td>';
                      echo '<td>' . $row["no_orden"] . '</td>';
                      echo '<td>' . $row["nombre_usuario"] . '</td>';
                      echo '<td>' . $row["no_contador"] . '</td>';
                      echo '<td>' . $row["lectura_anterior"] . '</td>';
                      echo '<td>' . $row["lectura_actual"] . '</td>';
                      echo '<td>' . $row["consumo"] . '</td>';
                      echo '<td>' . date('d/m/Y', strtotime($row["fecha_lectura"])) . '</td>';
                      echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
              } else {
                  echo '<p>No se encontraron resultados para el rango de fechas seleccionado.</p>';
              }
          }
        ?>
      </div>
    </div>
  </section>
</div>
