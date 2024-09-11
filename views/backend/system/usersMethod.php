					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">Plataforma</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Módulos</a>
											</li>
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Métodos</a>
											</li>
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Asignación</a>
											</li>                                            
										</ul>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container-fluid">
							<?Php
								if(isset($this->vDataUser) && count($this->vDataUser)):
									for($i=0;$i<count($this->vDataUser);$i++):
										$vCodeUser = $this->vDataUser[$i]['n_coduser'];
										$vNames = ucwords($this->vDataUser[$i]['c_name']);
										$vLastNames = ucwords($this->vDataUser[$i]['c_lastname']);
									endfor;
								endif;

								if(isset($this->vDataItemMenu) && count($this->vDataItemMenu)):
									for($j=0;$j<count($this->vDataItemMenu);$j++):
										$vCodMenu = $this->vDataItemMenu[$j]['n_codmenu'];
										$vTitleMenu = $this->vDataItemMenu[$j]['c_title'];
										$vDescMenu = $this->vDataItemMenu[$j]['c_descmenu'];
									endfor;
								endif;								
							?>								
								<!--begin::Row-->
								<div class="row">
									<div class="col-lg-12">
										<div class="alert alert-custom alert-success" role="alert">
											<div class="alert-icon">
												<span class="svg-icon svg-icon-white svg-icon-xl">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
															<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
												</span>
											</div>
											<div class="alert-text"><strong>¡Atención!</strong> Estas asignando permisos al usuario <strong><?Php echo $vNames.' '.$vLastNames?></strong></div>
										</div>
									</div>
								</div>
								<div class="row">									
									<div class="col-lg-12">										
										<!--begin::Advance Table Widget 4-->
										<div class="card card-custom card-stretch gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 py-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Listado dentro de Menú <?Php echo $vTitleMenu; ?></span>
													<span class="text-muted mt-3 font-weight-bold font-size-sm">Los items listados pueden contener otros sub menús</span>
												</h3>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-0 pb-3">

                                                    <?Php
                                                    if(isset($this->vMenuLevelData) && count($this->vMenuLevelData)):
														echo '
														<table class="table table-bordered table-hover table-checkable" id="datatable_method_modules" style="margin-top: 13px !important">
															<thead>
																<tr>
																	<th>Nº</th>
																	<th>Nombre</th>
																	<th>Descripción</th>
																	<th>Estado</th>
																	<th>Acciones</th>
																</tr>
															</thead>
															<tbody>';														
                                                            $vCount = 1;
                                                            for($i=0;$i<count($this->vMenuLevelData);$i++):
                                                                echo '<tr code="'.$this->vMenuLevelData[$i]['n_codmenu'].'" usercode="'.$vCodeUser.'" prevmenu="'.$this->vPrevCodMenu.'">';
                                                                    echo '<td>'.$vCount.'</td>';
                                                                    echo '<td>'.$this->vMenuLevelData[$i]['c_title'].'</td>';
                                                                    echo '<td>'.$this->vMenuLevelData[$i]['c_descmenu'].'</td>';
																	echo '<td>'.$this->vMenuLevelData[$i]['n_assigned'].'</td>';
                                                                    echo '<td></td>';
                                                                echo '</tr>';
                                                                ++$vCount;
                                                            endfor;
															echo '
															</tbody>
														</table>';
														else:
															echo '<div class="alert alert-custom alert-danger" role="alert">
																	<div class="alert-icon">
																		<span class="svg-icon svg-icon-white svg-icon-xl">
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
																					<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
																				</g>
																			</svg>
																		</span>
																	</div>
																	<div class="alert-text"><strong>¡Atención!</strong> Este menú ya no tiene más items</div>
																</div>';
                                                        endif;														
                                                    ?>
											</div>
											<!--end::Body-->
										</div>
										<!--end::Advance Table Widget 4-->
									</div>
								</div>
								<!--end::Row-->
								<!--end::Dashboard-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->