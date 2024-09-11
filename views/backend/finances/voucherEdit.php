<?Php
if(isset($this->DataVoucher) && count($this->DataVoucher)):
    $vCount = 1;
    for($i=0;$i<count($this->DataVoucher);$i++):
        $vCodVoucher = $this->DataVoucher[$i]['n_codvoucher'];
        $vCodAccountingSeat = $this->DataVoucher[$i]['n_codaccountingseat'];
        $vCodPartner = $this->DataVoucher[$i]['n_codpartner'];
        $vDataPartner = $this->DataVoucher[$i]['c_partner'];
        $vCodBill = $this->DataVoucher[$i]['n_codbill'];
        $vDataBill = $this->DataVoucher[$i]['c_bill'];
        $vCodChartOfAccount = $this->DataVoucher[$i]['n_codchartofaccounts'];
        $vNumChartOfAccount = $this->DataVoucher[$i]['n_chartofaccountname'];
        $vDescChartOfAccount = $this->DataVoucher[$i]['c_chartofaccountname'];
        $vTAccount = $this->DataVoucher[$i]['n_taccount'];
        $vCodVoucherType = $this->DataVoucher[$i]['n_vouchertype'];
        if($vCodVoucherType == 1){ $vVoucherType = 'Ingreso';}
        else if($vCodVoucherType == 2){ $vVoucherType = 'Egreso';}
        else if($vCodVoucherType == 3){ $vVoucherType = 'Traspaso';}
        $vVoucherDate = $this->DataVoucher[$i]['d_voucherdate'];
        $vVoucherAmount = $this->DataVoucher[$i]['n_voucheramount'];
        $vVoucherDesc = $this->DataVoucher[$i]['c_voucherdesc'];
        $vStatus = $this->DataVoucher[$i]['n_status'];
        $vActive = $this->DataVoucher[$i]['n_active'];
    endfor;
endif;
?>
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
                    <li class="breadcrumb-item text-muted">Comprobantes</li>
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
            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Registrar Comprobante</h3>
                            <div class="card-toolbar">
                                <button id="finances_form_vouchers_edit_submit" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Modificar Comprobante
                                    </span>
                                    <span class="indicator-progress">
                                        Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>                            
                        </div>                        
                        <div class="collapse show">
                            <form id="finances_form_vouchers_edit" class="form" action="#" autocomplete="off">                            												
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-3">
                                                <input type="hidden" value="<?Php echo $vCodVoucher; ?>" name="vCodVoucher" id="vCodVoucher" readonly/>
                                                <input type="hidden" value="<?Php echo $vCodAccountingSeat; ?>" id="vCodAccountingSeat" readonly/>
                                                <label class="form-label">Socios<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodPartner" id="vCodPartner" data-control="select2" placeholder="Seleccione Socio">
                                                <?Php
                                                    if($vCodPartner != 0){
                                                        echo '<option value="'.$vCodPartner.'" selected>'.$vDataPartner.'</option>';
                                                    }
                                                ?>                                                    
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
                                            <div class="col-md-3">
                                                <label class="form-label">Facturas<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodBill" id="vCodBill" data-control="select2" placeholder="Seleccione Factura">
                                                <?Php
                                                    if($vCodBill != 0){
                                                        echo '<option value="'.$vCodBill.'" selected>'.$vDataBill.'</option>';
                                                    }
                                                ?>
                                                <option value="">Seleccionar Factura</option>
                                                <?Php
                                                if (isset($this->DataBills) && count($this->DataBills)):
                                                    $vCount = 1;
                                                    for ($j = 0; $j < count($this->DataBills); $j++):
                                                        echo '<option value="' . $this->DataBills[$j]['n_codbill'] . '">'.$this->DataBills[$j]['n_numbill'].' - '.$this->DataBills[$j]['c_namepartner'].' - '.$this->DataBills[$j]['n_totalbill'].' - '.$this->DataBills[$j]['d_datebill'].'</option>';
                                                    endfor;
                                                endif;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Plan de Cuentas<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodChartOfAccount" id="vCodChartOfAccount" data-control="select2" placeholder="Seleccione Plan de Cuenta">
                                                <option value="<?Php echo $vCodChartOfAccount; ?>" selected><?Php echo $vNumChartOfAccount.' - '.$vDescChartOfAccount; ?></option>
                                                <option value="">Seleccionar Cuenta Contable</option>
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
                                                <label class="form-label">Comprobante</label>
                                                <select class="form-control mb-2 mb-md-0" name="vVoucherType" id="vVoucherType" placeholder="Seleccione la Cuenta T del Plan de Cuentas">
                                                    <option value="<?Php echo $vCodVoucherType; ?>" selected><?Php echo $vVoucherType; ?></option>
                                                    <option value="0">Seleccionar</option>
                                                    <option value="1">Ingreso</option>
                                                    <option value="2">Egreso</option>
                                                    <option value="3">Traspaso</option>
                                                </select>
                                            </div>                                            
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-3">
                                                <label class="form-label">Fecha de Solicitud<span class="text-danger">*</span></label>
                                                <input class="form-control form-control-solid" value="<?Php echo $vVoucherDate; ?>" name="vDateVoucher" id="vDateVoucher"/>
                                            </div>                                            
                                            <div class="col-md-3">                                                
                                                <label class="form-label">Monto</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vAmount" id="vAmount" value="<?Php echo $vVoucherAmount; ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Descripción<span class="text-danger">*</span></label>
                                                <textarea class="form-control mb-2 mb-md-0" id="vVoucherDesc" name="vVoucherDesc" rows="2"><?Php echo $vVoucherDesc; ?></textarea>                                                
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->