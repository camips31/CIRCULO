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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Módulo de Plataforma</h1>
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
                        <a href="#" class="text-muted text-hover-primary">Sistema</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Menú Principal</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Registro</li>
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
                <!--begin::Col-->
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-8 mb-xl-8">
                    <div class="card shadow-sm">
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title">Registro Menú Principal</h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form id="system-form-menu-edit" class="form" action="#" autocomplete="off">
                                <?Php                                               
                                    if(isset($this->vDataItemMenu) && count($this->vDataItemMenu)):
                                        for($i=0;$i<count($this->vDataItemMenu);$i++):                                       
                                            $vCodMenu = $this->vDataItemMenu[$i]['n_codmenu'];
                                            $vLevel1 = $this->vDataItemMenu[$i]['n_level1'];
                                            $vLevel2 = $this->vDataItemMenu[$i]['n_level2'];
                                            $vLevel3 = $this->vDataItemMenu[$i]['n_level3'];
                                            $vLevel4 = $this->vDataItemMenu[$i]['n_level4'];
                                            $vParent = $this->vDataItemMenu[$i]['n_parent'];
                                            $vRole = $this->vDataItemMenu[$i]['c_menutype'];
                                            $vModuleRole = $this->vDataItemMenu[$i]['c_role_module'];
                                            $vNameRole = $this->vDataItemMenu[$i]['c_name_module'];
                                            $vPosition = $this->vDataItemMenu[$i]['n_positionmenu'];
                                            $vIconMenu = $this->vDataItemMenu[$i]['c_iconmenu'];
                                            $vTitle = $this->vDataItemMenu[$i]['c_title'];
                                            $vControllerActive = $this->vDataItemMenu[$i]['c_controlleractive'];
                                            $vMethodActive = $this->vDataItemMenu[$i]['c_methodactive'];
                                            $vDesc = $this->vDataItemMenu[$i]['c_descmenu'];
                                            $vUrl = $this->vDataItemMenu[$i]['c_url'];
                                            $vCodProfileType = $this->vDataItemMenu[$i]['n_codprofiletype'];
                                            $vSession = $this->vDataItemMenu[$i]['n_session'];
                                            $vActive = $this->vDataItemMenu[$i]['n_active'];                                        
                                        endfor;
                                    endif;
                                ?>                                
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label">1º Nivel
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vLevel1" name="vLevel1">
                                                <option value="<?Php echo $vLevel1; ?>"><?Php echo $vLevel1; ?></option>
                                                <option value="">Seleccionar Nivel #1</option>
                                                <option value="0">No</option>
                                                <option value="1">Nivel 1</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">2º Nivel
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vLevel2" name="vLevel2">
                                                <option value="<?Php echo $vLevel2; ?>"><?Php echo $vLevel2; ?></option>
                                                <option value="">Seleccionar Nivel #2</option>
                                                <option value="0">No</option>
                                                <option value="1">Nivel 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">3º Nivel
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vLevel3" name="vLevel3">
                                                <option value="<?Php echo $vLevel3; ?>"><?Php echo $vLevel3; ?></option>
                                                <option value="">Seleccionar Nivel #3</option>
                                                <option value="0">No</option>
                                                <option value="1">Nivel 3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">4º Nivel
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control mb-2 mb-md-0" id="vLevel4" name="vLevel4">
                                                <option value="<?Php echo $vLevel4; ?>"><?Php echo $vLevel4; ?></option>
                                                <option value="">Seleccionar Nivel #4</option>
                                                <option value="0">No</option>
                                                <option value="1">Nivel 4</option>
                                            </select>
                                            </div>
                                            </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-2">
                                                <label class="form-label">Ícono del Menú</label>
                                                <select class="form-control mb-2 mb-md-0" id="vIconMenu" name="vIconMenu">
                                                    <option value="-">Seleccionar ícono de menú</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Nivel Padre
                                                <span class="text-danger">*</span></label>
                                                <select class="form-control mb-2 mb-md-0" name="vParentMenu" id="vParentMenu" data-control="select2" placeholder="Seleccione el Menú Padre">
                                                <option value="<?Php echo $vParent; ?>"><?Php echo $vParent; ?></option>
                                                <option value="">Seleccionar Padre del menú</option>
                                                <option value="0">Ninguno</option>
                                                <?Php
                                                if (isset($this->vMenuLevelAndParent) && count($this->vMenuLevelAndParent)):
                                                    $vCount = 1;
                                                    for ($i = 0; $i < count($this->vMenuLevelAndParent); $i++):

                                                        echo '<option value="' . $this->vMenuLevelAndParent[$i]['n_codmenu'] . '">' . $this->vMenuLevelAndParent[$i]['c_menulevelandparent'] . '</option>';
                                                    endfor;
                                                endif;
                                                ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Posición
                                                <span class="text-danger">*</span></label>
                                                <select class="form-control mb-2 mb-md-0" name="vPositionMenu" id="vPositionMenu">
                                                    <option value="<?Php echo $vPosition; ?>"><?Php echo $vPosition; ?></option>
                                                    <option value="">Seleccionar la posición del menú</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Privilegio
                                                <span class="text-danger">*</span></label>
                                                <select class="form-control mb-2 mb-md-0" id="vRoleMenu" name="vRoleMenu">
                                                    <option value="<?Php echo $vModuleRole; ?>"><?Php echo $vNameRole; ?></option>
                                                    <option value="0">Sin Privilegio</option>
                                                    <?Php
                                                        if (isset($this->vModuleData) && count($this->vModuleData)):
                                                            for ($i = 0; $i < count($this->vModuleData); $i++):

                                                                echo '<option value="' . $this->vModuleData[$i]['c_role_module'] . '">' . $this->vModuleData[$i]['c_name_module'] . '</option>';
                                                            endfor;
                                                        endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-3">
                                                <label class="form-label">Nombre Menú
                                                <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vNameMenu" id="vNameMenu" value="<?Php echo $vTitle; ?>" placeholder="Registrar el Nombre del Menú">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">URL Menú
                                                <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vURLMenu" id="vURLMenu" value="<?Php echo $vUrl; ?>" placeholder="Registrar la URL del Menú">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Controlador
                                                <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vControllerActive" id="vControllerActive" value="<?Php echo $vControllerActive; ?>" placeholder="Registrar el Controlador del Menú">
                                            </div> 
                                            <div class="col-md-3">
                                                <label class="form-label">Método
                                                <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-2 mb-md-0" name="vMethodActive" id="vMethodActive" value="<?Php echo $vMethodActive; ?>" placeholder="Registrar el Método del Menú">
                                            </div>                                            
                                        </div>
                                        <div class="fv-row form-group row mb-5">
                                            <div class="col-md-3">
                                                <label class="form-label">Sesión<span class="text-danger">*</span></label>
                                                <select class="form-control mb-2 mb-md-0" name="vSessionMenu" id="vSessionMenu">
                                                <option value="<?Php echo $vSession; ?>"><?Php echo $vSession; ?></option>
                                                    <option value="">Seleccionar en que sesión esta el menú</option>
                                                    <option value="0">Sessión Cerrada</option>
                                                    <option value="1">Sessión Registrada</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Estado<span class="text-danger">*</span></label>
                                                <select class="form-control mb-2 mb-md-0" id="vActiveMenu" name="vActiveMenu">
                                                <option value="<?Php echo $vActive; ?>"><?Php echo $vActive; ?></option>
                                                    <option value="">Seleccionar el estado del Menú</option>
                                                    <option value="0">Desactivado</option>
                                                    <option value="1">Activado</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Descripción<span class="text-danger">*</span></label>
                                                <textarea class="form-control mb-2 mb-md-0" id="vDescMenu" name="vDescMenu" rows="3" placeholder="Registre detalladamente la función del menú"><?Php echo $vDesc; ?></textarea>                                                
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <input type="hidden" name="vCodMenu" id="vCodMenu" value="<?Php echo $vCodMenu; ?>">
                                    <button id="system-form-menu-edit-submit" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Modificar
                                        </span>
                                        <span class="indicator-progress">
                                            Por favor espere... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Actions-->
                                </div>
                            </form>
                                <!--end::Form-->
                        </div>
                    </div>
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