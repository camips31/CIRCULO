<?Php

class financesController extends IdEnController
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
                $this->vView->visualize('index');                
			}
            public function chartOfAccountList()
            {
                //$this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountLevel0();
                $this->vView->visualize('chartOfAccountList');
            }
            public function chartOfAccountReg()
            {
                //$this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountLevel0();
                $this->vView->visualize('chartOfAccountReg');
            }    
            public function editChartOfAccount($vCodeChartOfAccount)
            {
                $vCodeChartOfAccount = (int) $vCodeChartOfAccount;
                $this->vView->DataChartOfAccount = $this->vFinancesData->getChartOfAccount($vCodeChartOfAccount);
                $this->vView->visualize('editChartOfAccount');
            }            
            public function pettycash(){            
                $this->vView->visualize('index');                
			}
            public function vouchers()
            {
                $this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountList();
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->DataBills = $this->vFinancesData->getBills();
                //$this->vView->DataBills = $this->vFinancesData->getBillsForVouchers();
                $this->vView->DataReceiptsList = $this->vFinancesData->getReceiptsList();

                $this->vView->DataVouchersList = $this->vFinancesData->getVouchers($this->vCodUserLogged, 0);

                $this->vView->visualize('vouchers');
            }
            public function voucherList()
            {
                $this->vView->DataVouchersList = $this->vFinancesData->getVoucherList();

                $this->vView->visualize('voucherList');
            }            
            public function receipts()
            {
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->DataReceiptsList = $this->vFinancesData->getReceipts($this->vCodUserLogged);

                $this->vView->visualize('receipts');
            }
            public function receiptList()
            {
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->DataReceiptsList = $this->vFinancesData->getReceiptsList();

                $this->vView->visualize('receiptList');
            }                        
            public function voucherEdit($vCodVoucher)
            {
                $vCodVoucher = (int) $vCodVoucher;

                $this->vView->vChartOfAccountList = $this->vFinancesData->getChartOfAccountList();
                $this->vView->DataPartners = $this->vPartnerData->getPartners();
                $this->vView->DataBills = $this->vFinancesData->getBills();

                $this->vView->DataVoucher = $this->vFinancesData->getVoucher($vCodVoucher);

                $this->vView->visualize('voucherEdit');
            }            
            public function bills()
            {
                $this->vView->visualize('bills');
            }
            public function accountingEntries($vMonth = 0)
            {
                if($vMonth == 0){
                    $vMonth = idate('m');
                } else {
                    $vMonth = (int) $vMonth;
                }

                $this->vView->vGroupMonthOfAccountingBook = $this->vFinancesData->getGroupMonthOfAccountingBook();
                $this->vView->vDataAccountEntriesList = $this->vFinancesData->getAccountingEntries($vMonth);

                $this->vView->visualize('accountingEntries');
            }
            public function accountSeat($vCodAccountingSeat)
            {
                $vCodAccountingSeat = (int) $vCodAccountingSeat;
                $this->vView->vDataAccountingSeat = $this->vFinancesData->getAccountingEntrie($vCodAccountingSeat);
                $this->vView->vDataAccountSeat = $this->vFinancesData->getVouchersFromAccountingSeat($vCodAccountingSeat);

                $this->vView->visualize('accountSeat');
            }
            public function accountSeatEdit($vCodAccountingSeat)
            {
                $vCodAccountingSeat = (int) $vCodAccountingSeat;
                $this->vView->vDataAccountSeat = $this->vFinancesData->getVouchersFromAccountingSeat($vCodAccountingSeat);

                $this->vView->visualize('accountSeat');
            }
            public function mainAccountingBooks()
            {
                $this->vView->visualize('mainAccountingBooks');
            }
            public function editMainAccountingBook($vCodChartOfAccount, $vMonth = 0)
            {
                $vCodChartOfAccount = (int) $vCodChartOfAccount;
                if($vMonth == 0){
                    $vMonth = idate('m');
                } else {
                    $vMonth = (int) $vMonth;
                }
                
                $this->vView->vCodChartOfAccount = $vCodChartOfAccount;
                $this->vView->vMonth = $vMonth;
                $this->vView->vGroupMonthOfAccountingBook = $this->vFinancesData->getGroupMonthOfAccountingBook();
                $this->vView->vDataMainAccountingBook = $this->vFinancesData->getMainAccountingBook($vCodChartOfAccount, $vMonth);
                $this->vView->visualize('editMainAccountingBook');
            } 
            public function debts()
            {
                $this->vView->vDataMainAccountingBook = $this->vFinancesData->getMainAccountingBook($vCodChartOfAccount);
                $this->vView->visualize('debts');
            }
            public function sumsAndBalances($vMonth = 0)
            {
                if($vMonth == 0){
                    $vMonth = idate('m');
                } else {
                    $vMonth = (int) $vMonth;
                }                
                
                $this->vView->vMonth = $vMonth;
                $this->vView->vGroupMonthOfAccountingBook = $this->vFinancesData->getGroupMonthOfAccountingBook();
                $this->vView->vDataSaldos = $this->vFinancesData->getSumsAndBalances($vMonth-1);
                $this->vView->vLastMonth = ($vMonth-1);
                $this->vView->vDataSumsAndBalances = $this->vFinancesData->getSumsAndBalances($vMonth);
                $this->vView->visualize('sumsAndBalances');
            }
            public function incomeStatement($vMonth = 0)
            {
                if($vMonth == 0){
                    $vMonth = idate('m');
                } else {
                    $vMonth = (int) $vMonth;
                }
                
                $this->vView->vMonth = $vMonth;                
                $this->vView->vGroupMonthOfAccountingBook = $this->vFinancesData->getGroupMonthOfAccountingBook();
                $this->vView->vDataSumsAndBalances = $this->vFinancesData->getSumsAndBalances($vMonth);
                $this->vView->visualize('incomeStatement');
            }
            public function accountingBalance($vMonth = 0)
            {
                if($vMonth == 0){
                    $vMonth = idate('m');
                } else {
                    $vMonth = (int) $vMonth;
                }                
                $this->vView->vGroupMonthOfAccountingBook = $this->vFinancesData->getGroupMonthOfAccountingBook();
                $this->vView->vDataSumsAndBalances = $this->vFinancesData->getAccountingBalance($vMonth);
                $this->vView->visualize('accountingBalance');
            }                                    
    }
?>