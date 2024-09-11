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
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-8 mb-xl-8">
                    <div class="card shadow-sm">
                        <?Php
                            if(isset($this->vDataUser) && count($this->vDataUser)):
                                for($i=0;$i<count($this->vDataUser);$i++):
                                    $vCodeUser = $this->vDataUser[$i]['n_coduser'];
                                    $vCodeRRSSId = $this->vDataUser[$i]['c_rrss_id'];
                                    $vNames = ucwords($this->vDataUser[$i]['c_name']);
                                    $vLastNames = ucwords($this->vDataUser[$i]['c_lastname']);
                                    $vUsername = $this->vDataUser[$i]['c_username'];
                                    $vEmail = $this->vDataUser[$i]['c_email'];
                                    $vUserRole = $this->vDataUser[$i]['c_userrole'];
                                    $vStatus = $this->vDataUser[$i]['n_status'];
                                    $vActive = $this->vDataUser[$i]['n_active'];
                                endfor;
                            endif;
                        ?>                        
                        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
                            <h3 class="card-title"><?Php echo $vNames.' '.$vLastNames?>&nbsp;<small>Usuario Registrado</small></h3>
                        </div>
                        <div class="collapse show">
                            <!--begin::Form-->
                            <form id="system-form-module-user-assign" class="form" action="#" autocomplete="off">                                
                                <div class="card-body">
                                    <div class="fv-row form-group row mb-5">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-12 col-form-label">Listado de Módulos</label>
                                                    <div class="col-6 col-form-label">
                                                        <div class="checkbox-inline">
                                                        <?Php
                                                            if(isset($this->vModuleData) && count($this->vModuleData)):
                                                                for($i=0;$i<count($this->vModuleData);$i++):
                                                                    $vChecked = '';
                                                                    if(strstr($vUserRole, $this->vModuleData[$i]['c_role_module']) !== false){
                                                                        $vChecked = 'checked';
                                                                    } else {
                                                                        $vChecked = '';
                                                                    }

                                                                    echo '<div class="form-check form-check-sm mt-5">
                                                                            <input class="form-check-input" type="checkbox" name="vModule" id="vModule'.$i.'" value="'.$this->vModuleData[$i]['c_role_module'].'" '.$vChecked.' />
                                                                            <label class="form-check-label" for="flexCheckChecked">'.ucwords($this->vModuleData[$i]['c_name_module']).'</label>
                                                                        </div>';                                                               
                                                                endfor;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="col-12 col-form-label">Módulos Asignados</label>
                                                    <input type="hidden" id="vUserName" value="<?Php echo $vNames.' '.$vLastNames; ?>" readonly>
                                                    <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="vUserRole" id="vUserRole" disabled><?Php echo $vUserRole; ?></textarea>
                                                </div>                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!--begin::Actions-->
                                    <input type="hidden" id="vCodUser" name="vCodUser" value="<?Php echo $vCodeUser; ?>" readonly>
                                    <button id="system-form-module-user-assign-submit" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Asignar
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
                <div class="col-md-6">
                    <div class="card card-custom">
                        <?Php
                            if(isset($this->vDataUser) && count($this->vDataUser)):
                                for($i=0;$i<count($this->vDataUser);$i++):
                                    $vCodeUser = $this->vDataUser[$i]['n_coduser'];
                                    $vCodeRRSSId = $this->vDataUser[$i]['c_rrss_id'];
                                    $vNames = ucwords($this->vDataUser[$i]['c_name']);
                                    $vLastNames = ucwords($this->vDataUser[$i]['c_lastname']);
                                    $vUsername = $this->vDataUser[$i]['c_username'];
                                    $vEmail = $this->vDataUser[$i]['c_email'];
                                    $vUserRole = $this->vDataUser[$i]['c_userrole'];
                                    $vStatus = $this->vDataUser[$i]['n_status'];
                                    $vActive = $this->vDataUser[$i]['n_active'];
                                endfor;
                            endif;
                        ?>                                            
                        <div class="card-header">
                            <h3 class="card-title">Privilegios Internos</h3>
                        </div>                                            
                        <form>
                            <div class="card-body">
                                <div class="form-group mb-8">
                                    <div class="alert alert-success d-flex align-items-center p-5">
                                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-success">Privilegios Específicos</h4>
                                            <span>Selecciona el módulo para poder editar los accesos específicos</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">                                          
                                        <?Php
                                        if(isset($this->vModuleData) && count($this->vModuleData)):
                                            for($i=0;$i<count($this->vModuleData);$i++):                                                
                                                if(strstr($vUserRole, $this->vModuleData[$i]['c_role_module']) !== false){
                                                    echo '<a href="'.BASE_VIEW_URL.'system/usersMethod/'.$this->vModuleData[$i]['n_codmenu'].'/'.$vCodeUser.'" class="btn btn-primary">'.ucwords($this->vModuleData[$i]['c_name_module']).'</a>&nbsp;';
                                                }
                                            endfor;
                                        endif;
                                        ?>
                                        </div>                                            
                                    </div>
                                </div>                                                    
                            </div>
                        </form>
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