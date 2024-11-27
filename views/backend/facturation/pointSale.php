<?php $this->vView->dataBranch ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos Editables</title>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>


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
              <a href="#" class="text-muted text-hover-primary">Ventas</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Productos</li>
            </li>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
      </div>
      <!--end::Toolbar container-->
    </div>

    <div class="section-body">
        <div class="row">
          <div class="col-lg-4 form">
            <div class="form-group floating-label" id="c_sucursal">
            <select class="form-control select2-list" id="sucursal" name="sucursal" onchange="listar_sucursales(this)">
                <?php foreach ($this->dataBranches as $branch) { ?>
                  <option value="<?php echo htmlspecialchars($branch['id_sucursal']); ?>" data-descripcion="<?php echo htmlspecialchars($branch['descripcion']); ?>">
                    <?php echo htmlspecialchars($branch['descripcion']); ?>
                  </option>
                <?php } ?>
            </select>
              <label for="sucursal">Seleccione Sucursal</label>
            </div>
          </div>
          <div class="col-lg-12">
            <h3 class="text-primary">Listado de Puntos de Venta <span id="titulo_sucursal"></span>
              <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right" style="margin-left: 20px;" onclick="consultar_punto_venta()">Consultar Puntos de Ventas</button>
              <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right" style="margin-left: 20px;" onclick="formulario2()"><span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp; Registrar Ubicacion Existente</button>
              <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right" onclick="formulario()"><span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp;Nuevo Punto de Venta</button>
              <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right" style="margin-right: 20px;" onclick="generar_cudfs()"> &nbsp;Generar Cufds</button>
            </h3>
            <hr>
          </div>
        </div>

        <div class="row" style="display: none;" id="form_registro">
          <div class="col-sm-8 col-md-9 col-lg-10 col-lg-offset-1">
            <div class="text-divider visible-xs"><span>Formulario de Registro</span></div>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <form class="form form-validate" novalidate="novalidate" name="form_punto_venta" id="form_punto_venta">

                  <div class="card">
                    <div class="card-head style-primary">
                      <div class="tools">
                        <div class="btn-group">
                          <a id="btn_update2" class="btn btn-icon-toggle" onclick="update_formulario()"><i class="md md-refresh"></i></a>
                          <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="md md-close"></i></a>
                        </div>
                      </div>
                      <header id="titulo"></header>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <input type="hidden" class="form-control" name="idsucursal" id="idsucursal">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group floating-label" id="c_descripcion">
                                <input type="text" class="form-control" name="descripcion" id="descripcion" required>
                                <div id="result-error"></div>
                                <label for="descripcion">Descripción</label>
                              </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group floating-label" id="c_nombre">
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                                <label for="nombre">Nombre</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group floating-label" id="c_tipo_venta">
                            <!-- <select class="form-control select2-list" id="tipo_venta" name="tipo_venta" required>
                              <option value=""></option>
                              <?php foreach ($lst_tipo_venta as $tipo_venta) {  ?>
                                <option value="<?php echo $tipo_venta->id_tipo_venta ?>" <?php echo set_select('tipo_venta', $tipo_venta->id_tipo_venta) ?>>
                                  <?php echo $tipo_venta->descripcion ?></option>
                              <?php  } ?>
                            </select> -->
                            <label for="tipo_venta">Seleccione Tipo de Punto de Venta</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                        <button type="button" class="btn btn-flat btn-primary ink-reaction" name="btn" id="btn_add" value="add" onclick="registrar_punto_venta('add');">Registrar Punto de Venta</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="display: none;" id="form_registro2">
          <div class="col-sm-8 col-md-9 col-lg-10 col-lg-offset-1">
            <div class="text-divider visible-xs"><span>Formulario de Registro</span></div>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <form class="form form-validate" novalidate="novalidate" name="form_punto_venta2" id="form_punto_venta2">
                  <div class="card">
                    <div class="card-head style-primary">
                      <div class="tools">
                        <div class="btn-group">
                          <a id="btn_update" class="btn btn-icon-toggle" onclick="update_formulario()"><i class="md md-refresh"></i></a>
                          <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="md md-close"></i></a>
                        </div>
                      </div>
                      <header id="titulo2"></header>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group floating-label" id="c_ubicacion">
                            <!-- <select class="form-control select2-list" id="ubicacion" name="ubicacion" required>
                              <?php foreach ($lst_ubicaciones as $ubi) {  ?>
                                <option value="<?php echo $ubi->oidubicacion ?>" <?php echo set_select('ubi', $ubi->oidubicacion) ?>>
                                  <?php echo $ubi->oubicacion ?></option>
                              <?php  } ?>
                            </select> -->
                            <label for="ubi">Seleccione Ubicacion</label>
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group floating-label" id="c_lt_sucursal">
                            <select class="form-control select2-list" id="lt_sucursal" name="lt_sucursal" onchange="generar_punto_venta(this)">
                              <option value=""></option>
                              <?php foreach ($this->dataBranch as $cs) { ?>
                                <option value="<?php echo $cs['id_sucursal']; ?>">
                                  <?php echo $cs['descripcion']; ?>
                                </option>
                              <?php } ?>
                            </select>
                            <label for="lt_sucursal">Seleccione Sucursal</label>
                          </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                          <div class="form-group floating-label" id="c_punto_venta" style="display: none;">
                            <select class="form-control select2-list" id="punto_venta" name="punto_venta" required>
                            </select>
                            <label for="punto_venta">Seleccione Punto de Venta</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                        <button type="button" class="btn btn-flat btn-primary ink-reaction" name="btn" id="btn_add" value="add" onclick="registrar_ubicacion_punto_venta('add');">Registrar Punto de Venta Existente</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="display: none;" id="form_registro3">
          <div class="col-sm-8 col-md-9 col-lg-10 col-lg-offset-1">
            <div class="text-divider visible-xs"><span>Formulario de Registro</span></div>
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <form class="form form-validate" novalidate="novalidate" name="form_punto_venta3" id="form_punto_venta3" enctype="multipart/form-data" method="post">
                  <div class="card">
                    <div class="card-head style-primary">
                      <div class="tools">
                        <div class="btn-group">
                          <a id="btn_update3" class="btn btn-icon-toggle" onclick="update_formulario()"><i class="md md-refresh"></i></a>
                          <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="md md-close"></i></a>
                        </div>
                      </div>
                      <header id="titulo3"></header>
                    </div>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group floating-label" id="c_ubicacion3">
                            <!-- <select class="form-control select2-list" id="ubicacion3" name="ubicacion3" required>
                              <?php foreach ($lst_ubicaciones as $ubi) {  ?>
                                <option value="<?php echo $ubi->oidubicacion ?>" <?php echo set_select('ubi', $ubi->oidubicacion) ?>>
                                  <?php echo $ubi->oubicacion ?></option>
                              <?php  } ?>
                            </select> -->
                            <label for="ubi">Seleccione Ubicacion</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                          <div class="form-group floating-label" id="c_punto_venta3">
                           <select class="form-control select2-list" id="punto_venta3" name="punto_venta3" required>
                              <option value=""></option>
                              <?php foreach ($lst_puntos_venta as $punto_venta) {  ?>
                                <option value="<?php echo $punto_venta->cod_punto_venta ?>" <?php echo set_select('punto_venta', $punto_venta->cod_punto_venta) ?>>
                                  <?php echo $punto_venta->nombre ?></option>
                              <?php  } ?>
                            </select> 
                            <label for="punto_venta3">Seleccione Punto de Venta</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btn" id="btn_add3" value="exist">Registrar Punto de Venta
                          Existente</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="tabla_punto_venta" style="display: block;">
          <div class="col-md-12">
            <div class="text-divider visible-xs"><span>Listado de Registros</span></div>
            <div class="card card-bordered style-primary">
              <div class="card-body style-default-bright">
                <div class="table-responsive">
                  <table id="datatable_punto_venta" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Cod. Punto Venta</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Tipo de Venta</th>
                        <th>Codigo Cuis</th>
                        <th>Fecha de ven. Cuis</th>
                        <th>Codigo Cufd</th>
                        <th>Fecha de ven. Cufd</th>
                        <th>Acci&oacute;n</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="tabla_punto_venta2" style="display: none;">
          <div class="col-md-12">
            <div class="text-divider visible-xs"><span>Listado de Registros</span></div>
            <div class="card card-bordered style-primary">
              <div class="card-body style-default-bright">
                <div class="table-responsive">
                  <table id="datatable_punto_venta_ubicacion" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nro.</th>
                        <th>Ubicacion</th>
                        <th>Sucursal</th>
                        <th>Punto de Venta</th>
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
  <!-- END CONTENT -->
  </div>
  <!-- END BASE -->
  <div class="modal fade" name="puntoVenta" id="puntoVenta" tabindex="-1" role="dialog" aria-labelledby="formModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form" role="form" name="form_editar" id="form_editar" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="formModalLabel">Lista de Puntos de Venta</h4>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="table-responsive" style="margin:10px; overflow-y: scroll;">
                  <table id="dt_puntoventa" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <!-- <th width="5%">N&deg;</th> -->
                        <th width="10%">COD. PUNTO VENTA</th>
                        <th width="40%">NOMBRE</th>
                        <th width="45%">TIPO PUNTO VENTA</th>
                        <th width="5%">ACCION</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <div><br> </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal faded-flex" id="sincronizacion_actividad" tabindex="-1" role="dialog" aria-labelledby="sincronizacion_actividad_title">
    <div class="modal-dialog modal-dialog-centeredalign-items-center" role="document">
      <div class="modal-content">
        <form class="form" role="form" name="form_actividad" id="form_actividad" method="post">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLongTitle"><b>Sincronizar Actividad</b></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" class="form-control" name="id_facturacion_act" id="id_facturacion_act">
            <input type="hidden" class="form-control" name="id_sucursal_act" id="id_sucursal_act">
            <input type="hidden" class="form-control" name="cod_punto_venta_act" id="cod_punto_venta_act">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group floating-label" id="c_actividad">
                  <select class="form-control select2-list" id="actividad" name="actividad" required>
                  </select>
                  <label for="actividad">Seleccione Actividad</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrar_modal()">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="agregar_actividad()">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

