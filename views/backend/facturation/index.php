<!-- <?php
var_dump($this->allData);
?> -->

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autocompletar Producto</title>
    <!-- jQuery y jQuery UI CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .autocomplete-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 5px;
        }
        .autocomplete-item span {
            margin-right: 10px;
        }
    </style>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
  <!--begin::Content wrapper-->
  <div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
          <!--begin::Title-->
          <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Facturación</h1>
          <!--end::Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
              <a href="#" class="text-muted text-hover-primary">Venta</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Venta Facturada</li>
          </li>
          </ul>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
      </div>
      <!--end::Toolbar container-->
    </div>
    <div id="content">
    <section>
      <div class="section-body ms-8">
        <div class="row">
          <div class="col-lg-12">
          <h3 class="text-primary d-flex justify-content-between align-items-center">
            VENTA FACTURADA</h3>
            <hr>
          </div>
        </div>
            <div class="card-body style-default-bright">
              <div class="row">
                <div class="col-md-12">
                  <label>Documento &nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <label class="lb_nombre">CI/NIT/Cod. Cliente
                    <button type="button" id="btn_verificar_nit" onclick="comprobar_documento()" class="btn btn-custom btn-sm" data-toggle="tooltip" data-placement="top" title="Verificar NIT">
                      <i class="fa fa-search" style="font-size: 10px;" aria-hidden="true"></i>
                    </button>
                  </label>
                  <label class="lb_nombre2" id="l_complemento">Complemento &nbsp;&nbsp;</label>
                  <label class="lb_nombre3">Nombre/Razon Social &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <!-- <label class="lb_nombre4">Linea de Crédito&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</label>-->

                  <label for="check_correo" class="lb_nombre5">&nbsp;&nbsp;&nbsp;&nbsp;Correo Electronico&nbsp;&nbsp;&nbsp;&nbsp;</label>
                  <input class="check_correo" type="checkbox" id="check_correo" name="check_correo">
                </div>
              </div>

          <div class="row mb-3">
                  <!-- Documento Identidad -->
                  <div class="col-md-1">
                      <select class="form-control select2-list" id="docs_identidad" name="docs_identidad" onchange="obtener_tipo_doc()" required>
                          <?php if (isset($this->allData) && count($this->allData) > 0) { ?>
                              <?php foreach ($this->allData as $item) { ?>
                                  <option value="<?php echo htmlspecialchars($item['id_catalogo']);?>">
                                      <?php echo htmlspecialchars($item['descripcion']);?>
                                  </option>
                              <?php } ?>
                          <?php } else { ?>
                              <option value="">No hay documentos disponibles</option>
                          <?php } ?>
                      </select>
                  </div>

                  <!-- NIT -->
                  <div class="col-md-2">
                      <input type="hidden" name="codigoExcepcion" class="caja_texto" id="codigoExcepcion" value="0">
                      <input type="text" name="nit" id="nit" class="form-control caja_texto" placeholder="NIT" style="border:1px solid #c7254e;">
                  </div>

                  <!-- Complemento -->
                  <div class="col-md-1">
                      <input type="text" name="complemento" id="complemento" class="form-control caja_texto" placeholder="Complemento" style="border:1px solid #c7254e;">
                  </div>

                  <!-- Nombre / Razón Social -->
                  <div class="col-md-4">
                      <input name="razonSocial" id="razonSocial" type="text" class="form-control caja_texto" placeholder="Nombre / Razón Social" onkeypress="onkeypress_nit_razonSocial()" value="<?php echo $cliente_caja ?>" style="border:1px solid #c7254e;">
                  </div>

                  <!-- Botón -->
                  <div class="col-md-1">
                      <button class="btn btn-secondary" data-toggle="modal" data-target="#finalizar_venta">...</button>
                  </div>

                  <!-- Correo Electrónico -->
                  <div class="col-md-2">
                      <input type="text" id="correo_venta" class="form-control caja_texto" placeholder="Correo electrónico" style="border:1px solid #c7254e; display: none;">
                  </div>
              </div>

              <!-- Dato Adicional -->
              <?php if ($dato_adicional_activo == 'true') { ?>
                  <div class="row mb-3" id="div_dato_adicional">
                      <div class="col-md-12">
                          <label><?php echo $dato_adicional; ?></label>
                          <input type="text" name="dato_adicional" id="dato_adicional" class="form-control caja_texto" placeholder="Dato Adicional" style="border:1px solid #c7254e; width:50%;">
                          <input type="hidden" name="dato_adicional_descripcion" id="dato_adicional_descripcion" class="caja_texto" value="<?php echo $dato_adicional; ?>">
                      </div>
                  </div>
              <?php } ?>
              <div class="row" id="div_alquiler" style="display: none;">
                <div class="col-md-12">
                  <label>Periodo: </label>
                  <input type="text" name="periodo" id="periodo" class="caja_texto" style="border:1px solid #c7254e; margin-right: 10px;;width:50%;">
                </div>
              </div>
              <div class="row" id="div_educativo" style="display: none;">
                <div class="col-md-4">
                  <label class="lb_estudiante" id="lb_estudiante">Nombre Estudiante: </label>
                  <input type="text" name="estudiante" id="estudiante" class="caja_texto" style="border:1px solid #c7254e;width: 70%;">
                </div>
                <div class="col-md-4">
                  <label class="lb_periodo" id="lb_periodo">Periodo Facturado: </label>
                  <input type="text" name="periodo_est" id="periodo_est" class="caja_texto" style="border:1px solid #c7254e;width: 70%;">
                </div>
              </div>
              </br>
              <div class="table-responsive">
                <table id="datatable3" class="table table-striped table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Precio Unidad</th>
                      <th>Precio Total</th>
                      <th>Acci&oacute;n</th>
                    </tr>
                  </thead>
                  <tr>
                    <td style="width: 10%">
                      <form method="post" id="base_form" onsubmit=" return listar(this);">
                        <input type="text" class="formulario" size="1" style="width : 150px" maxlength="50" name="id_producto" id="id_producto">
                      </form>
                    </td>
                    <td style="width: 30%">
                      <form method="post" id="form_nombre" onsubmit=" return listar1(this);">
                        <input type="text" class="formulario" size="1" style="width : 600px" maxlength="5000" name="nombre_producto" id="nombre_producto" onkeydown="onkeydown_nombre_producto()">
                      </form>
                    </td>
                    <td style="width: 5%">1</td>
                    <td style="width: 8%"></td>
                    <td style="width: 8%"></td>
                    <td style="width: 16%" align="center"></td>
                  </tr>
                  <tbody id="con">
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Total</font>
                      </th>
                      <th style="text-align: right;" size=4>

                        <font id="total" size=4><?php echo $total ?></font>
                        <input type="hidden" id="total_venta" name="total_venta">
                      </th>
                    </tr>
                    <tr>
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Descuento</font>
                      </th>
                      <th style="text-align: right;" size=4>
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="descuento" name="descuento" min="0.00" onkeydown="3q()" onblur="calcular_cambio()" value="0.00">
                      </th>
                    </tr>
                    <tr id="tr_gifcard" style="display: none;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Monto Giftcard</font>
                      </th>
                      <th style="text-align: right;">
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="gifcar" name="gifcar" value="0.00" onkeydown="calcular_cambio()" onblur="calcular_cambio()">
                      </th>
                    </tr>
                    <tr id="tr_tarjeta" style="display: none;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Numero Tarjeta</font>
                      </th>
                      <th style="text-align: right;">
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="nro_tarjeta" name="tarjeta" onchange="verificar_tarjeta()" onblur="verificar_tarjeta()">
                      </th>
                    </tr>
                    <tr id="tr_tarjeta2" style="display: none;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Monto Tarjeta</font>
                      </th>
                      <th style="text-align: right;">
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="monto_tarjeta" name="monto_tarjeta" value="0.00" onkeydown="calcular_cambio()" onblur="calcular_cambio()">
                      </th>
                    </tr>
                    <tr id="tr_otros" style="display: none;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Monto otros</font>
                      </th>
                      <th style="text-align: right;">
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="monto_otros" name="monto_otros" value="0.00" onkeydown="calcular_cambio()" onblur="calcular_cambio()">
                      </th>
                    </tr>
                    <tr id="tr_efectivo" style="display: table-row;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Efectivo</font>
                      </th>
                      <td>
                        <input type="number" name="pagado" id="pagado" style="text-align: right; font-size: 18px;  width: 100%;" value="0.00" onkeypress="handleKeyPress(event)" onblur="calcular_cambio()">
                      </td>
                    </tr>
                    <tr id="tr_tasa" style="display: none;">
                      <th colspan="4" style="text-align: right;">
                        <font size=4>Monto Tasa</font>
                      </th>
                      <th style="text-align: right;">
                        <input type="number" style="text-align: right; font-size: 18px;  width: 100%;" id="monto_tasa" name="monto_tasa" value="0.00">
                      </th>
                    </tr>
                    <tr>
                      <th colspan="4" style="text-align: right;">
                      </th>
                      <td>
                        <div style="margin-top: 10px; text-align: center;">
                          <input type="checkbox" id="efectivo" name="contact" value="efectivo" title="Al contado" onclick="mostrar_tr()" checked>
                          <label for="efectivo" title="Al contado"><i style="color: #006400; " class="fa fa-money fa-2x"></i></label>&nbsp;&nbsp;

                          <input type="checkbox" id="tarjeta" name="contact" value="tarjeta" title="Con tarjeta" onclick="mostrar_tr()">
                          <label for="tarjeta" title="Con tarjeta "><i style="color: #000000; " class="fa fa-credit-card fa-2x"></i></label>&nbsp;&nbsp;<br>


                          <input type="checkbox" id="tarQR" name="contact" value="tarQR" title="Con codigoQR" onclick="mostrar_tr()">
                          <label for="tarQR" title="Con codigoQR"><i style="color: #000000; " class="fa fa-qrcode fa-2x"></i></label>&nbsp;&nbsp;

                          <input type="checkbox" id="tareg" name="contact" value="tareg" title="Con giftcard" onclick="mostrar_tr()">
                          <label for="tareg" title="Con giftcard "><i style="color: #000000; " class="glyphicon glyphicon-gift fa-2x"></i></label>&nbsp;&nbsp;<br>

                          <input type="checkbox" id="deuda" name="contact" value="deuda" title="A deuda" onclick="mostrar_tr()">
                          A DEUDA<label for="deuda" title="A deuda">
                           
                          </label>&nbsp;&nbsp;
                        </div>
                        <div class="form form-group">
                          <select class="form-control select2-list" id="tipo_documento" name="tipo_documento" onclick="mostrar_tr1()" required>
                            <?php foreach ($metodo_pago as $met) {  ?>
                              <option value="<?php echo $met->oidtipo ?>"> <?php echo $met->otipo ?></option>
                            <?php  } ?>
                          </select>
                        </div>


                      </td>
                    </tr>

                    <tr>
                      <th colspan="4" style="text-align: right;">
                        <font id="cam" size=4>Cambio</font>
                      </th>
                      <th style="text-align: right;">
                        <font id="cambio" name="cambio" size=4></font>
                        <input type="hidden" id="cambio_venta" name="cambio_venta">
                      </th>
                    </tr>

                    </tfoot>
                </table>
                <button type="onclick" id="btnAgrupar" class="btn btn-primary " style="display: none;" onclick="Agrupar_venta();">Agrupar Venta</button>
                <div class="modal-footer">
                  <div class="alert alert-danger" id="apertura_error" style="text-align: left;display: none;"></div>
                  <button type="onclick" id="btnFinalizar" class="btn btn-primary " onclick="finalizar_venta();">Finalizar</button>
                  <div id="spinner_div" style="display: none;" class="spinner-container pull-right">
                    <div class="spinner"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>

 <script>
  $(document).ready(function() {
    $('#lineaCredito').hide();
    $('[data-toggle="tooltip"]').tooltip();

    function adjustColumnSize() {
      $(".action-column").each(function() {
        var isVisible = !$(this).hasClass("hidden");
        var columnIndex = $(this).index();

        if (isVisible) {
          var maxCellWidth = 0;

          $("#datatable3 tr").each(function() {
            var cell = $(this).find("td:eq(" + columnIndex + ")");
            var cellWidth = cell.outerWidth();
            maxCellWidth = Math.max(maxCellWidth, cellWidth);
          });

          $("th:eq(" + columnIndex + ")").css("width", maxCellWidth + "px");
          $("td:eq(" + columnIndex + ")").css("width", maxCellWidth + "px");
        } else {
          $("th:eq(" + columnIndex + ")").css("width", "");
          $("td:eq(" + columnIndex + ")").css("width", "");
        }
      });
    }

    $(window).resize(function() {
      adjustColumnSize();
    });
    adjustColumnSize();
  });
  

  function mostrarModalCarga() {
    return Swal.fire({
      title: 'Cargando...',
      allowOutsideClick: false,
      showConfirmButton: false,
    });
  }

  //habilitar añadir al input objetivo el valor class="move"
  $(document).ready(function() {
    $(document).keydown(
      function(e) {
        if (e.keyCode == 39) {
          console.log("39");
          $(".move:focus").next().focus();
        }
        if (e.keyCode == 37) {
          $(".move:focus").prev().focus();
          console.log("37");
        }
      }
    );
    $('#check_correo').change(function() {
      if (this.checked) {
        $('#correo_venta').show();
      } else {
        $('#correo_venta').hide();
      }
    })
  });
  

  function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  
