<?php
include_once 'Conexion.php';
class VentaProducto{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }

  function ver($id){
    $sql="SELECT venta_producto.precio AS precio, cantidad, producto.nombre AS producto, concentracion, adicional,laboratorio.nombre AS laboratorio, presentacion.nombre AS presentacion, tipo_producto.nombre AS tipo, subtotal
    FROM venta_producto
    JOIN producto ON producto_id_producto = id_producto AND venta_id_venta=:id
    JOIN laboratorio ON prod_lab = id_laboratorio
    JOIN tipo_producto ON prod_tip = id_tip_prod
    JOIN presentacion ON prod_pre = id_presentacion";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function borrar($id_venta){
    $sql="DELETE FROM venta_producto WHERE venta_id_venta=:id_venta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_venta'=>$id_venta));
  }
}
?>