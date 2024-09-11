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
                            <h3 class="card-title">Creación de Deudas para Socios</h3>
                        </div>
                        <div class="collapse show">
                        <?Php
                        if(isset($this->vDataDebt) && count($this->vDataDebt)):
                            for($i=0;$i<count($this->vDataDebt);$i++):
                                $vCodDebt = $this->vDataDebt[$i]['n_coddebt'];
                                $vPartner = $this->vDataDebt[$i]['n_numaccion'].' - '.$this->vDataDebt[$i]['t_nombres'];
                                $vMonthDebt = $this->vDataDebt[$i]['n_month'];
                                $vDateDebt = $this->vDataDebt[$i]['d_debtdate'];
                                $vCodChartAccount = $this->vDataDebt[$i]['n_chartofaccountname'];
                                $vChartAccount = $this->vDataDebt[$i]['c_chartofaccountname'];
                                $vAmountDebt = $this->vDataDebt[$i]['n_debttotal'];
                                $vDescDebt = $this->vDataDebt[$i]['c_debtdesc'];
                            endfor;
                        endif;
                        ?>                            
                            <!--begin::Form-->
                            <form id="partners-form-payoutoffdebt-reg" class="form" action="#" autocomplete="off">
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label">Datos Socio</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vPartner; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="fv-row form-group row mb-5">                                         
                                        <div class="col-md-4">
                                            <label class="form-label">Mes Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vMonthDebt; ?>" disabled>
                                        </div>                                        
                                        <div class="col-md-4">
                                            <label class="form-label">Fecha Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vDateDebt; ?>" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Monto Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vAmountDebt; ?>" disabled>
                                        </div>                                        
                                    </div>                                    

                                    <div class="fv-row form-group row mb-5">                                         
                                        <div class="col-md-2">
                                            <label class="form-label">Cuenta Contable</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vCodChartAccount; ?>" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Plan de Cuentas</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vChartAccount; ?>" disabled>
                                        </div>
                                        <div class="col-md-7">
                                            <label class="form-label">Detalle Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vDescDebt; ?>" disabled>
                                        </div>                                                                                
                                    </div>
                                    
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label">Detalle Deuda</label>
                                            <input type="text" class="form-control mb-2 mb-md-0" value="<?Php echo $vDescDebt; ?>" disabled>
                                        </div>
                                    </div>                                    

                                    <div class="fv-row form-group row mb-5">                                        
                                        <div class="col-md-12">
                                            <label class="form-label">Comprobantes Registrados<span class="text-danger">*</span></label>
                                            <input type="hidden" class="form-control mb-2 mb-md-0" name="n_coddebt" id="n_coddebt" value="<?Php echo $vCodDebt; ?>" readonly>
                                            <select class="form-select mb-2 mb-md-0" name="n_codvoucher" id="n_codvoucher" data-control="select2" placeholder="Seleccione Plan de Cuenta">
                                                <option value="">Seleccionar Comprobante</option>
                                                <?Php
                                                if (isset($this->vDataVouchersPartner) && count($this->vDataVouchersPartner)):
                                                    $vCount = 1;
                                                    for ($k = 0; $k < count($this->vDataVouchersPartner); $k++):
                                                        echo '<option value="' . $this->vDataVouchersPartner[$k]['n_codvoucher'] . '">
                                                                    '.$this->vDataVouchersPartner[$k]['n_chartofaccountname'].' -
                                                                    '.$this->vDataVouchersPartner[$k]['c_chartofaccountname'].' -  
                                                                    '.$this->vDataVouchersPartner[$k]['n_voucheramount'].' - 
                                                                    '.$this->vDataVouchersPartner[$k]['d_voucherdate'].' -
                                                                    '.$this->vDataVouchersPartner[$k]['c_voucherdesc'].' -
                                                                    Factura N° '.$this->vDataVouchersPartner[$k]['n_codbill'].' -
                                                                    Recibo N° '.$this->vDataVouchersPartner[$k]['n_codreceipt'].'
                                                                    </option>';
                                                    endfor;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <button id="partners-form-payoutoffdebt-reg-submit" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Registrar
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