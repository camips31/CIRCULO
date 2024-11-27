<!-- <?php
var_dump($this->allData);
?> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
              <a href="#" class="text-muted text-hover-primary">Cliente</a>
            </li>
            <li class="breadcrumb-item text-muted">Clientes</li>
            </li>
            <li class="breadcrumb-item text-muted">Información General</li>
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
            Clientes
            <button type="button" class="btn btn-primary ink-reaction btn-sm me-10" onclick="formulario()">
              <span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp; Nuevo Cliente
            </button>
          </h3>
            <hr>
          </div>
        </div>

        <div class="row" style="display: none;" id="form_registro">
          <div class="col-sm-8 col-md-9 col-lg-10 col-lg-offset-1">
            <div class="text-divider visible-xs"><span>Formulario de Registro</span></div>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
              <form id="cliente_Ana" class="form" autocomplete="off" method="POST">
                  <input type="hidden" name="id_cliente" id="id_cliente" value="0">
                  <div class="card">
                    <div class="card-head style-primary">
                      <div class="tools">
                        <div class="btn-group">
                        <a class="btn btn-icon-toggle" onclick="update_formulario()"><i class="fas fa-sync-alt"></i></a>
                        <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="fas fa-times"></i></a>
                        </div>
                      </div>
                      <header id="titulo"></header>
                    </div>

                    <!-- Datos de la ubicación actual
                    <input type="hidden" id="latitud" placeholder="Latitud" name="latitud" style="position:absolute;left:10px;bottom:100px;z-index:999;">
                    <input type="hidden" id="longitud" placeholder="Longitud" name="longitud" style="position:absolute;left:10px;bottom:120px;z-index:999;">
                    <input type="hidden" id="dir" placeholder="DIR" name="dir" style="position:absolute;left:10px;bottom:140px;z-index:999;">
                    <input type="hidden" id="direc_flag" name="direc_flag" style="position:absolute;left:10px;bottom:140px;z-index:999;">
                    <input type="hidden" id="latitud2" placeholder="Latitud" name="latitud2" style="position:absolute;left:10px;bottom:100px;z-index:999;">
                    <input type="hidden" id="longitud2" placeholder="Longitud" name="longitud2" style="position:absolute;left:10px;bottom:120px;z-index:999;">
                    <input type="hidden" id="dir2" placeholder="DIR" name="dir2" style="position:absolute;left:10px;bottom:140px;z-index:999;">


                    Datos de la ubicacion modificada
                    <input type="hidden" id="Latitude" name="Latitude" placeholder="Latitude">
                    <input type="hidden" id="Longitude" name="Longitude" placeholder="Longitude"> -->

                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="form-group floating-label" id="c_doc_identidad">
                            <select class="form-control select2-list" id="doc_identidad" name="doc_identidad" required>
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
                              <label for="docs_identidad">Tipo documento</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4" id="id_doc">
                          <div class="form-group">
                            <div class="form-group floating-label" id="vDocumento">
                               <input type="text" class="form-control" name="vDocumento" id="vDocumento" required data-rule-minlength="7" data-rule-maxlength="10" data-rule-number="true" oninput="this.value = this.value.replace(/[^0-9a-zA-Z\s]/g, '')">
                              <label for="documento">Documento</label>
                              <input type="hidden" class="form-control" name="codigoExcepcion" id="codigoExcepcion" value="0">
                            </div>
                            <p id="error-message" class="error-message"></p>
                          </div>
                        </div>
                        <div class="col-md-4" id="div_complemento">
                          <div class="form-group">
                            <div class="form-group floating-label" id="VComplemento">
                              <input type="text" class="form-control" name="VComplemento" id="vComplemento" onchange="return mayuscula(this);" oninput="this.value = this.value.replace(/[^()\/\*\#\.\,\-0-9a-zA-Z\s]/g, '')">
                              <label for="complemento">Complemento</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2" id="div_verificar_nit" style="display:none">
                          <div class="form-group">
                            <button type="button" class="btn btn-primary ink-reaction btn-sm" onclick="comprobar_documento()">Verificar Nit</button>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group floating-label" id="vNombres">
                            <input type="text" class="form-control" name="vNombres" id="vNombres" onchange="return mayuscula(this);" maxlength="40" required>
                            <label for="nombres">Nombres</label>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group floating-label" id="vApellidos">
                            <input type="text" class="form-control" name="vApellidos" id="vApellidos" onchange="return mayuscula(this);" maxlength="40" required>
                            <label for="apellidos">Apellidos</label>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group floating-label" id="vCorreo">
                            <input type="text" class="form-control" name="vCorreo" id="vCorreo">
                            <label for="correo">Correo</label>
                          </div>
                          <span id="correo-error" class="error-message" style="color: red; display: none;">Por favor, ingrese un correo válido</span>
                        </div>
                        <div class="col-sm-6" id="div_movil">
                          <div class="form-group floating-label" id="vMovil">
                            <input type="number" class="form-control" name="vMovil" id="vMovil" data-rule-number="true" oninput="this.value = this.value.replace(/[^0-9\+\s]/g, '')">
                            <label for="movil">Movil</label>
                          </div>
                          <span id="movil-error" class="error-message"></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group floating-label" id="vDescripcion">
                            <textarea class="form-control" name="vDescripcion" id="VDescripcion" rows="3" onchange="return mayuscula(this);" oninput="this.value = this.value.replace(/[^()\/\*\#\.\,\-0-9a-zA-Z\s]/g, '')"></textarea>
                            <label for="descripcion">Descripción</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group floating-label" id="vDireccion">
                            <textarea class="form-control" name="vDireccion" id="vDireccion" rows="3" onchange="return mayuscula(this);" oninput="this.value = this.value.replace(/[^()\/\*\#\.\,\-0-9a-zA-Z\s]/g, '')"></textarea>
                            <label for="direccion">Dirección</label>
                          </div>
                        </div>

                      </div>
                      <!-- <div class="col-md-12">
                         mapa -->
                        <!-- <div class="panel-body">
                          <div id="mapa1">

                          </div>

                        </div>

                      </div> --> 
                      
                      <div class="card-actionbar">
                        <div class="card-actionbar-row">
                          <!-- <button type="button" class="btn btn-flat btn-primary ink-reaction" onclick="gestionar_cliente('MODIFICADO');" name="btn" id="btn_edit" value="edit" disabled>Modificar Cliente</button> -->
                          <button id="btn_register_client" type="submit" class="btn btn-primary">
                              Registrar Cliente
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
 
        <!-- LISTADO -->
        <div class="row">
          <div class="col-md-12">
          <div class="card-header collapsible d-flex justify-content-between cursor-pointer rotate">
                            <h6 class="card-title">Listado de Clientes</h6>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon fs-1 position-absolute ms-4"></span>
                            <input type="text" id="searchPartners" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
          </div>
                            <!--end::Search-->  
           </div>
            <div class="card card-bordered style-primary">
              <div class="card-body style-default-bright">
                <div class="table-responsive">
                  <table id="datatable_cli" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>CI/NIT/Cod. Cliente</th>
                        <th>Tipo documento</th>
                        <th>Tel&eacute;fono M&oacute;vil</th>
                        <th>Descripción</th>
                        <th>Correo</th>
                        <th>Direcci&oacute;n</th>
                        <!-- <th>Estado</th> -->
                        <th>Acci&oacute;n</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- Modal ver mapa
  <div class="modal fade" id="ver_mapa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p class="h3" style="margin: 0px">UBICACIÓN</p>
        </div>
        <div class="modal-body">
          mapa 

          <div class="panel-body">
            <div id="mapa">

            </div>

          </div>
    </div>

    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-flat btn-primary ink-reaction" onclick="guardar_ubi_modal('MODIFICADO');">Guardar</button>
        </div>
        <input type="hidden" id="id_cliente_modal" name="id_cliente_modal" placeholder="id_cliente_modal">
        <input type="hidden" id="nombres_modal" name="nombres_modal" placeholder="nombres_modal">
        <input type="hidden" id="apellidos_modal" name="apellidos_modal" placeholder="apellidos_modal">
        <input type="hidden" id="ci_modal" name="ci_modal" placeholder="ci_modal">
        <input type="hidden" id="movil_modal" name="movil_modal" placeholder="movil_modal">
        <input type="hidden" id="direccion_modal" name="direccion_modal" placeholder="direccion_modal">
      </div>
    </div>
  </div>

  Modal de Linea de credito
  <div class="modal fade" id="m_linea_credito" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#5F9FF6">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <p class="h3" style="margin: 0px; color:#fff">Linea de crédito</p>
        </div>
        <br>
        <div class="modal-body">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="input-group" id="group-line">
                <div class="input-group-content">
                  <input type="number" step="0.01" style="padding-top:18px;" class="form-control" name="linea_credito" id="linea_credito" autocomplete="off" require min="0" onchange="validarLineaCredito();">
                  <label for="linea_credito">Linea de crédito</label>
                </div>
                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              </div>
            </div><br>
          </div>
          <br>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <div class="input-group date" id="demo-date">
                  <div class="input-group-content">
                    <input type="text" style="padding-top: 18px;" class="form-control" name="fecha_inicial" id="fecha_inicial" readonly="" required>
                    <label for="fecha_inicial">Fecha Inicial</label>
                  </div>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <div class="input-group date" id="demo-date-val">
                  <div class="input-group-content">
                    <input type="text" style="padding-top: 18px;" class="form-control" name="fecha_final" id="fecha_final" readonly="" required>
                    <label for="fecha_final">Fecha Final</label>
                  </div>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div> -->

        <!-- <br><br><br><br>
        <div class="modal-footer">
          <button type="button" class="btn btn-success  btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right"" onclick=" guardar_linea_credito();">Guardar</button>
        </div>
        <input type="hidden" id="id_cliente_modal_credito" name="id_cliente_modal_credito" placeholder="id_cliente_modal">
      </div>
    </div>
  </div> -->


  <script>
    function formulario() {
      $("#titulo").text("Registrar Cliente");
      $("#dir").val("");

      document.getElementById("form_registro").style.display = "block";
      update_formulario(); 
    }
    function cerrar_formulario() {
      document.getElementById("form_registro").style.display = "none";
    }
    function update_formulario() {
      $('#cliente_Ana')[0].reset();
      $('#btn_edit').attr("disabled", true);
      $('#btn_add').attr("disabled", false);
    }

    function mayuscula(field) {
      field.value = field.value.toUpperCase();
    }

    // function comprobar_documento() {
    //   var documento = document.getElementById("documento").value;
    //   $.ajax({
    //     url: globalCirculo + cliente/C_cliente/verificar_nit",
    //     type: "POST",
    //     data: {
    //       documento: documento
    //     },
    //     success: function(resp) {
    //       var c = JSON.parse(resp);
    //       console.log(c)
    //       if (c.success == true) {
    //         response = JSON.parse(c.response);
    //         transaccion = response.RespuestaVerificarNit.transaccion;
    //         if (transaccion) {
    //           Swal.fire({
    //             icon: 'success',
    //             title: response.RespuestaVerificarNit.mensajesList.descripcion,
    //             confirmButtonColor: '#3085d6',
    //             confirmButtonText: 'ACEPTAR'
    //           })
    //         } else {
    //           Swal.fire({
    //             icon: 'warning',
    //             title: response.RespuestaVerificarNit.mensajesList.descripcion,
    //             text: 'Registrar como Nit invalido?',
    //             confirmButtonColor: '#3085d6',
    //             confirmButtonText: 'ACEPTAR',
    //             showCancelButton: true,
    //             cancelButtonText: 'CANCELAR',
    //             cancelButtonColor: '#d33',
    //           }).then((result) => {
    //             document.getElementById('complemento').value = '';
    //             if (!result.isConfirmed) {
    //               document.getElementById('documento').value = '';
    //               $('#codigoExcepcion').val('0').trigger('change');
    //             } else {
    //               $('#codigoExcepcion').val('1').trigger('change');
    //             }
    //           })
    //         }
    //         console.log(response.RespuestaVerificarNit.transaccion)
    //       } else {
    //         Swal.fire({
    //           icon: 'error',
    //           title: 'Oops...',
    //           text: c.error,
    //           confirmButtonColor: '#d33',
    //           confirmButtonText: 'ACEPTAR'
    //         })
    //       }
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //       alert('Error al obtener datos de ajax');
    //     }
    //   });
    // }
  </script>

  
  </body>
  </html>