<?Php

class insertController extends IdEnController
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
        $this->vPartnerData = $this->LoadModel('partners');
        $this->vFinancesData = $this->LoadModel('finances');

        $this->vCodProfileLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'ProfileCode');
        $this->vCodUserLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');        
        /**********************************/
        /* BEGIN AUTHENTICATE USER ACTIVE */
        /**********************************/
    }

    public function index()
    {
        $this->vView->visualize('index');
    }

    
    public function registerPartner(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $vCodUser = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
            $vNumAccion = (int) $_POST['vNumAccion'];
            $vCategoria = (int) $_POST['vCategoria'];
            $vFechaIngreso = $_POST['vFechaIngreso'];
            $vNombres = (string) $_POST['vNombres'];
            $vFechaNacimiento = $_POST['vFechaNacimiento'];
            $vCarnetIdentidad = (string) $_POST['vCarnetIdentidad'];
            $vSexo = (int) $_POST['vSexo'];
            $vCelular = (int) $_POST['vCelular'];
            $vMail = (string) $_POST['vMail'];
            $vCiudad = (int) $_POST['vCiudad'];
            $vNombreNit = (string) $_POST['vNombreNit'];
            $vNIT = (string) $_POST['vNIT'];
            $vStatus = 1;//(int) $_POST['vStatus'];
            $vActive = 1;//(int) $_POST['vActive'];
            
            $vInsertPartner = $this->vPartnerData->insertPartner($vCodUser,$vNumAccion,$vCategoria,$vFechaIngreso,$vNombres,$vFechaNacimiento,$vCarnetIdentidad, $vSexo, $vCelular, $vMail, $vCiudad, $vNombreNit, $vNIT, $vStatus, $vActive);
            echo 'success';    
            /* CONTROL USER ACTION */
            //$this->vCtrl->insertCtrlAction($this->vCtrl->getLastSession(IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'ProfileCode'),IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode')), IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'ProfileCode'), IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode'), 'register', 'system', 'registerMenu', 'insertMenu', $vUserCode.';'.$vLevel1.';'.$vLevel2.';'.$vLevel3.';'.$vLevel4.';'.$vParentMenu.';'.$vPositionMenu.';'.$vRoleMenu.';'.$vIconMenu.';'.$vNameMenu.';'.$vDescMenu.';'.$vControllerActive.';'.$vMethodActive.';'.$vURLMenu.';'.$vSessionMenu.';'.$vActiveMenu);
            
        }             
    }
    
    public function insertFrontEndMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vUserCode = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
            $vLevel1 = (int) $_POST['vLevel1'];
            $vLevel2 = (int) $_POST['vLevel2'];
            $vLevel3 = null;
            $vLevel4 = null;
            $vParentMenu = (int) $_POST['vParentMenu'];
            $vPositionMenu = (int) $_POST['vPositionMenu'];
            $vRoleMenu = null;
            $vIconMenu = null;
            $vNameMenu = (string) $_POST['vNameMenu'];
            $vDescMenu = null;
            $vControllerActive = (string) $_POST['vControllerActive'];
            $vMethodActive = (string) $_POST['vMethodActive'];
            $vURLMenu = (string) $_POST['vURLMenu'];
            $vSessionMenu = 0;
            $vActiveMenu = 1;

            $vInsertMenu = $this->vFrontEndData->insertFrontEndMenu($vUserCode, $vLevel1, $vLevel2, $vLevel3, $vLevel4, $vParentMenu, $vPositionMenu, $vRoleMenu, $vIconMenu, $vNameMenu, $vDescMenu, $vControllerActive, $vMethodActive, $vURLMenu, $vSessionMenu, $vActiveMenu);

            if ($this->vMenuData->getMenuExists($vInsertMenu) == 1) {
                echo 'success';

                /* CONTROL USER ACTION */
                $this->vCtrl->insertCtrlAction($this->vCtrl->getLastSession(IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'ProfileCode'), IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode')), IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'ProfileCode'), IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode'), 'register', 'system', 'registerMenu', 'insertMenu', $vUserCode . ';' . $vLevel1 . ';' . $vLevel2 . ';' . $vLevel3 . ';' . $vLevel4 . ';' . $vParentMenu . ';' . $vPositionMenu . ';' . $vRoleMenu . ';' . $vIconMenu . ';' . $vNameMenu . ';' . $vDescMenu . ';' . $vControllerActive . ';' . $vMethodActive . ';' . $vURLMenu . ';' . $vSessionMenu . ';' . $vActiveMenu);
            } else {
                echo 'error';
            }

        }
    }
    
    public function chartOfAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vNumCodChartOfAccounts = (int) $_POST['vNumCodChartOfAccounts'];
            $vChartOfAccountsName = (string) $_POST['vChartOfAccountsName'];
            $vTAccount = (string) $_POST['vTAccount'];
            $vActive = (string) $_POST['vActive'];
            $vCodSupplier = $this->vFinancesData->insertChartOfAccount($vNumCodChartOfAccounts,$vChartOfAccountsName,$vTAccount,$vActive);
            echo 'success';
        }
    }

    public function voucher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodPartner = (int) $_POST['vCodPartner'];
            $vCodBill = (int) $_POST['vCodBill'];
            $vCodReceipt = (int) $_POST['vCodReceipt'];
            $vCodChartOfAccount = (int) $_POST['vCodChartOfAccount'];
            $vRadioTypeVoucher = (int) $_POST['radioTypeVoucher'];
            
            $vTAccount = (int) $this->vFinancesData->getTAccountFromChartOfAccount($vCodChartOfAccount);
            $vNumChartOfAccount = (int) $this->vFinancesData->getNumChartOfAccount($vCodChartOfAccount);

            $vVoucherType = (int) $_POST['vVoucherType'];
            $vDateVoucher = $_POST['vDateVoucher'];
            $vAmount = $_POST['vAmount'];
            $vVoucherDesc = (string) $_POST['vVoucherDesc'];
            $vState = 0;//(int) $_POST['vState'];
            $vActive = 1;//(int) $_POST['vActive'];

            //echo $vRadioTypeVoucher.' - '.$vAmount.' - '.($vAmount - ($vAmount*(1.9/100)));
            //SELECT * FROM `tb_cdlu_chartofaccount` WHERE `n_codchartofaccounts` in(275,139,142,210,52,140,141,146,58,12,55)
            if($vRadioTypeVoucher == 0){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 1){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 275, $this->vFinancesData->getTAccountFromChartOfAccount(275), $vVoucherType, $vDateVoucher, ($vAmount*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 139, $this->vFinancesData->getTAccountFromChartOfAccount(139), $vVoucherType, $vDateVoucher, ($vAmount*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 142, $this->vFinancesData->getTAccountFromChartOfAccount(142), $vVoucherType, $vDateVoucher, ($vAmount*0.13), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 210, $this->vFinancesData->getTAccountFromChartOfAccount(142), $vVoucherType, $vDateVoucher, ($vAmount - ($vAmount*0.13)), $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 2){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, ($vAmount - ($vAmount*0.13)), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 52, $this->vFinancesData->getTAccountFromChartOfAccount(52), $vVoucherType, $vDateVoucher, ($vAmount*0.13), $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 3){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, (($vAmount*100)/84), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 140, $this->vFinancesData->getTAccountFromChartOfAccount(140), $vVoucherType, $vDateVoucher, ((($vAmount*100)/84)*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 141, $this->vFinancesData->getTAccountFromChartOfAccount(141), $vVoucherType, $vDateVoucher, ((($vAmount*100)/84)*0.13), $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 4){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, (($vAmount*100)/92), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 140, $this->vFinancesData->getTAccountFromChartOfAccount(140), $vVoucherType, $vDateVoucher, ((($vAmount*100)/92)*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 146, $this->vFinancesData->getTAccountFromChartOfAccount(146), $vVoucherType, $vDateVoucher, ((($vAmount*100)/92)*0.05), $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 5){
                $vComision = ($vAmount*(1.9/100));
                $vMontoSinComision = ($vAmount - $vComision);

                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 58, $this->vFinancesData->getTAccountFromChartOfAccount(58), $vVoucherType, $vDateVoucher, $vComision, $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 12, $this->vFinancesData->getTAccountFromChartOfAccount(12), $vVoucherType, $vDateVoucher, $vMontoSinComision, $vVoucherDesc, $vState, $vActive);

                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 275, $this->vFinancesData->getTAccountFromChartOfAccount(275), $vVoucherType, $vDateVoucher, ($vAmount*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 139, $this->vFinancesData->getTAccountFromChartOfAccount(139), $vVoucherType, $vDateVoucher, ($vAmount*0.03), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 142, $this->vFinancesData->getTAccountFromChartOfAccount(142), $vVoucherType, $vDateVoucher, ($vAmount*0.13), $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 210, $this->vFinancesData->getTAccountFromChartOfAccount(142), $vVoucherType, $vDateVoucher, ($vAmount - ($vAmount*0.13)), $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 6){
                $vComision = ($vAmount*(1.9/100));
                $vMontoSinComision = ($vAmount - $vComision);

                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vMontoSinComision, $vVoucherDesc, $vState, $vActive);                
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 58, $this->vFinancesData->getTAccountFromChartOfAccount(58), $vVoucherType, $vDateVoucher, $vComision, $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 55, $this->vFinancesData->getTAccountFromChartOfAccount(55), $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);
            } else if($vRadioTypeVoucher == 7){
                $vComision = ($vAmount*(1.9/100));
                $vMontoSinComision = ($vAmount - $vComision);

                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 58, $this->vFinancesData->getTAccountFromChartOfAccount(58), $vVoucherType, $vDateVoucher, $vComision, $vVoucherDesc, $vState, $vActive);
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, 12, $this->vFinancesData->getTAccountFromChartOfAccount(12), $vVoucherType, $vDateVoucher, $vMontoSinComision, $vVoucherDesc, $vState, $vActive);
            }                        
            echo 'success';
        }
    }

    public function receipt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodReceipt = (int) $_POST['vNumCorrelative'];
            $vTypeReceipt = (int) $_POST['vCodTypeReceipt'];
            $vDateReceipt = $_POST['vDateReceipt'];
            $vCodPartner = (int) $_POST['vCodPartner'];
            $vAmount = $_POST['vAmount'];            
            $vReceiptDesc = (string) $_POST['vReceiptDesc'];

            $vState = 1;//(int) $_POST['vState'];
            $vActive = 1;//(int) $_POST['vActive'];
            
            $vCodReceipt = $this->vFinancesData->insertReceipt($vCodReceipt, $vTypeReceipt, $vDateReceipt, $vCodPartner, $vAmount, $vReceiptDesc, $vState, $vActive);

            echo 'success';
        }
    }    
    
    public function consolidateAccountingSeat()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vDateAccountingSeat = $_POST['vDateAccountingSeat'];
            $vDescAccountingSeat = $_POST['vDescAccountingSeat'];
            $vState = 1;
            $vActive = 1;
            $vCodAccountingSeat = $this->vFinancesData->insertAccountingSeat($vDateAccountingSeat, $vDescAccountingSeat, $vState, $vActive);
            $this->vFinancesData->updateVoucherCodAccountingSeat($vCodAccountingSeat, $this->vCodUserLogged, 1);
            echo 'success';
        }
    }
    
    public function registerDebt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodPartner = (int) $_POST['vCodPartner'];
            $vCodChartOfAccount = (int) $_POST['vCodChartOfAccount'];
            $vTypeDebt = (int) $_POST['vTypeDebt'];
            $vMonth = (int) $_POST['vMonth'];
            $vDateDebt = $_POST['vDateDebt'];
            $vAmountDebt = $_POST['vAmountDebt'];
            $vDescDebt = (string) $_POST['vDescDebt'];

            $vState = 1;
            $vActive = 1;

            if($vCodPartner == 0){
                //echo 'todos los socios';
                $this->vPartnersDebtsForDebts = $this->vPartnerData->getPartnersDebtsForDebts();
                if (isset($this->vPartnersDebtsForDebts) && count($this->vPartnersDebtsForDebts)):
                    for ($i = 0; $i < count($this->vPartnersDebtsForDebts); $i++):
                        $vCodPartner = $this->vPartnersDebtsForDebts[$i]['n_codpartner'];
                        $vCodDebt = $this->vPartnerData->insertDebt($vCodPartner,$vCodChartOfAccount,$vTypeDebt,$vMonth,$vDateDebt,$vAmountDebt,$vDescDebt,$vState,$vActive);
                    endfor;
                endif;                
            } else {
                $vCodDebt = $this->vPartnerData->insertDebt($vCodPartner,$vCodChartOfAccount,$vTypeDebt,$vMonth,$vDateDebt,$vAmountDebt,$vDescDebt,$vState,$vActive);
            }

            //echo $vTypeDebt.'/'.$vMonth.'/'.$vDateDebt.'/'.$vAmountDebt.'/'.$vDescDebt;
            //exit;

            //$vCodDebt = $this->vPartnerData->insertDebt($vCodPartner,$vCodChartOfAccount,$vTypeDebt,$vMonth,$vDateDebt,$vAmountDebt,$vDescDebt,$vState,$vActive);

            echo 'success';
        }
    }
    
    public function partnerApproveDebt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vCodDebt = (int) $_POST['vCodDebt'];
            $vTypeDebt = (int) $_POST['vTypeDebt'];
            $vMonth = (int) $_POST['vMonth'];
            $vState = 0;//(int) $vState;
            $vActive = 1;//(int) $vActive;

            //echo $vCodDebt.'/'.$vTypeDebt.'/'.$vMonth;
            $a = array(1,2,3,4,5,6,7,8,9,10,11,12);
            if(in_array($vTypeDebt, $a, true)) {
                //echo "Si esta en el array";
                $this->DataPartnersTypeList = $this->vPartnerData->getPartnersType($vTypeDebt);
            } else {
                //echo "No esta en el array";
                $this->DataPartnersTypeList = $this->vPartnerData->getPartners();
            }

            foreach ($this->DataPartnersTypeList as $row) {
                $this->vPartnerData->insertPartnerDebt($vCodDebt, $row['n_codpartner'], $vMonth, $vState, $vActive);
            }

            echo 'success';
        }
    }
    
    public function consolidateBalance()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vTotalSaldoDebe = $_POST['vTotalSaldoDebe'];
            $vTotalSaldoHaber = $_POST['vTotalSaldoHaber'];
            $vCodChartOfAccount = $_POST['vCodChartOfAccount'];
            $vMonth = $_POST['vMonth'];
            $vTAccount = $_POST['vTAccount'];

            //echo $vTotalSaldoDebe.' - '.$vTotalSaldoHaber.' - '.$vCodChartOfAccount.' - '.$vMonth.' - '.$vTAccount;

            $vCodPartner = 0;
            $vCodBill = 0;
            $vCodReceipt = 0;
            
            //$vTAccount = (int) $this->vFinancesData->getTAccountFromChartOfAccount($vCodChartOfAccount);
            $vTAccount = (int) $this->vFinancesData->getTAccountFromVoucher($vCodChartOfAccount);            
            $vNumChartOfAccount = (int) $this->vFinancesData->getNumChartOfAccount($vCodChartOfAccount);

            $vVoucherType = 4;

            if($vMonth == 12){
                $vDateVoucher = date('Y-1-1');
            } else {
                $vDateVoucher = date('Y-'.($vMonth+1).'-1');
            }

            if($vTAccount == 1){
                $vAmount = $vTotalSaldoDebe;
            } else if($vTAccount == 2){
                $vAmount = $vTotalSaldoHaber;
            }

            if($vMonth == 1){
                $vCloseMonth = 'Enero '.date('Y');
            } else if($vMonth == 2){
                $vCloseMonth = 'Febrero '.date('Y'); 
            } else if($vMonth == 3){
                $vCloseMonth = 'Marzo '.date('Y');
            } else if($vMonth == 4){
                $vCloseMonth = 'Abril '.date('Y');
            } else if($vMonth == 5){
                $vCloseMonth = 'Mayo '.date('Y');
            } else if($vMonth == 6){
                $vCloseMonth = 'Junio '.date('Y');
            } else if($vMonth == 7){
                $vCloseMonth = 'Julio '.date('Y');
            } else if($vMonth == 8){
                $vCloseMonth = 'Agosto '.date('Y');
            } else if($vMonth == 9){
                $vCloseMonth = 'Septiembre '.date('Y');
            } else if($vMonth == 10){
                $vCloseMonth = 'Octubre '.date('Y');
            } else if($vMonth == 11){
                $vCloseMonth = 'Noviembre '.date('Y');
            } else if($vMonth == 12){
                $vCloseMonth = 'Diciembre '.date('Y');
            }

            $vVoucherDesc = 'Saldo Cierre al Mes '.$vCloseMonth;
            $vState = 1;
            $vActive = 1;
            
            //echo $vCodChartOfAccount.' - '.$vDateVoucher.' - '.$vVoucherType;

            if($this->vFinancesData->getVoucherInitialBalances($vCodChartOfAccount, $vVoucherType, $vMonth+1) == 0){
                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);
                echo 'success';
            } else {
                echo 'exists';
            }
        }
    }

    public function consolidateGlobalBalance($vMonth)
    {
        $vMonth = (int) $vMonth;
        $this->vDataSumsAndBalances = $this->vFinancesData->getSumsAndBalances($vMonth);

        
        if(isset($this->vDataSumsAndBalances) && count($this->vDataSumsAndBalances)):
            for($i=0;$i<count($this->vDataSumsAndBalances);$i++):

                $vCodChartOfAccount = $this->vDataSumsAndBalances[$i]['n_codchartofaccounts'];
                $vTAccount = $this->vDataSumsAndBalances[$i]['n_taccount'];               

                $vCodPartner = 0;
                $vCodBill = 0;
                $vCodReceipt = 0;
                
                $vTAccount = (int) $this->vFinancesData->getTAccountFromVoucher($vCodChartOfAccount);            
                $vNumChartOfAccount = (int) $this->vFinancesData->getNumChartOfAccount($vCodChartOfAccount);
        
                $vVoucherType = 4;
        
                if($vMonth == 12){
                    $vDateVoucher = date('Y-01-01');
                } else {
                    $vDateVoucher = date('Y-'.($vMonth+1).'-1');
                }
        
                if($vTAccount == 1){
                    $vAmount = $vTotalSaldoDebe;
                } else if($vTAccount == 2){
                    $vAmount = $vTotalSaldoHaber;
                }
        
                if($vMonth == 1){
                    $vCloseMonth = 'Enero '.date('Y');
                } else if($vMonth == 2){
                    $vCloseMonth = 'Febrero '.date('Y'); 
                } else if($vMonth == 3){
                    $vCloseMonth = 'Marzo '.date('Y');
               } else if($vMonth == 4){
                    $vCloseMonth = 'Abril '.date('Y');
                } else if($vMonth == 5){
                    $vCloseMonth = 'Mayo '.date('Y');
                } else if($vMonth == 6){
                    $vCloseMonth = 'Junio '.date('Y');
                } else if($vMonth == 7){
                    $vCloseMonth = 'Julio '.date('Y');
                } else if($vMonth == 8){
                    $vCloseMonth = 'Agosto '.date('Y');
                } else if($vMonth == 9){
                    $vCloseMonth = 'Septiembre '.date('Y');
                } else if($vMonth == 10){
                    $vCloseMonth = 'Octubre '.date('Y');
                } else if($vMonth == 11){
                    $vCloseMonth = 'Noviembre '.date('Y');
                } else if($vMonth == 12){
                    $vCloseMonth = 'Diciembre '.date('Y');
                }
        
                $vVoucherDesc = 'Saldo Cierre al Mes '.$vCloseMonth;
                $vState = 1;
                $vActive = 1;                

                if($this->vDataSumsAndBalances[$i]['n_chartofaccountname'] == '1116011*'){
                    $n_sumas_debe = $this->vDataSumsAndBalances[$i]['n_sumas_debe'];
                    $n_sumas_haber = $this->vDataSumsAndBalances[$i]['n_sumas_haber'];
                    $n_saldos_debe = $this->vDataSumsAndBalances[$i]['n_saldos_debe'];
                    $n_saldos_haber = $this->vDataSumsAndBalances[$i]['n_saldos_haber'];

                    $vMontoFinalSumasDebe = ($n_sumas_debe * 6.96);
                    $vMontoFinalSumasHaber = ($n_sumas_haber * 6.96);
                    $vMontoFinalSaldosDebe = ($n_saldos_debe * 6.96);
                    $vMontoFinalSaldosHaber = ($n_saldos_haber * 6.96);																		
                } else {
                    $vMontoFinalSumasDebe = $this->vDataSumsAndBalances[$i]['n_sumas_debe'];
                    $vMontoFinalSumasHaber = $this->vDataSumsAndBalances[$i]['n_sumas_haber'];
                    $vMontoFinalSaldosDebe = $this->vDataSumsAndBalances[$i]['n_saldos_debe'];
                    $vMontoFinalSaldosHaber = $this->vDataSumsAndBalances[$i]['n_saldos_haber'];
                }																	

                /*echo '<tr code="'.$this->vDataSumsAndBalances[$i]['n_chartofaccountname'].'"
                          vTotalSaldoDebe="'.$vMontoFinalSaldosDebe.'"
                          vTotalSaldoHaber="'.$vMontoFinalSaldosHaber.'"
                          vCodChartOfAccount="'.$this->vDataSumsAndBalances[$i]['n_codchartofaccounts'].'"
                          vMonth="'.$this->vDataSumsAndBalances[$i]['n_month'].'"
                          vTAccount="'.$this->vDataSumsAndBalances[$i]['n_taccount'].'">';
                    echo '<td>'.$vCount.'</td>';
                    echo '<td>'.$this->vDataSumsAndBalances[$i]['n_chartofaccountname'].'</td>';
                    echo '<td>'.$this->vDataSumsAndBalances[$i]['c_chartofaccountname'].'</td>';

                    echo '<td>'.number_format($vMontoFinalSumasDebe,2,',','.').'</td>';
                    echo '<td>'.number_format($vMontoFinalSumasHaber,2,',','.').'</td>';
                    echo '<td>'.number_format($vMontoFinalSaldosDebe,2,',','.').'</td>';
                    echo '<td>'.number_format($vMontoFinalSaldosHaber,2,',','.').'</td>';
                    echo '<td></td>';
                echo '</tr>';

                $vSumasDebe = $vSumasDebe + $vMontoFinalSumasDebe;
                $vSumasHaber = $vSumasHaber + $vMontoFinalSumasHaber;
                $vSaldosDebe = $vSaldosDebe + $vMontoFinalSaldosDebe;
                $vSaldosHaber =  $vSaldosHaber + $vMontoFinalSaldosHaber;*/

                $vTotalSaldoDebe = $vMontoFinalSaldosDebe;
                $vTotalSaldoHaber = $vMontoFinalSaldosHaber;
                                

                $vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);

            endfor;
        endif;
        
        $this->redirect('finances/sumsAndBalances/'.$vMonth);

        //if($this->vFinancesData->getVoucherInitialBalances($vCodChartOfAccount, $vVoucherType, $vCloseMonth) == 0){
            //$vCodVoucher = $this->vFinancesData->insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive);
            //echo 'success';
        //} else {
        //    echo 'exists';
        //}
    }    
}