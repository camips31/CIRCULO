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
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
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
					<li class="breadcrumb-item text-muted">Dashboard</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Información General</li>
					<!--end::Item-->					
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Toolbar container-->
	</div>

	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-fluid">
			<!--<div class="row">
            	<div class="col-xl-3">
					<div class="card border-transparent" data-bs-theme="light" style="background-color: #1C325E;">
						<div class="card-body d-flex ps-xl-15">
							<div class="m-0">
								<div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
									<span class="me-2">Facturación</span>
								</div>
								<div class="mb-3">
									<button id="Submit" class="btn btn-danger fw-semibold mt-1">Cursos</button>
								</div>
							</div>
							<img src="<?Php //echo $vParamsViewBackEndLayout['root_backend_media'];?>illustrations/sigma-1/17-dark.png" class="position-absolute bottom-0 end-0 h-200px" alt="" />
						</div>
					</div>					
				</div>
			</div>-->		
			<div class="row g-5 g-xl-12 mb-xl-12">
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: #0C5709;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>" class="card-title fw-bold text-white fs-5 mb-3 d-block">Plan de Cuentas</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2"><?Php echo count($this->DataChartOfAccount); ?></span>
								<span class="fw-semibold text-muted fs-7"></span>
							</div>
							<div class="progress h-7px bg-white bg-opacity-50 mt-7">
								<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: green;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/bills" class="card-title fw-bold text-white fs-5 mb-3 d-block">Asientos Contables</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2">Bs <?Php echo $this->vTotalAccountingEntries; ?></span><br>
								<span class="fw-semibold text-white fs-7">N° Asientos Contabilizados <?Php echo $this->vMonth; ?></span>
							</div>
							<div class="progress h-7px bg-white bg-opacity-50 mt-7">
								<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>				
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: #F1416C;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/bills" class="card-title fw-bold text-white fs-5 mb-3 d-block">Facturas</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2">Bs <?Php echo $this->DataTotalAmountBills; ?></span><br>
								<span class="fw-semibold text-white fs-7">N° Facturas Emitidas <?Php echo count($this->DataBills); ?></span>
							</div>
							<div class="progress h-7px bg-white bg-opacity-50 mt-7">
								<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>								
				<div class="col-xl-3">
					<div class="card bg-light-primary card-xl-stretch mb-5 mb-xl-8">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>partners/list" class="card-title fw-bold text-primary fs-5 mb-3 d-block">Socios Registrados</a>
							<div class="py-1">
								<span class="text-dark fs-1 fw-bold me-2"><?Php echo count($this->DataPartners); ?></span>
								<span class="fw-semibold text-muted fs-7"></span>
							</div>
							<div class="progress h-7px bg-primary bg-opacity-50 mt-7">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>
			</div>						
		</div>
	</div>
</div>