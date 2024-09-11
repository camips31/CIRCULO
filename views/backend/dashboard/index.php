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

			<div class="row">
            	<div class="col-xl-6">
					<div class="col-md-12 col-xxl-12">
						<div class="card card-flush border-0 h-xl-100" data-bs-theme="light" style="background-color: #22232B">
							<div class="card-header pt-2">
								<h3 class="card-title">
									<span class="text-white fs-3 fw-bold me-2">Monto en Bancos</span>
									<span class="badge badge-success">Datos Registrados</span>
								</h3>
							</div>
							<div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
								<div class="d-flex flex-wrap px-9 mb-5">
								<?Php
									if(isset($this->DataTotalBankAmount) && count($this->DataTotalBankAmount)):
										for($i=0;$i<count($this->DataTotalBankAmount);$i++):
											echo '<div class="rounded min-w-125px py-3 px-4 my-1 me-6" style="border: 1px dashed rgba(255, 255, 255, 0.15)">
														<div class="d-flex align-items-center">
															<div class="text-white fs-1 fw-bold" data-kt-countup="true" data-kt-countup-value="'.$this->DataTotalBankAmount[$i]['n_amount'].'" data-kt-countup-prefix="Bs. ">0</div>
														</div>
														<div class="fw-semibold fs-7 text-white opacity-50">'.$this->DataTotalBankAmount[$i]['n_chartofaccountname'].'<br>'.$this->DataTotalBankAmount[$i]['c_chartofaccountname'].'</div>
													</div>';
										endfor;
									endif;									
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: #43cb57;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/bills" class="card-title fw-bold text-white fs-5 mb-3 d-block">Monto en Facturas</a>
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
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: #1fb571;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/bills" class="card-title fw-bold text-white fs-5 mb-3 d-block">Monto en Recibos</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2">Bs <?Php echo $this->DataTotalAmountReceipts; ?></span><br>
								<span class="fw-semibold text-white fs-7">N° Recibos Emitidas <?Php echo count($this->DataReceipts); ?></span>
							</div>
							<div class="progress h-7px bg-white bg-opacity-50 mt-7">
								<div class="progress-bar bg-white" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>				
			</div>		
			<!--<div class="row g-5 g-xl-12 mb-xl-12">-->
			<div class="row mt-5">
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background-color: #000;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/chartOfAccountList" class="card-title fw-bold text-white fs-5 mb-3 d-block">Plan de Cuentas</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2"><?Php echo count($this->DataChartOfAccount); ?></span><br>
								<span class="fw-semibold text-muted fs-7">Cuentas Contables Registradas</span>
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
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/accountingEntries" class="card-title fw-bold text-white fs-5 mb-3 d-block">Asientos Contables</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2"><?Php echo $this->vTotalAccountingEntries; ?></span><br>
								<span class="fw-semibold text-white fs-7">Asientos Contabilizados <?Php echo $this->vMonth; ?></span>
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
								<span class="text-dark fs-1 fw-bold me-2"><?Php echo count($this->DataPartners); ?></span><br>
								<span class="fw-semibold text-muted fs-7"></span>
							</div>
							<div class="progress h-7px bg-primary bg-opacity-50 mt-7">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3">
					<div class="card card-xl-stretch mb-5 mb-xl-8" style="background:  #3d509d;">
						<div class="card-body my-3">
							<a href="<?Php echo BASE_VIEW_URL; ?>finances/receiptList" class="card-title fw-bold text-primary fs-5 mb-3 d-block">Recibos Registrados</a>
							<div class="py-1">
								<span class="text-white fs-1 fw-bold me-2"><?Php echo count($this->DataReceiptsList); ?></span><br>
								<span class="fw-semibold text-white fs-7"></span>
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