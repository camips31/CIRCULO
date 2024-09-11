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
                            <h3 class="card-title">Editar Cuenta Contable</h3>
                        </div>
                        <div class="collapse show">
                            <?Php
                                if(isset($this->DataChartOfAccount) && count($this->DataChartOfAccount)):
                                    for($i=0;$i<count($this->DataChartOfAccount);$i++):
                                        $vCodChartOfAccounts = $this->DataChartOfAccount[$i]['n_codchartofaccounts'];
                                        $vNumCodChartOfAccounts = $this->DataChartOfAccount[$i]['n_chartofaccountname'];
                                        $vChartOfAccountsName = $this->DataChartOfAccount[$i]['c_chartofaccountname'];
                                        $vTAccount = $this->DataChartOfAccount[$i]['n_taccount'];
                                        if($vTAccount == 1){ $vTAccountText = 'Debe';} else if($vTAccount == 2){ $vTAccountText = 'Haber';}
                                        $vActive = $this->DataChartOfAccount[$i]['n_active'];
                                        if($vActive == 1){ $vActiveText = 'Activo';} else if($vActive == 2){ $vActiveText = 'Inactivo';} else { $vActiveText = 'Error';}
                                    endfor;
                                endif;
                            ?>
                            <!--begin::Form-->
                            <form id="finances_form_chartofaccount_edit" class="form" action="#" autocomplete="off">                            												
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-6">                                                
                                                <label class="form-label">Código Cuenta Contable:</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vNumCodChartOfAccounts" value="<?Php echo $vNumCodChartOfAccounts; ?>" placeholder="Número de Factura" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nombre Cuenta Contable:</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vChartOfAccountsName" value="<?Php echo $vChartOfAccountsName; ?>" placeholder="Número de DUI/DIM" />
                                            </div>
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Partida Doble:</label>
                                                <select class="form-control mb-2 mb-md-0" name="vTAccount" id="vTAccount" data-control="select2" placeholder="Seleccione Código del Plan de Cuentas">
                                                    <option value="<?Php echo $vTAccount; ?>" selected><?Php echo $vTAccountText; ?></option>
                                                    <option value="1">Debe</option>
                                                    <option value="2">Haber</option>
                                                </select>
                                            </div>                                            
                                            <div class="col-md-4">
                                                <label class="form-label">Estado:</label>
                                                <select class="form-control mb-2 mb-md-0" name="vActive" id="vActive" data-control="select2" placeholder="Seleccione Código del Plan de Cuentas">
                                                    <option value="<?Php echo $vActive; ?>" selected><?Php echo $vActiveText; ?></option>
                                                    <option value="1">Debe</option>
                                                    <option value="2">Haber</option>
                                                </select>                                                
                                                <input type="hidden" class="form-control mb-2 mb-md-0" name="vCodChartOfAccounts" value="<?Php echo $vCodChartOfAccounts; ?>" placeholder="Importe Total" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <button id="finances_edit_chartofaccount_submit" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Modificar
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