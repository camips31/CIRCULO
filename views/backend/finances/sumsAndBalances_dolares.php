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
												<a href="#" class="text-muted text-hover-primary">Dashboard</a>
											</li>
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
							<!--end::Toolbar-->
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
                                <div id="kt_app_content_container" class="app-container container-fluid">
									<!--begin::Row-->
									<div class="row g-5 g-xl-12 mb-xl-12">
										<div class="col-md-12">
											<a class="btn btn-sm btn-primary me-2" href="#">GESTIÓN 2024</a>
											<?Php
											if(isset($this->vGroupMonthOfAccountingBook) && count($this->vGroupMonthOfAccountingBook)):
												for($i=0;$i<count($this->vGroupMonthOfAccountingBook);$i++):
													echo '<a class="btn btn-sm btn-primary me-2" href="'.BASE_VIEW_URL.'finances/sumsAndBalances/'.$this->vGroupMonthOfAccountingBook[$i]['n_month'].'">'.$this->vGroupMonthOfAccountingBook[$i]['c_monthname'].'</a>';
												endfor;
											endif;
											?>
											<input type="hidden" id="vMonth" value="<?Php echo $this->spanishLiteralMonth($this->vMonth); ?>" readonly>
											<a class="btn btn-sm btn-primary me-2" href="<?Php echo BASE_VIEW_URL; ?>pdf/sumsAndBalances" target="_blank">Imprimir Reporte</a>
										</div>

										<div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 mb-md-10 mb-xl-10">
											<div class="card shadow-sm">
												<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
													<h3 class="card-title">Plan de Cuentas</h3>													
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                                        <input type="text" id="searchSumsAndBalances" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                                                    </div>
                                                    <!--end::Search-->                                                    
												</div>                                                
												<div class="collapse show">												
													<div class="card-body">
                                                    <table class="table table-bordered" id="datatable_sumsandbalances">
                                                            <thead> 
                                                                <tr> 
                                                                    <th colspan="3"></th>
                                                                    <th colspan="2" class="align-middle border-bottom border-end w-200px">Sumas</th> 
                                                                    <th colspan="2" class="align-middle border-bottom border-end w-200px">Saldos</th> 
                                                                    <th></th> 
                                                                </tr> 
                                                                <tr>
                                                                    <th>Num</th> 
                                                                    <th>Cuenta</th>
                                                                    <th>Descripción Cuenta</th>
                                                                    <th>Debe</th> 
                                                                    <th>Haber</th>																	
                                                                    <th>Debe</th> 
                                                                    <th>Haber</th>                                                                    
                                                                    <th>Acciones</th> 
                                                                </tr>                                                                
                                                            </thead> 
                                                            <tbody class="text-gray-600 fw-semibold">
                                                            <?Php
                                                            if(isset($this->vDataSumsAndBalances) && count($this->vDataSumsAndBalances)):
                                                                $vCount = 1;
                                                                $vAnteriorMesSumasDebe = $vAnteriorMesSumasHaber = $vAnteriorMesSaldosDebe = $vAnteriorMesSaldosHaber = 0;
																$vSumasDebe = $vSumasHaber = $vSaldosDebe = $vSaldosHaber = 0;
                                                                for($i=0;$i<count($this->vDataSumsAndBalances);$i++):


                                                                    echo '<tr code="'.$this->vDataSumsAndBalances[$i]['n_chartofaccountname'].'"
																			  vTotalSaldoDebe="'.$this->vDataSumsAndBalances[$i]['n_saldos_debe'].'"
																			  vTotalSaldoHaber="'.$this->vDataSumsAndBalances[$i]['n_saldos_haber'].'"
																			  vCodChartOfAccount="'.$this->vDataSumsAndBalances[$i]['n_codchartofaccounts'].'"
																			  vMonth="'.$this->vDataSumsAndBalances[$i]['n_month'].'"
																			  vTAccount="'.$this->vDataSumsAndBalances[$i]['n_taccount'].'">';
                                                                        echo '<td>'.$vCount.'</td>';
                                                                        echo '<td>'.$this->vDataSumsAndBalances[$i]['n_chartofaccountname'].'</td>';
                                                                        echo '<td>'.$this->vDataSumsAndBalances[$i]['c_chartofaccountname'].'</td>';



                                                                        echo '<td>'.number_format($this->vDataSumsAndBalances[$i]['n_sumas_debe'],2,',','.').'</td>';
                                                                        echo '<td>'.number_format($this->vDataSumsAndBalances[$i]['n_sumas_haber'],2,',','.').'</td>';
                                                                        echo '<td>'.number_format($this->vDataSumsAndBalances[$i]['n_saldos_debe'],2,',','.').'</td>';
                                                                        echo '<td>'.number_format($this->vDataSumsAndBalances[$i]['n_saldos_haber'],2,',','.').'</td>';
                                                                        echo '<td></td>';
                                                                    echo '</tr>';

                                                                    $vSumasDebe = $vSumasDebe + $this->vDataSumsAndBalances[$i]['n_sumas_debe'];
                                                                    $vSumasHaber = $vSumasHaber + $this->vDataSumsAndBalances[$i]['n_sumas_haber'];
                                                                    $vSaldosDebe = $vSaldosDebe + $this->vDataSumsAndBalances[$i]['n_saldos_debe'];
                                                                    $vSaldosHaber =  $vSaldosHaber + $this->vDataSumsAndBalances[$i]['n_saldos_haber'];

                                                                    ++$vCount;

                                                                endfor;
                                                            endif;
                                                            ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="fw-bold fs-6">
                                                                    <th colspan="3" class="text-nowrap align-end">Totales:</th>
                                                                    <th class="text-danger fs-3"><?Php echo number_format($vSumasDebe,2,',','.'); ?></th>
                                                                    <th class="text-danger fs-3"><?Php echo number_format($vSumasHaber,2,',','.'); ?></th>
                                                                    <th class="text-danger fs-3"><?Php echo number_format($vSaldosDebe,2,',','.'); ?></th>
                                                                    <th class="text-danger fs-3"><?Php echo number_format($vSaldosHaber,2,',','.'); ?></th>
                                                                    <th class="text-danger fs-3"></th>
                                                                </tr>
                                                            </tfoot>   
														</table>
													</div>
													<div class="card-footer"></div>                                                    
												</div>
											</div>
										</div>
									</div>
									<!--end::Row-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->