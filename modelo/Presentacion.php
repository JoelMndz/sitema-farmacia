<?php
include 'Conexion.php';
class Presentacion{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function crear($nombre){
    $sql="SELECT id_presentacion,estado FROM presentacion WHERE nombre=:nombre";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      foreach ($this->objetos as $pre) {
        $pre_id = $pre->id_presentacion;
        $pre_estado = $pre->estado;
      }
      if($pre_estado=='A'){
        echo 'noadd';
      }
      else{
        $sql="UPDATE presentacion SET estado='A' WHERE id_presentacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$pre_id));
        echo 'add';
      }
    }
    else{
      $sql="INSERT INTO presentacion(nombre) VALUES (:nombre)";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre));
      echo 'add';

    }
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM presentacion WHERE estado='A' AND nombre LIKE :consulta";//importante el espacio despues del LIKE
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT * FROM presentacion WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id_presentacion LIMIT 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }

  function borrar($id){
    $sql="SELECT * FROM producto WHERE prod_pre=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $pre=$query->fetchall();
    if(!empty($pre)){
      echo 'noborrado';
    }
    else{
      $sql="UPDATE presentacion SET estado='I' WHERE id_presentacion=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id));
      if(!empty($query->execute(array(':id'=>$id)))){
        echo 'borrado';
      }
      else{
        echo 'noborrado';
      }
    }
  }
  function editar($nombre,$id_editado){
    $sql="UPDATE presentacion SET nombre=:nombre WHERE id_presentacion=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
    echo 'edit';
  }

  function rellenar_presentaciones(){
    $sql="SELECT * FROM presentacion WHERE estado='A' ORDER BY nombre ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchall();
    return $this->objetos;
  }
}
?>