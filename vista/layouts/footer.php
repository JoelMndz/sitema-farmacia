<footer class="main-footer" style="background: var(--dark-color1); color: var(--text-color)">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
  </div>
    <strong>Copyright &copy; 2023 <a style="color: var(--text-color2)" href="https://github.com/MyCaliGT">MaycolCali</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="../js/demo.js"></script>-->
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- Select2 -->
<script src="../js/select2.js"></script>
<!-- Datatable -->
<script src="../js/datatables.js"></script>
<script src="../js/dark_mode.js"></script>
<!--<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>-->
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<!-- Dark mode -->
</body>
<script>
  let funcion = 'devolver_avatar';
  $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
    const avatar = JSON.parse(response);
    $('#avatar4').attr('src','../img/'+avatar.avatar);
  })
  funcion='tipo_usuario';
  $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
    if(response==1){
      $('#gestion_lote').hide();
      $('#gestion_compra').hide();
    }
    else if(response==2){
      $('#gestion_lote').hide();
      $('#gestion_usuario').hide();
      $('#gestion_producto').hide();
      $('#gestion_atributo').hide();
      $('#gestion_proveedor').hide();
      $('#gestion_compra').hide();
      $('#almacenes').hide();
      $('#compras_nav').hide();
    }
  })
</script>
</html>