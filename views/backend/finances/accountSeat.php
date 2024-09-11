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

            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Comprobantes Pendientes de Contabilización</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchAccountingSeats" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <div>
                                <?Php
                                    if(isset($this->vDataAccountingSeat) && count($this->vDataAccountingSeat)):
                                        for($i=0;$i<count($this->vDataAccountingSeat);$i++):
                                            echo $this->spanishLiteralDate($this->vDataAccountingSeat[$i]['d_accountingseatdate']);
                                            echo $this->vDataAccountingSeat[$i]['c_accountingseatdesc'];                                       
                                        endfor;
                                    endif;
                                    ?>
                                </div>
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_accountingseat">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Cuenta Contable</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                        <th>Fecha Voucher</th>
                                        <th>Glosa</th>
                                        <th>Estado</th>
                                        <th>Socio/Factura</th>
                                        <th data-priority="1">acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                    <?Php
                                    if(isset($this->vDataAccountSeat) && count($this->vDataAccountSeat)):
                                        $vCount = 1;
                                        $vTotalDebe = $vTotalHaber = $vMontoFinal = 0;
                                        for($i=0;$i<count($this->vDataAccountSeat);$i++):

                                            if($this->vDataAccountSeat[$i]['n_chartofaccountname'] == '1116011*'){
                                                $vMontoEnDolares = $this->vDataAccountSeat[$i]['n_voucheramount'];
                                                $vMontoFinal = ($vMontoEnDolares * 6.96);
                                            } else {
                                                $vMontoFinal = $this->vDataAccountSeat[$i]['n_voucheramount'];
                                            }                                            

                                            echo '<tr code="'.$this->vDataAccountSeat[$i]['n_codvoucher'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vDataAccountSeat[$i]['n_chartofaccountname'].' - '.$this->vDataAccountSeat[$i]['c_chartofaccountname'].'</td>';
                                                if($this->vDataAccountSeat[$i]['n_taccount'] == 1){
                                                    echo '<td>'.$vMontoFinal.'</td>';
                                                    echo '<td>0</td>';
                                                    $vTotalDebe = $vTotalDebe + $vMontoFinal;
                                                } else if($this->vDataAccountSeat[$i]['n_taccount'] == 2){
                                                    echo '<td>0</td>';
                                                    echo '<td>'.$vMontoFinal.'</td>';    
                                                    $vTotalHaber = $vTotalHaber + $vMontoFinal;
                                                }
                                                echo '<td>'.$this->spanishLiteralDate($this->vDataAccountSeat[$i]['d_voucherdate']).'</td>';
                                                echo '<td>'.$this->vDataAccountSeat[$i]['c_voucherdesc'].'</td>';
                                                echo '<td>'.$this->vDataAccountSeat[$i]['n_status'].'</td>';
                                                echo '<td>'.$this->vDataAccountSeat[$i]['c_partner'].'<br>'.$this->vDataAccountSeat[$i]['c_bill'].'</td>';
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