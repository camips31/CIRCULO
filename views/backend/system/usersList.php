					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<div class="d-flex align-items-center flex-wrap mr-1">
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<h5 class="text-dark font-weight-bold my-1 mr-5">Sistema</h5>
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Gestión de Usuarios</a>
											</li>
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Listado</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-column-fluid">
							<div class="container-fluid">
								<div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
									<div class="alert-icon">
										<span class="svg-icon svg-icon-primary svg-icon-xl">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
													<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
										</span>
									</div>
									<div class="alert-text">The default page control presented by DataTables (forward and backward buttons with up to 7 page numbers in-between) is fine for most situations.
									<br />For more info see
									<a class="font-weight-bold" href="https://datatables.net/" target="_blank">the official home</a>of the plugin.</div>
								</div>
								<div class="card card-custom">
									<div class="card-header flex-wrap py-5">
										<div class="card-title">
											<h3 class="card-label">Listado de Menús
											<span class="d-block text-muted pt-2 font-size-sm">Todos los Items Registrados activos y no activos</span></h3>
										</div>
									</div>
									<div class="card-body">
                                        <table class="table table-bordered table-hover table-checkable" id="datatable_users" style="margin-top: 13px !important">
                                            <thead>
												<tr>
													<th>Nº</th>
													<th>ID RRSS</th>
													<th>Imagen</th>
													<th>E-Mail</th>
                                                    <th>Privilegio</th>
													<th>Código de Activación</th>
                                                    <th>Estado</th>
													<th>Acciones</th>
												</tr>
                                            </thead>
											<tbody class="fw-semibold text-gray-600">
											</tbody>
                                        </table>
									</div>
								</div>
							</div>
						</div>
					</div>