//   function listar() {
//     let con = document.getElementById('con');
//     let codigo = document.getElementById("id_producto").value;
//     console.log("Se cargó por código: " + codigo);

//     $.ajax({
//         url:  globalURLCirculo + 'facturation/datos_producto/,
//         type: "POST",
//         data: {
//             buscar: codigo
//         },
//         success: function(respuesta) {
//             var json = JSON.parse(respuesta);
//             console.log(json);

//             if (json.error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error con el producto seleccionado',
//                     text: 'El producto no cuenta con stock disponible',
//                     confirmButtonColor: '#d33',
//                     confirmButtonText: 'ACEPTAR'
//                 });
//                 document.getElementById("base_form").reset();
//             } else {
//                 // Mostrar únicamente el producto buscado en la lista temporal
//                 $("#con").empty();
//                 let content = '<tr onclick="agregarProducto(' + JSON.stringify(json[0]) + ')">' +
//                     '<td>' + json[0].ocodigo + '</td>' +
//                     '<td>' + json[0].onombre + '</td>' +
//                     '<td>' + json[0].ocantidad + '</td>' +
//                     '<td>' + parseFloat(json[0].oprecio_uni).toFixed(2) + '</td>' +
//                     '</tr>';
//                 $("#con").append(content);

//                 // Agregar el producto al presionar Enter
//                 document.getElementById("id_producto").addEventListener("keypress", function(event) {
//                     if (event.key === "Enter") {
//                         agregarProducto(json[0]);
//                         document.getElementById("id_producto").value = ''; // Limpiar el campo de búsqueda
//                     }
//                 });
//             }
//         },
//         error: function(err) {
//             console.error("Error en la solicitud AJAX: ", err);
//         }
//     });
//  }

