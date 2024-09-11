<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<div class="d-flex align-items-center flex-wrap mr-1">
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<h5 class="text-dark font-weight-bold my-1 mr-5">Plataforma</h5>
					<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Módulos</a>
						</li>
						<li class="breadcrumb-item">
							<a href="" class="text-muted">Métodos</a>
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
				<?Php
				if(isset($this->vModuleData) && count($this->vModuleData)):
						$vCount = 1;
						for($i=0;$i<count($this->vModuleData);$i++):
							echo '<div class="col-lg-2">
									<div class="card card-custom bgi-no-repeat gutter-b" style="height: 225px; background-color: #663259; background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto; background-image: url('.$vParamsViewBackEndLayout['root_backend_media'].'svg/patterns/taieri.svg)">
										<div class="card-body d-flex flex-column">
											<a href="'.BASE_VIEW_URL.'system/methodManagement/'.$this->vModuleData[$i]['n_codmenu'].'" class="text-white text-hover-primary font-weight-bolder font-size-h3">'.ucfirst($this->vModuleData[$i]['c_name_module']).'</a>
											<div class="text-muted font-weight-bold">'.$this->vModuleData[$i]['c_desc_module'].'</div><hr/>
											<a href="'.BASE_VIEW_URL.'system/methodManagement/'.$this->vModuleData[$i]['n_codmenu'].'" class="btn btn-icon btn-success"><i class="flaticon2-pen"></i></a>
										</div>
									</div>
								</div>';
						endfor;
					endif;
				?>				
			</div>
		</div>
	</div>
</div>