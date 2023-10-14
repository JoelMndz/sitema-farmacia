<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/css/all.min.css">
</head>
<?php
session_start();
if(!empty($_SESSION['us_tipo'])){
  header('Location: controlador/LoginController.php');
}
else{
  session_destroy();
?>
  <body>
    <img  class="wave" src="./img/wave.png" alt="">
    <div class="contenedor">
      <div class="logo_slogan">
        <img src="./img/bg1.png" alt="">
      </div>
      <div class="login-box">
        <div class="cont_logo_form">
          <img class="logo_form" src="./img/222222LogoFarmacia.png" alt="">
        </div>
        <div>
          <h2>Iniciar Sesión</h2>
        </div>
        <form action="controlador/LoginController.php" id="login" method="post">
          <div class="user-box box1">
            <input type="text" name="user" required="" autocomplete="off" id="dpi">
            <label>Usuario</label>
          </div>

          <div class="user-box box2">
            <input type="password" name="pass" required="" id="password">
            <label>Contraseña</label>
          </div>
          <a class="recuperar" href="http://localhost:8022/farmacia/vista/recuperar.php">Recuperar Contraseña</a>
          <button class="intro">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Iniciar
          </button>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
}
?>