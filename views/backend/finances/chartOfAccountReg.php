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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Finanzas</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Plataforma Empresarial</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->											
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Finanzas</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Plan de Cuentas</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Edición</li>
                    <!--end::Item-->                                            
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-12 mb-xl-12">
                <!--begin::Col-->
                <div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 mb-md-10 mb-xl-10">
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Registrar Cuenta Contable</h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form id="finances_form_chartofaccount_reg" class="form" action="#" autocomplete="off">                            												
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-6">                                                
                                                <label class="form-label">Código Cuenta Contable:</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vNumCodChartOfAccounts" placeholder="Número de Factura" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nombre Cuenta Contable:</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vChartOfAccountsName" placeholder="Número de DUI/DIM" />
                                            </div>
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Partida Doble:</label>
                                                <select class="form-control mb-2 mb-md-0" name="vTAccount" id="vTAccount" placeholder="Seleccione la Cuenta T del Plan de Cuentas">
                                                <option value="0" selected>Seleccionar</option>
                                                    <option value="1">Debe</option>
                                                    <option value="2">Haber</option>
                                                </select>
                                            </div>                                            
                                            <div class="col-md-4">
                                                <label class="form-label">Estado:</label>
                                                <select class="form-control mb-2 mb-md-0" name="vActive" id="vActive" placeholder="Seleccione estado del Plan de Cuentas">
                                                    <option value="" selected>Seleccionar</option>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <button id="finances_reg_chartofaccount_submit" type="submit" class="btn btn-primary">
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
<!--end::Content wrapper-->