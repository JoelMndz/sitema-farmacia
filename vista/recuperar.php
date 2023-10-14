<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recuperar Contraseña</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/fontawesome-free-6.3.0-web/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/farmacia/css/sweetalert2.css">
  <!-- Style -->
  <link rel="stylesheet" href="http://localhost:8022/farmacia/css/recuperar.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1">
        <div class="cont_logo_form">
          <img class="logo_form" src="../img/222222LogoFarmacia.png" alt="">
        </div>
      </a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Olvidaste tu contraseña? Aquí puedes recuperar facilmente una nueva.</p>
      <span id="aviso1" class="text-primary">texto</span>
      <span id="aviso" class="text-danger">texto</span>
      <form id="form-recuperar" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="dpi-recuperar" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email-recuperar" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="login-box-msg mt-3">Se le enviará un código a su correo electronico.</p>
      <p class="mt-3 mb-1">
        <a href="../index.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.js"></script>

<script src="../js/recuperar.js"></script>
</body>
</html>
