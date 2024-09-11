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
										<h5 class="text-dark font-weight-bold my-1 mr-5">Sistema</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Menú Plataforma</a>
											</li>
											<li class="breadcrumb-item">
												<a href="" class="text-muted">Edición</a>
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
                                <div class="row">
                                    <div class="col-md-8">

										<!--begin::Card-->
										<div class="card card-custom">
											<div class="card-header">
												<h3 class="card-title">Edición de Menú</h3>
											</div>
                                            <?Php
                                                echo $this->vMenuPancho;
                                                /*if(IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE)){
                                                    if(isset($this->vMenuPancho) && count($this->vMenuPancho)){
                                                        for($i=0;$i<count($this->vMenuPancho);$i++){
                                                            echo $this->vMenuPancho[$i]['c_title'].'<br>';
                                                        }
                                                    }
                                                }*/
                                            ?>
										</div>
										<!--end::Card-->                                        
                                    </div>                                
                                </div>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->