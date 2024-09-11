<?php

class IdEnView  extends IdEnController
	{				
		private $vController;
		
		public function __construct(IdEnRequest $vRequest)
			{
				$this->vController = $vRequest->getController();
				$this->vJavaScript = array();      

			}
			
		public function index(){}
			
		public function visualize($vNameView, $vItem = FALSE)
			{

				$vParamsViewBootstrap = array(
                                        'root_bootstrap_css'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/bootstrap/css/',
                                        'root_bootstrap_fonts'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/bootstrap/fonts/',
                                        'root_bootstrap_js'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/bootstrap/js/'
									 );
                
				$vParamsViewFrontEndLayout = array(
                                        'root_frontend_img'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/frontend/img/',
										'root_frontend_js'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/frontend/js/',
                                        'root_frontend_css'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/frontend/css/',
										'root_frontend_vendors'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/frontend/vendors/'
									 );							 

				$vParamsViewBackEndLayout = array(
										'root_backend_css'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/backend/css/',
										'root_backend_media'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/backend/media/',
                                        'root_backend_js'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/backend/js/',
                                        'root_backend_plugins'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/backend/plugins/',
										'root_backend_scripts'=>BASE_VIEW_URL.'views/layout/'.DEFAULT_VIEW_LAYOUT.'/backend/scripts/',
									 );				
									 
				$vRouteViewFrontEnd = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'frontend'.DIR_SEPARATOR.$this->vController.DIR_SEPARATOR.$vNameView.'.php';

				$vRouteViewBackEnd = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.$this->vController.DIR_SEPARATOR.$vNameView.'.php';
            
                $vRouteViewAuth = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'auth'.DIR_SEPARATOR.$this->vController.DIR_SEPARATOR.$vNameView.'.php';
                
                $vRouteViewError = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'error'.DIR_SEPARATOR.$this->vController.DIR_SEPARATOR.$vNameView.'.php';

				if(is_readable($vRouteViewFrontEnd))
					{
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'header1.frontend.php';
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'header2.frontend.php';
						include_once $vRouteViewFrontEnd;
                        include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'footer1.frontend.php';
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'footer2.frontend.php';
					}
				elseif(is_readable($vRouteViewBackEnd))
					{
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'header.backend.php';
						include_once $vRouteViewBackEnd;
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'footer.backend.php';
					}
				elseif(is_readable($vRouteViewAuth))
					{
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'header.auth.php';
						include_once $vRouteViewAuth;
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'footer.auth.php';
					}
				elseif(is_readable($vRouteViewError))
					{
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'header.error.php';
						include_once $vRouteViewError;
						include_once ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.'footer.error.php';
					}
				else
					{
                        header('Location: '.BASE_VIEW_URL.'error/view');
						exit;
					}								
			}			
	}
?>
