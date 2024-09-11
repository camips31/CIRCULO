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
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Gestión de Socios</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="#" class="text-muted text-hover-primary">Círculo de la Unión</a>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Gestión de Socios</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Información General</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Registro</li>
					<!--end::Item-->                    					
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Toolbar container-->
	</div>

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-12 mb-xl-12">
                <!--begin::Col-->
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-8 mb-xl-8">
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Registro Información de Socios</h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form id="partners-form-reg" class="form" action="#" autocomplete="off">
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label">Nro de Acción
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vNumAccion" id="vNumAccion" placeholder="">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Categoría<span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vCategoria" name="vCategoria">
                                                <option value="">Seleccionar Categoría</option>
                                                <option value="1">Activo Presente</option>
                                                <option value="2">Emérito Presente</option>
                                                <option value="3">Corporativo</option>
                                                <option value="4">Activo Ausente</option>
                                                <option value="5">Emérito Ausente</option>
                                                <option value="6">Especial</option>
                                                <option value="7">Diplomático</option>
                                                <option value="8">Congelado</option>
                                                <option value="9">Exento</option>
                                                <option value="10">Concesionario</option>
                                                <option value="11">Emérito No Aportante</option>
                                                <option value="12">Exento</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Fecha de Ingreso
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vFechaIngreso" id="vFechaIngreso" value="<?Php echo date('Y/m/d'); ?>" placeholder="">
                                        </div>                                        
                                    </div>
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label">Nombre y Apellidos
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vNombres" id="vNombres" placeholder="">
                                        </div>                                        
                                        <div class="col-md-3">
                                            <label class="form-label">Fecha Nacimiento
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vFechaNacimiento" id="vFechaNacimiento" value="<?Php echo date('Y/m/d'); ?>" placeholder="">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Carnet de Identidad
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vCarnetIdentidad" id="vCarnetIdentidad" value="" placeholder="">
                                    </div>
                                    <div class="fv-row form-group row mb-5">                                                                                
                                        <div class="col-md-3">
                                            <label class="form-label">Sexo<span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vSexo" name="vSexo">
                                                <option value="">Seleccionar Categoría</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Celular
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vCelular" id="vCelular" placeholder="">
                                        </div>                                                                                 
                                        <div class="col-md-3">
                                            <label class="form-label">Correo Electrónico
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vMail" id="vMail" value="" placeholder="">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Ciudad<span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vCiudad" name="vCiudad">
                                                <option value="">Seleccionar Ciudad</option>
                                                <option value="1">La Paz</option>
                                                <option value="2">Santa Cruz de la Sierra</option>
                                                <option value="3">Cochabamba</option>
                                                <option value="4">Chuquisaca</option>
                                                <option value="5">Oruro</option>
                                                <option value="6">Potosí</option>
                                                <option value="7">Tarija</option>
                                                <option value="8">Beni</option>
                                                <option value="9">Pando</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                    <div class="fv-row form-group row mb-5">                                            
                                    </div>
                                    <div class="fv-row form-group row mb-5">                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Nombre Facturación
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vNombreNit" id="vNombreNit" value="" placeholder="">
                                        </div>                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Número NIT
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vNIT" id="vNIT" placeholder="">
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <button id="partners-form-reg-submit" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Registrar
                                        </span>
                                        <span class="indicator-progress">
                                            Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Actions-->
                                </div>
                            </form>
                                <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>