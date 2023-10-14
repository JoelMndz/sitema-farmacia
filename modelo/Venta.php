<?php
include_once 'Conexion.php';
class Venta{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }
  function Crear($cliente, $total, $fecha, $vendedor){
    $sql="INSERT INTO venta(fecha, total, vendedor, id_cliente) VALUES(:fecha,:total,:vendedor,:cliente)";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':fecha'=>$fecha, ':cliente'=>$cliente, ':total'=>$total, ':vendedor'=>$vendedor));
  }

  function ultima_venta(){
    $sql="SELECT MAX(id_venta) as ultima_venta FROM venta";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function borrar($id_venta){
    $sql="DELETE FROM venta WHERE id_venta=:id_venta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_venta'=>$id_venta));
    echo 'delete';
  }

  function buscar(){
    $sql="SELECT id_venta, fecha, cliente, dpi, total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) AS vendedor,id_cliente FROM venta JOIN usuario ON vendedor=id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function verificar($id_venta,$id_usuario){
    $sql="SELECT * FROM venta WHERE vendedor=:id_usuario AND id_venta=:id_venta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario,':id_venta'=>$id_venta));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      return 1;
    }
    else{
      return 0;
    }
  }

  function recuperar_vendedor($id_venta){
    $sql="SELECT us_tipo FROM venta JOIN usuario ON id_usuario=vendedor WHERE id_venta=:id_venta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_venta'=>$id_venta));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function venta_dia_vendedor($id_usuario){
    $sql="SELECT SUM(total) AS venta_dia_vendedor FROM `venta` WHERE vendedor=:id_usuario AND DATE(fecha) = Date(curdate())";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function venta_diaria(){
    $sql="SELECT SUM(total) AS venta_diaria FROM `venta` WHERE DATE(fecha) = Date(curdate())";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function venta_mensual(){
    $sql="SELECT SUM(total) AS venta_mensual FROM `venta` WHERE YEAR(fecha) = YEAR(curdate()) AND MONTH(fecha) = MONTH(curdate())";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function monto_costo(){
    $sql="SELECT SUM(det_cantidad * precio_compra) AS monto_costo FROM detalle_venta
    JOIN venta ON id_det_venta=id_venta AND YEAR(fecha) = YEAR(curdate()) AND MONTH(fecha) = MONTH(curdate())
    JOIN lote ON id_det_lote=lote.id";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function venta_anual(){
    $sql="SELECT SUM(total) AS venta_anual FROM `venta` WHERE YEAR(fecha) = YEAR(curdate())";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function buscar_id($id_venta){
    $sql="SELECT id_venta, fecha, cliente, dpi, total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) AS vendedor,id_cliente FROM venta JOIN usuario ON vendedor=id_usuario AND id_venta=:id_venta";
    $query = $this->acceso->prepare($sql);
    $query->execute(array('id_venta'=>$id_venta));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function venta_mes(){
    $sql="SELECT SUM(total) AS cantidad, month(fecha) AS mes FROM `venta` WHERE year(fecha) = year(curdate()) GROUP BY month(fecha)";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function vendedor_mes(){
    $sql="SELECT CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) AS vendedor_nombre, SUM(total) AS cantidad FROM `venta` JOIN usuario ON id_usuario=vendedor WHERE MONTH(fecha)=MONTH(curdate()) AND YEAR(fecha)=YEAR(curdate()) GROUP BY vendedor ORDER BY cantidad DESC LIMIT 3";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function ventas_anual(){
    $sql="SELECT SUM(total) AS cantidad, month(fecha) AS mes FROM `venta` WHERE year(fecha) = year(DATE_ADD(CURDATE(), INTERVAL -1 YEAR)) GROUP BY month(fecha)";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function producto_mas_vendido(){
    $sql="SELECT nombre,concentracion,adicional, SUM(cantidad) AS total FROM `venta` JOIN venta_producto ON id_venta=venta_id_venta JOIN producto ON id_producto=producto_id_producto WHERE YEAR(fecha)=YEAR(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) GROUP BY producto_id_producto ORDER BY total DESC LIMIT 5";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function producto_menos_vendido(){
    $sql="SELECT nombre,concentracion,adicional, SUM(cantidad) AS total FROM `venta` JOIN venta_producto ON id_venta=venta_id_venta JOIN producto ON id_producto=producto_id_producto WHERE YEAR(fecha)=YEAR(CURDATE()) AND MONTH(fecha) = MONTH(CURDATE()) GROUP BY producto_id_producto ORDER BY total ASC LIMIT 5";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function cliente_mes(){
    $sql="SELECT CONCAT(cliente.nombre,' ',cliente.apellidos) AS cliente_nombre, SUM(total) AS cantidad FROM `venta` JOIN cliente ON id_cliente=id WHERE MONTH(fecha)=MONTH(curdate()) AND YEAR(fecha)=YEAR(curdate()) GROUP BY id_cliente ORDER BY cantidad DESC LIMIT 3";
    $query = $this->acceso->prepare($sql);
    $query->execute();
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }
}

?>