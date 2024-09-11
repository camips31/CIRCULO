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
                <div class="col-md-12 mb-5">
                    <a class="btn btn-sm btn-primary me-2" href="#">GESTIÓN 2024</a>
                    <?Php
                    if(isset($this->vDataGroupPartnerMonthlyPayments) && count($this->vDataGroupPartnerMonthlyPayments)):
                        for($i=0;$i<count($this->vDataGroupPartnerMonthlyPayments);$i++):
                            echo '<a class="btn btn-sm btn-primary me-2" href="'.BASE_VIEW_URL.'partners/monthlyPayments/'.$this->vDataGroupPartnerMonthlyPayments[$i]['n_month'].'">'.$this->vDataGroupPartnerMonthlyPayments[$i]['c_monthname'].'</a>';
                        endfor;
                    endif;
                    ?>
                </div>                
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">                
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Pagos Mensuales Registrados</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchPartnerMonthlyPayments" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table table-striped table-row-bordered gy-5 gs-7" id="datatable_partnermonthlypayments">
                                    <thead class="fw-semibold fs-6 text-gray-800">
                                        <th>Num</th>
                                        <th>Acción</th>
                                        <th>Nombre Socio</th>
                                        <th>Monto Bs</th>
                                        <th>Monto Dólares</th>
                                        <th>Descripción</th>
                                        <th>Cuenta Contable</th>
                                        <th data-priority="1">Acciones</th>
                                        <!--end::Table row-->
                                    </thead>
                                    <?Php
                                    if(isset($this->vDataPartnerMonthlyPayments) && count($this->vDataPartnerMonthlyPayments)):
                                        $vCount = 1;
                                        for($i=0;$i<count($this->vDataPartnerMonthlyPayments);$i++):
                                            echo '<tr code="'.$this->vDataPartnerMonthlyPayments[$i]['n_codvoucher'].'">';
                                                echo '<td>'.$vCount.'</td>';
                                                echo '<td>'.$this->vDataPartnerMonthlyPayments[$i]['n_numaccion'].'</td>';
                                                echo '<td>'.$this->vDataPartnerMonthlyPayments[$i]['t_nombres'].'</td>';
                                                echo '<td>Bs. '.$this->vDataPartnerMonthlyPayments[$i]['n_voucheramount'].'</td>';
                                                echo '<td>$us. '.($this->vDataPartnerMonthlyPayments[$i]['n_voucheramount'] / 6.96).'</td>';
                                                echo '<td>'.$this->vDataPartnerMonthlyPayments[$i]['c_voucherdesc'].' - '.$this->spanishLiteralDate($this->vDataPartnerMonthlyPayments[$i]['d_voucherdate']).'</td>';
                                                echo '<td>'.$this->vDataPartnerMonthlyPayments[$i]['n_chartofaccountname'].' - '.$this->vDataPartnerMonthlyPayments[$i]['c_chartofaccountname'].'</td>';
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