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
												<a href="" class="text-muted">Registro</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex flex-column-fluid">
							<div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
										<div class="card card-custom">
											<div class="card-header">
												<h3 class="card-title">Registro de Usuarios</h3>
											</div>
											<form id="system-form-user">
												<div class="card-body">
													<div class="form-group mb-8">
														<div class="alert alert-custom alert-default" role="alert">
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
															<div class="alert-text">Registro de items para el menú de toda la plataforma, asignar los privilegios a cada item es importante para controlar el acceso a la información y a los módulos.</div>
														</div>
													</div>
													<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Nombres del Usuario
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="vNames" id="vNames">
                                                                <span class="form-text text-muted">Registre los nombres del usuario.</span>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Apellidos del Usuario
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="vLastNames" id="vLastNames">
                                                                <span class="form-text text-muted">Registre los apellidos del usuario.</span>
                                                            </div>                                                            
                                                        </div>
													</div>
													<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Correo Electrónico
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="vEmail" id="vEmail">
                                                                <span class="form-text text-muted">Registre los nombres del usuario.</span>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Módulos
                                                                <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="vRoleMenu" name="vRoleMenu">
                                                                    <option value="">Seleccionar</option>
                                                                    <?Php
                                                                    if(isset($this->vModuleData) && count($this->vModuleData)):
                                                                        for($i=0;$i<count($this->vModuleData);$i++):

                                                                            echo '<option value="'.$this->vModuleData[$i]['c_role_module'].'">'.$this->vModuleData[$i]['c_name_module'].'</option>';
                                                                        endfor;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                                <span class="form-text text-muted">Asignar privilegio de visualización.</span>
                                                            </div>                                                             
                                                        </div>
													</div>
													<div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Estado
                                                                <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="vStatus" id="vStatus">
                                                                    <option value="">Seleccionar</option>
                                                                    <option value="0">Inactivo</option>
                                                                    <option value="1">Activo</option>
                                                                </select>
                                                                <span class="form-text text-muted">Estado del registro.</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Activo
                                                                <span class="text-danger">*</span></label>
                                                                <select class="form-control margin-top-10" id="vActive" name="vActive">
                                                                    <option value="">Seleccionar</option>
                                                                    <option value="0">Desactivado</option>
                                                                    <option value="1">Activado</option>
                                                                </select>
                                                                <span class="form-text text-muted">Estado del Usuario.</span>
                                                            </div>
                                                            <div class="col-md-8"></div>                                                            
                                                        </div>
													</div>
												</div>
												<div class="card-footer">
													<button type="submit" class="btn btn-primary mr-2" id="system-form-reg-user-submit">Registrar</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</form>
										</div>
                                    </div>                                
                                </div>
							</div>
						</div>
					</div>