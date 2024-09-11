
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
<div class="d-flex flex-column flex-column-fluid">
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Gestión de Socios</h1>
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
					<li class="breadcrumb-item text-muted">
						<a href="#" class="text-muted text-hover-primary">Círculo de la Unión</a>
					</li>
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<li class="breadcrumb-item text-muted">Gestión de Socios</li>
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<li class="breadcrumb-item text-muted">Información General</li>
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<li class="breadcrumb-item text-muted">Registro</li>
				</ul>
			</div>
		</div>
	</div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-12 mb-xl-12">
                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-12 mb-xl-12">											
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Listado de Socios Registrados</h3>													
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon fs-1 position-absolute ms-4"></span>
                                <input type="text" id="searchPartners" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Búsqueda..." />
                            </div>
                            <!--end::Search-->  
                        </div>
                        <div class="collapse show">												
                            <div class="card-body">
                                <table class="table align-middle rounded table-row-dashed fs-6 g-5" id="datatable_partners">
                                    <thead>
                                        <!--begin::Table row-->
                                        <th>Num</th>
                                        <th>N° Acción</th>
                                        <th data-priority="3">Categoria</th>
                                        <th>Fecha Ingreso</th>
                                        <th data-priority="2">Nombre Completo</th>
                                        <th>Estado</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Carnet de Identidad</th>
                                        <th>Sexo</th>
                                        <th>Celular</th>
                                        <th>Correo Electrónico</th>
                                        <th>Ciudad</th>
                                        <th>Nombre</th>
                                        <th>NIT</th>
                                        <th data-priority="1">acciones</th>
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
    </div>
</div>