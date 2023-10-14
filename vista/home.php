<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==2){
  include_once 'layouts/header.php';
?>
  <title>Farmacia EBENEZER - Bienvenido</title>

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
          <h1 class="animate__animated animate__flipInX">Bienvenido</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <section class="bienvenida">
    <div class="contenedor_bien">
      <div class="logo_farma">
        <img src="../img/ebenezer4.png" class="image_logo">
        <img src="../img/ebenezer5.png" class="image_logo2">
      </div>
    </div>
    <div class="card-body-bien">
      <div class="vision">
        <h2>Visión</h2>
        <p>Ser reconocidos como el recurso confiable y comprensivo en el cuidado de la salud dentro de nuestro municipio, brindando orientación personalizada y apoyo integral a cada paciente que ingresa a nuestra farmacia.</p>
      </div>
      <div class="mision">
        <h2>Misión</h2>
      <p>Nuestra misión es proporcionar un entorno acogedor y empático donde los pacientes encuentren respuestas claras y apoyo en su búsqueda de una salud óptima. A través de la experiencia en enfermería de nuestro equipo y nuestra dedicación a comprender las necesidades individuales, nos esforzamos por ofrecer información precisa y consejos relevantes sobre medicamentos y tratamientos. Nos comprometemos a ser más que una simple farmacia, siendo un socio de confianza en el viaje de cada paciente hacia el bienestar.</p>
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