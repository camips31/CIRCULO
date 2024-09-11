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
                    <li class="breadcrumb-item text-muted">Registro</li>
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
                                <button id="finances_form_vouchers_submit" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Registrar Comprobante
                                    </span>
                                    <span class="indicator-progress">
                                        Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>                            
                        </div>                        
                        <div class="collapse show">
                            <form id="finances_form_vouchers_reg" class="form" action="#" autocomplete="off">                            												
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-2">
                                                <label class="form-label">Comprobante</label>
                                                <select class="form-control mb-2 mb-md-0" name="vVoucherType" id="vVoucherType" placeholder="Seleccione la Cuenta T del Plan de Cuentas">
                                                <option value="">Seleccionar</option>
                                                    <option value="1">Ingreso</option>
                                                    <option value="2">Egreso</option>
                                                    <option value="3">Traspaso</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
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
                                                <label class="form-label">Fecha de Solicitud<span class="text-danger">*</span></label>
                                                <input class="form-control form-control-solid" placeholder="Seleccionar Fecha" name="vDateVoucher" id="vDateVoucher"/>
                                            </div>
                                            <div class="col-md-3">                                                
                                                <label class="form-label">Monto</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vAmount" id="vAmount" placeholder="Monto Comprobante" />
                                            </div>                                                                                                                                    
                                        </div>                                        
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
                                                <label class="form-label">Facturas<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodBill" id="vCodBill" data-control="select2" placeholder="Seleccione Factura">
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
                                            <div class="col-md-4">
                                                <label class="form-label">Recibos<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodReceipt" id="vCodReceipt" data-control="select2" placeholder="Seleccione Recibo">
                                                    <option value="">Seleccionar Recibo</option>
                                                    <?Php
                                                    if (isset($this->DataReceiptsList) && count($this->DataReceiptsList)):
                                                        $vCount = 1;
                                                        for ($j = 0; $j < count($this->DataReceiptsList); $j++):
                                                            echo '<option value="' . $this->DataReceiptsList[$j]['n_codreceipt'] . '">'.$this->DataReceiptsList[$j]['n_numreceipt'].' - '.$this->DataReceiptsList[$j]['c_partner'].' - '.$this->DataReceiptsList[$j]['c_typereceipt'].' - '.$this->DataReceiptsList[$j]['n_totalreceipt'].' - '.$this->DataReceiptsList[$j]['d_datereceipt'].'</option>';
                                                        endfor;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row form-group row mb-5">                                            
                                            <div class="col-md-6">
                                                <label class="form-label">Descripción<span class="text-danger">*</span></label>
                                                <textarea class="form-control mb-2 mb-md-0" id="vVoucherDesc" name="vVoucherDesc" rows="2" placeholder="Registre la glosa del comprobante"></textarea>                                                
                                            </div>
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="0" id="radioTypeVoucher" name="radioTypeVoucher" checked />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Ninguno
                                                        </label>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="1" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Débito Fiscal
                                                        </label>
                                                    </div>
                                                </div>                                               
                                            </div>                                            
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="2" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Crédito Fiscal
                                                        </label>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="3" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Retenciones Servicios
                                                        </label>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="4" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Retenciones Compras
                                                        </label>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="5" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Pago Cuota Mensual con Tarjeta
                                                        </label>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="6" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Pago Cuota Mortuoria con Tarjeta
                                                        </label>
                                                    </div>
                                                </div>                                             
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="7" id="radioTypeVoucher" name="radioTypeVoucher" />
                                                        <label class="form-check-label" for="flexCheckChecked1">
                                                            Pagos con Tarjeta
                                                        </label>
                                                    </div>
                                                </div>                                             
                                            </div>                                                                                                                                    
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Comprobantes Pendientes de Contabilización</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchVoucherAccountingSeats" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_vouchers_accountingseat">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Cuenta Contable</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Fecha Voucher</th>
                                        <th>Glosa</th>
                                        <th>Estado</th>
                                        <th data-priority="1">acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    <?Php
                                    if(isset($this->DataVouchersList) && count($this->DataVouchersList)):
                                        $vCount = 1;
                                        $vTotalDebe = $vTotalHaber = $vMontoEnDolares = $vMontoFinal = 0;
                                        for($i=0;$i<count($this->DataVouchersList);$i++):
                                            echo '<tr code="'.$this->DataVouchersList[$i]['n_codvoucher'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->DataVouchersList[$i]['n_chartofaccountname'].' - '.$this->DataVouchersList[$i]['c_chartofaccountname'].'</td>';

                                                if($this->DataVouchersList[$i]['n_chartofaccountname'] == '1116011*'){
                                                    $vMontoEnDolares = $this->DataVouchersList[$i]['n_voucheramount'];
                                                    $vMontoFinal = ($vMontoEnDolares * 6.96);
                                                } else {
                                                    $vMontoFinal = $this->DataVouchersList[$i]['n_voucheramount'];
                                                }

                                                if($this->DataVouchersList[$i]['n_taccount'] == 1){
                                                    echo '<td>'.$vMontoFinal.'</td>';
                                                    echo '<td>0</td>';
                                                    $vTotalDebe = $vTotalDebe + $vMontoFinal;
                                                } else if($this->DataVouchersList[$i]['n_taccount'] == 2){
                                                    echo '<td>0</td>';
                                                    echo '<td>'.$vMontoFinal.'</td>';    
                                                    $vTotalHaber = $vTotalHaber + $vMontoFinal;
                                                }
                                                echo '<td>'.$this->DataVouchersList[$i]['d_voucherdate'].'</td>';
                                                echo '<td>'.$this->DataVouchersList[$i]['c_voucherdesc'].'</td>';
                                                echo '<td>'.$this->DataVouchersList[$i]['n_status'].'</td>';
                                                echo '<td></td>';
                                            echo '</tr>';
                                            ++$vCount;                                            
                                        endfor;
                                    endif;
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="fw-bold fs-6">
                                            <th colspan="2" class="text-nowrap align-end">Total:</th>
                                            <th colspan="1" class="text-danger fs-3"><?Php echo number_format($vTotalDebe,2,',','.'); ?></th>
                                            <th colspan="1" class="text-danger fs-3"><?Php echo number_format($vTotalHaber,2,',','.'); ?></th>
                                            <th colspan="4" class="text-nowrap align-end">
                                                <?Php
                                                if(number_format($vTotalDebe,2,',','.') == number_format($vTotalHaber,2,',','.')){
                                                    echo '<button id="finances_form_vouchers_consolidar_submit" type="button" class="btn btn-primary">
                                                            <span class="indicator-label">
                                                                Consolidar Asiento
                                                            </span>
                                                            <span class="indicator-progress">
                                                                Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                            </span>
                                                        </button>';
                                                }
                                                ?>
                                            </th>
                                        </tr>
                                    </tfoot>                                    
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
<!--end::Content wrapper-->