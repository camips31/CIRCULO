<?Php

class dashboardController extends IdEnController
	{		
		public function __construct(){

                parent::__construct();
            
				/* BEGIN VALIDATION TIME SESSION USER */
				if(!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE)){
                    $this->redirect('auth');
                } else {
                    IdEnSession::timeSession();                    
                }
                /* END VALIDATION TIME SESSION USER */
                
                $this->vView->vSessionLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE);
                
                $this->vCtrl = $this->LoadModel('ctrl');
                $this->vMenuData = $this->LoadModel('menu');
                $this->vAccessData = $this->LoadModel('access');
                $this->vUsersData = $this->LoadModel('users');
                $this->vProfileData = $this->LoadModel('profile');
                $this->vPartnerData = $this->LoadModel('partners');
                $this->vFinancesData = $this->LoadModel('finances');
            
                /**********************************/
                /* BEGIN AUTHENTICATE USER ACTIVE */
                /**********************************/
                $this->vCodProfileLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'ProfileCode');
                $this->vCodUserLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
                //$this->vView->vProfileImageNameLogged = 'directory_'.$this->vCodProfileLogged.'/'.$this->vProfileData->getProfileImage($this->vCodProfileLogged);
                $this->vView->vProfileNameLogged = ucwords($this->vProfileData->getNames($this->vCodProfileLogged).' '.$this->vProfileData->getLastNames($this->vCodProfileLogged));
                $this->vView->vProfileNameLetters = substr($this->vProfileData->getNames($this->vCodProfileLogged), 0, 1).substr($this->vProfileData->getLastNames($this->vCodProfileLogged), 0, 1);
                $this->vView->vProfileEmailLogged = $this->vUsersData->getUserEmail($this->vCodUserLogged);
                $this->vView->vProfileEmailValidation = $this->vUsersData->getAccountStatusUserCode($this->vCodUserLogged);
                $this->vView->vUserRoleList = $this->vUsersData->getUserRole($this->vCodUserLogged);
                /********************************/
                /* END AUTHENTICATE USER ACTIVE */
                /********************************/         
            
                $this->vView->vControllerActive = 'dashboard';
                $this->vView->vSubNavContent = '';
            
			}
			
		public function index(){

                $this->vView->DataLastSession = $this->vCtrl->getLastSession($this->vCodProfileLogged,$this->vCodUserLogged);
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->DataTotalAmountBills = $this->vFinancesData->getTotalAmountBills();
                $this->vView->DataBills = $this->vFinancesData->getBills();
                $this->vView->DataChartOfAccount = $this->vFinancesData->getChartOfAccountList();

                $vMonth = idate('m')-1;
                $this->vView->vTotalAccountingEntries = $this->vFinancesData->getTotalAccountingEntries($vMonth);

                if($vMonth == 1){
                    $vMonth = 'Enero '.idate('Y');
                } else if($vMonth == 2){
                    $vMonth = 'Febrero '.idate('Y');
                } else if($vMonth == 3){
                    $vMonth = 'Marzo '.idate('Y');
                } else if($vMonth == 4){
                    $vMonth = 'Abril '.idate('Y');
                } else if($vMonth == 5){
                    $vMonth = 'Mayo '.idate('Y');
                } else if($vMonth == 6){
                    $vMonth = 'Junio '.idate('Y');
                } else if($vMonth == 7){
                    $vMonth = 'Julio '.idate('Y');
                } else if($vMonth == 8){
                    $vMonth = 'Agosto '.idate('Y');
                } else if($vMonth == 9){
                    $vMonth = 'Septiembre '.idate('Y');
                } else if($vMonth == 10){
                    $vMonth = 'Octubre '.idate('Y');
                } else if($vMonth == 11){
                    $vMonth = 'Noviembre '.idate('Y');
                } else if($vMonth == 12){
                    $vMonth = 'Diciembre '.idate('Y');
                }                

                $this->vView->vMonth = $vMonth;
                

                $this->vView->vMethodActive = 'index';
                $this->vView->visualize('index');
			}     
	}
?>