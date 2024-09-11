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
                            <h3 class="card-title">Información del Socio</h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form class="form" action="#" autocomplete="off">
                            <?Php
                                if(isset($this->vDataPartner) && count($this->vDataPartner)):
                                    for($i=0;$i<count($this->vDataPartner);$i++):
                                        $vCodPartner = $this->vDataPartner[$i]['n_codpartner'];
                                        $vNumAccion = $this->vDataPartner[$i]['n_numaccion'];
                                        //$vType = $this->vDataPartner[$i]['n_categoria'];

                                        if($this->vDataPartner[$i]['n_categoria'] == 1){
                                            $vType = 'Activo Presente';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 2){
                                            $vType = 'Emérito Presente';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 3){
                                            $vType = 'Corporativo';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 4){
                                            $vType = 'Activo Ausente';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 5){
                                            $vType = 'Emérito Ausente';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 6){
                                            $vType = 'Especial';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 7){
                                            $vType = 'Diplomático';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 8){
                                            $vType = 'Congelado';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 9){
                                            $vType = 'Exento';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 10){
                                            $vType = 'Concesionario';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 11){
                                            $vType = 'Emérito No Aportante';
                                        } else if($this->vDataPartner[$i]['n_categoria'] == 12){
                                            $vType = 'Exento';
                                        } else {
                                            $vType = '¡Error! {'.$this->vDataPartner[$i]['n_categoria'].'}';
                                        }

                                        $vPartnerName = $this->vDataPartner[$i]['t_nombres'];
                                    endfor;
                                endif;
                            ?>                                
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-2">
                                            <label class="form-label">N° Acción
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vNumAccion; ?>" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Categoría
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vType; ?>" disabled>
                                        </div>
                                        <div class="col-md-7">
                                            <label class="form-label">Nombre Completo
                                            <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vPartnerName; ?>" disabled>
                                        </div>                                                                                
                                    </div>
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
                            <h3 class="card-title">Listado de Deudas</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchPartnerDebts" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_partnerdebts">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Tipo</th>
                                        <th>Mes</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th data-priority="1">acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <?Php
                                    if(isset($this->vDataRecordDebtPartner) && count($this->vDataRecordDebtPartner)):
                                        $vCount = 1;
                                        for($i=0;$i<count($this->vDataRecordDebtPartner);$i++):
                                            echo '<tr code="'.$this->vDataRecordDebtPartner[$i]['n_codpartnerdebt'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vDataRecordDebtPartner[$i]['n_categoria'].'</td>';
                                                if($this->vDataRecordDebtPartner[$i]['n_month'] == 1){
                                                    $vMonth = 'Enero '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 2){
                                                    $vMonth = 'Febrero '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 3){
                                                    $vMonth = 'Marzo '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 4){
                                                    $vMonth = 'Abril '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 5){
                                                    $vMonth = 'Mayo '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 6){
                                                    $vMonth = 'Junio '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 7){
                                                    $vMonth = 'Julio '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 8){
                                                    $vMonth = 'Agosto '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 9){
                                                    $vMonth = 'Septiembre '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 10){
                                                    $vMonth = 'Octubre '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 11){
                                                    $vMonth = 'Noviembre '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                } else if($this->vDataRecordDebtPartner[$i]['n_month'] == 12){
                                                    $vMonth = 'Diciembre '.date('Y',strtotime($this->vDataRecordDebtPartner[$i]['d_debtdate']));
                                                }

                                                echo '<td>'.$vMonth.'</td>';
                                                echo '<td>'.$this->spanishLiteralDate($this->vDataRecordDebtPartner[$i]['d_debtdate']).'</td>';
                                                echo '<td>'.$this->vDataRecordDebtPartner[$i]['n_debttotal'].'</td>';
                                                echo '<td>'.$this->vDataRecordDebtPartner[$i]['c_debtdesc'].'</td>';
                                                echo '<td>'.$this->vDataRecordDebtPartner[$i]['n_status'].'</td>';
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

            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Comprobantes </h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchVoucherAccountingSeats" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_recordfinancespartner">
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
                                    if(isset($this->vDataRecordFinancesPartner) && count($this->vDataRecordFinancesPartner)):
                                        $vCount = 1;
                                        $vTotalDebe = $vTotalHaber = $vMontoEnDolares = $vMontoFinal = 0;
                                        for($i=0;$i<count($this->vDataRecordFinancesPartner);$i++):
                                            echo '<tr code="'.$this->vDataRecordFinancesPartner[$i]['n_codvoucher'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['n_chartofaccountname'].' - '.$this->vDataRecordFinancesPartner[$i]['c_chartofaccountname'].'</td>';

                                                if($this->vDataRecordFinancesPartner[$i]['n_chartofaccountname'] == '1116011*'){
                                                    $vMontoEnDolares = $this->vDataRecordFinancesPartner[$i]['n_voucheramount'];
                                                    $vMontoFinal = ($vMontoEnDolares * 6.96);
                                                } else {
                                                    $vMontoFinal = $this->vDataRecordFinancesPartner[$i]['n_voucheramount'];
                                                }

                                                if($this->vDataRecordFinancesPartner[$i]['n_taccount'] == 1){
                                                    echo '<td>'.$vMontoFinal.'</td>';
                                                    echo '<td>0</td>';
                                                    $vTotalDebe = $vTotalDebe + $vMontoFinal;
                                                } else if($this->vDataRecordFinancesPartner[$i]['n_taccount'] == 2){
                                                    echo '<td>0</td>';
                                                    echo '<td>'.$vMontoFinal.'</td>';    
                                                    $vTotalHaber = $vTotalHaber + $vMontoFinal;
                                                }
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['d_voucherdate'].'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['c_voucherdesc'].'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['n_status'].'</td>';
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

            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Recibos </h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchVoucherAccountingSeats" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_recordfinancespartner">
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
                                    if(isset($this->vDataRecordFinancesPartner) && count($this->vDataRecordFinancesPartner)):
                                        $vCount = 1;
                                        $vTotalDebe = $vTotalHaber = $vMontoEnDolares = $vMontoFinal = 0;
                                        for($i=0;$i<count($this->vDataRecordFinancesPartner);$i++):
                                            echo '<tr code="'.$this->vDataRecordFinancesPartner[$i]['n_codvoucher'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['n_chartofaccountname'].' - '.$this->vDataRecordFinancesPartner[$i]['c_chartofaccountname'].'</td>';

                                                if($this->vDataRecordFinancesPartner[$i]['n_chartofaccountname'] == '1116011*'){
                                                    $vMontoEnDolares = $this->vDataRecordFinancesPartner[$i]['n_voucheramount'];
                                                    $vMontoFinal = ($vMontoEnDolares * 6.96);
                                                } else {
                                                    $vMontoFinal = $this->vDataRecordFinancesPartner[$i]['n_voucheramount'];
                                                }

                                                if($this->vDataRecordFinancesPartner[$i]['n_taccount'] == 1){
                                                    echo '<td>'.$vMontoFinal.'</td>';
                                                    echo '<td>0</td>';
                                                    $vTotalDebe = $vTotalDebe + $vMontoFinal;
                                                } else if($this->vDataRecordFinancesPartner[$i]['n_taccount'] == 2){
                                                    echo '<td>0</td>';
                                                    echo '<td>'.$vMontoFinal.'</td>';    
                                                    $vTotalHaber = $vTotalHaber + $vMontoFinal;
                                                }
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['d_voucherdate'].'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['c_voucherdesc'].'</td>';
                                                echo '<td>'.$this->vDataRecordFinancesPartner[$i]['n_status'].'</td>';
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