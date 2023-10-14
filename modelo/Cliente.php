<?php
include_once 'Conexion.php';
class Cliente{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM cliente WHERE estado='A' AND nombre LIKE :consulta";//importante el espacio despues del LIKE
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT * FROM cliente WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id  DESC LIMIT 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }

  function crear($nombre,$apellido,$dpi,$edad,$telefono,$correo,$sexo,$adicional,$avatar){
    $sql="SELECT id,estado FROM cliente WHERE nombre=:nombre AND apellidos=:apellido AND dpi=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':dpi'=>$dpi));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      foreach ($this->objetos as $cli) {
        $cli_id = $cli->id;
        $cli_estado = $cli->estado;
      }
      if($cli_estado=='A'){
        echo 'noadd';
      }
      else{
        $sql="UPDATE cliente SET estado='A' WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$cli_id));
        echo 'add';
      }
    }
    else{
      $sql="INSERT INTO cliente(nombre,apellidos,dpi,edad,telefono,correo,sexo,adicional,avatar) VALUES (:nombre,:apellido,:dpi,:edad,:telefono,:correo,:sexo,:adicional,:avatar)";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':dpi'=>$dpi,':edad'=>$edad,':telefono'=>$telefono,':correo'=>$correo,':sexo'=>$sexo,':adicional'=>$adicional,':avatar'=>$avatar));
      echo 'add';
    }
  }

  function editar($id,$telefono,$correo,$adicional){
    $sql="SELECT id FROM cliente WHERE id=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    if(empty($this->objetos)){
      echo 'noedit';
    }
    else{
      $sql="UPDATE cliente SET telefono=:telefono, correo=:correo, adicional=:adicional WHERE id=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id,':telefono'=>$telefono,':correo'=>$correo,':adicional'=>$adicional));
      echo 'edit';
    }
  }

  function borrar($id){
    $sql="UPDATE cliente SET estado='I' WHERE id=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
    }
    else{
      echo 'noborrado';
    }
  }

  function rellenar_clientes(){
    $sql="SELECT * FROM cliente WHERE estado='A' ORDER BY nombre ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function buscar_datos_cliente($id_cliente){
    $sql="SELECT * FROM cliente WHERE id=:id_cliente";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_cliente'=>$id_cliente));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }
}