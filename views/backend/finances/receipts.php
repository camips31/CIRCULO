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
                            <h3 class="card-title">Registrar Recibo</h3>
                            <div class="card-toolbar">
                                <button id="finances_form_receipts_submit" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Registrar Recibo
                                    </span>
                                    <span class="indicator-progress">
                                        Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>                            
                        </div>                        
                        <div class="collapse show">
                            <form id="finances_form_receipts_reg" class="form" action="#" autocomplete="off">                            												
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-2">
                                                <label class="form-label">N° Recibo<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-2 mb-md-0" id="vNumCorrelativeShow" disabled>
                                                <input type="hidden" class="form-control mb-2 mb-md-0" name="vNumCorrelative" id="vNumCorrelative" readonly>
                                            </div>                                            
                                            <div class="col-md-2">
                                                <label class="form-label">Tipo Recibo<span class="text-danger">*</span></label>
                                                <select class="form-select mb-2 mb-md-0" name="vCodTypeReceipt" id="vCodTypeReceipt" data-control="select2" placeholder="Seleccione Factura">
                                                    <option value="">Seleccionar Tipo Recibo</option>
                                                    <option value="1">Montos Iniciales</option>
                                                    <option value="2">Cuota Extraordinaria</option>
                                                    <option value="3">Cuota Mortuoria</option>
                                                    <option value="4">Cuota Participación</option>
                                                    <!--<option value="5">Cuota Ingreso</option>
                                                    <option value="6">Compra Libro</option>-->
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Fecha de Recibo<span class="text-danger">*</span></label>
                                                <input class="form-control form-control-solid" placeholder="Seleccionar Fecha" name="vDateReceipt" id="vDateReceipt"/>
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
                                            <div class="col-md-3">                                                
                                                <label class="form-label">Monto</label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vAmount" id="vAmount" placeholder="Monto Comprobante" />
                                            </div>                                            
                                        </div>
                                        <div class="fv-row form-group row mb-5">                                            
                                            <div class="col-md-7">
                                                <label class="form-label">Descripción<span class="text-danger">*</span></label>
                                                <textarea class="form-control mb-2 mb-md-0" id="vReceiptDesc" name="vReceiptDesc" rows="2" placeholder="Registre el detalle del recibo"></textarea>                                                
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
                                <input type="text" id="searchReceipts" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_receipts">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Tipo</th>
                                        <th>Socio</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th data-priority="1">acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    <?Php
                                    if(isset($this->DataReceiptsList) && count($this->DataReceiptsList)):
                                        $vCount = 1;
                                        $vTotalDebe = $vTotalHaber = 0;
                                        for($i=0;$i<count($this->DataReceiptsList);$i++):
                                            echo '<tr code="'.$this->DataReceiptsList[$i]['n_codreceipt'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['c_typereceipt'].'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['c_partner'].'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['n_totalreceipt'].'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['d_datereceipt'].'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['c_descreceipt'].'</td>';
                                                echo '<td>'.$this->DataReceiptsList[$i]['n_status'].'</td>';
                                                echo '<td></td>';
                                            echo '</tr>';
                                            ++$vCount;                                            
                                        endfor;
                                    endif;
                                    ?>
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
<!--end::Content wrapper-->