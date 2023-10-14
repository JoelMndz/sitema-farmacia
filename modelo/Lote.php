<?php
include_once 'Conexion.php';
class Lote{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT l.id AS id_lote,CONCAT(l.id,' | ',l.codigo) AS codigo,cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom, presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo
      FROM lote AS l
      JOIN compra ON l.id_compra = compra.id AND l.estado='A'
      JOIN proveedor ON proveedor.id_proveedor = compra.id_proveedor
      JOIN producto ON producto.id_producto = l.id_producto
      JOIN laboratorio ON prod_lab = id_laboratorio
      JOIN tipo_producto ON prod_tip = id_tip_prod
      JOIN presentacion ON prod_pre = id_presentacion AND producto.nombre LIKE :consulta ORDER BY producto.nombre LIMIT 25;";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT l.id AS id_lote,CONCAT(l.id,' | ',l.codigo) AS codigo, cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom, presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo
      FROM lote AS l
      JOIN compra ON l.id_compra = compra.id AND l.estado='A'
      JOIN proveedor ON proveedor.id_proveedor = compra.id_proveedor
      JOIN producto ON producto.id_producto = l.id_producto
      JOIN laboratorio ON prod_lab = id_laboratorio
      JOIN tipo_producto ON prod_tip = id_tip_prod
      JOIN presentacion ON prod_pre = id_presentacion AND producto.nombre NOT LIKE '' ORDER BY producto.nombre LIMIT 25;";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }
  function editar($id,$stock){
    $sql="UPDATE lote SET cantidad_lote=:stock WHERE id=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id,':stock'=>$stock));
    echo 'edit';
  }

  function borrar($id){
    $sql="UPDATE lote SET estado='I' WHERE id=:id";
    $query=$this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    if(!empty( $query->execute(array(':id'=>$id)))){
      echo 'borrado';
    }
    else{
      echo 'noborrado';
    }
  }

  function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
    $sql="SELECT * FROM lote WHERE id=:id_lote";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_lote'=>$id_lote));
    $lote=$query->fetchall();
    $sql="UPDATE lote SET cantidad_lote=cantidad_lote+:cantidad,estado='A' WHERE id=:id_lote";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
  }
  ////////////////////////////////////////Actualización/////////////////////////////////////

  function crear_lote($codigo,$cantidad,$vencimiento,$precio_compra,$id_compra,$id_producto){
    $sql="INSERT INTO lote(codigo,cantidad,cantidad_lote,vencimiento,precio_compra,id_compra,id_producto) VALUES (:codigo,:cantidad,:cantidad_lote,:vencimiento,:precio_compra,:id_compra,:id_producto)";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':codigo'=>$codigo,':cantidad'=>$cantidad,':cantidad_lote'=>$cantidad,':vencimiento'=>$vencimiento,':precio_compra'=>$precio_compra,':id_compra'=>$id_compra,':id_producto'=>$id_producto));
    echo 'add';
  }

  function ver($id){
    $sql="SELECT l.codigo AS codigo, l.cantidad AS cantidad, vencimiento, precio_compra, p.nombre AS producto, concentracion,adicional, la.nombre AS laboratorio, t.nombre AS tipo, pre.nombre AS presentacion
    FROM lote AS l
    JOIN producto AS p ON l.id_producto = p.id_producto AND id_compra=:id
    JOIN laboratorio AS la ON prod_lab = id_laboratorio
    JOIN tipo_producto AS t ON prod_tip = id_tip_prod
    JOIN presentacion AS pre ON prod_pre = id_presentacion";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }
}
?>