<?Php

class selectController extends IdEnController
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

        $this->vCodProfileLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'ProfileCode');
        $this->vCodUserLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');        

        $this->vCtrl = $this->LoadModel('ctrl');
        $this->vMenuData = $this->LoadModel('menu');
        $this->vUsersData = $this->LoadModel('users');
        $this->vPartnerData = $this->LoadModel('partners');
        $this->vFinancesData = $this->LoadModel('finances');

        /**********************************/
        /* BEGIN AUTHENTICATE USER ACTIVE */
        /**********************************/

        $this->vView->vSubNavContent = '';
    }

    public function index()
    {
        $this->vView->visualize('index');
    }

    public function dataFromExcel()
    {
        $this->DataDataFromExcel = $this->vCtrl->getDataFromExcel();
        foreach ($this->DataDataFromExcel as $row) {
            $data[] = array(
                "a" => $row['a'],
                "b" => $row['b'],
                "c" => $row['c'],
                "d" => $row['d'],
                "e" => $row['e'],
                "f" => $row['f'],
                "g" => $row['g'],
                "h" => $row['h'],
                /*"i"=>$row['i'],
            "j"=>$row['j'],
            "k"=>$row['k'],
            "l"=>$row['l'],
            "m"=>$row['m'],
            "n"=>$row['n'],
            "o"=>$row['o'],
            "p"=>$row['p'],
            "q"=>$row['q'],
            "r"=>$row['r'],
            "s"=>$row['s'],
            "t"=>$row['t'],
            "u"=>$row['u'],
            "v"=>$row['v'],
            "w"=>$row['w'],
            "x"=>$row['x'],
            "y"=>$row['y'],
            "z"=>$row['z']*/
            );
        }

        $dataset = array(
            "draw" => 1,
            "totalrecords" => count($data),
            "totaldisplayrecords" => count($data),
            "data" => $data,
        );

        echo json_encode($dataset);
    }

    public function dataMenuSide()
    {
        $this->DataListMenu = $this->vMenuData->getListMenu();
        foreach ($this->DataListMenu as $row) {
            $data[] = array(
                "n_codmenu" => $row['n_codmenu'],
                "n_level1" => $row['n_level1'],
                "n_level2" => $row['n_level2'],
                "n_level3" => $row['n_level3'],
                "n_level4" => $row['n_level4'],
                "c_controlleractive" => $row['c_controlleractive'],
                "c_title" => $row['c_title'],
                "n_parent" => $row['n_parent'],
                "c_menutype" => $row['c_menutype'],
                "n_positionmenu" => $row['n_positionmenu'],
                "c_url" => $row['c_url'],
                "n_session" => $row['n_session'],
                "n_active" => $row['n_active'],
            );
        }

        $dataset = array(
            "draw" => 1,
            "totalrecords" => count($data),
            "totaldisplayrecords" => count($data),
            "data" => $data,
        );

        echo json_encode($dataset);
    }

    public function dataUsers()
    {
        $this->DataListUsers = $this->vUsersData->getUsers();
        foreach ($this->DataListUsers as $row) {
            $data[] = array(
                "n_coduser" => $row['n_coduser'],
                "c_rrss_id" => $row['c_rrss_id'],
                "c_username" => $row['c_username'],
                "c_pass1" => $row['c_pass1'],
                "c_pass2" => $row['c_pass2'],
                "c_email" => $row['c_email'],
                "c_userrole" => $row['c_userrole'],
                "n_tnc" => $row['n_tnc'],
                "n_activationcode" => $row['n_activationcode'],
                "n_status" => $row['n_status'],
                "n_active" => $row['n_active'],
                "n_codprofile" => $row['n_codprofile'],
                "c_profile_img" => '<span class="symbol symbol-lg-35 symbol-25 symbol-light-success"><div class="symbol-label" style="background-image:url(' . $vParamsViewBackEndLayout['root_backend_media_users'] . 'directory_' . $this->vDataUsers[$i]['n_codprofile'] . '/' . $row['c_profile_img'] . ')"></div></span></strong>',
            );
        }

        $dataset = array(
            "draw" => 1,
            "totalrecords" => count($data),
            "totaldisplayrecords" => count($data),
            "data" => $data,
        );

        echo json_encode($dataset);
    }

    public function dataChartOfAccount(){
        $this->DataListChartOfAccount = $this->vFinancesData->getChartOfAccountList();
        foreach ($this->DataListChartOfAccount as $row) {
            $data[] = array(
                "n_codchartofaccounts"=>$row['n_codchartofaccounts'],
                "n_chartofaccountname"=>$row['n_chartofaccountname'],
                "c_chartofaccountname"=>$row['c_chartofaccountname'],
                "n_taccount"=>$row['n_taccount'],
                "n_active"=>$row['n_active'],                  
                );
            }


            $dataset = array(
                "draw" => 1,
                "totalrecords" => count($data),
                "totaldisplayrecords" => count($data),
                "data" => $data
            );
            
            echo json_encode($dataset);
        }    

    public function dataPartners()
    {
        $this->DataPartners = $this->vPartnerData->getPartners();
        foreach ($this->DataPartners as $row) {
            $data[] = array(               
                "n_codpartner" => $row['n_codpartner'],
                "n_numaccion" => $row['n_numaccion'],
                "n_categoria" => $row['n_categoria'],
                "d_fechaingreso" => $row['d_fechaingreso'],
                "t_nombres" => $row['t_nombres'],
                "d_fechanacimiento" => $row['d_fechanacimiento'],
                "t_carnetidentidad" => $row['t_carnetidentidad'],
                "n_sexo" => $row['n_sexo'],
                "n_celular" => $row['n_celular'],
                "t_mail" => $row['t_mail'],
                "n_ciudad" => $row['n_ciudad'],
                "t_nombrenit" => $row['t_nombrenit'],
                "t_nit" => $row['t_nit'],
                "n_status" => $row['n_status'],
                "n_active" => $row['n_active'],
            );
        }

        $dataset = array(
            "draw" => 1,
            "totalrecords" => count($data),
            "totaldisplayrecords" => count($data),
            "data" => $data,
        );

        echo json_encode($dataset);
    }
    
    public function dataBills(){
        $this->DataListBills = $this->vFinancesData->getBills();
        foreach ($this->DataListBills as $row) {
            $data[] = array(
                "n_codbill"=>$row['n_codbill'],
                "n_numbill"=>$row['n_numbill'],
                "n_codpartner"=>$row['n_codpartner'],
                "c_namepartner"=>$row['c_namepartner'],
                "n_totalbill"=>$row['n_totalbill'],
                "d_datebill"=>$row['d_datebill'],
                "n_status"=>$row['n_status'],
                "n_active"=>$row['n_active'],                  
                );
            }


            $dataset = array(
                "draw" => 1,
                "totalrecords" => count($data),
                "totaldisplayrecords" => count($data),
                "data" => $data
            );
            
            echo json_encode($dataset);
        }
        public function dataVouchers($vState){
            $vCodUser = $this->vCodUserLogged;
            $vState = (int) $vState;
            $this->DataListVouchers = $this->vFinancesData->getVouchers($vCodUser, $vState);
            foreach ($this->DataListVouchers as $row) {
                $data[] = array(
                    "n_codvoucher"=>$row['n_codvoucher'],
                    "n_coduser"=>$row['n_coduser'],
                    "n_codpartner"=>$row['n_codpartner'],
                    "n_codbill"=>$row['n_codbill'],
                    "c_data_bill"=>$row['c_data_bill'],
                    "n_codchartofaccounts"=>$row['n_codchartofaccounts'],
                    "n_chartofaccountname"=>$row['n_chartofaccountname'],
                    "c_chartofaccountname"=>$row['c_chartofaccountname'],
                    "n_vouchertype"=>$row['n_vouchertype'],
                    "n_voucheramount"=>$row['n_voucheramount'],
                    "c_voucherdesc"=>$row['c_voucherdesc'],
                    "n_status"=>$row['n_status'],
                    "n_active"=>$row['n_active'],
                    );
                }
    
    
                $dataset = array(
                    "draw" => 1,
                    "totalrecords" => count($data),
                    "totaldisplayrecords" => count($data),
                    "data" => $data
                );
                
                echo json_encode($dataset);
            }
            
        public function dataMainAccountingBooks($vDate = null){

            /*if($vDate == null){
                $date = date("Y/m/d"); 
                $vMonth = date('m', strtotime($vDate));
                
                //$day = date('d', strtotime($date)); 
                //$month = date('m', strtotime($date)); 
                //$year = date('Y', strtotime($date)); 
                
            } else {
                $vMonth = date("m",strtotime($vDate));
            }*/

            $vMonth = '04';
            
            $this->DataListMainAccountingBooks = $this->vFinancesData->getMainAccountingBooks();
            foreach ($this->DataListMainAccountingBooks as $row) {
                $data[] = array(
                    "n_codchartofaccounts"=>$row['n_codchartofaccounts'],
                    "n_chartofaccountname"=>$row['n_chartofaccountname'],
                    "c_chartofaccountname"=>$row['c_chartofaccountname'],
                    "n_taccount"=>$row['n_taccount'],
                    "n_status"=>$row['n_status'],                  
                    );
                }
    
    
                $dataset = array(
                    "draw" => 1,
                    "totalrecords" => count($data),
                    "totaldisplayrecords" => count($data),
                    "data" => $data
                );

                echo json_encode($dataset);

            }
            
            public function dataDebts(){
            
                $this->DataListDebts = $this->vPartnerData->getDebts();
                foreach ($this->DataListDebts as $row) {                   
                    $data[] = array(
                        /*"n_coddebt"=>$row['n_coddebt'],
                        "n_codpartner"=>$row['n_codpartner'],
                        "n_numaccion"=>$row['n_numaccion'],
                        "t_nombres"=>$row['t_nombres'],
                        "n_codchartofaccounts"=>$row['n_codchartofaccounts'],
                        "n_chartofaccountname"=>$row['n_chartofaccountname'],
                        "c_chartofaccountname"=>$row['c_chartofaccountname'],
                        "n_typedebt"=>$row['n_typedebt'],                        
                        "n_month"=>$row['n_month'],
                        "d_debtdate"=>$row['d_debtdate'],
                        "n_debttotal"=>$row['n_debttotal'],
                        "c_debtdesc"=>$row['c_debtdesc'],
                        "n_status"=>$row['n_status'],*/
                        "n_coddebt"=>$row['n_coddebt'],
                        "n_codpartner"=>$row['n_numaccion'].' - '.$row['t_nombres'],
                        "n_codchartofaccounts"=>$row['n_chartofaccountname'].' - '.$row['c_chartofaccountname'],
                        "n_typedebt"=>$row['n_typedebt'],                        
                        "n_month"=>$row['n_month'],
                        "d_debtdate"=>$row['d_debtdate'],
                        "n_debttotal"=>$row['n_debttotal'],
                        "c_debtdesc"=>$row['c_debtdesc'],
                        "n_status"=>$row['n_status'],                        
                        );
                    }
        
        
                    $dataset = array(
                        "draw" => 1,
                        "totalrecords" => count($data),
                        "totaldisplayrecords" => count($data),
                        "data" => $data
                    );
    
                    echo json_encode($dataset);
    
            }

            public function dataSumsAndBalances(){
            
                $this->vDataListSumsAndBalances = $this->vFinancesData->getSumsAndBalances();
                $vCount = 1;
                foreach ($this->vDataListSumsAndBalances as $row) {
                    $data[] = array(
                        "n_num"=>$vCount,
                        "n_chartofaccountname"=>$row['n_chartofaccountname'],
                        "c_chartofaccountname"=>$row['c_chartofaccountname'],
                        "n_sumas_debe"=>$row['n_sumas_debe'],
                        "n_sumas_haber"=>$row['n_sumas_haber'],
                        "n_saldos_debe"=>$row['n_saldos_debe'],
                        "n_saldos_haber"=>$row['n_saldos_haber']
                        );
                    $vCount++;
                    }        
        
                    $dataset = array(
                        "draw" => 1,
                        "totalrecords" => count($data),
                        "totaldisplayrecords" => count($data),
                        "data" => $data
                    );
    
                    echo json_encode($dataset);
    
            }

            public function dataCorrelativeReceiptNumber(){
            
                $vCodTypeReceipt = (int) $_POST['vCodTypeReceipt'];
                $vReceiptNumber = $this->vFinancesData->getObtainCorrelativeReceiptNumber($vCodTypeReceipt) + 1;
                
                echo $vReceiptNumber;
    
            }
}
