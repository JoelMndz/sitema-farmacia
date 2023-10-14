<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==2){
  include_once 'layouts/header.php';
?>
  <title>Adm | Alertas</title>

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
            <h1 class="animate__animated animate__flipInX">Alertas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Alertas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section>
      <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Lotes en riesgo</h3>
          </div>
          <div class="card-body p-0">
            <table id="lotes" class="animate__animated animate__fadeIn table text-nowrap">
              <thead class="table_nav">
                <tr>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Stock</th>
                  <th>Estado</th>
                  <th>Laboratorio</th>
                  <th>Presentación</th>
                  <th>Proveedor</th>
                  <th>Mes</th>
                  <th>Día</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody class="table-active">

              </tbody>
            </table>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </section>

    <!--<section>
      <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Productos agotados</h3>
          </div>
          <div class="card-body p-0">
            <table id="lotes" class="animate__animated animate__fadeIn table text-nowrap">
              <thead class="table_nav">
                <tr>
                  <th>Código</th>
                  <th>Producto</th>
                  <th>Stock</th>
                  <th>Estado</th>
                  <th>Laboratorio</th>
                  <th>Presentación</th>
                  <th>Proveedor</th>
                  <th>Mes</th>
                  <th>Día</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody class="table-active">

              </tbody>
            </table>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </section>-->
  </div>
  <!-- /.content-wrapper -->
<?php 
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/Alertas.js"></script>