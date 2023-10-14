<?php
include_once 'Conexion.php';
class Usuario{
  var $objetos;
  public function __construct(){
    $db = new Conexion();
    $this->acceso = $db->pdo;
  }
  function Loguearse($dpi,$pass){
    $sql="SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where dpi_us=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dpi' => $dpi));
    $objetos = $query->fetchAll();
    foreach ($objetos as $objeto) {
      var_dump($objetos);
      $contrasena_actual = $objeto->contrasena_us;
    }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($pass,$contrasena_actual)){
        return "logueado";
      }
    }
    else{
      if($pass==$contrasena_actual){
        return "logueado";
      }
    }
  }

  function obtener_dato_logueo($dpi){
    $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and dpi_us=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dpi' => $dpi));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }

  function obtener_datos($id){
    $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id' => $id));
    $this->objetos = $query->fetchAll();
    return $this->objetos;
  }
  //editar datos
  function editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional){
    $sql="UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional WHERE id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_usuario, ':telefono'=>$telefono, ':residencia'=>$residencia, ':correo'=>$correo, ':sexo'=>$sexo, ':adicional'=>$adicional));
  }

  function cambiar_contra($id_usuario,$oldpass,$newpass){
    $sql="SELECT * FROM usuario WHERE id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_usuario));
    $this->objetos = $query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($oldpass,$contrasena_actual)){
        $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]); //se encripta la contraseña
        $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
        echo 'update';
      }
      else{
        echo 'noupdate';
      }
    }
    else{
      if($oldpass==$contrasena_actual){
        $pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
        $sql="UPDATE usuario SET contrasena_us=:newpass WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
        echo 'update';
      }
      else{
        echo 'noupdate';
      }
    }
  }

  function cambiar_photo($id_usuario,$nombre){
    $sql="SELECT avatar FROM usuario WHERE id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_usuario));
    $this->objetos = $query->fetchall();
    $sql="UPDATE usuario SET avatar=:nombre WHERE id_usuario=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$id_usuario, ':nombre'=>$nombre));
    return $this->objetos; 
  }
  function buscar(){
    if(!empty($_POST['consulta'])){
      $consulta=$_POST['consulta'];
      $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us WHERE nombre_us LIKE :consulta";//importante el espacio despues del LIKE
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':consulta'=>"%$consulta%"));
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
    else{
      $sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us WHERE nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
      $query = $this->acceso->prepare($sql);
      $query->execute();
      $this->objetos=$query->fetchall();
      return $this->objetos;
    }
  }
  function crear($nombre,$apellido,$edad,$dpi,$pass,$tipo,$avatar){
    $sql="SELECT id_usuario FROM usuario WHERE dpi_us=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':dpi'=>$dpi));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      echo 'noadd';
    }
    else{
      $sql="INSERT INTO usuario(nombre_us, apellidos_us,edad,dpi_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellido,:edad,:dpi,:pass,:tipo,:avatar)";
      $query = $this->acceso->prepare($sql);
      $query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dpi'=>$dpi,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
      echo 'add';

    }
  }

  function ascender($pass,$id_ascendido,$id_usuario){
    $sql="SELECT * FROM usuario WHERE id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($pass,$contrasena_actual)){
        $tipo=1;
        $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
        echo 'ascendido';
        
      }
      else{
        echo 'noascendido';
      }
    }
    else{
      if($pass==$contrasena_actual){
        $tipo=1;
        $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
        echo 'ascendido';
      }
      else{
        echo 'noascendido';
      }
    }
  }

  function descender($pass,$id_descendido,$id_usuario){
    $sql="SELECT * FROM usuario WHERE id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($pass,$contrasena_actual)){
        $tipo=2;
        $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
        echo 'descendido';
        
      }
      else{
        echo 'nodescendido';
      }
    }
    else{
      if($pass==$contrasena_actual){
        $tipo=2;
        $sql="UPDATE usuario SET us_tipo=:tipo WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
        echo 'descendido';
      }
      else{
        echo 'nodescendido';
      }
    }
  }

  function borrar($pass,$id_borrado,$id_usuario){
    $sql="SELECT * FROM usuario WHERE id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();
    foreach ($this->objetos as $objeto) {
      $contrasena_actual = $objeto->contrasena_us;
    }
    if(strpos($contrasena_actual,'$2y$10$')===0){
      if(password_verify($pass,$contrasena_actual)){
        $sql="DELETE FROM usuario WHERE id_usuario =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_borrado));
        echo 'borrado';
      }
      else{
        echo 'noborrado';
      }
    }
    else{
      if($pass==$contrasena_actual){
        $sql="DELETE FROM usuario WHERE id_usuario =:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_borrado));
        echo 'borrado';
      }
      else{
        echo 'noborrado';
      }
    }
  }
  function devolver_avatar($id_usuario){
    $sql="SELECT avatar FROM usuario WHERE id_usuario=:id_usuario";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id_usuario'=>$id_usuario));
    $this->objetos=$query->fetchall();
    return $this->objetos;
  }

  function verificar($email,$dpi){
    $sql="SELECT * FROM usuario WHERE correo_us=:email AND dpi_us=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':email'=>$email,':dpi'=>$dpi));
    $this->objetos=$query->fetchall();
    if(!empty($this->objetos)){
      if($query->rowCount()==1){
        echo 'encontrado';
      }
      else{
        echo 'noencontrado';
      }
    }
    else{
      echo 'noencontrado';
    }
  }

  function remplazar($codigo,$email,$dpi){
    $sql="UPDATE usuario SET contrasena_us=:codigo WHERE correo_us=:email AND dpi_us=:dpi";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':codigo'=>$codigo,':email'=>$email,':dpi'=>$dpi));
    //echo 'remplazado';
  }
}
?>