<?php
include '../modelo/Cliente.php';
$cliente = new Cliente();
if($_POST['funcion']=='buscar'){
  $cliente->buscar();
  date_default_timezone_set('America/Guatemala');
  $fecha= date('Y-m-d H:i:s');
  $fecha_actual = new DateTime($fecha);
  $json=array();
  foreach ($cliente->objetos as $objeto){
    $nacimiento = new DateTime($objeto->edad);
    $edad = $nacimiento->diff($fecha_actual);
    $edad_y = $edad->y;
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre.' '.$objeto->apellidos,
      'dpi'=>$objeto->dpi,
      'edad'=>$edad_y,
      'telefono'=>$objeto->telefono,
      'correo'=>$objeto->correo,
      'sexo'=>$objeto->sexo,
      'sexo'=>$objeto->sexo,
      'adicional'=>$objeto->adicional,
      'avatar'=>'../img/avatar2.png'
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

if($_POST['funcion']=='crear'){
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $dpi = $_POST['dpi'];
  $edad = $_POST['edad'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $sexo = $_POST['sexo'];
  $adicional = $_POST['adicional'];
  $avatar = 'avatar2.png';
  $cliente->crear($nombre,$apellido,$dpi,$edad,$telefono,$correo,$sexo,$adicional,$avatar);
}

if($_POST['funcion']=='editar'){
  $id = $_POST['id'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $adicional = $_POST['adicional'];
  $cliente->editar($id,$telefono,$correo,$adicional);
}

if($_POST['funcion']=='borrar'){
  $id=$_POST['id'];
  $cliente->borrar($id);
}

if($_POST['funcion']=='rellenar_clientes'){
  $cliente->rellenar_clientes();
  $json = array();
  foreach ($cliente->objetos as $objeto) {
    $json[]=array(
      'id'=>$objeto->id,
      'nombre'=>$objeto->nombre.' '.$objeto->apellidos.' | '.$objeto->dpi
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}