<div class="content-wrapper">
  <section class="content-header">
    <h1>Reportes de Cobro Base</h1>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Filtros de búsqueda</h3>
      </div>

      <div class="box-body">
        <form method="post" action="">
          <div class="row">
            <div class="col-md-3">
              <label>Fecha Inicio:</label>
              <input type="date" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Fecha Fin:</label>
              <input type="date" name="fecha_fin" class="form-control" required>
            </div>
            <div class="col-md-3">
              <label>Estado:</label>
              <select name="estado" class="form-control">
                <option value="todos">Todos</option>
                <option value="pendiente">Pendiente</option>
                <option value="pagado">Pagado</option>
              </select>
            </div>
            <div class="col-md-3">
  <label>Tipo de Cobro:</label>
  <select name="tipo_cobro" class="form-control">
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
          // Verificar si los datos fueron enviados por POST
          if (isset($_POST["fecha_inicio"]) && isset($_POST["fecha_fin"])) {
              $fecha_inicio = $_POST["fecha_inicio"];
              $fecha_fin = $_POST["fecha_fin"];
              $estado = $_POST["estado"];
              // Verificar si 'tipo_cobro' está definido para evitar errores
              $tipo_cobro = isset($_POST["tipo_cobro"]) ? $_POST["tipo_cobro"] : 'todos';

            // Mostrar el botón para imprimir solo si se enviaron los filtros
            echo '<a href="extensiones/imprimir_cobro_base_pdf.php?fecha_inicio=' . $fecha_inicio . '&fecha_fin=' . $fecha_fin . '&estado=' . $estado . '&tipo_cobro=' . $tipo_cobro . '" target="_blank" class="btn btn-success">';
            echo '<i class="fa fa-print"></i> Imprimir PDF</a>';


              // Llamar al controlador para obtener los resultados filtrados
              $resultados = ControladorCobro::ctrMostrarCobrosBaseF(null, null, $fecha_inicio, $fecha_fin, $estado, $tipo_cobro);

              // Si hay resultados, mostrar la tabla
              if (!empty($resultados)) {
                  echo '<div class="table-responsive">';
                  echo '<table class="table table-bordered table-striped dt-responsive tablas" width="100%">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>No. Cobro</th>';
                  echo '<th>Nombre del Usuario</th>';
                  echo '<th>No Contador</th>';
                  echo '<th>Detalle</th>';
                  echo '<th>Monto A PAGAR</th>';
                  echo '<th>Tipo Cobro</th>';
                  echo '<th>Fecha Cobro</th>';
                  echo '<th>Estado</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';
                  foreach ($resultados as $row) {
                      echo '<tr>';
                      echo '<td>' . $row["idcobro_base"] . '</td>';
                      echo '<td>' . $row["nombre_usuario"] . '</td>';
                      echo '<td>' . $row["no_contador"] . '</td>';
                      echo '<td>' . $row["detalle"] . '</td>';
                      echo '<td>Q ' . number_format($row["monto_base"], 2) . '</td>';
                      echo '<td>' . $row["tipo_cobro"] . '</td>';
                      echo '<td>' . date('d/m/Y', strtotime($row["fecha_cobro"])) . '</td>';
                      echo '<td>' . $row["estado_cobro"] . '</td>';
                      echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
              } else {
                  echo '<p>No se encontraron resultados para el rango de fechas, estado y tipo de cobro seleccionados.</p>';
              }
          }
        ?>
      </div>
    </div>
  </section>
</div>
