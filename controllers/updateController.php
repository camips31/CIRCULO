<?Php

class updateController extends IdEnController
{
    public function __construct()
    {

        parent::__construct();

        /* BEGIN VALIDATION TIME SESSION USER */
        if (!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE)) {
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
    }

    public function index()
    {
        $this->vView->visualize('index');
    }

    public function chartOfAccountDoubleMatch()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodChartOfAccounts = (int) $_POST['vCodChartOfAccounts'];
            
            if($this->vFinancesData->getChartOfAccountDoubleMatch($vCodChartOfAccounts) == 1){
                $this->vFinancesData->updateChartOfAccountDoubleMatch($vCodChartOfAccounts, 2);
                echo 'success';
            } else if($this->vFinancesData->getChartOfAccountDoubleMatch($vCodChartOfAccounts) == 2){
                $this->vFinancesData->updateChartOfAccountDoubleMatch($vCodChartOfAccounts, 1);
                echo 'success';
            } else {
                echo 'error-taccount';
            }
        }
    }
    public function supplier()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodSupplier = (int) $_POST['vCodSupplier'];
            $vCodTypeSupplier = (int) $_POST['vCodTypeSupplier'];
            $vBusinessName = (string) $_POST['vBusinessName'];
            $vNameSupplier = (string) $_POST['vNameSupplier'];
            $vNITSupplier = (string) $_POST['vNITSupplier'];
            $vBankAccountSupplier = (string) $_POST['vBankAccountSupplier'];
            $vNameAccountSupplier = (string) $_POST['vNameAccountSupplier'];
            $vTypeAccountSupplier = (string) $_POST['vTypeAccountSupplier'];
            $vAccountSupplier = (string) $_POST['vAccountSupplier'];

            $vStatus = 1;
            $vActive = 1;

            //$vTotalPettyCash = $this->vFinancesData->getTotalStartPettyCash($vCodActivity) - $this->vFinancesData->getTotalPettyCash($vCodActivity);
            //if ($vAmount <= $vTotalPettyCash) {
            $vCodSupplier = $this->vWarehousesData->updateSupplier($vCodSupplier,$vCodTypeSupplier,$vBusinessName,$vNameSupplier,$vNITSupplier,$vBankAccountSupplier,$vNameAccountSupplier,$vTypeAccountSupplier,$vAccountSupplier,$vStatus,$vActive);
            echo 'success';
            //} else {
              //  echo 'error-InsufficientPettyCash';
            //}
            /*}*/
        }
    }

    public function voucherChangeTAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodVoucher = (int) $_POST['vCodVoucher'];

            
            if($this->vFinancesData->getVoucherTAccount($vCodVoucher) == 1){
                $this->vFinancesData->updateTAccountVoucher($vCodVoucher, 2);
                echo 'success';
            } else if($this->vFinancesData->getVoucherTAccount($vCodVoucher) == 2){
                $this->vFinancesData->updateTAccountVoucher($vCodVoucher, 1);
                echo 'success';
            } else {
                echo 'error-taccount';
            }
        }
    }

    public function consolidatedAccountingEntry()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodAccountingSeat = (int) $_POST['vCodAccountingSeat'];
            $vDateAccountingSeat = $_POST['vDateAccountingSeat'];
            $vDescAccountingSeat = (string) $_POST['vDescAccountingSeat'];
            
            $this->vFinancesData->updateAccountingSeat($vCodAccountingSeat, $vDateAccountingSeat, $vDescAccountingSeat);
            echo 'success';
        }
    }
    
    public function voucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodVoucher = (int) $_POST['vCodVoucher'];
            $vCodPartner = (int) $_POST['vCodPartner'];
            $vCodBill = (int) $_POST['vCodBill'];
            $vCodChartOfAccount = (int) $_POST['vCodChartOfAccount'];
            $vVoucherType = (int) $_POST['vVoucherType'];
            $vDateVoucher = $_POST['vDateVoucher'];
            $vAmount = $_POST['vAmount'];
            $vVoucherDesc = (string) $_POST['vVoucherDesc'];

            $this->vFinancesData->updateVoucher($vCodVoucher, $vCodPartner, $vCodBill, $vCodChartOfAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc);
            
            echo 'success';
        }
    }    
  
    public function accountingEntrieChangeType()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodAccountingSeat = (int) $_POST['vCodAccountingSeat'];
            $vTypeAccountingSeat = (int) $_POST['vType'];
            
            //echo $vCodAccountingSeat.' - '.$vTypeAccountingSeat;

            if($vTypeAccountingSeat == 0){
                $this->vFinancesData->updateAccountingEntrieType($vCodAccountingSeat, 1);
                echo 'success';
            } else if($vTypeAccountingSeat == 1){
                $this->vFinancesData->updateAccountingEntrieType($vCodAccountingSeat, 2);
                echo 'success';
            } else if($vTypeAccountingSeat == 2){
                $this->vFinancesData->updateAccountingEntrieType($vCodAccountingSeat, 3);
                echo 'success';
            } else if($vTypeAccountingSeat == 3){
                $this->vFinancesData->updateAccountingEntrieType($vCodAccountingSeat, 0);
                echo 'success';
            }
        }
    }

    public function updatePayOutOffDebt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodDebt = (int) $_POST['n_coddebt'];
            $vCodVoucher = (int) $_POST['n_codvoucher'];
            $vState = 2;

            $this->vPartnerData->updatePayOutOffDebt($vCodDebt, $vCodVoucher, $vState);
            echo 'success';
        }
    }    
}
