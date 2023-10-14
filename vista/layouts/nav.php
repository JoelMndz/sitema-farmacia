  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- icon -->
  <link rel="icon" href="../img/icon1.png" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/animate.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/farmacia/Util/css/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/farmacia/css/sweetalert2.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/farmacia/css/select2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
  <!-- style -->
  <link rel="stylesheet" href="../css/carrito.css">
  <!-- style -->
  <link rel="stylesheet" href="../css/compra.css">
  <!-- style -->
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/footer.css">
  <!-- datatable -->
  <link rel="stylesheet" href="../css/datatables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">-->

</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light" style="background: var(--dark-color1)">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: var(--text-color)"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../vista/home.php" class="nav-link" style="color: var(--text-color)">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color: var(--text-color)">Contact</a>
      </li>
      <li class="nav-item dropdown" id="cat-carrito" style="display:none">
          <img src="../img/carrito2.png" class="imagen-carrito nav-link dropdown-toggle" style="cursor:pointer" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="true">
          <span id="contador" class="contador badge badge-danger"></span>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <table class="carro table text-nowrap p-0">
              <thead class="table">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Concentración</th>
                  <th>Adicional</th>
                  <th>Precio</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody id="lista">

              </tbody>
            </table>
            <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Procesar Compra</a>
            <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block">Vaciar Carrito</a>
          </ul>
        </li>
    </ul>   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <div class="container_dark"></div>
      <img src="../img/moon.png" alt="dark-mode" id="dark_mode">
      <a style="color: var(--text-color2)" href="../controlador/Logout.php">Cerrar Sesión</a>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: var(--nav-color)">
    <!-- Brand Logo -->
    <a href="/farmacia/vista/home.php" class="brand-link" style="background: var(--nav-color)">
      <img src="../img/icon-dark.png" alt="Farmacia EBEN-EZER" class="brand-image elevation" style="opacity: .8">
      <img src="../img/slogan.png" class=" img-light ml-5" id="img-slogan" style="width: 65px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img id="avatar4" src="../img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="../vista/editar_datos_personales.php" class="d-block" style="color: var(--text-color) !important">
          <!--Mia Miracle-->
          <?php
            echo $_SESSION['nombre_us'];
          ?>
        </a>
        </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li id="gestion_catalogo" class="nav-item">
            <a href="adm_catalogo.php" class="nav-link">
              <i class="nav-icon fas fa-cart-plus" style="color: var(--icon-color1);"></i>
              <p>
                Catalogo
              </p>
            </a>
          </li>

          <li id="gestion_catalogo" class="nav-item">
            <a href="adm_alertas.php" class="nav-link">
              <i class="nav-icon fas fa-exclamation-triangle" style="color: #C70039"></i>
              <p>
                Alertas
              </p>
            </a>
          </li>
          
          <li class="nav-header">Usuario</li>
          <li class="nav-item">
            <a href="editar_datos_personales.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog" style="color: var(--icon-color2);"></i>
              <p>
                Mi Perfil
              </p>
            </a>
          </li>

          <li id="gestion_usuario" class="nav-item">
            <a href="adm_usuario.php" class="nav-link">
              <i class="nav-icon fas fa-users" style="color: var(--icon-color2);"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

          <li id="gestion_cliente" class="nav-item">
            <a href="adm_cliente.php" class="nav-link">
              <i class="nav-icon fas fa-user-friends" style="color: var(--icon-color2);"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          
          <li class="nav-header">Ventas</li>
          <li class="nav-item">
            <a href="adm_venta.php" class="nav-link">
              <i class="nav-icon fas fa-notes-medical" style="color: var(--text-color)"></i>
              <p>
                Listar Ventas
              </p>
            </a>
          </li>
          <li id="almacenes"class="nav-header">Almacenes</li>
          <li id="gestion_producto" class="nav-item">
            <a href="adm_producto.php" class="nav-link">
              <i class="nav-icon fas fa-pills" style="color: var(--icon-color3);"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li id="gestion_atributo" class="nav-item">
            <a href="adm_atributo.php" class="nav-link">
              <i class="nav-icon fas fa-vials" style="color: var(--icon-color1);"></i>
              <p>
                Atributos
              </p>
            </a>
          </li>
          <li id="gestion_lote" class="nav-item">
            <a href="adm_lote.php" class="nav-link">
              <i class="nav-icon fas fa-cubes" style="color: var(--icon-color4);"></i>
              <p>
                Lotes
              </p>
            </a>
          </li>
          <li id="compras_nav" class="nav-header">Compras</li>
          <li id="gestion_proveedor" class="nav-item">
            <a href="adm_proveedor.php" class="nav-link">
              <i class="nav-icon fas fa-truck" style="color: var(--text-color)"></i>
              <p>
                Proveedores
              </p>
            </a>
          </li>

          <li id="gestion_compra" class="nav-item">
            <a href="adm_compras.php" class="nav-link">
              <i class="nav-icon fas fa-people-carry" style="color: var(--icon-color2);"></i>
              <p>
                Compras
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>