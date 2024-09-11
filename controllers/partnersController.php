<?Php

class partnersController extends IdEnController
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
                $this->vView->vProfileNameLogged = ucwords($this->vProfileData->getNames($this->vCodProfileLogged).' '.$this->vProfileData->getLastNames($this->vCodProfileLogged));
                $this->vView->vProfileEmailLogged = $this->vUsersData->getUserEmail($this->vCodUserLogged);
                $this->vView->vProfileEmailValidation = $this->vUsersData->getAccountStatusUserCode($this->vCodUserLogged);
                //$this->vView->vProfileNotifications = $this->vNotificationsData->getProfileNotifications($this->vCodProfileLogged, 0);
                /********************************/
                /* END AUTHENTICATE USER ACTIVE */
                /********************************/

                $this->vView->vControllerActive = 'profile';
                $this->vView->vSubNavContent = '';
            
			}
		public function index(){
            
				/* BEGIN VALIDATION TIME SESSION USER */
				if(!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE)){
                    $this->redirect('auth');
                } else {
                    IdEnSession::timeSession();
                }
                /* END VALIDATION TIME SESSION USER */
			}
            public function register()
            {
                $this->vView->visualize('register');    
            }
            public function list()
            {
                $this->vView->visualize('list');    
            } 
            public function debts()
            {
                $this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountList();
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->vDebtsLits = $this->vPartnerData->getDebts();
                $this->vView->visualize('debts');    
            }
            public function debtorPartners()
            {
                $this->vDataPartners = $this->vPartnerData->getPartnersGroupDebts();
                $this->vDataPartnersDebt = $this->vPartnerData->getPartnersDebt($this->vDataPartners[$i]['n_codpartner']);
                $this->vView->visualize('debtorPartners');    
            }            
            public function debtReconciliation()
            {
                $this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountList();
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->vTotalDebts = $this->vPartnerData->getTotalDebts();
                $this->vView->visualize('debtReconciliation');    
            }            
            public function financesRecordPartner($vCodPartner)
            {
                $vCodPartner = (int) $vCodPartner;
                
                $this->vView->vDataPartner = $this->vPartnerData->getPartner($vCodPartner);
                $this->vView->vDataRecordDebtPartner = $this->vPartnerData->getRecordDebtPartner($vCodPartner);
                $this->vView->vDataRecordFinancesPartner = $this->vPartnerData->getRecordFinancesPartner($vCodPartner);
                
                $this->vView->visualize('financesRecordPartner');    
            }
            public function partnerPayOffDebt($vCodDebt)
            {
                $vCodDebt = (int) $vCodDebt;                
            
                //$this->vView->vDataPartner = $this->vPartnerData->getPartner($vCodPartner);
                //$this->vView->vDataPartnersDebt = $this->vPartnerData->getPartnersDebt($vCodPartner);
                $this->vView->vDataDebt = $this->vPartnerData->getDebt($vCodDebt);
                
                $vCodPartner = $this->vPartnerData->getCodPartnerFromDebt($vCodDebt);
                $this->vView->vDataVouchersPartner = $this->vPartnerData->getVouchersFromCodPartner();
                
                $this->vView->visualize('partnerPayOffDebt');
            }                                   
    }
?>