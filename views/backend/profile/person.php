				<!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<div class="d-flex flex-column flex-column-fluid">
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
									<!--begin::Page title-->
									<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
										<!--begin::Title-->
										<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Información del Negocio</h1>
										<!--end::Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">
												<a href="" class="text-muted text-hover-primary">Plataforma Empresarial</a>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">Perfil</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">Información</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">Datos de Usuario</li>
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
								<div id="kt_app_content_container" class="app-container container-xxl">
									<!--begin::Navbar-->
									<?Php
										if(isset($this->vDataBusiness) && count($this->vDataBusiness)):												
											for($i=0;$i<count($this->vDataBusiness);$i++):
												$vCodBusiness = $this->vDataBusiness[$i]['n_codbusiness'];
												$vBusinessName1 = $this->vDataBusiness[$i]['c_name1'];
												$vBusinessName2 = $this->vDataBusiness[$i]['c_name2'];
												$vBusinessAddress = $this->vDataBusiness[$i]['c_address'];
												$vBusinessPhone = $this->vDataBusiness[$i]['c_phone'];
												$vBusinessWhatsApp = $this->vDataBusiness[$i]['c_whatsapp'];
												$vBusinessWeb = $this->vDataBusiness[$i]['c_web'];
												$vBusinessCountry = $this->vDataBusiness[$i]['c_country'];
												$vBusinessLanguage = $this->vDataBusiness[$i]['c_language'];
												$vBusinessTimezone = $this->vDataBusiness[$i]['c_timezone'];
												$vBusinessCurrency = $this->vDataBusiness[$i]['c_currency'];
												$vBusinessImageName = $this->vDataBusiness[$i]['c_image_name'];
												$vBusinessImageContent = $this->vDataBusiness[$i]['c_image_content'];
												$vStatus = $this->vDataBusiness[$i]['n_status'];
												$vActive = $this->vDataBusiness[$i]['n_active'];
											endfor;
										endif;
									?>									
									<div class="card mb-5 mb-xl-10">
										<div class="card-body pt-9 pb-0">
											<!--begin::Details-->
											<div class="d-flex flex-wrap flex-sm-nowrap">
												<!--begin: Pic-->
												<div class="me-7 mb-4">
													<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
														<?Php echo '<img src="data:image/jpeg;base64,'.base64_encode(stripslashes($vBusinessImageContent)) .' "/>'; ?>
														<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
													</div>
												</div>
												<!--end::Pic-->
												<!--begin::Info-->
												<div class="flex-grow-1">
													<!--begin::Title-->
													<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
														<!--begin::User-->
														<div class="d-flex flex-column">
															<!--begin::Name-->
															<div class="d-flex align-items-center mb-2">
																<a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?Php echo $this->vProfileCompleteName; ?></a>
																<a href="#">
																	<i class="ki-duotone ki-verify fs-1 text-primary">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</a>
															</div>
															<!--end::Name-->
															<!--begin::Info-->
															<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
																<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
																<i class="ki-duotone ki-profile-circle fs-4 me-1">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i><?Php echo $vBusinessAddress; ?></a>
																<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
																<i class="ki-duotone ki-geolocation fs-4 me-1">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i><?Php echo $vBusinessPhone; ?></a>
																<a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
																<i class="ki-duotone ki-sms fs-4">
																	<span class="path1"></span>
																	<span class="path2"></span>
																</i><?Php echo $vBusinessWhatsApp; ?></a>
															</div>
															<!--end::Info-->
														</div>
														<!--end::User-->
													</div>
													<!--end::Title-->
													<!--begin::Stats-->
													<div class="d-flex flex-wrap flex-stack">
														<!--begin::Wrapper-->
														<div class="d-flex flex-column flex-grow-1 pe-8">
															<!--begin::Stats-->
															<div class="d-flex flex-wrap">
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Earnings</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<i class="ki-duotone ki-arrow-down fs-3 text-danger me-2">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="80">0</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Projects</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
																<!--begin::Stat-->
																<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
																	<!--begin::Number-->
																	<div class="d-flex align-items-center">
																		<i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>
																		<div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
																	</div>
																	<!--end::Number-->
																	<!--begin::Label-->
																	<div class="fw-semibold fs-6 text-gray-400">Success Rate</div>
																	<!--end::Label-->
																</div>
																<!--end::Stat-->
															</div>
															<!--end::Stats-->
														</div>
														<!--end::Wrapper-->
														<!--begin::Progress-->
														<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
															<div class="d-flex justify-content-between w-100 mt-auto mb-2">
																<span class="fw-semibold fs-6 text-gray-400">Profile Compleation</span>
																<span class="fw-bold fs-6">50%</span>
															</div>
															<div class="h-5px mx-3 w-100 bg-light mb-3">
																<div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<!--end::Progress-->
													</div>
													<!--end::Stats-->
												</div>
												<!--end::Info-->
											</div>
											<!--end::Details-->
											<!--begin::Navs-->
											<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="<?Php echo BASE_VIEW_URL; ?>profile/person/<?Php echo $this->vProfileName; ?>">Información Esencial</a>
												</li>
												<!--end::Nav item-->
												<!--begin::Nav item-->
												<li class="nav-item mt-2">
													<a class="nav-link text-active-primary ms-0 me-10 py-5" href="<?Php echo BASE_VIEW_URL; ?>profile/personEdit/<?Php echo $this->vProfileName; ?>">Datos Personales</a>
												</li>
												<!--end::Nav item-->												
											</ul>
											<!--begin::Navs-->
										</div>
									</div>
									<!--end::Navbar-->
									<!--begin::details View-->
									<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
										<!--begin::Card header-->
										<div class="card-header cursor-pointer">
											<!--begin::Card title-->
											<div class="card-title m-0">
												<h3 class="fw-bold m-0">Datos Personales</h3>
											</div>
											<!--end::Card title-->
											<!--begin::Action-->
											<a href="<?Php echo BASE_VIEW_URL; ?>profile/personEdit/<?Php echo $this->vProfileName; ?>" class="btn btn-sm btn-primary align-self-center">Editar</a>
											<!--end::Action-->
										</div>
										<!--begin::Card header-->										
										<!--begin::Card body-->
										<div class="card-body p-9">
											<!--begin::Row-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Nombre Comercial</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4">
													<span class="fw-bold fs-6 text-gray-800"><?Php echo $vBusinessName1; ?></span>
												</div>
												<!--end::Col-->
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Razón Social</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4 fv-row">
													<span class="fw-semibold text-gray-800 fs-6"><?Php echo $vBusinessName2; ?></span>
												</div>
												<!--end::Col-->																							
											</div>
											<!--end::Row-->
											<!--begin::Input group-->
											<div class="row mb-7">

											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Dirección
												<span class="ms-1" data-bs-toggle="tooltip" title="Dirección principal">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-10 d-flex align-items-center">
													<span class="fw-bold fs-6 text-gray-800 me-2"><?Php echo $vBusinessAddress; ?></span>
													<span class="badge badge-success">mapa</span>
												</div>
												<!--end::Col-->
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Teléfono Fijo</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4">
													<a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?Php echo $vBusinessPhone; ?></a>
												</div>
												<!--end::Col-->
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">WhatsApp</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4">
													<a href="#" class="fw-semibold fs-6 text-gray-800 text-hover-primary"><?Php echo $vBusinessWhatsApp; ?></a>
												</div>
												<!--end::Col-->												
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-7">
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Sitio Web
												<span class="ms-1" data-bs-toggle="tooltip" title="País de Funcionamiento">
													<i class="ki-duotone ki-information fs-7">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
													</i>
												</span></label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4">
													<span class="fw-bold fs-6 text-gray-800"><?Php echo $vBusinessWeb; ?></span>
												</div>
												<!--end::Col-->
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">País</label>
												<!--end::Label-->
												<!--begin::Col-->
												<div class="col-lg-4">
													<span class="fw-bold fs-6 text-gray-800"><?Php echo $vBusinessCountry; ?></span>
												</div>
												<!--end::Col-->												
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-10">
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Lenguaje</label>
												<!--begin::Label-->
												<!--begin::Label-->
												<div class="col-lg-4">
													<span class="fw-semibold fs-6 text-gray-800"><?Php echo $vBusinessLanguage; ?></span>
												</div>
												<!--begin::Label-->
												<!--begin::Label-->
												<label class="col-lg-2 fw-semibold text-muted">Zona Horaria</label>
												<!--begin::Label-->
												<!--begin::Label-->
												<div class="col-lg-4">
													<span class="fw-semibold fs-6 text-gray-800"><?Php echo $vBusinessTimezone; ?></span>
												</div>
												<!--begin::Label-->												
											</div>
											<!--end::Input group-->
											<!--begin::Input group-->
											<div class="row mb-10">
												<!--begin::Label-->
												<label class="col-lg-4 fw-semibold text-muted">Moneda en Curso</label>
												<!--begin::Label-->
												<!--begin::Label-->
												<div class="col-lg-8">
													<span class="fw-semibold fs-6 text-gray-800"><?Php echo $vBusinessCurrency; ?></span>
												</div>
												<!--begin::Label-->
											</div>
											<!--end::Input group-->
											<!--begin::Notice-->
											<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
												<!--begin::Icon-->
												<i class="ki-duotone ki-information fs-2tx text-warning me-4">
													<span class="path1"></span>
													<span class="path2"></span>
													<span class="path3"></span>
												</i>
												<!--end::Icon-->
												<!--begin::Wrapper-->
												<div class="d-flex flex-stack flex-grow-1">
													<!--begin::Content-->
													<div class="fw-semibold">
														<h4 class="fw-bold text-warning">Completa la Información</h4>
														<div class="fs-6 text-warning">Puedes completar la información de tu empresa ingresando <a class="fw-bold" href="<?Php echo BASE_VIEW_URL; ?>business/businessEdit">aquí</a>.</div>
													</div>
													<!--end::Content-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Notice-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::details View-->
									<!--begin::Row-->
									<div class="row gy-5 g-xl-10">
										<!--begin::Col-->
										<div class="col-xl-8 mb-xl-10"></div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-xl-4 mb-xl-2"></div>
										<!--end::Col-->                                        
									</div>
									<!--end::Row-->
									<!--begin::Row-->
									<div class="row gy-5 g-xl-10">
										<!--begin::Col-->
										<div class="col-xl-4">
										</div>
										<!--end::Col-->
										<!--begin::Col-->
										<div class="col-xl-8">
										</div>
										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->