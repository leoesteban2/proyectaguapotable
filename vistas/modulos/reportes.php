<div class="content-wrapper">
  <section class="content-header">
    <h1>Reportes de Cobros por Exceso</h1>
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
              <label>Estado:</label>
              <select name="estado" class="form-control">
                <option value="todos">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="pagado">Pagado</option>
              </select>
            </div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
      </div>

      <div class="box-body">
        <?php
          // Verificar si los datos fueron enviados por POST
          if (isset($_POST["fecha_inicio"]) && isset($_POST["fecha_fin"])) {
              $fecha_inicio = $_POST["fecha_inicio"];
              $fecha_fin = $_POST["fecha_fin"];
              $estado = $_POST["estado"];

              // Mostrar el botón para imprimir solo si se enviaron los filtros
              echo '<a href="extensiones/imprimir_exceso_pdf.php?fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin . '&estado=' . $estado . '" target="_blank" class="btn btn-success">';
              echo '<i class="fa fa-print"></i> Imprimir PDF</a>';

              // Llamar al controlador para obtener los resultados filtrados
              $resultados = ControladorExceso::ctrMostrarExcesoF(null, null, $fecha_inicio, $fecha_fin, $estado);

              // Si hay resultados, mostrar la tabla
              if (!empty($resultados)) {
                  echo '<div class="table-responsive">';
                  echo '<table class="table table-bordered table-striped dt-responsive tablas" width="100%">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>No Exceso</th>';
                  echo '<th>Nombre del Usuario</th>';
                  echo '<th>No de contador</th>';
                  echo '<th>Detalle</th>';
                  echo '<th>Exceso Menor</th>';
                  echo '<th>Exceso Mayor</th>';
                  echo '<th>Total Exceso</th>';
                  echo '<th>Total A PAGAR</th>';
                  echo '<th>Tipo de Cobro</th>';
                  echo '<th>Fecha de Cobro</th>';
                  echo '<th>ESTADO</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';
                  foreach ($resultados as $row) {
                      echo '<tr>';
                      echo '<td>' . $row["idcobro"] . '</td>';
                      echo '<td>' . $row["nombre_usuario"] . '</td>';
                      echo '<td>' . $row["no_contador"] . '</td>';
                      echo '<td>' . $row["detalle"] . '</td>';
                      echo '<td>' . $row["exceso_menor"] . '</td>';
                      echo '<td>' . $row["exceso_mayor"] . '</td>';
                      echo '<td>' . $row["total_exceso"] . '</td>';
                      echo '<td>' . $row["total_a_pagar"] . '</td>';
                      echo '<td>' . $row["tipo_cobro"] . '</td>';
                      echo '<td>' . date('d/m/Y', strtotime($row["fecha_cobro"])) . '</td>';
                      echo '<td>' . $row["estado_cobro"] . '</td>';
                      echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
              } else {
                  echo '<p>No se encontraron resultados para el rango de fechas y estado seleccionados.</p>';
              }
          }
        ?>
      </div>
    </div>
  </section>
</div>
