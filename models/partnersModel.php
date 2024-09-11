<?php

class partnersModel extends IdEnModel
	{
		public function __construct(){
				parent::__construct();
			}

        /* BEGIN SELECT STATEMENT QUERY  */
        public function getPartners(){
            $vResultPartners = $this->vDataBase->query("SELECT tb_cdlu_partners.* FROM tb_cdlu_partners;");
            return $vResultPartners->fetchAll();
            $vResultPartners->close();            
        }
        public function getPartnersByShare(){
            $vResultPartners = $this->vDataBase->query("SELECT tb_cdlu_partners.n_categoria, COUNT(*) FROM tb_cdlu_partners GROUP BY tb_cdlu_partners.n_categoria;");
            return $vResultPartners->fetchAll();
            $vResultPartners->close();            
        }        
        /*public function getPartnersDebts(){
            $vResultPartners = $this->vDataBase->query("SELECT
            tb_cdlu_debts.n_codpartner,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_categoria,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
            tb_cdlu_debts.n_status
            FROM tb_cdlu_debts
            WHERE tb_cdlu_debts.n_status = 1
            GROUP BY tb_cdlu_debts.n_codpartner;");
            return $vResultPartners->fetchAll();
            $vResultPartners->close();            
        }*/
        public function getPartnersDebtsGroupByChartOfAccount(){
            $vResultPartners = $this->vDataBase->query("SELECT
            tb_cdlu_debts.n_codchartofaccounts,
            (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS n_chartofaccountname,
            (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS c_chartofaccountname
            FROM tb_cdlu_debts
            GROUP BY tb_cdlu_debts.n_codchartofaccounts;");
            return $vResultPartners->fetchAll();
            $vResultPartners->close();            
        }      
        public function getPartnersGroupDebts(){
            $vResultPartnersGroupDebts = $this->vDataBase->query("SELECT
tb_cdlu_debts.n_codpartner,
(SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
(SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_categoria,
(SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres
FROM tb_cdlu_debts
WHERE tb_cdlu_debts.n_status = 1
AND tb_cdlu_debts.n_active = 1
GROUP BY tb_cdlu_debts.n_codpartner");
            return $vResultPartnersGroupDebts->fetchAll();
            $vResultPartnersGroupDebts->close();            
        }
        public function getPartnersDebts(){
            $vResultPartners = $this->vDataBase->query("SELECT
            tb_cdlu_debts.n_coddebt,
            tb_cdlu_debts.n_codpartner,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_categoria,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
            tb_cdlu_debts.n_typedebt,
            tb_cdlu_debts.n_codchartofaccounts,
            (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS n_chartofaccountname,
            (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS c_chartofaccountname,
            tb_cdlu_debts.n_month,
            tb_cdlu_debts.c_debtdesc,
            tb_cdlu_debts.n_debttotal,
            tb_cdlu_debts.d_debtdate,
            tb_cdlu_debts.n_status
            FROM tb_cdlu_debts
            ORDER BY tb_cdlu_debts.n_codpartner;");
            return $vResultPartners->fetchAll();
            $vResultPartners->close();            
        }                        
        public function getPartner($vCodPartner){
            $vCodPartner = (int) $vCodPartner;
            $vResultPartner = $this->vDataBase->query("SELECT
                                                            tb_cdlu_partners.*
                                                        FROM tb_cdlu_partners
                                                            WHERE tb_cdlu_partners.n_codpartner = $vCodPartner;");
            return $vResultPartner->fetchAll();
            $vResultPartner->close();            
        }
        public function getVouchersFromCodPartner()
        {
            $vResultVouchersFromAccountSeat = $this->vDataBase->query("SELECT
            tb_cdlu_voucher.n_codvoucher,
            (SELECT tb_cdlu_accountingentries.c_accountingseatdesc FROM tb_cdlu_accountingentries WHERE tb_cdlu_accountingentries.n_codaccountingseat = tb_cdlu_voucher.n_codaccountingseat) AS c_accountingseatdesc,
            tb_cdlu_voucher.n_codpartner,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_voucher.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_voucher.n_codpartner) AS t_nombres,
            (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_chartofaccountname,
            (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS c_chartofaccountname,
            tb_cdlu_voucher.n_codbill,
            tb_cdlu_voucher.n_codreceipt,
            tb_cdlu_voucher.n_taccount,
            tb_cdlu_voucher.n_vouchertype,
            tb_cdlu_voucher.d_voucherdate,
            tb_cdlu_voucher.n_voucheramount,
            tb_cdlu_voucher.c_voucherdesc
        FROM tb_cdlu_voucher;");
            return $vResultVouchersFromAccountSeat->fetchAll();
            $vResultVouchersFromAccountSeat->close();
        }
        public function getDebt($vCodDebt){
            $vCodDebt = (int) $vCodDebt;
            $vResultPartner = $this->vDataBase->query("SELECT
            tb_cdlu_debts.*,
            (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS n_chartofaccountname,
            (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS c_chartofaccountname,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres
            FROM tb_cdlu_debts WHERE tb_cdlu_debts.n_coddebt = $vCodDebt;");
            return $vResultPartner->fetchAll();
            $vResultPartner->close();               
        }
        public function getCodPartnerFromDebt($vCodDebt){
            $vCodDebt = (int) $vCodDebt;
            $vResultPartner = $this->vDataBase->query("SELECT tb_cdlu_debts.n_codpartner FROM tb_cdlu_debts WHERE tb_cdlu_debts.n_coddebt = $vCodDebt;");
            return $vResultPartner->fetchColumn();
            $vResultPartner->close();               
        }
        public function getPartnerPayments(){
            $vResultPartnerPayments = $this->vDataBase->query("SELECT
tb_cdlu_annualpayments.n_codannualpayments,
tb_cdlu_annualpayments.n_management,
tb_cdlu_annualpayments.n_codpartner,
(SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_annualpayments.n_codpartner) AS n_numaccion,
(SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_annualpayments.n_codpartner) AS n_categoria,
(SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_annualpayments.n_codpartner) AS t_nombres,
tb_cdlu_annualpayments.n_typepayment,
tb_cdlu_annualpayments.n_codchartofaccounts,
(SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_annualpayments.n_codchartofaccounts) AS n_chartofaccountname,
(SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_annualpayments.n_codchartofaccounts) AS c_chartofaccountname,
tb_cdlu_annualpayments.c_descpayment,
tb_cdlu_annualpayments.n_payment,
tb_cdlu_annualpayments.n_status
FROM tb_cdlu_annualpayments;");
            return $vResultPartnerPayments->fetchAll();
            $vResultPartnerPayments->close();               
        }                
        public function getDebts(){
            $vResultDebts = $this->vDataBase->query("SELECT
            tb_cdlu_debts.*,
            (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS n_chartofaccountname,
            (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS c_chartofaccountname,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
            CASE
                WHEN tb_cdlu_debts.n_month = 1 THEN 'ENERO'
                WHEN tb_cdlu_debts.n_month = 2 THEN 'FEBRERO'
                WHEN tb_cdlu_debts.n_month = 3 THEN 'MARZO'
                WHEN tb_cdlu_debts.n_month = 4 THEN 'ABRIL'
                WHEN tb_cdlu_debts.n_month = 5 THEN 'MAYO'
                WHEN tb_cdlu_debts.n_month = 6 THEN 'JUNIO'
                WHEN tb_cdlu_debts.n_month = 7 THEN 'JULIO'
                WHEN tb_cdlu_debts.n_month = 8 THEN 'AGOSTO'
                WHEN tb_cdlu_debts.n_month = 9 THEN 'SEPTIEMBRE'
                WHEN tb_cdlu_debts.n_month = 10 THEN 'OCTUBRE'
                WHEN tb_cdlu_debts.n_month = 11 THEN 'NOVIEMBRE'
                WHEN tb_cdlu_debts.n_month = 12 THEN 'DICIEMBRE'
            END AS c_monthname
            FROM tb_cdlu_debts
            WHERE tb_cdlu_debts.n_status = 1;");
            return $vResultDebts->fetchAll();
            $vResultDebts->close();            
        }

        public function getTotalDebts(){
            $vResultDebts = $this->vDataBase->query("SELECT
  tb_cdlu_debts.n_coddebt,
  tb_cdlu_debts.n_codpartner,
  (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
  (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_categoria,
  (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
  tb_cdlu_debts.n_typedebt,
  tb_cdlu_debts.n_codchartofaccounts,
  (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS n_chartofaccountname,
  (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_debts.n_codchartofaccounts) AS c_chartofaccountname,
  tb_cdlu_debts.n_month,
  CASE
      WHEN tb_cdlu_debts.n_month = 1 THEN 'ENERO'
      WHEN tb_cdlu_debts.n_month = 2 THEN 'FEBRERO'
      WHEN tb_cdlu_debts.n_month = 3 THEN 'MARZO'
      WHEN tb_cdlu_debts.n_month = 4 THEN 'ABRIL'
      WHEN tb_cdlu_debts.n_month = 5 THEN 'MAYO'
      WHEN tb_cdlu_debts.n_month = 6 THEN 'JUNIO'
      WHEN tb_cdlu_debts.n_month = 7 THEN 'JULIO'
      WHEN tb_cdlu_debts.n_month = 8 THEN 'AGOSTO'
      WHEN tb_cdlu_debts.n_month = 9 THEN 'SEPTIEMBRE'
      WHEN tb_cdlu_debts.n_month = 10 THEN 'OCTUBRE'
      WHEN tb_cdlu_debts.n_month = 11 THEN 'NOVIEMBRE'
      WHEN tb_cdlu_debts.n_month = 12 THEN 'DICIEMBRE'
  END AS c_monthname,
  tb_cdlu_debts.c_debtdesc,
  tb_cdlu_debts.n_codvoucher,
  (SELECT tb_cdlu_voucher.n_voucheramount FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codvoucher = tb_cdlu_debts.n_codvoucher) AS n_voucheramount,
  (SELECT tb_cdlu_voucher.n_codaccountingseat FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codvoucher = tb_cdlu_debts.n_codvoucher) AS n_codaccountingseat,
  tb_cdlu_debts.n_debttotal,
  tb_cdlu_debts.d_debtdate,
  tb_cdlu_debts.n_status
FROM tb_cdlu_debts
  ORDER BY tb_cdlu_debts.n_codpartner;");
            return $vResultDebts->fetchAll();
            $vResultDebts->close();            
        }        

        public function getPartnersType($vPartnerType){
            $vPartnerType = (int) $vPartnerType;
            $vResultPartnersType = $this->vDataBase->query("SELECT * FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_typedebt = $vPartnerType;");
            return $vResultPartnersType->fetchAll();
            $vResultPartnersType->close();            
        }

        public function getPartnersDebt($vCodPartner){
            $vCodPartner = (int) $vCodPartner;
            $vResultPartnersDebt = $this->vDataBase->query("SELECT
            tb_cdlu_debts.n_coddebt,
            tb_cdlu_debts.n_typedebt,
            tb_cdlu_debts.c_debtdesc,
            tb_cdlu_debts.n_debttotal,
            tb_cdlu_debts.d_debtdate,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
            tb_cdlu_debts.n_month,
            tb_cdlu_debts.n_status
            FROM tb_cdlu_debts
            WHERE tb_cdlu_debts.n_codpartner = $vCodPartner
            AND tb_cdlu_debts.n_status = 1
            AND tb_cdlu_debts.n_active = 1;");
            return $vResultPartnersDebt->fetchAll();
            $vResultPartnersDebt->close();            
        }

        public function getRecordDebtPartner($vCodPartner){
            $vCodPartner = (int) $vCodPartner;
            $vResultPartnersDebt = $this->vDataBase->query("SELECT
            tb_cdlu_debts.n_coddebt,
            tb_cdlu_debts.n_typedebt,
            tb_cdlu_debts.c_debtdesc,
            tb_cdlu_debts.n_debttotal,
            tb_cdlu_debts.d_debtdate,
            (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS n_numaccion,
            (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_debts.n_codpartner) AS t_nombres,
            tb_cdlu_debts.n_month,
            tb_cdlu_debts.n_status
            FROM tb_cdlu_debts
            WHERE tb_cdlu_debts.n_codpartner = $vCodPartner;");
            return $vResultPartnersDebt->fetchAll();
            $vResultPartnersDebt->close();            
        } 
        
        public function getRecordFinancesPartner($vCodPartner){
            $vCodPartner = (int) $vCodPartner;
            $vResultPartnersDebt = $this->vDataBase->query("SELECT
            tb_cdlu_voucher.n_codvoucher,
            tb_cdlu_voucher.n_codaccountingseat,
            tb_cdlu_voucher.n_codpartner,
            tb_cdlu_voucher.n_codbill,
            (SELECT CONCAT(tb_cdlu_bills.n_numbill,'; ',tb_cdlu_bills.c_namepartner,'; ',tb_cdlu_bills.n_totalbill,'; ',tb_cdlu_bills.d_datebill) FROM tb_cdlu_bills WHERE tb_cdlu_bills.n_codbill = tb_cdlu_voucher.n_codbill) AS c_data_bill,
            tb_cdlu_voucher.n_codchartofaccounts,
            tb_cdlu_chartofaccount.n_chartofaccountname,
            tb_cdlu_chartofaccount.c_chartofaccountname,
            tb_cdlu_voucher.n_taccount,
            tb_cdlu_voucher.n_vouchertype,
            tb_cdlu_voucher.d_voucherdate,
            tb_cdlu_voucher.n_voucheramount,
            tb_cdlu_voucher.c_voucherdesc,
            tb_cdlu_voucher.n_status,
            tb_cdlu_voucher.n_active
        FROM tb_cdlu_chartofaccount, tb_cdlu_voucher
            WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts
                AND tb_cdlu_voucher.n_codpartner = $vCodPartner;");
            return $vResultPartnersDebt->fetchAll();
            $vResultPartnersDebt->close();            
        }        
        
		public function insertPartner($vCodUser,$vNumAccion,$vCategoria,$vFechaIngreso,$vNombres,$vFechaNacimiento,$vCarnetIdentidad, $vSexo, $vCelular, $vMail, $vCiudad, $vNombreNit, $vNIT, $vStatus, $vActive){
            
            $vCodUser = (int) $vCodUser;
            $vNumAccion = (int) $vNumAccion;
            $vCategoria = (int) $vCategoria;
            $vFechaIngreso = $vFechaIngreso;
            $vNombres = (string) $vNombres;
            $vFechaNacimiento =$vFechaNacimiento;
            $vCarnetIdentidad = (string) $vCarnetIdentidad;
            $vSexo = (int) $vSexo;
            $vCelular = (int) $vCelular;
            $vMail = (string) $vMail;
            $vCiudad = (int) $vCiudad;
            $vNombreNit = (string) $vNombreNit;
            $vNIT = (string) $vNIT;
            $vStatus = (int) $vStatus;
            $vActive = (int) $vActive;

            $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
            $vDateCreate = date("Y-m-d H:i:s", time());         

            $vResultRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_partners(n_coduser,n_numaccion,n_categoria,d_fechaingreso,t_nombres,d_fechanacimiento,t_carnetidentidad,n_sexo,n_celular,t_mail,n_ciudad,t_nombrenit,t_nit,n_status,n_active,c_usercreate,d_datecreate)
                                                            VALUES(:n_coduser,:n_numaccion,:n_categoria,:d_fechaingreso,:t_nombres,:d_fechanacimiento,:t_carnetidentidad,:n_sexo,:n_celular,:t_mail,:n_ciudad,:t_nombrenit,:t_nit,:n_status,:n_active,:c_usercreate,:d_datecreate);")
                            ->execute(
                                    array(
                                        ':n_coduser' => $vCodUser,
                                        ':n_numaccion' => $vNumAccion,
                                        ':n_categoria' => $vCategoria,
                                        ':d_fechaingreso' => $vFechaIngreso,
                                        ':t_nombres' => $vNombres,
                                        ':d_fechanacimiento' => $vFechaNacimiento,
                                        ':t_carnetidentidad' => $vCarnetIdentidad,
                                        ':n_sexo' => $vSexo,
                                        ':n_celular' => $vCelular,
                                        ':t_mail' => $vMail,
                                        ':n_ciudad' => $vCiudad,
                                        ':t_nombrenit' => $vNombreNit,
                                        ':t_nit' => $vNIT,
                                        ':n_status' => $vStatus,
                                        ':n_active' => $vActive,
                                        ':c_usercreate' => $vUserCreate,
                                        ':d_datecreate' => $vDateCreate
                                    ));
            return $vResultRegister = $this->vDataBase->lastInsertId();
            $vResultRegister->close();
        }
        
		public function insertDebt($vCodPartner,$vCodChartOfAccount,$vTypeDebt,$vMonth,$vDateDebt,$vAmountDebt,$vDescDebt,$vState,$vActive){
            
            $vCodUser = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
            $vCodPartner = (int) $vCodPartner;
            $vCodChartOfAccount = (int) $vCodChartOfAccount;
            $vTypeDebt = (int) $vTypeDebt;
            $vMonth = (int) $vMonth;
            $vDateDebt = $vDateDebt;
            $vAmountDebt = $vAmountDebt;
            $vDescDebt = (string) $vDescDebt;
            $vState = (int) $vState;
            $vActive = (int) $vActive;

            $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
            $vDateCreate = date("Y-m-d H:i:s", time());

            $vResultRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_debts(n_coduser, n_codpartner, n_typedebt, n_codchartofaccounts, n_month, c_debtdesc, n_debttotal, d_debtdate, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_coduser, :n_codpartner, :n_typedebt, :n_codchartofaccounts, :n_month, :c_debtdesc, :n_debttotal, :d_debtdate, :n_status, :n_active, :c_usercreate, :d_datecreate);")
                            ->execute(
                                    array(
                                        ':n_coduser' => $vCodUser,
                                        ':n_codpartner' => $vCodPartner,
                                        ':n_typedebt' => $vTypeDebt,
                                        ':n_codchartofaccounts' => $vCodChartOfAccount,                                                                                
                                        ':n_month' => $vMonth,
                                        ':c_debtdesc' => $vDescDebt,
                                        ':n_debttotal' => $vAmountDebt,
                                        ':d_debtdate' => $vDateDebt,
                                        ':n_status' => $vState,
                                        ':n_active' => $vActive,
                                        ':c_usercreate' => $vUserCreate,
                                        ':d_datecreate' => $vDateCreate
                                    ));
            return $vResultRegister = $this->vDataBase->lastInsertId();
            $vResultRegister->close();
        }

		public function insertPartnerDebt($vCodDebt, $vCodPartner, $vMonth, $vState, $vActive){
            
            $vCodUser = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');;
            $vCodDebt = (int) $vCodDebt;
            $vCodPartner = (int) $vCodPartner;
            $vMonth = (int) $vMonth;
            $vState = (int) $vState;
            $vActive = (int) $vActive;

            $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
            $vDateCreate = date("Y-m-d H:i:s", time());

            $vResultRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_partnerdebts(n_coduser, n_coddebt, n_codpartner, n_month, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_coduser, :n_coddebt, :n_codpartner, :n_month, :n_status, :n_active, :c_usercreate, :d_datecreate);")
                            ->execute(
                                    array(
                                        ':n_coduser' => $vCodUser,
                                        ':n_coddebt' => $vCodDebt,
                                        ':n_codpartner' => $vCodPartner,
                                        ':n_month' => $vMonth,
                                        ':n_status' => $vState,
                                        ':n_active' => $vActive,
                                        ':c_usercreate' => $vUserCreate,
                                        ':d_datecreate' => $vDateCreate
                                    ));
            return $vResultRegister = $this->vDataBase->lastInsertId();
            $vResultRegister->close();
        }        
    /* BEGIN DELETE STATEMENT QUERY  */

        /* BEGIN UPDATE STATEMENT QUERY  */    
		public function updatePayOutOffDebt($vCodDebt, $vCodVoucher, $vStatus)
            {
                $vCodDebt = (int) $vCodDebt;
                $vCodVoucher = (int) $vCodVoucher;
                $vStatus = (int) $vStatus;
            
                $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
                $vDateMod = date("Y-m-d H:i:s", time());
            
                $vResultUpdatePayOutOffDebt = $this->vDataBase->prepare("UPDATE
                                                                            tb_cdlu_debts
                                                                        SET tb_cdlu_debts.n_codvoucher = :n_codvoucher,
                                                                            tb_cdlu_debts.n_status = :n_status,
                                                                            tb_cdlu_debts.c_usermod = :c_usermod,
                                                                            tb_cdlu_debts.d_datemod = :d_datemod
                                                                        WHERE tb_cdlu_debts.n_coddebt = :n_coddebt;")
                                                        ->execute(
                                                                    array(
                                                                        ':n_codvoucher'=>$vCodVoucher,
                                                                        ':n_status'=>$vStatus,
                                                                        ':c_usermod'=>$vUserMod,
                                                                        ':d_datemod'=>$vDateMod,
                                                                        ':n_coddebt'=>$vCodDebt
                                                                        )
                                                                );
                return $vResultUpdatePayOutOffDebt;
                $vResultUpdatePayOutOffDebt->close();
			}    
        /* END UPDATE STATEMENT QUERY  */     

    public function deletePartner($vCodPartner)
    {
        $vCodPartner = (int) $vCodPartner;

        $this->vDataBase->query("DELETE FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = $vCodPartner;");
    }
    /* END DELETE STATEMENT QUERY  */        
    }    
?>