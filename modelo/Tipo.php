<?php
include 'Conexion.php';
class Tipo{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function crear($nombre){
    $sql="SELECT id_tip_prod,estado FROM tipo_producto WHERE nombre=:nombre";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      foreach ($this->objetos as $tip) {
        $tip_id = $tip->id_tip_prod;
        $tip_estado = $tip->estado;
      }
      if($tip_estado=='A'){
        echo 'noadd';
      }
      else{
        $sql="UPDATE tipo_producto SET estado='A' WHERE id_tip_prod=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$tip_id));
        echo 'add';
      }
    }
    else{
      $sql="INSERT INTO tipo_producto(nombre) VALUES (:nombre)";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre));
      echo 'add';

    }
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM tipo_producto WHERE estado='A' AND nombre LIKE :consulta";//importante el espacio despues del LIKE
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT * FROM tipo_producto WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id_tip_prod LIMIT 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }

  function borrar($id){
    $sql="SELECT * FROM producto WHERE prod_tip=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $tip=$query->fetchall();
    if(!empty($tip)){
      echo 'noborrado';
    }
    else{
      $sql="UPDATE tipo_producto SET estado='I' WHERE id_tip_prod=:id";
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
    $sql="UPDATE tipo_producto SET nombre=:nombre WHERE id_tip_prod=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre));
    echo 'edit';
  }
  function rellenar_tipos(){
    $sql="SELECT * FROM tipo_producto WHERE estado='A' ORDER BY nombre ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos = $query->fetchall();
    return $this->objetos;
  }
}
?>