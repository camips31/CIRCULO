<!-- <?php
var_dump($this->allParametricas);
?> -->
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
              <a href="#" class="text-muted text-hover-primary">Productos</a>
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Categorias</li>
            </li>
          <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
      </div>
      <!--end::Toolbar container-->
    </div>

    <div class="section-body ms-8">
        <div class="row">
          <div class="col-lg-12">
          <h3 class="text-primary d-flex justify-content-between align-items-center">
            Categories
            <button type="button" class="btn btn-primary ink-reaction btn-sm me-10" onclick="formulario()">
              <span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp; Nueva Categoria
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
                <form class="form form-validate" novalidate="novalidate" name="form_category" id="form_category" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="id_categoria" id="id_categoria">
                  <input type="hidden" name="imagen" id="imagen">
                  <div class="card">
                    <div class="card-head style-primary">
                      <div class="tools">
                        <div div class="btn-group">
                            <a class="btn btn-icon-toggle" onclick="update_formulario()"><i class="fas fa-sync-alt"></i></a>
                            <a class="btn btn-icon-toggle" onclick="cerrar_formulario()"><i class="fas fa-times"></i></a>
                        </div>
                      </div>
                      <header id="titulo"></header>
                    </div>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group floating-label" id="code_cat">
                                <input type="text" class="form-control" name="code_cat" id="code_cat" onchange="return mayuscula(this);" required>
                                <div id="result-error"></div>
                                <label for="code_cat">C&oacute;digo</label>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="form-group floating-label" id="descrp_cat">
                                <input type="text" class="form-control" name="descrp_cat" id="descrp_cat" onchange="return mayuscula(this);" required>
                                <label for="descrp_cat">Categor&iacute;a</label>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group floating-label" id="c_codsin">
                                <select class="form-control select2-list" id="codsin" name="codsin">
                                  <option value=""></option>
                                  <?php foreach ($codsim as $cod) {  ?>
                                    <option value="<?php echo $cod->out_codprod ?>" <?php echo set_select('codsin', $cod->out_codprod) ?>> <?php echo $cod->out_descripcion ?></option>
                                  <?php  } ?>

                                </select>
                                <label for="codsin">Seleccione Codigo SIN (categoria)</label>
                              </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                              <div class="form-group floating-label" id="unities_cat">
                                <select class="form-control select2-list" id="unities_cat" name="unities_cat">
                                  <option value=""></option>
                                  <?php foreach ($unidades as $uni) {  ?>
                                    <option value="<?php echo $uni->out_codclas ?>" <?php echo set_select('unidades', $uni->out_codclas) ?>> <?php echo $uni->out_descripcion ?></option>
                                  <?php  } ?>

                                </select>
                                <label for="unidades">Seleccione unidad categoria</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                          <center>
                            <table style="width: 80%; height: 180px; border: 3px solid #eb0038; margin-bottom: 5px;">
                              <tr>
                                <td><output id="list"></output></td>
                              </tr>
                            </table>
                            <label class="btn btn-primary btn-sm btn-file ink-reaction btn-raised">
                              Seleccionar Imagen<input style="display: none;" type="file" id="img_cat" name="img_cat" class="form-control" />
                            </label>
                          </center>
                        </div>
                      </div>
                    </div>

                    <div class="card-actionbar">
                      <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btn_edit_category" id="btn_edit_category" onclick="deshabilitar_modificar()" value="edit" disabled>Modificar Categor&iacute;a</button>
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btn_add_category" id="btn_add_category" value="add">Registrar Categor&iacute;a</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <input type="checkbox" name="mod_auxi" id="mod_auxi" value="Modificar" style="display:none">
        <div class="row">
          <div class="col-md-12">
            <div class="text-divider visible-xs"><span>Listado de Registros</span></div>
            <div class="card card-bordered style-primary">
              <div class="card-body style-default-bright">
                <div class="table-responsive">
                  <table id="datatable_cat" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>C&oacute;digo</th>
                        <!-- <th style="display: none;">Categoria_id</th> -->
                        <th>Categor&iacute;a</th>
                        <th>Estado</th>
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

<script>
    function formulario() {
      $("#titulo").text("Registrar Categoria");
      document.getElementById("form_registro").style.display = "block";
      update_formulario();
    }
    function cerrar_formulario() {
      document.getElementById("form_registro").style.display = "none";
    }

    function update_formulario() {
      $('#form_category')[0].reset();
      $('#btn_edit').attr("disabled", true);
      $('#btn_add').attr("disabled", false);
    }

    function mayuscula(field) {
      field.value = field.value.toUpperCase();
    }
</script>

</body>
</html>