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
					<li class="breadcrumb-item text-muted">Creación de Deudas</li>
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
                            <h3 class="card-title">Creación de Deudas para Socios</h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form id="partners-form-debt-reg" class="form" action="#" autocomplete="off">
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label">Socios<span class="text-danger">*</span></label>
                                            <select class="form-select mb-2 mb-md-0" name="vCodPartner" id="vCodPartner" data-control="select2" placeholder="Seleccione Socio">
                                            <option value="">Seleccionar Socio</option>
                                            <?Php
                                            if (isset($this->DataPartners) && count($this->DataPartners)):
                                                $vCount = 1;
                                                for ($i = 0; $i < count($this->DataPartners); $i++):
                                                    echo '<option value="' . $this->DataPartners[$i]['n_codpartner'] . '">'.$this->DataPartners[$i]['n_numaccion'].' - '.$this->DataPartners[$i]['t_nombres'].'</option>';
                                                endfor;
                                            endif;
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="fv-row form-group row mb-5">                                        
                                        <div class="col-md-6">
                                            <label class="form-label">Plan de Cuentas<span class="text-danger">*</span></label>
                                            <select class="form-select mb-2 mb-md-0" name="vCodChartOfAccount" id="vCodChartOfAccount" data-control="select2" placeholder="Seleccione Plan de Cuenta">
                                                <option value="">Seleccionar Plan de Cuentas</option>
                                                <?Php
                                                if (isset($this->vChartOfAccountList) && count($this->vChartOfAccountList)):
                                                    $vCount = 1;
                                                    for ($k = 0; $k < count($this->vChartOfAccountList); $k++):
                                                        echo '<option value="' . $this->vChartOfAccountList[$k]['n_codchartofaccounts'] . '">'.$this->vChartOfAccountList[$k]['n_chartofaccountname'].' - '.$this->vChartOfAccountList[$k]['c_chartofaccountname'].'</option>';
                                                    endfor;
                                                endif;
                                                ?>
                                            </select>
                                        </div>                                        
                                        <div class="col-md-3">
                                            <label class="form-label">Tipo de Deuda<span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vTypeDebt" name="vTypeDebt">
                                                <option value="">Seleccionar Tipo Deuda</option>
                                                <option value="1">Montos Iniciales</option>
                                                <option value="2">Cuota Mensual</option>
                                                <option value="3">Cuota Mortuoria</option>
                                                <option value="4">Cuota Participación</option>
                                                <option value="5">Cuota Ingreso</option>
                                                <option value="6">Compra Libro</option>                                                
                                                <!--<option value="1">Deuda Activo Presente</option>
                                                <option value="2">Deuda Emérito Presente</option>
                                                <option value="3">Deuda Corporativo</option>
                                                <option value="4">Deuda Activo Ausente</option>
                                                <option value="5">Deuda Emérito Ausente</option>
                                                <option value="6">Deuda Especial</option>
                                                <option value="7">Deuda Diplomático</option>
                                                <option value="8">Deuda Congelado</option>
                                                <option value="9">Deuda Exento</option>
                                                <option value="10">Deuda Concesionario</option>
                                                <option value="11">Deuda Emérito No Aportante</option>
                                                <option value="12">Deuda Exento</option>
                                                <option value="13">Deuda Mortuoria</option>
                                                <option value="14">Deuda Extraordinaria</option>
                                                <option value="15">Deuda Otra</option>-->
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Mes<span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vMonth" name="vMonth">
                                                <option value="">Seleccionar Mes</option>
                                                <option value="1">Enero</option>
                                                <option value="2">Febrero</option>
                                                <option value="3">Marzo</option>
                                                <option value="4">Abril</option>
                                                <option value="5">Mayo</option>
                                                <option value="6">Junio</option>
                                                <option value="7">Julio</option>
                                                <option value="8">Agosto</option>
                                                <option value="9">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label">Fecha Deuda
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vDateDebt" id="vDateDebt" value="" placeholder="<?Php echo date('Y/m/d'); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Monto Deuda
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vAmountDebt" id="vAmountDebt" value="" placeholder="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Descripción de la Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" name="vDescDebt" id="vDescDebt" placeholder="">
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <button id="partners-form-debt-reg-submit" type="submit" class="btn btn-primary">
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

            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Deudas Generadas</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchDebts" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_debts">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Socio</th>
                                        <th>Cuenta</th>
                                        <th>Tipo</th>
                                        <th>Mes</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th data-priority="1">acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>