function listar1() {
    let con = document.getElementById('con');
    var codigo = document.getElementById("nombre_producto").value;
    var match = codigo.match(/ID:(\d+)/);
    var idInvLote = match ? match[1] : null;
    codigo = codigo.split('|');
    codigo = codigo[0];
    console.log("Se cargo por nombre" + codigo);
    $.ajax({
      url:  globalURLCirculo + 'facturation/datos_nombre',
      type: "POST",
      data: {
        buscar: codigo,
        idInvLote: idInvLote
      },
      success: function(respuesta) {
        var json = JSON.parse(respuesta);
        console.log(json);
        if (json.error) {
          Swal.fire({
            icon: 'error',
            title: 'Sucedio un error con el producto seleccionado',
            text: 'El producto no cuenta con stock disponible',
            confirmButtonColor: '#d33',
            confirmButtonText: 'ACEPTAR'
          });
          document.getElementById("base_form").reset();
        } else {
          console.log(respuesta);
          $("#con").empty();
          con.innerHTML = '';
          let total = 0.000;
          for (var i = 0; i < json.length; i++) {
            let codigo_producto = json[i].ocodigo.toString();
            let inv_lote = json[i].invlot;
            let cantidad = json[i].ocantidad;
            let pos = i;
            let num = parseFloat(json[i].oprecio);
            total = total + num;
            let id = json[i].oidventa;
            var precio_total = (parseFloat(json[i].oprecio)).toFixed(2);
            var precio_unidad = (parseFloat(json[i].oprecio_uni)).toFixed(2);
            var content = '<tr>' +
              '<td>' + codigo_producto + '</td>' +
              '<td>' + json[i].onombre + '</td>' +
              '<td>' +
              '<input type="number" style="border:1px solid #c7254e; width : 60px" min="1" name="cantidad' + i + '" id="cantidad' + i + '" value="' + json[i].ocantidad + '" onkeydown="onkeydown_cantidad(this,' + id + ',' + i + ')"' + '" onblur="onkeydown_cantidad(this,' + id + ',' + i + ')"'+ '&nbsp' +
              '</td>' +
              '</td>' +
              '<td>' +
              '<input type="number" style="border:1px solid #c7254e; width : 100px" min="0" name="precio_uni' + i + '" id="precio_uni' + i + '" value="' + precio_unidad + '" onkeydown="onkeydown_precio_uni(this,' + id + ',' + i + ')"' + '" onblur="onkeydown_precio_uni(this,' + id + ',' + i + ')"' + '&nbsp' +
              '</td>' +
              '<td>' +
              '<input type="number" style="border:1px solid #c7254e; width : 100px" min="0" name="precio' + i + '" id="precio' + i + '" value="' + precio_total + '" onkeypress="if (event.keyCode === 13) onkeydown_cant(this,' + id + ')" onblur="onkeydown_cant(this,' + id + ')"' + '&nbsp' +
              '</td>' +
              '<form method="post"  onsubmit="eliminar(' + json[i].oidventa + ');">' +
              '<input type="hidden" name="idVenta" id="id_Venta" value="' + json[i].oidventa + '"></input>' +
              '<td class="action-column" style="width: 10%" align="center">' +
              '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-info" data-toggle="modal" data-target="#adicionales" onclick="adicionar(' + json[i].oidventa + ')">' + '<i class="fa fa-pencil fa-lg">' + '</i>' + '</button>' +
              '<label>&nbsp;&nbsp;&nbsp;</label>' +
              '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-success" data-toggle="modal" data-target="#infoStock" onclick="mostrar_stock(\'' + codigo_producto + '\'); ver_imagen(\'' + json[i].oimagen + '\',\'' + json[i].ocodigo + '\')">' +'<i class="fa fa-eye fa-lg"></i>' + '</button>'+
              '<label>&nbsp;&nbsp;&nbsp;</label>' +
              '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-danger" onclick="eliminar(' + json[i].oidventa + '); ">' + '<i class="fa fa-trash-o">' + '</i>' + '</button>' +
              '<label>&nbsp;&nbsp;&nbsp;</label>' +
              '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-warning" data-toggle="modal" data-target="#infoPrecio" onclick="mostrar_precios(\'' +
              codigo_producto + '\',' + id + ',' + i + ')">' +
              '<i class="fa fa-dollar fa-lg">' + '</i>' +
              '</button>' +
              '<label>&nbsp;&nbsp;&nbsp;</label>' +
              '<button type="button" id ="button_lote_' + i + '" class="btn ink-reaction btn-floating-action btn-xs" style="color:#fff; background-color: #9b59b6;" data-toggle="modal" data-target="#infoLote">' + //GAN-MS-A7-0933 CMurguia 20/11/2023
              '<i class="fa fa-th-list"></i>' +
              '</button>' +
              '</td>' +
              '</form>' +
              '</tr>';
            $("#con").append(content);
            $("#button_lote_" + i).click(function() {
              console.log("json cantidades: " + inv_lote);
              var cod_prod = codigo_producto;
              var id_venta = id;
              var dat = pos;
              var inv_lot = inv_lote;
              var cant = cantidad;
              mostrar_lotes(cod_prod, id_venta, dat, inv_lot, cant);
            });
          }
          total = total.toFixed(2);
          $("#total").html(total);
          document.getElementById("form_nombre").reset();
          $('#total_venta').val(total).trigger('change');
          var pago_efectivo = parseFloat(document.getElementById("pagado").value);
          var pago_gift = parseFloat(document.getElementById("gifcar").value);
          var pago_tarjeta = parseFloat(document.getElementById("monto_tarjeta").value);
          var pago_otros = parseFloat(document.getElementById("monto_otros").value);
          var descuento = parseFloat(document.getElementById("descuento").value);
          console.log(pago_efectivo);
          console.log(pago_gift);
          console.log(pago_tarjeta);
          console.log(pago_otros);
          console.log(descuento);
          var tipo_pago;
          tipo_pago = 'monto_otros';
          let valor = document.getElementById('tipo_documento').value;
          let encontrado = false;
          if (valor == '1723' && !encontrado) {
              tipo_pago = 'pagado';
              encontrado = true;
          }  
          if (valor == '1724' && !encontrado) {
              tipo_pago = 'monto_tarjeta';
              encontrado = true;
          }
          valor = document.getElementById('tareg');
          if (valor.checked && !encontrado) {
              tipo_pago = 'gifcar';
              encontrado = true;
          }  
          valor = document.getElementById('tarQR');
          if (valor.checked && !encontrado) {
              tipo_pago = 'monto_otros';
              encontrado = true;
          }
          valor = document.getElementById('tarjeta');
          if (valor.checked && !encontrado) {
              tipo_pago = 'monto_otros';
              encontrado = true;
          }
          console.log(tipo_pago);

          /* Resetear los inputs de montos */
          document.getElementById('pagado').value = '0.00';
          document.getElementById('gifcar').value = '0.00';
          document.getElementById('monto_tarjeta').value = '0.00';
          document.getElementById('monto_otros').value = '0.00';
          console.log("Listar 1");
          $('#' + tipo_pago).val(total).trigger('change');
          if (json.length != 0) {
            console.log("listar 1 - cambio");
            calcular_cambio();
          } else {
            $("#pagado").val("0.00");
            $("#cambio").html("0.00");
            $("#cambio_venta").val("0.00").trigger('change');
            $("#total").html("0.00");
          }
          //document.getElementById("cantidad0").select();
        }
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire({
          icon: 'error',
          title: 'Sucedio un error con el producto seleccionado',
          text: 'por favor revise inventarios y abastecimiento',
          confirmButtonColor: '#d33',
          confirmButtonText: 'ACEPTAR'
        });
        document.getElementById("form_nombre").reset();
      }
    });
    return false;
  }

function agregarProducto(producto) {
    let lista = document.getElementById('lista_productos'); // Tabla final donde se agregan los productos
    let fila = '<tr>' +
        '<td>' + producto.ocodigo + '</td>' +
        '<td>' + producto.onombre + '</td>' +
        '<td>' +
        '<input type="number" style="border:1px solid #c7254e; width : 60px" min="1" value="' + producto.ocantidad + '">' +
        '</td>' +
        '<td>' +
        '<input type="number" style="border:1px solid #c7254e; width : 100px" min="0" value="' + parseFloat(producto.oprecio_uni).toFixed(2) + '">' +
        '</td>' +
        '<td>' + (parseFloat(producto.oprecio) || 0).toFixed(2) + '</td>' +
        '<td>' +
        '<button type="button" class="btn btn-danger" onclick="eliminarProducto(this)">Eliminar</button>' +
        '</td>' +
        '</tr>';
    $(lista).append(fila);
}

function eliminarProducto(button) {
    $(button).closest('tr').remove(); // Elimina la fila donde se encuentra el botón
}


</script>
<!-- FIN DE VENTA FACTURADA -->

