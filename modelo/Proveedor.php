<?php
include 'Conexion.php';
class Proveedor{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function crear($nombre,$telefono,$correo,$direccion,$avatar){
    $sql="SELECT id_proveedor,estado FROM proveedor WHERE nombre=:nombre AND telefono=:telefono AND correo=:correo AND direccion=:direccion";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      foreach ($this->objetos as $prov) {
        $prov_id = $prov->id_proveedor;
        $prov_estado = $prov->estado;
      }
      if($prov_estado=='A'){
        echo 'noadd';
      }
      else{
        $sql="UPDATE proveedor SET estado='A' WHERE id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$prov_id));
        echo 'add';
      }
    }
    else{
      $sql="INSERT INTO proveedor(nombre,telefono,correo,direccion,avatar) VALUES (:nombre,:telefono,:correo,:direccion,:avatar)";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion,':avatar'=>$avatar));
      echo 'add';

    }
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM proveedor WHERE estado='A' AND nombre LIKE :consulta";//importante el espacio despues del LIKE
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT * FROM proveedor WHERE estado='A' AND nombre NOT LIKE '' ORDER BY id_proveedor  DESC LIMIT 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }
  
  function cambiar_logo($id,$nombre){
    $sql="UPDATE proveedor SET avatar=:nombre WHERE id_proveedor=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':nombre'=>$nombre));
  }
  function borrar($id){
    $sql="UPDATE proveedor SET estado='I' WHERE id_proveedor=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty($query->execute(array(':id'=>$id)))){
      echo 'borrado';
    }
    else{
      echo 'noborrado';
    }
  }
  function editar($id,$nombre,$telefono,$correo,$direccion){
    $sql="SELECT id_proveedor FROM proveedor WHERE id_proveedor!=:id and nombre=:nombre";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id, ':nombre'=>$nombre));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      echo 'noedit';
    }
    else{
      $sql="UPDATE proveedor SET nombre=:nombre, telefono=:telefono, correo=:correo, direccion=:direccion WHERE id_proveedor=:id";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':id'=>$id, ':nombre'=>$nombre,':telefono'=>$telefono,':correo'=>$correo,':direccion'=>$direccion));
      echo 'edit';
    }
  }
  function rellenar_proveedores(){
    $sql="SELECT * FROM proveedor WHERE estado='A' ORDER BY nombre ASC";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }
}
?>