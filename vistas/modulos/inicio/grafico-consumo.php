<div class="box box-solid bg-teal-gradient">
   <div class="box-header ui-sortable-handle" style="cursor: move;">
      <i class="fa fa-th"></i>
      <h3 class="box-title">Evolución del Consumo de Agua</h3>
      <div class="box-tools pull-right">
         <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
         <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
   </div>
   <div class="box-body border-radius-none">
      <!-- Ajustamos el tamaño del canvas para que sea flexible -->
      <div style="position: relative; height:40vh; width:80vw;">
        <canvas id="line-chart"></canvas>
      </div>
   </div>
</div>

<?php
  // Obtener lecturas por mes desde el controlador
  $lecturasPorMes = ControladorLectura::ctrObtenerLecturasPorMes();
  $meses = [];
  $consumos = [];

  foreach ($lecturasPorMes as $lectura) {
      $meses[] = $lectura["mes"];
      $consumos[] = $lectura["total_consumo"];
  }

  // Convertir arrays a formato JSON
  $mesesJson = json_encode($meses);
  $consumosJson = json_encode($consumos);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  var ctx = document.getElementById('line-chart').getContext('2d');
  var lineChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: <?php echo $mesesJson; ?>, // Meses en el eje X
          datasets: [{
              label: 'Consumo de agua (m³)',
              data: <?php echo $consumosJson; ?>, // Valores de consumo en el eje Y
              borderColor: '#3c8dbc',
              fill: false
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false, // Permite que el gráfico se ajuste al contenedor
          scales: {
              x: {
                  title: {
                      display: true,
                      text: 'Mes'
                  }
              },
              y: {
                  title: {
                      display: true,
                      text: 'Consumo (m³)'
                  },
                  beginAtZero: true
              }
          },
          plugins: {
              legend: {
                  display: true,
                  position: 'bottom' // Colocamos la leyenda en la parte inferior para ahorrar espacio
              }
          }
      }
  });
</script>
