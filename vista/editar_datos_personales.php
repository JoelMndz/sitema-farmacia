<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==2){
  include_once 'layouts/header.php';
?>
  <title>Adm | Editar Datos</title>

<?php
  include_once 'layouts/nav.php';
?>
<!-- Modal cambio contraseña-->
<div class="animate__animated animate__bounceInDown modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Password</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
          <b>
            <?php
              echo $_SESSION['nombre_us'];
            ?>
          </b>
        </div>
        <div class="alert alert-success text-center" id="update" style="display:none;">
          <span><i class="fas fa-check m-1"></i>Se cambio password correctamente</span>
        </div>
        <div class="alert alert-danger text-center" id="noupdate" style="display:none;">
          <span><i class="fas fa-times m-1"></i>El password no es correcto</span>
        </div>
        <form id="form-pass">
          <div class="input-group mb-3">            
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
            </div>
            <input id="oldpass" type="password" class="form-control" placeholder="Ingrese password actual">
          </div>
          <div class="input-group mb-3">            
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input id="newpass" type="text" class="form-control" placeholder="Ingrese password nuevo">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal cambio avatar-->
<div class="animate__animated animate__bounceInDown modal fade" id="cambiophoto" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar avatar</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        <span aria-hidden="true">&times;</span>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="avatar1" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
          <b>
            <?php
              echo $_SESSION['nombre_us'];
            ?>
          </b>
        </div>
        <div class="alert alert-success text-center" id="edit" style="display:none;">
          <span><i class="fas fa-check m-1"></i>Se cambio el avatar</span>
        </div>
        <div class="alert alert-danger text-center" id="noedit" style="display:none;">
          <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
        </div>
        <form id="form-photo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">            
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" value="cambiar_foto">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mi Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body box-profile">
                  <div class="d-md-flex align-items-center">
                    <div class="col-md-6 profile-user text-center">
                      <img id="avatar2" src="../img/avatar.png" class="profile-user-img img-fluid img-circle" style="width: 13rem; border-color:var(--bg-color);">
                    </div>
                    <div class="col-md-6 user text-center">
                      <input id="id_usuario" type="hidden" value="<?php echo  $_SESSION['usuario']?>">
                      <h3 id="nombre_us" class="profile-username text-center text-primary text-xl">Nombre</h3>
                      <p id="apellidos_us" class="text-muted text-center text-xl">Apellidos</p>
                      <div class="text-center mt-3">
                        <button type="button" data-toggle="modal" data-target="#cambiophoto" class="btn btn-primary btn-sm">Cambiar avatar</button>
                      </div>
                    </div>
                  </div>
                  <ul class="list-group list-group-unbordered mb-1">
                    <li class="list-group-item">
                      <b>Edad</b><a id="edad" class="float-right">12</a>
                    </li>
                    <li class="list-group-item">
                      <b>Usuario</b><a id="dpi_us" class="float-right">12</a>
                    </li>
                    <li class="list-group-item">
                      <b>Tipo Usuario</b>
                      <span  id="us_tipo" class="float-right">Administrador</span>
                    </li>
                    <button data-toggle="modal" data-target="#cambiocontra" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar password</button>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Sobre mi</h3>
                </div>
                <div class="card-body">
                  <strong>
                  <i class="fas fa-phone mr-1"></i>Telefono
                  </strong>
                  <p id='telefono_us' class="text-muted">24536879</p>
                  <strong>
                  <i class="fas fa-map-marker-alt mr-1"></i>Residencia
                  </strong>
                  <p id='residencia_us' class="text-muted">24536879</p>
                  <strong>
                  <i class="fas fa-at mr-1"></i>Correo
                  </strong>
                  <p id='correo_us' class="text-muted">24536879</p>
                  <strong>
                  <i class="fas fa-smile-wink mr-1"></i>Sexo
                  </strong>
                  <p id='sexo_us' class="text-muted">24536879</p>
                  <strong>
                  <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                  </strong>
                  <p id='adicional_us' class="text-muted">24536879</p>
                  <button class="edit btn btn-block btn-outline-danger btn-sm" data-toggle="tooltip" title="Click si deseas editar">Editar</button>
                </div>
              </div>
            </div>
            <div class="col-md-9 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Editar datos personales</h3>
                </div>
                <div class="card-body">
                  <div class="alert alert-success text-center" id="editado" style="display:none;">
                    <span><i class="fas fa-check m-1"></i>Editado</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noeditado" style="display:none;">
                    <span><i class="fas fa-times m-1"></i>Edición Deshabilitada</span>
                  </div>
                <form id="form-usuario" class="form-horizontal">
                  <div class="form-group row">
                    <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                    <div class="col-sm-10">
                      <input type="number" id="telefono" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                    <div class="col-sm-10">
                      <input type="text" id="residencia" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="text" id="correo" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                    <div class="col-sm-10">
                      <input type="text" id="sexo" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
                    <div class="col-sm-10">
                      <textarea type="text" id="adicional" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-6 col-sm10">
                      <button class="btn btn-block btn-outline-primary">Guardar</button>
                    </div>
                  </div>
                </form>
                </div>
                <div class="card-footer">
                  <p class="text-muted">Verificar que los datos sean correctos</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php 
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/usuario.js"></script>