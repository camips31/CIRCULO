<?Php

class deleteController extends IdEnController
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
        $this->vFinancesData = $this->LoadModel('finances');
        $this->vPartnerData = $this->LoadModel('partners');

        /**********************************/
        /* BEGIN AUTHENTICATE USER ACTIVE */
        /**********************************/
        $this->vView->vSubNavContent = '';
    }

    public function index()
    {
        $this->vView->visualize('index');
    }

    public function chartOfAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodChartOfAccounts = (int) $_POST['vCodChartOfAccounts'];
            $this->vFinancesData->deleteChartOfAccount($vCodChartOfAccounts);
            echo 'success';
        }
    }

    public function partner()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodPartner = (int) $_POST['vCodPartner'];
            $this->vPartnerData->deletePartner($vCodPartner);
            echo 'success';
        }
    }
    
    public function voucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vCodVoucher = (int) $_POST['vCodVoucher'];
            $this->vFinancesData->deleteVoucher($vCodVoucher);
            echo 'success';
        }
    }
    
    public function accountingSeat()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $vCodAccountingSeat = (int) $_POST['vCodAccountingSeat'];
            //$this->vFinancesData->deleteVoucher($vCodVoucher);
            //echo 'success';
        }
    }    

}