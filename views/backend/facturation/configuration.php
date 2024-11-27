<!-- <?php 
var_dump($data->estado) ?> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos Editables</title>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

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
                <a href="#" class="text-muted text-hover-primary">Configuracion</a>
              </li>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <form class="form form-validate" novalidate="novalidate" enctype="multipart/form-data" name="form_configuracion" id="form_configuracion" method="post">
              <div class="card">
                <div class="card-head style-primary ms-8">
                  <header>Configuraci&oacute;n de sistemas inform&aacute;ticos de facturaci&oacute;n</header>
                </div>
                <div class="card-body">
                  <div class="col-md-12">
                    <div class="row">
                      <input type="hidden" class="form-control" name="id_facturacion" id="id_facturacion">
                      <div class="col-md-6">
                        <div class="form-group floating-label" id="c_codigo">
                          <input type="text" class="form-control" name="codigo" id="codigo" required>
                          <label for="codigo">Codigo de Sistema</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group floating-label" id="c_nit">
                          <input type="text" class="form-control" name="nit" id="nit" required>
                          <label for="nit">NIT</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <select class="form-control select2-list" id="ambiente" name="ambiente" required>
                            <option value="2">PRUEBAS</option>
                            <option value="1">PRODUCCIÓN</option>
                          </select>
                          <label for="ambiente">Tipo Ambiente</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <select class="form-control select2-list" id="modalidad" name="modalidad">
                            <option value="1">ELECTRÓNICA EN LÍNEA</option>
                            <option value="2">COMPUTARIZADA EN LÍNEA</option>
                          </select>
                          <label for="modalidad">Tipo Modalidad</label>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc">
                                <input type="text" class="form-control" name="cafc" id="cafc">
                                <label for="cafc">CAFC - Factura Compra Venta</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc_ini">
                                <input type="number" class="form-control" name="cafc_ini" id="cafc_ini">
                                <label for="cafc_ini">Rango Inicial</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc_fin">
                                <input type="number" class="form-control" name="cafc_fin" id="cafc_fin">
                                <label for="cafc_fin">Rango final</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc_tasas">
                                <input type="text" class="form-control" name="cafc_tasas" id="cafc_tasas">
                                <label for="cafc_tasas">CAFC - Factura Compra Venta Tasas</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc_tasas_ini">
                                <input type="number" class="form-control" name="cafc_tasas_ini" id="cafc_tasas_ini">
                                <label for="cafc_tasas_ini">Rango Inicial</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <div class="floating-label" id="c_cafc_tasas_fin">
                                <input type="number" class="form-control" name="cafc_tasas_fin" id="cafc_tasas_fin">
                                <label for="cafc_tasas_fin">Rango final</label>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group floating-label" id="c_token">
                          <textarea class="form-control" name="token" id="token" rows="4"></textarea>
                          <label for="token">Token</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group floating-label" id="c_host">
                          <input type="text" class="form-control" name="smtp_host" id="smtp_host" required>
                          <label for="smtp_host">Smtp Host</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group floating-label" id="c_port">
                          <input type="text" class="form-control" name="smtp_port" id="smtp_port" required>
                          <label for="smtp_port">Smtp Port</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group floating-label" id="c_user">
                          <input type="text" class="form-control" name="smtp_user" id="smtp_user" required>
                          <label for="smtp_user">Smtp User</label>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group floating-label" id="c_pass">
                          <input type="password" class="form-control" name="smtp_pass" id="smtp_pass" required>
                          <label for="smtp_pass">Smtp Pass</label>
                          <span class="fa fa-fw fa-eye password-icon show-password" style="color:#a6cded;" id="password-icon" onclick="prev_password()"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="cert">
                      <div class="col-sm-6">
                        <div class="form-group floating-label" id="c_pk">
                          <label for="">Seleccione su certificado/s digital (".pem", ".crt", ".p12")</label>
                          <input class="" type="file" name="archivo_crt[]" id="archivo_crt" multiple />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group floating-label" id="c_pk">
                          <label for="">Seleccione su firma digital (".pem", ".crt", ".p12")</label>
                          <input class="" type="file" name="archivo_pk[]" id="archivo_pk" multiple />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-actionbar">
                  <div class="card-actionbar-row" style="display: block;" id="form1">
                    <button type="button" class="btn btn-flat btn-primary ink-reaction" name="btn" id="btn_edit" value="edit" onclick="gestionar_sistema(this)">Guardar Cambios</button>
                    <button type="button" class="btn btn-flat btn-primary ink-reaction" onclick="formulario()"> Nueva Configuracion</button>
                  </div>
                  <div class="row" style="display: none;" id="form_registro">
                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                        <button type="button" class="btn btn-flat btn-primary ink-reaction" name="btn" id="btn_add" value="add" onclick="gestionar_sistema(this)">Registrar Configuracion</button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </form>

          </div>

        </div>
      </div>

    </section>
  </div>

  <script>
    function datos_sistema() {
          var dataSistema = <?= json_encode($this->dataSistem) ?>;
          // console.log(dataSistema);
          if (dataSistema.length > 0) {
              $('#id_facturacion').val(dataSistema[0].id_facturacion).trigger('change');
              $('#codigo').val(dataSistema[0].cod_sistema).trigger('change');
              $('#nit').val(dataSistema[0].nit).trigger('change');
              $('#ambiente').val(dataSistema[0].cod_ambiente).trigger('change');
              $('#modalidad').val(dataSistema[0].cod_modalidad).trigger('change');
              $('#cafc').val(dataSistema[0].cod_cafc).trigger('change');
              $('#cafc_ini').val(dataSistema[0].cafc_ini).trigger('change');
              $('#cafc_fin').val(dataSistema[0].cafc_fin).trigger('change');
              $('#cafc_tasas').val(dataSistema[0].cod_cafc_tasas).trigger('change');
              $('#cafc_tasas_ini').val(dataSistema[0].cafc_tasas_ini).trigger('change');
              $('#cafc_tasas_fin').val(dataSistema[0].cafc_tasas_fin).trigger('change');
              $('#estado').val(dataSistema[0].cod_emision).trigger('change');
              console.log(dataSistema[0].cod_token);  // Verificar si se imprime el token completo en la consola
              $('#token').val(dataSistema[0].cod_token).trigger('change');
              $('#smtp_host').val(dataSistema[0].smtp_host).trigger('change');
              $('#smtp_port').val(dataSistema[0].smtp_port).trigger('change');
              $('#smtp_user').val(dataSistema[0].smtp_user).trigger('change');
              $('#smtp_pass').val(dataSistema[0].smtp_pass).trigger('change');
      } else {
          formulario();
      }
    }


    function gestionar_sistema(val) {
      var input_crt = document.getElementById('archivo_crt');
      var input_pk = document.getElementById('archivo_pk');
      var files_crt = input_crt.files;
      var files_pk = input_pk.files;
      var validExtensions = [".pem", ".crt", ".p12"];
      var valid = true;

      console.log(files_crt);

      for (var i = 0; i < files_crt.length; i++) {
          var fileName = files_crt[i].name;
          var fileExtension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
          var fileName_pk = files_pk[i].name;
          var fileExtension_pk = fileName_pk.substring(fileName_pk.lastIndexOf('.')).toLowerCase();

          if (validExtensions.indexOf(fileExtension) === -1 || validExtensions.indexOf(fileExtension_pk) === -1) {
              valid = false;
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Solo se permiten archivos de extension .pem, .crt o .p12.',
                  confirmButtonColor: '#d33',
                  confirmButtonText: 'ACEPTAR'
              });
              input_crt.value = '';
              input_pk.value = '';
              break;
          }
      }

      var token = document.getElementById('token').value;
      var codigo = document.getElementById('codigo').value;
      var nit = document.getElementById('nit').value;

      if (token === "" || codigo === "" || nit === "") {
          valid = false;
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor completa todos los campos obligatorios.',
              confirmButtonColor: '#d33',
              confirmButtonText: 'ACEPTAR'
          });
          return;
      }

      var tipo = document.getElementById('modalidad').value;

      if (valid || tipo == 2) {
          var formData = new FormData($('#form_configuracion')[0]);
          let loadingSwal = Swal.fire({
              title: 'Cargando...',
              allowOutsideClick: false,
              showConfirmButton: false,
          });

          $.ajax({
            type: "POST",
            url: globalURLCirculo + 'facturation/C_gestionar_sistema/' + val.value,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json", // Especifica que se espera JSON
            beforeSend: function() {
                loadingSwal;
            },
            success: function(resp) {
                try {
                    if (resp[0].estado === true) {  
                        Swal.fire({
                            icon: 'success',
                            title: 'El agregado o modificación se realizó con éxito',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ACEPTAR'
                        }).then(function(result) {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: resp[0].mensaje,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'ACEPTAR'
                        });
                    }
                } catch (error) {
                    console.error("Error al analizar JSON: ", error, resp);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hubo un error en la respuesta del servidor.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'ACEPTAR'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en la solicitud AJAX: ", textStatus, errorThrown, jqXHR.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error en la conexión con el servidor: ' + jqXHR.responseText,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'ACEPTAR'
                });
            }
        });

          $('.swal2-container').click(function(e) {
              e.stopPropagation();
          });
      }
    }


    function formulario() {
      document.getElementById("form_registro").style.display = "block";

      document.getElementById("form1").style.display = "none";
      $('#form_configuracion')[0].reset();
    }
      
    function prev_password() {
      let showPassword = document.querySelector('.show-password');
      let password = document.getElementById('smtp_pass');
      if (password.type === "text") {
        password.type = "password";
        showPassword.classList.remove('fa-eye-slash');
      } else {
        password.type = "text";
        showPassword.classList.toggle("fa-eye-slash");
      }
    }

    function validarArchivos_crt() {
      var input_crt = document.getElementById('archivo_crt');
      var file_crt = input_crt.files;

      if (file_crt.length > 1) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Solo debe ingresar 1 archivo.',
          confirmButtonColor: '#d33',
          confirmButtonText: 'ACEPTAR'
        });
        input_crt.value = '';
        return false;
      } else {
        return true;
      }
    }

    function validarArchivos_pk() {
      var input_pk = document.getElementById('archivo_pk');
      var files_pk = input_pk.files;
      console.log("entro");
      

      if (files_pk.length > 1) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Solo debe ingresar 1 archivo.',
          confirmButtonColor: '#d33',
          confirmButtonText: 'ACEPTAR'
        });
        input_pk.value = '';
        return false;
      } else {
        return true;
      }
    }
    
    function validar_tipo() {
      var tipo = document.getElementById('modalidad').value;    
      if (tipo == 1) {
        document.getElementById("cert").style.display = "block";
        $('#archivo_crt').prop('required', true);
        $('#archivo_pk').prop('required', true);
      } else {
        document.getElementById("cert").style.display = "none";
        $('#archivo_crt').removeAttr('required');
        $('#archivo_pk').removeAttr('required');
      }
    }
      
    $(document).ready(function() {
      datos_sistema();
        $('#modalidad').on('change', function() {
        validar_tipo(); 
        });
    });
  
  </script>  
  </body>
  </html>