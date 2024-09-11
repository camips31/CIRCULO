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
            <div class="row g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Deudas</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchPartnerDebtReconciliation" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_partnerdebtreconciliation">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Socio</th>
                                        <th>Cuenta Contable</th>
                                        <th>Tipo</th>
                                        <th>Mes</th>
                                        <th>Fecha</th>
                                        <th>Monto Deuda</th>
                                        <th>Monto Comprobante</th>
                                        <th>Comprobante</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th data-priority="1">Acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <?Php
                                    if(isset($this->vTotalDebts) && count($this->vTotalDebts)):
                                        $vCount = 1;
                                        for($i=0;$i<count($this->vTotalDebts);$i++):
                                            echo '<tr code="'.$this->vTotalDebts[$i]['n_codpartnerdebt'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['t_nombres'].'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['n_chartofaccountname'].' - '.$this->vTotalDebts[$i]['c_chartofaccountname'].'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['n_typedebt'].'</td>';
                                                if($this->vTotalDebts[$i]['n_month'] == 1){
                                                    $vMonth = 'Enero '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 2){
                                                    $vMonth = 'Febrero '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 3){
                                                    $vMonth = 'Marzo '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 4){
                                                    $vMonth = 'Abril '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 5){
                                                    $vMonth = 'Mayo '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 6){
                                                    $vMonth = 'Junio '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 7){
                                                    $vMonth = 'Julio '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 8){
                                                    $vMonth = 'Agosto '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 9){
                                                    $vMonth = 'Septiembre '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 10){
                                                    $vMonth = 'Octubre '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 11){
                                                    $vMonth = 'Noviembre '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                } else if($this->vTotalDebts[$i]['n_month'] == 12){
                                                    $vMonth = 'Diciembre '.date('Y',strtotime($this->vTotalDebts[$i]['d_debtdate']));
                                                }
                                                echo '<td>'.$vMonth.'</td>';
                                                echo '<td>'.$this->spanishLiteralDate($this->vTotalDebts[$i]['d_debtdate']).'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['n_debttotal'].'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['n_voucheramount'].'</td>';
                                                echo '<td><a href="'.BASE_VIEW_URL.'finances/accountSeat/'.$this->vTotalDebts[$i]['n_codaccountingseat'].'" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Ver Asiento Contable" target="_blank"><i class="la la-list"></i></a></td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['c_debtdesc'].'</td>';
                                                echo '<td>'.$this->vTotalDebts[$i]['n_status'].'</td>';
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