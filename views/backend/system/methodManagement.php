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
												<a href="" class="text-muted">Registro</a>
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
								<!--begin::Row-->
								<div class="row">
									<div class="col-lg-6">
										<div class="card card-custom card-stretch gutter-b">
											<div class="card-header border-0 py-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Listado de Sub Menús</span>
													<span class="text-muted mt-3 font-weight-bold font-size-sm">Los Sub Menús tienen relación con los métodos dentro del sistema</span>
												</h3>
											</div>
											<div class="card-body pt-0 pb-3">
                                                <table class="table table-bordered table-hover table-checkable" id="datatable_menulist" style="margin-top: 13px !important">
                                                    <thead>
                                                        <tr>
                                                            <th>Nº</th>
                                                            <th>Nombre</th>
                                                            <th>Rol</th>
                                                            <th>Estado</th>
															<th>Fecha</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?Php
                                                    if(isset($this->vMethodsFromCodModuleData) && count($this->vMethodsFromCodModuleData)):
                                                        $vCount = 1;
                                                        for($i=0;$i<count($this->vMethodsFromCodModuleData);$i++):
                                                            echo '<tr code="'.$this->vMethodsFromCodModuleData[$i]['n_codmenu'].'">';
                                                                echo '<td>'.$vCount.'</td>';
                                                                echo '<td>'.ucfirst($this->vMethodsFromCodModuleData[$i]['c_title']).'</td>';
                                                                echo '<td>'.$this->vMethodsFromCodModuleData[$i]['c_menutype'].'</td>';
                                                                echo '<td>'.$this->vMethodsFromCodModuleData[$i]['n_active'].'</td>';
                                                                echo '<td>'.date_format(date_create($this->vMethodsFromCodModuleData[$i]['	d_datecreate']), 'd/m/Y').'</td>';
                                                                echo '<td></td>';
                                                            echo '</tr>';
                                                            ++$vCount;
                                                        endfor;
                                                    endif;
                                                    ?>
                                                    </tbody>
                                                </table>
											</div>
										</div>
									</div>									
									<div class="col-lg-6">
										<!--begin::Advance Table Widget 4-->
										<div class="card card-custom card-stretch gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 py-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Sub Menús Asignados</span>
													<span class="text-muted mt-3 font-weight-bold font-size-sm">Los Sub Menús tienen relación con los métodos dentro del sistema</span>
												</h3>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-0 pb-3">
                                                <table class="table table-bordered table-hover table-checkable" id="datatable_modules" style="margin-top: 13px !important">
                                                    <thead>
                                                        <tr>
                                                            <th>Nº</th>
                                                            <th>Nombre</th>
                                                            <th>Rol</th>
                                                            <th>Estado</th>
															<th>Fecha</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?Php
                                                    /*if(isset($this->vModuleData) && count($this->vModuleData)):
                                                            $vCount = 1;
                                                            for($i=0;$i<count($this->vModuleData);$i++):
                                                                echo '<tr code="'.$this->vModuleData[$i]['n_codmodule'].'">';
                                                                    echo '<td>'.$vCount.'</td>';
                                                                    echo '<td>'.$this->vModuleData[$i]['c_name_module'].'</td>';
                                                                    echo '<td>'.$this->vModuleData[$i]['c_role_module'].'</td>';
																	echo '<td>'.$this->vModuleData[$i]['n_status'].'</td>';
                                                                    echo '<td>'.date_format(date_create($this->vModuleData[$i]['	d_datecreate']), 'd/m/Y').'</td>';
                                                                    echo '<td></td>';
                                                                echo '</tr>';
                                                                ++$vCount;
                                                            endfor;
                                                        endif;*/
                                                    ?>
                                                    </tbody>
                                                </table>
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