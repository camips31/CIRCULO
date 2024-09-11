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
										<div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">											
											<div class="card shadow-sm">
												<div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
													<h3 class="card-title">Listado de Menú</h3>													
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                                        <input type="text" id="searchMenu" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                                                    </div>
                                                    <!--end::Search-->  
												</div>
												<div class="collapse show">												
													<div class="card-body">
														<table class="table align-middle rounded table-row-dashed fs-6 g-5" id="datatable_menu">
															<thead>
																<!--begin::Table row-->
																<th>Num</th>
																<th>1º Nivel</th>
																<th>2º Nivel</th>
																<th>3º Nivel</th>
																<th>4º Nivel</th>
																<th>Controller Active</th>
																<th>Nombre Menú</th>
																<th>Nivel Padre</th>
																<th>Usuario</th>
																<th>Posición</th>
																<th>URL</th>
																<th>Sesión</th>
																<th>Estado</th>
																<th>acciones</th>
																<!--end::Table row-->
															</thead>
															<tbody class="fw-semibold text-gray-600">
															</tbody>
														</table>
													</div>
													<div class="card-footer">
														Footer
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