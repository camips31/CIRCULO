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
												echo '<a class="btn btn-sm btn-primary me-2" href="'.BASE_VIEW_URL.'finances/editMainAccountingBook/'.$this->vCodChartOfAccount.'/'.$this->vGroupMonthOfAccountingBook[$i]['n_month'].'">'.$this->vGroupMonthOfAccountingBook[$i]['c_monthname'].'</a>';
											endfor;
										endif;
										?>
											<a class="btn btn-sm btn-primary me-2" href="<?Php echo BASE_VIEW_URL.'pdf/mainAccountingBook/'.$this->vCodChartOfAccount.'/'.$this->vMonth; ?>" target="_blank">IMPRIMIR</a>
											<!--<button class="btn btn-sm btn-danger me-2" id="submitConsolidateBalance" >CIERRE MENSUAL</button>-->
										</div>
										<div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 mb-md-10 mb-xl-10">
											<div class="card shadow-sm">
												<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
													<h3 class="card-title">Libros Mayores Registrados</h3>													
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                                        <input type="text" id="searchMainAccountingBooksTable2" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                                                    </div>
                                                    <!--end::Search-->													
												</div>
												<div class="collapse show">												
													<div class="card-body">
                                                        <table class="table table-row-bordered gy-5" id="datatable_mainaccountingbooks2">
                                                            <thead>
                                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                                    <th>Num</th>
                                                                    <th>Fecha</th>
																	<th>Num Comprobante</th>
																	<th>Cuenta Contable</th>
                                                                    <th>DEBE</th>
																	<th>HABER</th>
																	<th>SALDO</th>
                                                                    <th>Glosa</th>
																	<th>Estado</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-gray-600 fw-semibold">
                                                            <?Php
                                                                if(isset($this->vDataMainAccountingBook) && count($this->vDataMainAccountingBook)):
                                                                    $vCount = $vCountAnterior = 1;
                                                                    $vTotalDebe = $vTotalHaber = $vTotalSaldo = $vMontoFinal = 0;

                                                                    for($i=0;$i<count($this->vDataMainAccountingBook);$i++):
                                                                        echo '<tr code="'.$this->vDataMainAccountingBook[$i]['n_codvoucher'].'">';
																			echo '<td>'.$vCount.'</td>';
																			echo '<td>'.$this->spanishLiteralDate($this->vDataMainAccountingBook[$i]['d_voucherdate']).'</td>';
																			echo '<td><a href="'.BASE_VIEW_URL.'finances/accountSeat/'.$this->vDataMainAccountingBook[$i]['n_codaccountingseat'].'" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Ver Asiento Contable"><i class="la la-list"></i></a></td>';
																			//echo '<td>'.date('Y',strtotime($this->vDataMainAccountingBook[$i]['d_accountingseatdate'])).date('m',strtotime($this->vDataMainAccountingBook[$i]['d_accountingseatdate'])).$vType.'</th>';
																			echo '<td>'.$this->vDataMainAccountingBook[$i]['n_chartofaccountname'].'<br>'.$this->vDataMainAccountingBook[$i]['c_chartofaccountname'].'</td>';

																			if($this->vDataMainAccountingBook[$i]['n_chartofaccountname'] == '1116011*'){
																				$vMontoEnDolares = $this->vDataMainAccountingBook[$i]['n_voucheramount'];
																				$vMontoFinal = ($vMontoEnDolares * 6.96);
																			} else {
																				$vMontoFinal = $this->vDataMainAccountingBook[$i]['n_voucheramount'];
																			}																			

																			if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
																				/* DEBE */
																				echo '<td>'.number_format($vMontoFinal, 2,',','.').'</td>';
																				echo '<td>0</td>';
																				$vTotalDebe = $vTotalDebe + $vMontoFinal;
																			} else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
																				/* HABER */
																				echo '<td>0</td>';
																				echo '<td>'.number_format($vMontoFinal, 2,',','.').'</td>';
																				$vTotalHaber = $vTotalHaber + $vMontoFinal;
																			}

																			/* SALDO */
																			if($vCount == 1){
																				if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
																					$vTotalSaldo = $vTotalHaber + $vTotalDebe;
																					echo '<td>'.number_format($vTotalSaldo, 2,',','.').'</td>';
																				} else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
																					$vTotalSaldo = $vTotalHaber + $vTotalDebe;
																					echo '<td>'.number_format($vTotalSaldo, 2,',','.').'</td>';																					
																				}
																			} else{
																				if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
																					$vTotalSaldo = $vTotalDebe - $vTotalHaber;
																					echo '<td>'.number_format($vTotalSaldo, 2,',','.').'</td>';
																				} else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
																					$vTotalSaldo = $vTotalDebe - $vTotalHaber;
																					echo '<td>'.number_format($vTotalSaldo, 2,',','.').'</td>';																					
																				}
																			}                                
																			echo '<td>'.$this->vDataMainAccountingBook[$i]['c_voucherdesc'].'</td>';
																			echo '<td>'.$this->vDataMainAccountingBook[$i]['n_status'].'</td>';
																			echo '<td></td>';
                                                                        echo '</tr>';
                                                                        ++$vCount;                                            
                                                                    endfor;
                                                                endif;
                                                            ?>                                                                    																
                                                            </tbody>
															<tfoot>
																<tr class="fw-bold fs-6">
																	<th colspan="4" class="text-nowrap align-end">Total:</th>
																	<th colspan="1" class="text-danger fs-3"><?Php echo number_format($vTotalDebe,2,',','.'); ?></th>
																	<th colspan="1" class="text-danger fs-3"><?Php echo number_format($vTotalHaber,2,',','.'); ?></th>
																	<th colspan="1" class="text-danger fs-3"><?Php echo number_format($vTotalSaldo,2,',','.'); ?></th>
																	<th colspan="2" class="text-nowrap align-end"></th>
																</tr>
															</tfoot>															
                                                        </table>
													</div>
													<div class="card-footer">
													<input type="hidden" id="vTotalSaldo" value="<?Php echo $vTotalSaldo; ?>" readonly>
													<input type="hidden" id="vCodChartOfAccount" value="<?Php echo $this->vCodChartOfAccount; ?>" readonly>
													<input type="hidden" id="vMonth" value="<?Php echo $this->vMonth; ?>" readonly>
													</div>
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