<script>
    //FORMULARIOS

    //DATATABLE LIST
    function listar_sucursales(element) {
      var id_sucursal = element.value;
      var selectedDescription = element.options[element.selectedIndex].getAttribute('data-descripcion');
      id_suc = id_sucursal;
      console.log("Elemento capturado:", element);
      console.log("Valor de id_sucursal:", id_sucursal);
      console.log("Descripción seleccionada:", selectedDescription);

      $('#idsucursal').val(id_suc).trigger('change');
      // Acceder al elemento por su ID
      var etiqueta = document.getElementById("titulo_sucursal");
      // Cambiar el contenido
      etiqueta.innerHTML = " - " + selectedDescription;
      let loadingSwal = Swal.fire({
        title: 'Cargando...',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        }
      });
      $.ajax({
            url: globalURLCirculo + 'facturation/C_lst_punto_venta/',
            type: "post",
            dataType: "json",
            data: {
                id_sucursal: id_suc
            },
            beforeSend: function() {
                loadingSwal;
            },
            success: function(data) {
                console.log(data);

              $('#datatable_punto_venta').DataTable({
                  "data": data,
                  "responsive": true,
                  "destroy": true,
                  "columnDefs": [{
                      "searchable": false,
                      "orderable": false,
                      "targets": 0
                  }],
                  "order": [
                      [0, 'asc']
                  ],
                  "aoColumns": [
                      {"mData": "cod_punto_venta"},
                      {"mData": "nombre"},
                      {"mData": "descripcion"},
                      {"mData": "tipo_venta"},
                      {
                          "mRender": function(data, type, row, meta) {
                              return `<font>${(row.cuis != null && new Date(row.fecvencuis) > new Date().getTime()) ? 'Activo' : (row.cuis ? 'Vencido' : 'Sin Asignar')}</font>`;
                          }
                      },
                      {"mData": "fecvencuis"},
                      {
                          "mRender": function(data, type, row, meta) {
                              return `<font>${(row.cufd != null && new Date(row.fecvencufd) > new Date().getTime()) ? 'Activo' : (row.cufd ? 'Vencido' : 'Sin Asignar')}</font>`;
                          }
                      },
                      {"mData": "fecvencufd"},
                      {
                      "mRender": function(data, type, row, meta) {
                        var cuis = '';
                        if (row.cuis != null) {
                          if (new Date(row.fecvencuis) > new Date().getTime()) {
                            cuis = ''; // Activo, no se necesita botón
                          } else {
                            cuis = `<button title="Solicitar Cuis" type="button" class="btn btn-xs btn-info" onclick="generar_cuis(${row.id_facturacion}, ${row.cod_punto_venta})"><i class="bi bi-pencil-square"></i></button>`;
                          }
                        } else {
                          cuis = `<button title="Solicitar Cuis" type="button" class="btn btn-xs btn-info" onclick="generar_cuis(${row.id_facturacion}, ${row.cod_punto_venta})"><i class="bi bi-pencil-square"></i></button>`;
                        }

                        var cufd = '';
                        if (row.cufd != null) {
                          if (new Date(row.fecvencufd) > new Date().getTime()) {
                            cufd = ''; // Activo, no se necesita botón
                          } else {
                            cufd = `<button title="Solicitar Cufd" type="button" class="btn btn-xs btn-warning" onclick="generar_cufd(${row.id_facturacion}, ${row.cod_punto_venta}, '${row.cuis}', '${row.fecvencuis}')"><i class="bi bi-pencil-square"></i></button>`;
                          }
                        } else {
                          cufd = `<button title="Solicitar Cufd" type="button" class="btn btn-xs btn-warning" onclick="generar_cufd(${row.id_facturacion}, ${row.cod_punto_venta}, '${row.cuis}', '${row.fecvencuis}')"><i class="bi bi-pencil-square"></i></button>`;
                        }

                        var valor = `
                          ${cuis}
                          ${cufd}
                          <button title="Solicitar Catalogo" type="button" class="btn btn-xs btn-success" onclick="generar_catalogo(${row.id_facturacion}, ${row.cod_punto_venta}, '${row.cuis}', '${row.fecvencuis}')">
                            <i class="bi bi-book"></i>
                          </button>
                          <button title="Sincronizar Actividad" type="button" class="btn btn-xs btn-primary" onclick="generar_actividad(${row.id_facturacion}, ${row.cod_punto_venta}, '${row.cuis}', '${row.fecvencuis}', ${row.cod_actividad})">
                            <i class="bi bi-arrow-clockwise"></i>
                          </button>
                          <button type="button" class="btn btn-xs btn-danger" onclick="eliminar_punto_venta(${row.id_facturacion}, ${row.cod_punto_venta}, '${row.nombre}')" title="Eliminar Punto Venta">
                            <i class="bi bi-trash"></i>
                          </button>
                        `;
                        return valor;
                      }
                    }
                  ],
                  "dom": 'C<"clear">lfrtip',
                  "colVis": {
                      "buttonText": "Columnas"
                  }
              });
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Error al obtener datos de ajax');
          },
          complete: function() {
              loadingSwal.close();
          }
      });
      $('.swal2-container').click(function(e) {
        e.stopPropagation();
      });
    }

    $(document).ready(function() {
      var val_sucursal = document.getElementById("sucursal");
      listar_sucursales(val_sucursal);
    });

    //BOTONES PANEL GENERAL
    
    //generar CUFDS para TODOS los puntos de venta
    function generar_cudfs(){
      let loadingSwal = Swal.fire({
            title: 'Cargando...',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
              Swal.showLoading();
            }
          });
      $.ajax({
          type: "POST",
          url: globalURLCirculo + 'facturation/C_generar_cufds/',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function() {
              loadingSwal;
              console.log();
              
          },
          success: function(resp) {
            console.log(resp);
            var c = JSON.parse(resp);
            console.log(c);
            if (c[0].oboolean == 't') {
              Swal.fire({
                icon: 'success',
                text: 'SE GENERARON LOS CUFDS EXITOSAMENTE',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ACEPTAR'
              }).then(function(result) {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: c[0].omensaje,
                confirmButtonColor: '#d33',
                confirmButtonText: 'ACEPTAR'
              })
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error al obtener datos de ajax');
          },
          complete: function() {
            loadingSwal.close();
          }
        });
    }

    //BOTONES para cada dato de datatable
      //Generar CUIS para un punto de venta
      function generar_cuis(id_facturacion, id_punto_venta) {
        let id_sucursal = id_suc;
        console.log(id_sucursal)
        let loadingSwal = Swal.fire({
          title: 'Cargando...',
          allowOutsideClick: false,
          showConfirmButton: false,
          onBeforeOpen: () => {
            Swal.showLoading();
          }
        });
          $.ajax({
            url: globalURLCirculo + 'facturation/C_generar_cuis',
            type: "POST",
            data: {
              id_facturacion: id_facturacion,
              id_punto_venta: id_punto_venta,
              id_sucursal: id_sucursal
            },
            beforeSend: function() {
              loadingSwal;
            },
            success: function(resp) {
              var c = (resp);
              console.log(c);
              if (c[0].oboolean == 't') {
                Swal.fire({
                  icon: 'success',
                  text: 'EL CUIS SE GENERO EXITOSAMENTE',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'ACEPTAR'
                }).then(function(result) {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: c[0].omensaje,
                  confirmButtonColor: '#d33',
                  confirmButtonText: 'ACEPTAR'
                })
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Error al obtener el cuis de SIAT');
            },
            complete: function() {
              loadingSwal.close();
            }
          });
        $('.swal2-container').click(function(e) {
          e.stopPropagation();
        });
      }

      //generar CUFD para un punto de venta
      function generar_cufd(id_facturacion, id_punto_venta, cuis, fechaVencimientoCuis) {
        let id_sucursal = id_suc;
        if (cuis == '') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Primero debe generar un nuevo Codigo Cuis',
            confirmButtonColor: '#d33',
            confirmButtonText: 'ACEPTAR'
          })
        } else {
          console.log("Id facturacion: "+ id_facturacion);
          console.log("id_punto_venta: "+ id_punto_venta);
          console.log("id_sucursal: "+ id_sucursal);
          console.log("cuis: "+ cuis);
          if (new Date(fechaVencimientoCuis) > new Date().getTime()) {
            let loadingSwal = Swal.fire({
              title: 'Cargando...',
              allowOutsideClick: false,
              showConfirmButton: false,
              onBeforeOpen: () => {
                Swal.showLoading();
              }
            });
            $.ajax({
              url: globalURLCirculo + 'facturation/C_generar_cufd/',
              type: "POST",
              data: {
                id_facturacion: id_facturacion,
                id_punto_venta: id_punto_venta,
                id_sucursal: id_sucursal,
                cod_cuis: cuis
              },
              beforeSend: function() {
                loadingSwal;
              },
              success: function(resp) {
                var c = JSON.parse(resp);
                console.log(c);
                if (c[0].oboolean == 't') {
                  Swal.fire({
                    icon: 'success',
                    text: 'EL CUFD SE GENERO EXITOSAMENTE',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ACEPTAR'
                  }).then(function(result) {
                    location.reload();
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: c[0].omensaje,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'ACEPTAR'
                  })
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al obtener el cuis de SIAT');
              },
              complete: function() {
                loadingSwal.close();
              }
            });
            $('.swal2-container').click(function(e) {
              e.stopPropagation();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Primero debe generar un nuevo Codigo Cuis',
              confirmButtonColor: '#d33',
              confirmButtonText: 'ACEPTAR'
            })
          }
        }

      }

      function generar_catalogo(id_facturacion, id_punto_venta, cuis, fechaVencimientoCuis) {
        let id_sucursal = id_suc;
        if (cuis == '') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Primero debe generar un nuevo Codigo Cuis',
            confirmButtonColor: '#d33',
            confirmButtonText: 'ACEPTAR'
          })
        } else {
          if (new Date(fechaVencimientoCuis) > new Date().getTime()) {
            let loadingSwal = Swal.fire({
              title: 'Cargando...',
              allowOutsideClick: false,
              showConfirmButton: false,
              onBeforeOpen: () => {
                Swal.showLoading();
              }
            });
            $.ajax({
              url:  globalURLCirculo + 'facturation/C_generar_catalogo',
              type: "POST",
              data: {
                id_facturacion: id_facturacion,
                id_punto_venta: id_punto_venta,
                id_sucursal: id_sucursal,
                cod_cuis: cuis
              },
              beforeSend: function() {
                loadingSwal;
              },
              success: function(resp) {
                var c = JSON.parse(resp);
                console.log(c);
                if (c[0].oboolean == 't') {
                  Swal.fire({
                    icon: 'success',
                    text: 'LA SINCRONIZACION DE CATALOGOS SE GENERO EXITOSAMENTE',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ACEPTAR'
                  }).then(function(result) {
                    location.reload();
                  });
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: c[0].omensaje,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'ACEPTAR'
                  })
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al obtener el cuis de SIAT');
              },
              complete: function() {
                loadingSwal.close();
              }
            });
            $('.swal2-container').click(function(e) {
              e.stopPropagation();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Primero debe generar un nuevo Codigo Cuis',
              confirmButtonColor: '#d33',
              confirmButtonText: 'ACEPTAR'
            })
          }
        }
      }

      function generar_actividad(id_facturacion, cod_punto_venta, cuis, fechaVencimientoCuis, cod_actividad) {
        let id_sucursal = id_suc;
        if (cuis == '') {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Primero debe generar un nuevo Codigo Cuis, y su respectiva Sincronizacion de Catalogos',
            confirmButtonColor: '#d33',
            confirmButtonText: 'ACEPTAR'
          })
        } else {
          if (new Date(fechaVencimientoCuis) > new Date().getTime()) {
            let loadingSwal = Swal.fire({
              title: 'Cargando...',
              allowOutsideClick: false,
              showConfirmButton: false,
              onBeforeOpen: () => {
                Swal.showLoading();
              }
            });
            $.ajax({
              url: globalURLCirculo + 'facturation/C_generar_lista_actividades',
              type: "POST",
              data: {
                id_facturacion: id_facturacion,
                cod_punto_venta: cod_punto_venta,
                id_sucursal: id_sucursal,
              },
              beforeSend: function() {
                loadingSwal;
              },
              success: function(resp) {
                var c = JSON.parse(resp);
                console.log(c);
                $('#id_facturacion_act').val(id_facturacion).trigger('change');
                $('#cod_punto_venta_act').val(cod_punto_venta).trigger('change');
                $('#id_sucursal_act').val(id_sucursal).trigger('change');
                
                $('#c_actividad').removeClass('floating-label');
                $('#actividad').empty();
                $('#actividad').prop('selectedIndex', -1);
                var selectElement = $('#actividad');

                $.each(c, function(index, item) {
                  var optionElement = $('<option></option>');
                  optionElement.val(item.codigoCaeb);
                  optionElement.text(item.descripcion);

                  selectElement.append(optionElement);
                  });
                  
                  selectElement.select2();
                  
                  if (cod_actividad !== null && cod_actividad !== '') {
                    $('#actividad').val(c[0].codigoCaeb).trigger('change');
                  }
          
                  $('#sincronizacion_actividad').modal('show');
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al obtener el cuis de SIAT');
              },
              complete: function() {
                loadingSwal.close();
              }
            });
            $('.swal2-container').click(function(e) {
              e.stopPropagation();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Primero debe generar un nuevo Codigo Cuis',
              confirmButtonColor: '#d33',
              confirmButtonText: 'ACEPTAR'
            })
          }
        }
      }

    
      function agregar_actividad() {
        var formData = new FormData($('#form_actividad')[0]);
        $.ajax({
          type: "POST",
          url: globalURLCirculo + 'facturation/C_agregar_actividad/',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(resp) {
            console.log(resp);
            var c = JSON.parse(resp);
            if (true) {
              Swal.fire({
                icon: 'success',
                text: 'SE REGISTRO EXITOSAMENTE',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'ACEPTAR'
              }).then(function(result) {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: c[0].omensaje,
                confirmButtonColor: '#d33',
                confirmButtonText: 'ACEPTAR'
              });
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error al obtener datos de ajax');
          }
        });
      }

      function cerrar_modal() {
         $('#sincronizacion_actividad').modal('hide');
      }


      function formulario2() {
        document.getElementById("tabla_punto_venta").style.display = "none";
        document.getElementById("form_registro3").style.display = "none";
        document.getElementById("tabla_punto_venta2").style.display = "block";
        document.getElementById("form_registro").style.display = "none";
        $("#titulo2").text("Registrar Punto de Venta Existente");
        $('#form_punto_venta2')[0].reset();

        document.getElementById("form_registro2").style.display = "block";

        var lista_ubicacion = '<?= json_encode($this->dataUbicacion) ?>';
        var c = JSON.parse(lista_ubicacion);
        console.log(c)
        // Vacía todas las opciones del elemento <select>
        $('#ubicacion').empty();

        // Restablece el elemento <select> a su valor predeterminado
        $('#ubicacion').prop('selectedIndex', -1);

        // Obtén una referencia al elemento <select>
        var selectElement = $('#ubicacion');

        // Itera sobre el array y crea las opciones
        $.each(c, function(index, item) {
          // Crea un elemento <option>
          var optionElement = $('<option></option>');

          // Establece el valor y el texto de la opción usando los valores del array
          optionElement.val(item.oidubicacion);
          optionElement.text(item.oubicacion);

          // Agrega la opción al elemento <select>
          selectElement.append(optionElement);
      });

      // Inicializa el plugin select2 en el elemento <select> si estás utilizando select2
      selectElement.select2();
      // document.getElementById("btn_update").style.display = "block";
    }

    function formulario() {
      document.getElementById("tabla_punto_venta2").style.display = "none";
      document.getElementById("form_registro3").style.display = "none";
      document.getElementById("tabla_punto_venta").style.display = "block";
      document.getElementById("form_registro2").style.display = "none";
      $("#titulo").text("Registrar Punto de Venta");
      $('#form_punto_venta')[0].reset();
      $('#idsucursal').val(id_suc).trigger('change');
      document.getElementById("form_registro").style.display = "block";
      // document.getElementById("btn_update").style.display = "block";
    }

      function cerrar_formulario() {
      document.getElementById("form_registro").style.display = "none";
      $('#form_punto_venta')[0].reset();
      document.getElementById("form_registro2").style.display = "none";
      $('#form_punto_venta2')[0].reset();
      document.getElementById("form_registro3").style.display = "none";
      $('#form_punto_venta3')[0].reset();
      $('#idsucursal').val(id_suc).trigger('change');
    }

    function update_formulario() {
      $('#form_punto_venta')[0].reset();
      $('#form_punto_venta2')[0].reset();
      $('#form_punto_venta3')[0].reset();
      $('#idsucursal').val(id_suc).trigger('change');
    }
</script>