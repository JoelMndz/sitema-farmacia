<?php
session_start();
if($_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==2){
  include_once 'layouts/header.php';
?>
  <title>Adm | Más consultas </title>

<?php
  include_once 'layouts/nav.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Más consultas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Más consultas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
      <div class="container-fluid">
        <div class="card card-dark">
          <div class="card-header">
            <h3 class="card-title">Consultas generales</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 text-center">
                <h2>Ventas por mes del año actual</h2>
                <div class="chart-responsive">
                  <canvas id="Grafico1" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
              <div class="col-md-6 text-center">
                <h2>Top 3 vendedor del mes</h2>
                <div class="chart-responsive">
                <canvas id="Grafico2" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
              <div class="col-md-12 text-center mt-5">
                <h2>Comparativa de meses con el año anterior</h2>
                <div class="chart-responsive">
                <canvas id="Grafico3" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
              <div class="col-md-6 text-center mt-5">
                <h2>Top 5 productos más vendidos en el mes</h2>
                <div class="chart-responsive">
                <canvas id="Grafico4" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
              <div class="col-md-6 text-center mt-5">
                <h2>Top 5 productos menos vendidos en el mes</h2>
                <div class="chart-responsive">
                <canvas id="Grafico5" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
              <div class="col-md-12 text-center">
                <h2>Top 3 cliente del mes</h2>
                <div class="chart-responsive">
                <canvas id="Grafico6" style="min-height: 350px; height: 350px; max-height: 350px; max width: 100%"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php 
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/Chart.min.js"></script>
<script src="../js/Mas_consultas.js"></script>