<?php
include_once 'Venta.php';
include_once 'VentaProducto.php';
include_once 'Cliente.php';
function getHtml($id_venta){
  $venta = new Venta();
  $venta_producto = new VentaProducto();
  $cliente = new Cliente();
  $venta->buscar_id($id_venta);
  $venta_producto->ver($id_venta);
  $venta->buscar_id($id_venta);
  $plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/icon1.png" width="60" height="60">
      </div>
      <h1>COMPROBANTE DE PAGO</h1>
      <div id="company" class="clearfix">
        <div id="negocio">Farmacia EBENEZER</div>
        <div>Direccion: 3 Avenida 0-49 Zona 2,<br /> Comalapa, Chimaltenango</div>
        <div>(502) 7849-8072</div>
      </div>';
      foreach ($venta->objetos as $objeto) {
        if(empty($objeto->id_cliente)){
          $cliente_nombre = $objeto->cliente;
          $cliente_dpi = $objeto->dpi;
        }
        else{
          $cliente->buscar_datos_cliente($objeto->id_cliente);
          foreach ($cliente->objetos as $cli) {
            $cliente_nombre=$cli->nombre.' '.$cli->apellidos;
            $cliente_dpi=$cli->dpi;
          }
        }
      $plantilla.='
    
      <div id="project">
        <div><span>Codigo de Venta: </span>'.$objeto->id_venta.'</div>
        <div><span>Cliente: </span>'.$cliente_nombre.'</div>
        <div><span>DPI: </span>'.$cliente_dpi.'</div>
        <div><span>Fecha y Hora: </span>'.$objeto->fecha.'</div>
        <div><span>Vendedor: </span>'.$objeto->vendedor.'</div>
      </div>';
      }
    $plantilla.='
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">Producto</th>
            <th class="service">Concentracion</th>
            <th class="service">Adicional</th>
            <th class="service">Laboratorio</th>
            <th class="service">Presentacion</th>
            <th class="service">Tipo</th>
            <th class="service">Cantidad</th>
            <th class="service">Precio</th>
            <th class="service">Subtotal</th>
          </tr>
        </thead>
        <tbody>';
        foreach ($venta_producto->objetos as $objeto) {
          $plantilla.='<tr>
            
            <td class="servic">'.$objeto->producto.'</td>
            <td class="servic">'.$objeto->concentracion.'</td>
            <td class="servic">'.$objeto->adicional.'</td>
            <td class="servic">'.$objeto->laboratorio.'</td>
            <td class="servic">'.$objeto->presentacion.'</td>
            <td class="servic">'.$objeto->tipo.'</td>
            <td class="servic">'.$objeto->cantidad.'</td>
            <td class="servic">'.$objeto->precio.'</td>
            <td class="servic">'.$objeto->subtotal.'</td>
          </tr>';
        }
        $calculos= new Venta();
        $calculos->buscar_id($id_venta);
        foreach ($calculos->objetos as $objeto) {
          $iva=$objeto->total*0.12;
          $sub=$objeto->total-$iva;
          
          $plantilla.='
          <tr>
            <td colspan="8" class="grand total">SUBTOTAL</td>
            <td class="grand total">Q.'.$sub.'</td>
          </tr>
          <tr>
            <td colspan="8" class="grand total">IVA(12%)</td>
            <td class="grand total">Q.'.$iva.'</td>
          </tr>
          <tr>
            <td colspan="8" class="grand total">TOTAL</td>
            <td class="grand total">Q.'.$objeto->total.'</td>
          </tr>';

        }
        $plantilla.='
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">*Presentar este comprobante de pago para cualquier reclamo o devolucion.</div>
        <div class="notice">*El reclamo procedera dentro de las 24 horas de haber hecho la compra.</div>
        <div class="notice">*Si el producto esta dañado o abierto, la devolucion no procedera.</div>
        <div class="notice">*Revise su cambio antes de salir del establecimiento.</div>
      </div>
    </main>
    <footer>
      Created by Farmacia EBENEZER.
    </footer>
  </body>';
  return $plantilla;
}