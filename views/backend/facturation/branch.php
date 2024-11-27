<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos Editables</title>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
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
    
    <div id="content">
        <section>
                <div class="section-header">
                    <ol class="breadcrumb">
                    <li><a href="#">Facturacion</a></li>
                    <li class="active">Registro de Sucursales</li>
                    </ol>
                </div>
                <!-- GAN-DPR-B2-0300  Inicio-->
                <!-- GAN-MS-M0-0364 Inicio Flavio A.C.V -->
                <div class="modal fade" id="devolucionModal" tabindex="-1" role="dialog" aria-labelledby="devolucionModalLabel" aria-hidden="true">
                    <!-- GAN-MS-M0-0364 Fin Flavio A.C.V -->
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <!-- GAN-MS-M0-0364 Inicio Flavio A.C.V -->
                        <h5 class="modal-title" id="tituloModal"></h5>
                        <h5 class="modal-title" visible="false" id="codigo_activoModal"></h5>
                        <!-- GAN-MS-M0-0364 Fin Flavio A.C.V -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <div class="form-group">
                            <!-- GAN-MS-M0-0364 Inicio Flavio A.C.V -->
                            <label for="formModal">Motivo</label>
                            <textarea class="form-control" id="motivoModal" rows="3"></textarea>
                            <!-- GAN-MS-M0-0364 Fin Flavio A.C.V -->
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <!-- GAN-MS-M0-0364 Inicio Flavio A.C.V -->
                        <button type="button" class="btn btn-primary" onClick="guardar_devolucion()">Guardar</button>
                        <!-- GAN-MS-M0-0364 Fin Flavio A.C.V -->
                        </div>
                    </div>
                    </div>
                </div>
                <!--  GAN-DPR-B2-0300 fin-->
                <div class="section-body" id="container">
                    <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-primary">Listado de Sucursales
                        <button type="button" class="btn btn-primary ink-reaction btn-sm pull-right" onclick="formulario()"><span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp;
                            Nueva Sucursal</button>
                        </h3>
                        <hr>
                    </div>
                    </div>



                    <div class="row" style="display: none;" id="form_registro">
                    <div class="col-sm-8 col-md-9 col-lg-10 col-lg-offset-1">
                        <div class="text-divider visible-xs"><span>Formulario de Registro</span></div>
                        <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form class="form form-validate" novalidate="novalidate" name="form_sucursal" id="form_sucursal" method="post">
                            <input type="hidden" name="id_sucursal" id="id_sucursal" value="0">
                            <div class="card">
                                <div class="card-head style-primary">
                                <div class="tools">
                                    <div class="btn-group">
                                    <a id="btn_update" class="btn btn-icon-toggle" onclick="update_formulario()"><i class="md md-refresh"></i></a>
                                    <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="md md-close"></i></a>
                                    </div>
                                </div>
                                <header id="titulo"></header>
                                </div>

                                <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group floating-label" id="c_producto">
                                        <input type="number" class="form-control" name="cod_sucursal" id="cod_sucursal" required>
                                        <label for="cod_sucursal">Cód. Sucursal</label>
                                    </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <div class="form-group floating-label" id="c_producto">
                                        <input type="text" class="form-control" name="name_sucursal" id="name_sucursal" required>
                                        <label for="name_sucursal">Nombre Sucursal</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-actionbar">
                                    <div class="card-actionbar-row">
                                    <button type="button" class="btn btn-flat btn-primary ink-reaction" onclick="agregar_modifi_sucursal('MODIFICADO')" name="btn" id="btn_edit" value="add">Modificar Sucursal</button>
                                    <button type="button" class="btn btn-flat btn-primary ink-reaction" onclick="agregar_modifi_sucursal('REGISTRADO')" name="btn" id="btn_add" value="edit">Agregar Sucursal</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row" id="listado">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="text-divider visible-xs"><span>Listado de Sucursales</span></div>
                    <div class="card card-bordered style-primary">
                        <div class="card-body style-default-bright">
                        <div id="tabla">
                            <div class="table-responsive">
                            <table id="datatable" class=" table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="10%">Nª</th>
                                    <th width="20%">Código Sucursal</th>
                                    <th width="30%">Nombre de Sucursal</th>
                                    <th width="20%">Estado</th>
                                    <th width="20%">Acción</th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>