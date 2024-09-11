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
											<li class="breadcrumb-item text-muted">Deudas</li>
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
										<div class="col-md-10 col-lg-10 col-xl-10 col-xxl-10 mb-md-10 mb-xl-10">
											<div class="card shadow-sm">
												<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
													<h3 class="card-title">Deudas</h3>													
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                                        <input type="text" id="searchAccountingEntries" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                                                    </div>
                                                    <!--end::Search-->                                                    
												</div>
												<div class="collapse show">												
													<div class="card-body">
														<table class="table table-row-bordered gy-5" id="datatable_accountingentries">
															<thead>
																<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																	<th>Num Registro</th>
																	<th>Num Asiento</th>
																	<th>Fecha</th>
																	<th>Glosa</th>
																	<th>Tipo</th>
																	<th>Estado</th>
																	<th>Acciones</th>
																</tr>
															</thead>
															<tbody class="text-gray-600 fw-semibold">
                                                            <?Php
                                                                if(isset($this->vDataAccountEntriesList) && count($this->vDataAccountEntriesList)):
                                                                    $vNumAccountinEntrie = $vCount = $vIngreso = $vEgreso = $vTraspaso = $vOtro = 1;
                                                                    for($i=0;$i<count($this->vDataAccountEntriesList);$i++):
																		
																		/*$date = new DateTimeImmutable($this->vDataAccountEntriesList[$i]['d_accountingseatdate']);
                                                                        $date->format('l jS \of F Y h:i:s A');*/

																		if($this->vDataAccountEntriesList[$i]['n_accoutingseattype'] == 1){
																			$vNumAccountinEntrie = $vIngreso;
																			$vIngreso++;
																		} else if($this->vDataAccountEntriesList[$i]['n_accoutingseattype'] == 2){
																			$vNumAccountinEntrie = $vEgreso;
																			$vEgreso++;
																		} else if($this->vDataAccountEntriesList[$i]['n_accoutingseattype'] == 3){
																			$vNumAccountinEntrie = $vTraspaso;
																			$vTraspaso++;
																		} else {
																			$vNumAccountinEntrie = $vOtro;
																			$vOtro++;
																		}

																		echo '<tr code="'.$this->vDataAccountEntriesList[$i]['n_codaccountingseat'].'" num="'.$vNumAccountinEntrie.'" type="'.$this->vDataAccountEntriesList[$i]['n_accoutingseattype'].'">';

																			echo '<td>'.$vCount.'</td>';
																			echo '<td>'.$vNumAccountinEntrie.'</td>';                                                          
                                                                            echo '<td>'.$this->spanishLiteralDate($this->vDataAccountEntriesList[$i]['d_accountingseatdate']).'</td>';
                                                                            echo '<td>'.$this->vDataAccountEntriesList[$i]['c_accountingseatdesc'].'</td>';
                                                                            echo '<td>'.$this->vDataAccountEntriesList[$i]['n_accoutingseattype'].'</td>';
																			echo '<td>'.$this->vDataAccountEntriesList[$i]['n_status'].'</td>';
                                                                            echo '<td></td>';
                                                                        echo '</tr>';
                                                                        ++$vCount;                                            
                                                                    endfor;
                                                                endif;
                                                                ?>
                                                            </tbody>
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