<!-- <?php
var_dump($this->allParametricas);
?> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos Editables</title>

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS de Bootstrap Toggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

    <!-- Estilos de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
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

    <div class="col-md-12">
    <div class="section-body ms-8">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-primary d-flex justify-content-between align-items-center">
                    Listado de Productos
                    <button type="button" class="btn btn-primary ink-reaction btn-sm me-10" onclick="formulario()">
                        <span class="pull-left"><i class="fa fa-plus"></i></span> &nbsp; Nuevo Producto
                    </button>
                </h3>
                <hr>
            </div>
        </div>

        <input type="hidden" class="form-control" name="contador" id="contador" value="0">
        
        <div class="col-sm-8 col-md-9 col-lg-10" style="display: none;" id="form_producto">
            <div class="text-divider"><span>Formulario de Registro</span></div>
                <form class="form" name="form_producto" id="form_producto" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id_producto" id="id_producto">
                    <input type="hidden" name="imagen" id="imagen">
                    <input type="hidden" name="count0" id="count0" value="0">

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

                    <div class="card-body">
                        <!-- Categoría y Marca -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoria">Seleccione Categoría</label>
                                    <select class="form-control select2-list" id="categoria" name="categoria" required>
                                        <?php if (isset($this->datacat) && count($this->datacat) > 0) { ?>
                                            <?php foreach ($this->datacat as $item) { ?>
                                                <option value="<?php echo htmlspecialchars($item['id_categoria']); ?>">
                                                    <?php echo htmlspecialchars($item['descripcion']); ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="">No hay categorías disponibles</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marca">Seleccione Marca</label>
                                    <select class="form-control select2-list" id="marca" name="marca" required>
                                        <option value=""></option>
                                        <?php if (isset($this->datamarca) && count($this->datamarca) > 0) { ?>
                                            <?php foreach ($this->datamarca as $item) { ?>
                                                <option value="<?php echo htmlspecialchars($item['id_marca']); ?>">
                                                    <?php echo htmlspecialchars($item['descripcion']); ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="">No hay marcas disponibles</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Códigos -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" name="codigo" id="codigo" onchange="mayuscula(this);" required>
                                    <div id="result-error"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo_alt">Código Alternativo</label>
                                    <input type="text" class="form-control" name="codigo_alt" id="codigo_alt" onchange="mayuscula(this);">
                                    <div id="error-codigo-alt"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Producto -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="producto">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" onchange="guardar_descripcion(this);" required>
                                    <div id="error-producto"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Código SIN y Unidades -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codsin">Seleccione Código SIN</label>
                                    <select class="form-control select2-list" id="codsin" name="codsin">
                                        <option value=""></option>
                                        <?php if (!empty($this->datacodsim) && is_array($this->datacodsim)) { ?>
                                            <?php foreach ($this->datacodsim as $item) { ?>
                                                <?php 
                                                    $codsimData = explode(',', $item["fn_get_codsim_productos(1)"]);

                                                    $codprod = $codsimData[0];
                                                    $descripcion = $codsimData[1];
                                                    $codigo = $codsimData[2]; 
                                                ?>
                                                <option value="<?php echo htmlspecialchars($codprod); ?>">
                                                    <?php echo htmlspecialchars($descripcion); ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="">No hay Código SIN disponible</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unidades">Seleccione Unidad</label>
                                    <select class="form-control select2-list" id="unidades" name="unidades">
                                        <option value=""></option>
                                        <?php if (!empty($this->allParametricas) && is_array($this->allParametricas)) { ?>
    <?php foreach ($this->allParametricas as $item) { ?>
        <option value="<?php echo htmlspecialchars($item['descripcion']); ?>">
            <?php echo htmlspecialchars($item['descripcion']); ?>
        </option>
    <?php } ?>
<?php } else { ?>
    <option value="">No hay unidades disponibles</option>
<?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Características y Garantías -->
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="caracteristica">Características</label>
                                    <textarea class="form-control" name="caracteristica" id="caracteristica" rows="2" onchange="mayuscula(this);" required><?php echo preg_replace('/\s+/', ' ', trim($caracteristica)); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                <input type="checkbox" class="form-control" name="con_garantia" id="con_garantia" data-toggle="toggle" data-width="175" data-on="Con Series" data-off="Sin Series">
                                    <input type="text" class="form-control" id="garantia" name="garantia" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="guarantee" name="guarantee" value="false">
                                </div>
                            </div>
                        </div>

                        <!-- Precios -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group floating-label" id="c_precio_compra">
                                    <input type="number" class="form-control" name="precio_compra" id="precio_compra" required step=".01" onblur="Cambiar_compra()">
                                    <label for="precio_compra">Precio Compra</label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group floating-label" id="c_precio">
                                    <input type="number" class="form-control" name="precio" id="precio" required step=".01" onblur="Cambiar()">
                                    <label for="precio">Precio Venta</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
        
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="font-size:18px">
                                    <b>INFORMACIÓN DETALLADA</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <input type="checkbox" data-toggle="toggle" name="con_garantia" id="con_garantia" data-width="175" data-on="Con Garantía" data-off="Sin Garantía">
                                        <input type="text" class="form-control" id="garantia" name="garantia" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="guarantee" name="guarantee" value="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <input type="checkbox" data-toggle="toggle" data-width="175" name="servicio" id="servicio" data-on="Con Stock" data-off="Sin Stock">
                                        <input type="text" class="form-control" id="serv" name="serv" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="servicios" name="servicios" value="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <input type="checkbox" data-toggle="toggle" data-width="175" name="renovacion" id="renovacion" data-on="Con Renovación" data-off="Sin Renovación">
                                        <input type="text" class="form-control" id="renov" name="renov" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="renovaciones" name="renovaciones" value="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <input type="checkbox" data-toggle="toggle" name="con_receta" id="con_receta" data-width="175" data-on="Con Receta" data-off="Sin Receta">
                                        <input type="text" class="form-control" id="desc" name="desc" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="receta" name="receta" value="false">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                                    <div class="form-group">
                                        <input type="checkbox" data-toggle="toggle" data-width="230" name="precio_global" id="precio_global" data-on="Precio Global" data-off="Precio por Ubicación">
                                        <input type="text" class="form-control" id="priceController" name="priceController" value="unidad" style="color: #FA5600; display:none;"></input>
                                        <input type="hidden" id="global_price" name="global_price" value="false">
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- Imagen del producto -->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="card" style="padding:20px;">
                                    <center>
                                        <table style="width: 80%; height: 180px; border: 3px solid #eb0038; margin-bottom: 5px;">
                                            <tr>
                                                <td><output id="list"></output></td>
                                            </tr>
                                        </table>
                                        <label class="btn btn-primary btn-sm btn-file ink-reaction btn-raised">
                                            Seleccionar Imagen<input style="display: none;" type="file" id="files" name="img_producto" class="form-control">
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                            <div class="card-actionbar">
                                <div class="card-actionbar-row">
                                    <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btn_edit_product" id="btn_edit_product" value="edit">Modificar Producto</button>
                                    <button type="submit" class="btn btn-flat btn-primary ink-reaction" name="btn_add_product" id="btn_add_product" value="add">Registrar Producto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- LISTA -->
        <div class="card card-bordered style-primary">
            <div class="card-body style-default-bright">
                <div class="table-responsive">
                    <table id="datatableprod" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nª</th>
                                <th>Categorías</th>
                                <th>Marca</th>
                                <th style="display: none;">Código Producto</th>
                                <th>Código</th>
                                <th>Código Alt.</th>
                                <th>Garantía</th>
                                <th>Producto</th>
                                <th>Característica</th>
                                <th>Precio</th>
                                <th>Min. Existencia</th>
                                <th>Unidad</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se llenarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function formulario() {
    document.getElementById('form_producto').style.display = 'block';
    document.getElementById('form_producto').reset();
    }
    function cerrar_formulario() {
      document.getElementById("form_producto").style.display = "none";
    }
    function Cambiar() {
            var valor_actual = document.getElementById("precio").value;
            var valor_antiguo = document.getElementById("precio_antiguo").value;
    }

    function Cambiar_compra() {
            var valor_actual_compra = document.getElementById("precio_compra").value;
            var valor_antiguo_compra = document.getElementById("precio_antiguo_compra").value;
    }

    function update_formulario() {
      $('#form_producto')[0].reset();
      $('#btn_edit').attr("disabled", true);
      $('#btn_add').attr("disabled", false);
    }

    function mayuscula(field) {
      field.value = field.value.toUpperCase();
    }
    
</script>
</body>
</html>
