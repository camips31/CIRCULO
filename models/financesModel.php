<?php

class financesModel extends IdEnModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /* BEGIN SELECT STATEMENT QUERY  */

    public function getTotalBankAmount()
    {
        $vResultTotalBankAmount = $this->vDataBase->query("SELECT
                                                                    (SELECT tb_cdlu_chartofaccount.n_chartofaccountname
                                                                        FROM tb_cdlu_chartofaccount 
                                                                            WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_chartofaccountname,
                                                                    (SELECT tb_cdlu_chartofaccount.c_chartofaccountname
                                                                        FROM tb_cdlu_chartofaccount
                                                                            WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS c_chartofaccountname,
                                                                    SUM(tb_cdlu_voucher.n_voucheramount) AS n_amount
                                                                FROM tb_cdlu_voucher
                                                                    WHERE tb_cdlu_voucher.n_codchartofaccounts IN(12,14)
                                                                        GROUP BY tb_cdlu_voucher.n_codchartofaccounts;");
        return $vResultTotalBankAmount->fetchAll();
        $vResultTotalBankAmount->close();
    }

    public function getChartOfAccountDoubleMatch($vCodChartOfAccounts)
    {
        $vCodChartOfAccounts = (int) $vCodChartOfAccounts;
        $vResultChartOfAccountDoubleMatch = $this->vDataBase->query("SELECT tb_cdlu_chartofaccount.n_taccount FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = $vCodChartOfAccounts;");
        return $vResultChartOfAccountDoubleMatch->fetchColumn();
        $vResultChartOfAccountDoubleMatch->close();
    }    

    public function getChartOfAccountList()
    {
        $vResultChartOfAccountIni = $this->vDataBase->query("SELECT * FROM tb_cdlu_chartofaccount;");
        return $vResultChartOfAccountIni->fetchAll();
        $vResultChartOfAccountIni->close();
    }

    public function getMainAccountingBooks()
    {
        $vDate = (int) $vDate;
        $vResultMainAccountingBooks = $this->vDataBase->query("SELECT
                                                                    tb_cdlu_voucher.n_codchartofaccounts,
                                                                    tb_cdlu_voucher.d_voucherdate,
                                                                    (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_chartofaccountname,
                                                                    (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS c_chartofaccountname,
                                                                    (SELECT tb_cdlu_chartofaccount.n_taccount FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_taccount,
                                                                    (SELECT tb_cdlu_chartofaccount.n_status FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_status
                                                                FROM tb_cdlu_voucher
                                                                    /*WHERE MONTH(tb_cdlu_voucher.d_voucherdate) = $vDate*/
                                                                        GROUP BY tb_cdlu_voucher.n_codchartofaccounts;");
        return $vResultMainAccountingBooks->fetchAll();
        $vResultMainAccountingBooks->close();
    }
    
    public function getMainAccountingBook($vCodChartOfAccount, $vDate)
    {
        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vDate = (int) $vDate;
        $vResultMainAccountingBooks = $this->vDataBase->query("SELECT
                tb_cdlu_voucher.n_codchartofaccounts,
                tb_cdlu_voucher.n_codaccountingseat,
                (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_chartofaccountname,
                (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS c_chartofaccountname,
                tb_cdlu_voucher.n_voucheramount,
                tb_cdlu_voucher.c_voucherdesc,
                tb_cdlu_voucher.n_taccount,
                tb_cdlu_voucher.d_voucherdate,
                tb_cdlu_voucher.n_status
            FROM tb_cdlu_voucher
                WHERE MONTH(tb_cdlu_voucher.d_voucherdate) = $vDate
                    AND tb_cdlu_voucher.n_codchartofaccounts = $vCodChartOfAccount
                    AND tb_cdlu_voucher.n_status = 1
                        ORDER BY tb_cdlu_voucher.d_voucherdate ASC;");
        return $vResultMainAccountingBooks->fetchAll();
        $vResultMainAccountingBooks->close();
    }    

    public function getGroupMonthOfAccountingBook()
    {
        $vResultGroupMonthOfAccountingBook = $this->vDataBase->query("SELECT
                                                                            MONTH(tb_cdlu_accountingentries.d_accountingseatdate) AS n_month,
                                                                            CASE
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 1 THEN 'ENERO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 2 THEN 'FEBRERO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 3 THEN 'MARZO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 4 THEN 'ABRIL'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 5 THEN 'MAYO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 6 THEN 'JUNIO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 7 THEN 'JULIO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 8 THEN 'AGOSTO'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 9 THEN 'SEPTIEMBRE'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 10 THEN 'OCTUBRE'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 11 THEN 'NOVIEMBRE'
                                                                                WHEN MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = 12 THEN 'DICIEMBRE'
                                                                            END AS c_monthname
                                                                        FROM tb_cdlu_accountingentries
                                                                            GROUP BY MONTH(tb_cdlu_accountingentries.d_accountingseatdate);");
        return $vResultGroupMonthOfAccountingBook->fetchAll();
        $vResultGroupMonthOfAccountingBook->close();
    }

    public function getChartOfAccount($vCodeChartofAccount)
    {
        $vCodeChartofAccount = (int) $vCodeChartofAccount;
        $vResultChartOfAccount = $this->vDataBase->query("SELECT * FROM tb_cdlu_chartofaccount WHERE n_codchartofaccounts = $vCodeChartofAccount;");
        return $vResultChartOfAccount->fetchAll();
        $vResultChartOfAccount->close();
    }    

    public function getTAccountFromChartOfAccount($vCodeChartofAccount)
    {
        $vCodeChartofAccount = (int) $vCodeChartofAccount;
        $vResultTAccountFromChartOfAccount = $this->vDataBase->query("SELECT tb_cdlu_chartofaccount.n_taccount FROM tb_cdlu_chartofaccount WHERE n_codchartofaccounts = $vCodeChartofAccount;");
        return $vResultTAccountFromChartOfAccount->fetchColumn();
        $vResultTAccountFromChartOfAccount->close();
    }
    
    public function getTAccountFromVoucher($vCodeChartofAccount)
    {
        $vCodeChartofAccount = (int) $vCodeChartofAccount;
        $vResultTAccountFromChartOfAccount = $this->vDataBase->query("SELECT tb_cdlu_voucher.n_taccount FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codchartofaccounts = $vCodeChartofAccount;");
        return $vResultTAccountFromChartOfAccount->fetchColumn();
        $vResultTAccountFromChartOfAccount->close();
    }    
    
    public function getNumChartOfAccount($vCodeChartofAccount)
    {
        $vCodeChartofAccount = (int) $vCodeChartofAccount;
        $vResultTAccountFromChartOfAccount = $this->vDataBase->query("SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE n_codchartofaccounts = $vCodeChartofAccount;");
        return $vResultTAccountFromChartOfAccount->fetchColumn();
        $vResultTAccountFromChartOfAccount->close();
    }     

    public function getBills()
    {
        $vResultBills = $this->vDataBase->query("SELECT * FROM tb_cdlu_bills;");
        return $vResultBills->fetchAll();
        $vResultBills->close();
    }

    public function getCurrentMonthlyBilling($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultCurrentMonthlyBilling = $this->vDataBase->query("SELECT * FROM tb_cdlu_bills WHERE MONTH(tb_cdlu_bills.d_datebill) = $vMonth;");
        return $vResultCurrentMonthlyBilling->fetchAll();
        $vResultCurrentMonthlyBilling->close();
    }
    
    public function getCurrentMonthlyReceipts($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultCurrentMonthlyReceipts = $this->vDataBase->query("SELECT * FROM tb_cdlu_receipts WHERE MONTH(tb_cdlu_receipts.d_datereceipt) = $vMonth;");
        return $vResultCurrentMonthlyReceipts->fetchAll();
        $vResultCurrentMonthlyReceipts->close();
    }    

    public function getBillsForVouchers()
    {
        $vResultBillsForVouchers = $this->vDataBase->query("SELECT *
        FROM tb_cdlu_bills
        WHERE tb_cdlu_bills.n_codbill NOT IN(SELECT tb_cdlu_voucher.n_codbill FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codbill <> 0 GROUP BY tb_cdlu_voucher.n_codbill);");
        return $vResultBillsForVouchers->fetchAll();
        $vResultBillsForVouchers->close();
    }

    public function getObtainCorrelativeReceiptNumber($vCodTypeReceipt)
    {
        $vCodTypeReceipt = (int) $vCodTypeReceipt;
        $vResultCorrelativeReceiptNumber = $this->vDataBase->query("SELECT MAX(tb_cdlu_receipts.n_numreceipt) FROM tb_cdlu_receipts WHERE tb_cdlu_receipts.n_typereceipt = $vCodTypeReceipt;");
        return $vResultCorrelativeReceiptNumber->fetchColumn();
        $vResultCorrelativeReceiptNumber->close();
    }    

    public function getTotalAmountBills()
    {
        $vResultBills = $this->vDataBase->query("SELECT SUM(tb_cdlu_bills.n_totalbill) FROM tb_cdlu_bills;");
        return $vResultBills->fetchColumn();
        $vResultBills->close();
    }

    public function getCurrentMonthTotalAmountBills($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultCurrentMonthTotalAmountBills = $this->vDataBase->query("SELECT SUM(tb_cdlu_bills.n_totalbill) FROM tb_cdlu_bills WHERE MONTH(tb_cdlu_bills.d_datebill) = $vMonth;");
        return $vResultCurrentMonthTotalAmountBills->fetchColumn();
        $vResultCurrentMonthTotalAmountBills->close();
    }

    public function getCurrentMonthTotalAmountReceipts($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultCurrentMonthTotalAmountReceipts = $this->vDataBase->query("SELECT SUM(tb_cdlu_receipts.n_totalreceipt) FROM tb_cdlu_receipts WHERE MONTH(tb_cdlu_receipts.d_datereceipt) = $vMonth;");
        return $vResultCurrentMonthTotalAmountReceipts->fetchColumn();
        $vResultCurrentMonthTotalAmountReceipts->close();
    }

    public function getTotalAccountingEntries($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultTotalAccountingEntries = $this->vDataBase->query("SELECT COUNT(*)
                                                    FROM tb_cdlu_accountingentries
                                                        WHERE tb_cdlu_accountingentries.n_status = 1
                                                            AND MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = $vMonth;");
        return $vResultTotalAccountingEntries->fetchColumn();
        $vResultTotalAccountingEntries->close();
    }    
    public function getReceipts($vCodUser)
    {
        $vCodUser = (int) $vCodUser;
        $vResultReceipts = $this->vDataBase->query("SELECT
                                                        tb_cdlu_receipts.n_codreceipt,
                                                        IFNULL((SELECT tb_cdlu_voucher.n_codvoucher FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codreceipt = tb_cdlu_receipts.n_codreceipt AND tb_cdlu_voucher.n_status = 0), 0)AS n_codvoucher,
                                                        tb_cdlu_receipts.n_coduser,
                                                        tb_cdlu_receipts.n_numreceipt,
                                                        tb_cdlu_receipts.n_typereceipt,
                                                        CASE
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 1 THEN 'Montos Iniciales'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 2 THEN 'Cuota Mensual'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 3 THEN 'Cuota Mortuoria'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 4 THEN 'Cuota Participación'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 5 THEN 'Cuota Ingreso'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 6 THEN 'Compra Libro'
                                                        END AS c_typereceipt,
                                                        tb_cdlu_receipts.n_codpartner,
                                                        (SELECT CONCAT(tb_cdlu_partners.n_numaccion,' - ',tb_cdlu_partners.t_nombres) FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS c_partner,
                                                        (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_numaccion,
                                                        (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS t_nombres,
                                                        (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_categoria,
                                                        CASE
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 1 THEN 'Activo Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 2 THEN 'Emérito Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 3 THEN 'Corporativo'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 4 THEN 'Activo Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 5 THEN 'Emérito Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 6 THEN 'Especial'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 7 THEN 'Diplomático'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 8 THEN 'Congelado'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 9 THEN 'Exento'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 10 THEN 'Concesionario'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 11 THEN 'Emérito No Aportante'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 12 THEN 'Exento'
                                                        END AS c_categoria,
                                                        tb_cdlu_receipts.n_totalreceipt,
                                                        tb_cdlu_receipts.d_datereceipt,
                                                        tb_cdlu_receipts.c_descreceipt,
                                                        tb_cdlu_receipts.n_status,
                                                        tb_cdlu_receipts.c_usercreate,
                                                        tb_cdlu_receipts.d_datecreate
                                                    FROM tb_cdlu_receipts
                                                        WHERE tb_cdlu_receipts.n_coduser = $vCodUser
                                                            ORDER BY tb_cdlu_receipts.n_numreceipt DESC;");
        return $vResultReceipts->fetchAll();
        $vResultReceipts->close();
    }
    public function getReceiptsList()
    {
        $vResultReceipts = $this->vDataBase->query("SELECT
                                                        tb_cdlu_receipts.n_codreceipt,
                                                        /*IFNULL((SELECT tb_cdlu_voucher.n_codvoucher FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codreceipt = tb_cdlu_receipts.n_codreceipt AND tb_cdlu_voucher.n_status = 0), 0)AS n_codvoucher,*/
                                                        tb_cdlu_receipts.n_coduser,
                                                        tb_cdlu_receipts.n_numreceipt,
                                                        tb_cdlu_receipts.n_typereceipt,
                                                        CASE
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 1 THEN 'Montos Iniciales'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 2 THEN 'Cuota Mensual'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 3 THEN 'Cuota Mortuoria'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 4 THEN 'Cuota Participación'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 5 THEN 'Cuota Ingreso'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 6 THEN 'Compra Libro'
                                                        END AS c_typereceipt,
                                                        tb_cdlu_receipts.n_codpartner,
                                                        (SELECT CONCAT(tb_cdlu_partners.n_numaccion,' - ',tb_cdlu_partners.t_nombres) FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS c_partner,
                                                        (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_numaccion,
                                                        (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS t_nombres,
                                                        (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_categoria,
                                                        CASE
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 1 THEN 'Activo Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 2 THEN 'Emérito Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 3 THEN 'Corporativo'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 4 THEN 'Activo Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 5 THEN 'Emérito Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 6 THEN 'Especial'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 7 THEN 'Diplomático'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 8 THEN 'Congelado'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 9 THEN 'Exento'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 10 THEN 'Concesionario'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 11 THEN 'Emérito No Aportante'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 12 THEN 'Exento'
                                                        END AS c_categoria,
                                                        tb_cdlu_receipts.n_totalreceipt,
                                                        tb_cdlu_receipts.d_datereceipt,
                                                        tb_cdlu_receipts.c_descreceipt,
                                                        tb_cdlu_receipts.n_status,
                                                        tb_cdlu_receipts.c_usercreate,
                                                        tb_cdlu_receipts.d_datecreate
                                                    FROM tb_cdlu_receipts
                                                        ORDER BY tb_cdlu_receipts.n_numreceipt DESC;");
        return $vResultReceipts->fetchAll();
        $vResultReceipts->close();
    }
    public function getReceipt($vCodReceipt)
    {
        $vCodReceipt = (int) $vCodReceipt;
        $vResultReceipts = $this->vDataBase->query("SELECT
                                                        tb_cdlu_receipts.n_codreceipt,
                                                        IFNULL((SELECT tb_cdlu_voucher.n_codvoucher FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codreceipt = tb_cdlu_receipts.n_codreceipt), 0)AS n_codvoucher,
                                                        tb_cdlu_receipts.n_coduser,
                                                        tb_cdlu_receipts.n_numreceipt,
                                                        tb_cdlu_receipts.n_typereceipt,
                                                        CASE
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 1 THEN 'Montos Iniciales'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 2 THEN 'Cuota Mensual'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 3 THEN 'Cuota Mortuoria'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 4 THEN 'Cuota Participación'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 5 THEN 'Cuota Ingreso'
                                                            WHEN tb_cdlu_receipts.n_typereceipt = 6 THEN 'Compra Libro'
                                                        END AS c_typereceipt,
                                                        tb_cdlu_receipts.n_codpartner,
                                                        (SELECT CONCAT(tb_cdlu_partners.n_numaccion,' - ',tb_cdlu_partners.t_nombres) FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS c_partner,
                                                        (SELECT tb_cdlu_partners.n_numaccion FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_numaccion,
                                                        (SELECT tb_cdlu_partners.t_nombres FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS t_nombres,
                                                        (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) AS n_categoria,
                                                        CASE
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 1 THEN 'Activo Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 2 THEN 'Emérito Presente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 3 THEN 'Corporativo'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 4 THEN 'Activo Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 5 THEN 'Emérito Ausente'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 6 THEN 'Especial'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 7 THEN 'Diplomático'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 8 THEN 'Congelado'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 9 THEN 'Exento'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 10 THEN 'Concesionario'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 11 THEN 'Emérito No Aportante'
                                                            WHEN (SELECT tb_cdlu_partners.n_categoria FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_receipts.n_codpartner) = 12 THEN 'Exento'
                                                        END AS c_categoria,
                                                        tb_cdlu_receipts.n_totalreceipt,
                                                        tb_cdlu_receipts.d_datereceipt,
                                                        tb_cdlu_receipts.c_descreceipt,
                                                        tb_cdlu_receipts.n_status,
                                                        tb_cdlu_receipts.c_usercreate,
                                                        tb_cdlu_receipts.d_datecreate
                                                    FROM tb_cdlu_receipts
                                                        WHERE tb_cdlu_receipts.n_codreceipt = $vCodReceipt;");
        return $vResultReceipts->fetchAll();
        $vResultReceipts->close();
    }                
    public function getVouchers($vCodUser, $vState)
    {
        $vCodUser = (int) $vCodUser;
        $vState = (int) $vState;
        $vResultBills = $this->vDataBase->query("SELECT
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
                                                            AND tb_cdlu_voucher.n_coduser = $vCodUser AND tb_cdlu_voucher.n_status = $vState;");
        return $vResultBills->fetchAll();
        $vResultBills->close();
    }
    public function getVoucherList()
    {
        $vResultBills = $this->vDataBase->query("SELECT
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
                                                        WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts;");
        return $vResultBills->fetchAll();
        $vResultBills->close();
    }       
    public function getVoucher($vCodVoucher)
    {
        $vCodVoucher = (int) $vCodVoucher;
        $vResultVoucher = $this->vDataBase->query("SELECT
                                                        tb_cdlu_voucher.n_codvoucher,
                                                        tb_cdlu_voucher.n_codaccountingseat,
                                                        tb_cdlu_voucher.n_codpartner,
                                                        tb_cdlu_voucher.n_codbill,
                                                        (SELECT CONCAT(tb_cdlu_partners.n_numaccion,' - ',tb_cdlu_partners.t_nombres) FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_voucher.n_codpartner) AS c_partner,
                                                        (SELECT CONCAT(tb_cdlu_bills.n_numbill,' - ',tb_cdlu_bills.c_namepartner,' - ',tb_cdlu_bills.n_totalbill,' - ',tb_cdlu_bills.d_datebill) FROM tb_cdlu_bills WHERE tb_cdlu_bills.n_codbill = tb_cdlu_voucher.n_codbill) AS c_bill,
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
                                                            AND tb_cdlu_voucher.n_codvoucher = $vCodVoucher;");
        return $vResultVoucher->fetchAll();
        $vResultVoucher->close();
    }    
    public function getVoucherTAccount($vCodVoucher)
    {
        $vCodVoucher = (int) $vCodVoucher;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT tb_cdlu_voucher.n_taccount FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codvoucher = $vCodVoucher;");
        return $vResultVoucherTAccount->fetchColumn();
        $vResultVoucherTAccount->close();
    }
    public function getVouchersFromAccountSeat($vCodAccountSeat)
    {
        $vCodAccountSeat = (int) $vCodAccountSeat;
        $vResultVouchersFromAccountSeat = $this->vDataBase->query("SELECT
                                                                        tb_cdlu_voucher.n_codvoucher,
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
                                                                            AND tb_cdlu_voucher.n_codaccountingseat  = $vCodAccountSeat
                                                                            AND tb_cdlu_voucher.n_status = 1;");
        return $vResultVouchersFromAccountSeat->fetchColumn();
        $vResultVouchersFromAccountSeat->close();
    }        
    public function getAccountingEntries($vMonth)
    {
        $vMonth = (int) $vMonth;
        $vResultAccountingEntries = $this->vDataBase->query("SELECT *
                                                            FROM tb_cdlu_accountingentries
                                                                WHERE tb_cdlu_accountingentries.n_status = 1
                                                                    AND MONTH(tb_cdlu_accountingentries.d_accountingseatdate) = $vMonth
                                                                        ORDER BY tb_cdlu_accountingentries.d_accountingseatdate ASC;");
        return $vResultAccountingEntries->fetchAll();
        $vResultAccountingEntries->close();
    }
    public function getAccountingEntrie($vCodAccountingSeat)
    {
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT * FROM tb_cdlu_accountingentries WHERE tb_cdlu_accountingentries.n_codaccountingseat = $vCodAccountingSeat;");
        return $vResultVoucherTAccount->fetchAll();
        $vResultVoucherTAccount->close();
    }        
    public function getVouchersFromAccountingSeat($vCodAccountingSeat)
    {
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT
        tb_cdlu_voucher.*,
        (SELECT tb_cdlu_chartofaccount.n_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS n_chartofaccountname,
        (SELECT tb_cdlu_chartofaccount.c_chartofaccountname FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts) AS c_chartofaccountname,
        (SELECT CONCAT(tb_cdlu_partners.n_numaccion,' - ',tb_cdlu_partners.t_nombres) FROM tb_cdlu_partners WHERE tb_cdlu_partners.n_codpartner = tb_cdlu_voucher.n_codpartner) AS c_partner,
        (SELECT CONCAT(tb_cdlu_bills.n_numbill,' - ',tb_cdlu_bills.c_namepartner,' - ',tb_cdlu_bills.n_totalbill,' - ',tb_cdlu_bills.d_datebill) FROM tb_cdlu_bills WHERE tb_cdlu_bills.n_codbill = tb_cdlu_voucher.n_codbill) AS c_bill
        FROM tb_cdlu_voucher
        WHERE tb_cdlu_voucher.n_codaccountingseat = $vCodAccountingSeat");
        return $vResultVoucherTAccount->fetchAll();
        $vResultVoucherTAccount->close();
    }
    public function getSumsAndBalances($vMonth)
    {
        $vMonth = (int) $vMonth;
        //$vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT
        tb_cdlu_chartofaccount.n_codchartofaccounts,
        $vMonth AS n_month,
        tb_cdlu_chartofaccount.n_chartofaccountname,
        tb_cdlu_chartofaccount.c_chartofaccountname,
        tb_cdlu_chartofaccount.n_taccount,
        (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                FROM tb_cdlu_voucher
                    WHERE tb_cdlu_voucher.n_taccount = 1
                    AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                    AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0)) AS n_sumas_debe,
        (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                FROM tb_cdlu_voucher
                    WHERE tb_cdlu_voucher.n_taccount = 2
                    AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                    AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0)) AS n_sumas_haber,
        (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 1
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))>
            (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 2
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))),
            ((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 1
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))-
             (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 2
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))),0)) AS n_saldos_debe,
        (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                FROM tb_cdlu_voucher
                    WHERE tb_cdlu_voucher.n_taccount = 2
                    AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                    AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))>
             (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 1
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))),
             ((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 2
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))-
              (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                        FROM tb_cdlu_voucher
                        WHERE tb_cdlu_voucher.n_taccount = 1
                            AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts
                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth),0))),0)) AS n_saldos_haber
    FROM tb_cdlu_chartofaccount
        INNER JOIN tb_cdlu_voucher
            ON tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts
                GROUP BY tb_cdlu_chartofaccount.n_chartofaccountname, tb_cdlu_chartofaccount.c_chartofaccountname
                    ORDER BY tb_cdlu_chartofaccount.n_codchartofaccounts ASC;");
        return $vResultVoucherTAccount->fetchAll();
        $vResultVoucherTAccount->close();
    }
    public function getIncomeStatement($vCodReport,$vMonth)
    {
        $vCodReport = (int) $vCodReport;
        $vMonth = (int) $vMonth;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT
                                                                    tb_cdlu_chartofaccount.n_chartofaccountname,
                                                                    tb_cdlu_chartofaccount.c_chartofaccountname,
                                                                    (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                            FROM tb_cdlu_voucher
                                                                                WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0)) AS n_sumas_debe,
                                                                    (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                            FROM tb_cdlu_voucher
                                                                                WHERE tb_cdlu_voucher.n_taccount = 2
                                                                                AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0)) AS n_sumas_haber,
                                                                    (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))>
                                                                        (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 2
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),
                                                                        ((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))-(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),0)) AS n_saldos_debe,
                                                                    (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))>(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 1 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))-(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 1 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),0)) AS n_saldos_haber
                                                                FROM tb_cdlu_chartofaccount
                                                                    INNER JOIN tb_cdlu_voucher
                                                                        ON tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts
                                                                            WHERE tb_cdlu_chartofaccount.n_codnumreport = $vCodReport
                                                                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vMonth
                                                                            GROUP BY tb_cdlu_chartofaccount.n_chartofaccountname, tb_cdlu_chartofaccount.c_chartofaccountname
                                                                                ORDER BY tb_cdlu_chartofaccount.n_codchartofaccounts;");
        return $vResultVoucherTAccount->fetchAll();
        $vResultVoucherTAccount->close();
    }
    public function getAccountingBalance($vChartOfAccount)
    {
        $vChartOfAccount = (string) $vChartOfAccount;
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vResultVoucherTAccount = $this->vDataBase->query("SELECT
                                                                    tb_cdlu_chartofaccount.n_chartofaccountname,
                                                                    tb_cdlu_chartofaccount.c_chartofaccountname,
                                                                    (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                            FROM tb_cdlu_voucher
                                                                                WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0)) AS n_sumas_debe,
                                                                    (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                            FROM tb_cdlu_voucher
                                                                                WHERE tb_cdlu_voucher.n_taccount = 2
                                                                                AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0)) AS n_sumas_haber,
                                                                    (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))>
                                                                        (IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 2
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),
                                                                        ((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount)
                                                                                    FROM tb_cdlu_voucher
                                                                                    WHERE tb_cdlu_voucher.n_taccount = 1
                                                                                        AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))-(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),0)) AS n_saldos_debe,
                                                                    (IF(((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))>(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 1 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),((IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 2 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))-(IFNULL((SELECT SUM(tb_cdlu_voucher.n_voucheramount) FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_taccount = 1 AND tb_cdlu_voucher.n_codchartofaccounts = tb_cdlu_chartofaccount.n_codchartofaccounts),0))),0)) AS n_saldos_haber
                                                                FROM tb_cdlu_chartofaccount
                                                                    INNER JOIN tb_cdlu_voucher
                                                                        ON tb_cdlu_chartofaccount.n_codchartofaccounts = tb_cdlu_voucher.n_codchartofaccounts
                                                                        WHERE tb_cdlu_chartofaccount.n_chartofaccountname LIKE '$vChartOfAccount%'
                                                                            GROUP BY tb_cdlu_chartofaccount.n_chartofaccountname, tb_cdlu_chartofaccount.c_chartofaccountname
                                                                                ORDER BY tb_cdlu_chartofaccount.n_codchartofaccounts;");
        return $vResultVoucherTAccount->fetchAll();
        $vResultVoucherTAccount->close();
    }
    public function getVoucherInitialBalances($vCodChartOfAccount, $vVoucherType, $vCloseMonth)
    {
        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vVoucherType = (int) $vVoucherType;
        $vCloseMonth = (int) $vCloseMonth;

        $vResultVoucherInitialBalances = $this->vDataBase->query("SELECT
                                                                        COUNT(*)
                                                                    FROM tb_cdlu_voucher
                                                                        WHERE tb_cdlu_voucher.n_codchartofaccounts = $vCodChartOfAccount
                                                                            AND tb_cdlu_voucher.n_vouchertype = $vVoucherType
                                                                            AND MONTH(tb_cdlu_voucher.d_voucherdate) = $vCloseMonth;");
        return $vResultVoucherInitialBalances->fetchColumn();
        $vResultVoucherInitialBalances->close();
    }            
    /* END SELECT STATEMENT QUERY  */
    /* BEGIN INSERT STATEMENT QUERY  */

    public function insertDailyEntries($vCodChartOfAccount,$vCodSupplier,$vNumBilling,$vNumDUI,$vDate,$vAmountTotal,$vAmountIce,$vDiscount,$vControlCode,$vStatus,$vActive)
    {

        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vCodSupplier = (int) $vCodSupplier;
        $vNumBilling = (int) $vNumBilling;
        $vNumDUI = (int) $vNumDUI;
        $vDate = $vDate;
        $vAmountTotal = floatval($vAmountTotal);
        $vAmountIce = floatval($vAmountIce);
        $vDiscount = floatval($vDiscount);
        $vControlCode = (string) $vControlCode;
        $vStatus = (int) $vStatus;
        $vActive = (int) $vActive;

        $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateCreate = date('Y-m-d H:i:s', time());

        $vResultInsertDailyEntries = $this->vDataBase->prepare("INSERT INTO tb_cdlu_purchases(n_codchartofaccounts, n_codsupplier, n_numbillingpurchase, n_numduidimpurchase, d_datepurchase, n_totalamountpurchase, n_amounticepurchase, n_discount, c_controlcode, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_codchartofaccounts, :n_codsupplier, :n_numbillingpurchase, :n_numduidimpurchase, :d_datepurchase, :n_totalamountpurchase, :n_amounticepurchase, :n_discount, :c_controlcode, :n_status, :n_active, :c_usercreate, :d_datecreate)")
            ->execute(
                array(
                    ':n_codchartofaccounts' => $vCodChartOfAccount,
                    ':n_codsupplier' => $vCodSupplier,
                    ':n_numbillingpurchase' => $vNumBilling,
                    ':n_numduidimpurchase' => $vNumDUI,
                    ':d_datepurchase' => $vDate,
                    ':n_totalamountpurchase' => $vAmountTotal,
                    ':n_amounticepurchase' => $vAmountIce,
                    ':n_discount' => $vDiscount,
                    ':c_controlcode' => $vControlCode,
                    ':n_status' => $vStatus,
                    ':n_active' => $vActive,
                    ':c_usercreate' => $vUserCreate,
                    ':d_datecreate' => $vDateCreate,
                ));
        return $vResultInsertDailyEntries = $this->vDataBase->lastInsertId();
        $vResultInsertDailyEntries->close();
    }

    public function insertChartOfAccount($vNumCodChartOfAccounts,$vChartOfAccountsName,$vTAccount,$vActive)
    {

        $vNumCodChartOfAccounts = (string) $vNumCodChartOfAccounts;
        $vChartOfAccountsName = (string) $vChartOfAccountsName;
        $vTAccount = (int) $vTAccount;
        $vActive = (int) $vActive;

        $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateCreate = date('Y-m-d H:i:s', time());

        $vResultChartOfAccountLevel1Register = $this->vDataBase->prepare("INSERT INTO tb_cdlu_chartofaccount(n_chartofaccountname, c_chartofaccountname, n_taccount, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_chartofaccountname, :c_chartofaccountname, :n_taccount, :n_active, :c_usercreate, :d_datecreate)")
            ->execute(
                array(
                    ':n_chartofaccountname' => $vNumCodChartOfAccounts,
                    ':c_chartofaccountname' => $vChartOfAccountsName,
                    ':n_taccount' => $vTAccount,
                    ':n_active' => $vActive,
                    ':c_usercreate' => $vUserCreate,
                    ':d_datecreate' => $vDateCreate,
                ));
        return $vResultChartOfAccountLevel1Register = $this->vDataBase->lastInsertId();
        $vResultChartOfAccountLevel1Register->close();
    }
    public function insertVoucher($vCodPartner, $vCodBill, $vCodReceipt, $vCodChartOfAccount, $vTAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc, $vState, $vActive)
    {

        $vCodPartner = (int) $vCodPartner;
        $vCodBill = (int) $vCodBill;
        $vCodReceipt = (int) $vCodReceipt;
        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vTAccount = (int) $vTAccount;
        $vVoucherType = (int) $vVoucherType;
        $vDateVoucher = $vDateVoucher;
        $vAmount = $vAmount;
        $vVoucherDesc = (string) $vVoucherDesc;
        $vState = (int) $vState;
        $vActive = (int) $vActive;

        $vUserCode = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
        $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateCreate = date('Y-m-d H:i:s', time());

        $vResultVoucherRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_voucher(n_coduser, n_codaccountingseat, n_codpartner, n_codbill, n_codreceipt, n_codchartofaccounts, n_taccount, n_vouchertype, d_voucherdate, n_voucheramount, c_voucherdesc, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_coduser, :n_codaccountingseat, :n_codpartner, :n_codbill, :n_codreceipt, :n_codchartofaccounts, :n_taccount, :n_vouchertype, :d_voucherdate, :n_voucheramount, :c_voucherdesc, :n_status, :n_active, :c_usercreate, :d_datecreate)")
            ->execute(
                array(
                    ':n_coduser' => $vUserCode,
                    ':n_codaccountingseat' => 0,
                    ':n_codpartner' => $vCodPartner,
                    ':n_codbill' => $vCodBill,
                    ':n_codreceipt' => $vCodReceipt,
                    ':n_codchartofaccounts' => $vCodChartOfAccount,
                    ':n_taccount' => $vTAccount,
                    ':n_vouchertype' => $vVoucherType,
                    ':d_voucherdate' => $vDateVoucher,
                    ':n_voucheramount' => $vAmount,
                    ':c_voucherdesc' => $vVoucherDesc,
                    ':n_status' => $vState,
                    ':n_active' => $vActive,
                    ':c_usercreate' => $vUserCreate,
                    ':d_datecreate' => $vDateCreate,
                ));
        return $vResultVoucherRegister = $this->vDataBase->lastInsertId();
        $vResultVoucherRegister->close();
    }
    
    public function insertAccountingSeat($vDateAccountingSeat, $vDescAccountingSeat, $vState, $vActive)
    {

        $vDateAccountingSeat = $vDateAccountingSeat;
        $vDescAccountingSeat = (string) $vDescAccountingSeat;
        $vState = (int) $vState;
        $vActive = (int) $vActive;

        $vUserCode = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
        $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateCreate = date('Y-m-d H:i:s', time());

        $vResultAccountingSeatRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_accountingentries(n_coduser, d_accountingseatdate, c_accountingseatdesc, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_coduser, :d_accountingseatdate, :c_accountingseatdesc, :n_status, :n_active, :c_usercreate, :d_datecreate)")
            ->execute(
                array(
                    ':n_coduser' => $vUserCode,
                    ':d_accountingseatdate' => $vDateAccountingSeat,
                    ':c_accountingseatdesc' => $vDescAccountingSeat,
                    ':n_status' => $vState,
                    ':n_active' => $vActive,
                    ':c_usercreate' => $vUserCreate,
                    ':d_datecreate' => $vDateCreate,
                ));
        return $vResultAccountingSeatRegister = $this->vDataBase->lastInsertId();
        $vResultAccountingSeatRegister->close();
    }
    
    public function insertReceipt($vCodReceipt, $vTypeReceipt, $vDateReceipt, $vCodPartner, $vAmount, $vReceiptDesc, $vState, $vActive)
    {

        $vCodReceipt = (int)$vCodReceipt;
        $vTypeReceipt = (int) $vTypeReceipt;
        $vDateReceipt = $vDateReceipt;
        $vCodPartner = (int) $vCodPartner;
        $vAmount = $vAmount;
        $vReceiptDesc = (string) $vReceiptDesc;

        $vState = (int) $vState;
        $vActive = (int) $vActive;

        $vUserCode = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
        $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateCreate = date('Y-m-d H:i:s', time());

        $vResultAccountingSeatRegister = $this->vDataBase->prepare("INSERT INTO tb_cdlu_receipts(n_coduser, n_numreceipt, n_typereceipt, n_codpartner, n_totalreceipt, d_datereceipt, c_descreceipt, n_status, n_active, c_usercreate, d_datecreate)
                                                            VALUES(:n_coduser, :n_numreceipt, :n_typereceipt, :n_codpartner, :n_totalreceipt, :d_datereceipt, :c_descreceipt, :n_status, :n_active, :c_usercreate, :d_datecreate)")
            ->execute(
                array(
                    ':n_coduser' => $vUserCode,
                    ':n_numreceipt' => $vCodReceipt,
                    ':n_typereceipt' => $vTypeReceipt,
                    ':n_codpartner' => $vCodPartner,
                    ':n_totalreceipt' => $vAmount,
                    ':d_datereceipt' => $vDateReceipt,
                    ':c_descreceipt' => $vReceiptDesc,
                    ':n_status' => $vState,
                    ':n_active' => $vActive,
                    ':c_usercreate' => $vUserCreate,
                    ':d_datecreate' => $vDateCreate,
                ));
        return $vResultAccountingSeatRegister = $this->vDataBase->lastInsertId();
        $vResultAccountingSeatRegister->close();
    }    
    /* END INSERT STATEMENT QUERY  */
    /* BEGIN UPDATE STATEMENT QUERY */
    public function updateChartOfAccountDoubleMatch($vCodChartOfAccounts, $vTAccount)
    {
        $vCodChartOfAccounts = (int) $vCodChartOfAccounts;
        $vTAccount = (int) $vTAccount;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time());

        $vResultUpdateChartOfAccountDoubleMatch = $this->vDataBase->prepare("UPDATE
                                                                                        tb_cdlu_chartofaccount
                                                                                    SET tb_cdlu_chartofaccount.n_taccount = :n_taccount,
                                                                                    tb_cdlu_chartofaccount.c_usermod = :c_usermod,
                                                                                    tb_cdlu_chartofaccount.d_datemod = :d_datemod
                                                                                    WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = :n_codchartofaccounts;")
            ->execute(
                array(
                    ':n_taccount' => $vTAccount,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_codchartofaccounts' => $vCodChartOfAccounts,
                )
            );
        return $vResultUpdateChartOfAccountDoubleMatch;
        $vResultUpdateChartOfAccountDoubleMatch->close();
    }
    public function updateTAccountVoucher($vCodVoucher, $vTAccount)
    {
        $vCodVoucher = (int) $vCodVoucher;
        $vTAccount = (int) $vTAccount;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time());

        $vResultUpdateTAccountVoucher = $this->vDataBase->prepare("UPDATE
                                                                                        tb_cdlu_voucher
                                                                                    SET tb_cdlu_voucher.n_taccount = :n_taccount,
                                                                                    tb_cdlu_voucher.c_usermod = :c_usermod,
                                                                                    tb_cdlu_voucher.d_datemod = :d_datemod
                                                                                    WHERE tb_cdlu_voucher.n_codvoucher = :n_codvoucher;")
            ->execute(
                array(
                    ':n_taccount' => $vTAccount,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_codvoucher' => $vCodVoucher,
                )
            );
        return $vResultUpdateTAccountVoucher;
        $vResultUpdateTAccountVoucher->close();
    }
    public function updateVoucherCodAccountingSeat($vCodAccountingSeat, $vCodUser, $vState)
    {
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vCodUser = (int) $vCodUser;
        $vState = (int) $vState;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time());

        $vResultUpdateVoucherCodAccountingSeat = $this->vDataBase->prepare("UPDATE
                                                                                        tb_cdlu_voucher
                                                                                        SET tb_cdlu_voucher.n_codaccountingseat = :n_codaccountingseat,
                                                                                            tb_cdlu_voucher.n_status = :n_status,
                                                                                            tb_cdlu_voucher.c_usermod = :c_usermod,
                                                                                            tb_cdlu_voucher.d_datemod = :d_datemod
                                                                                        WHERE tb_cdlu_voucher.n_coduser = :n_coduser
                                                                                            AND tb_cdlu_voucher.n_status = 0
                                                                                            AND tb_cdlu_voucher.n_codaccountingseat = 0;")
            ->execute(
                array(
                    ':n_codaccountingseat' => $vCodAccountingSeat,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_coduser' => $vCodUser,
                    ':n_status' => $vState,
                )
            );
        return $vResultUpdateVoucherCodAccountingSeat;
        $vResultUpdateVoucherCodAccountingSeat->close();
    }
    public function updateVoucher($vCodVoucher, $vCodPartner, $vCodBill, $vCodChartOfAccount, $vVoucherType, $vDateVoucher, $vAmount, $vVoucherDesc)
    {
        $vCodVoucher = (int) $vCodVoucher;
        $vCodPartner = (int) $vCodPartner;
        $vCodBill = (int) $vCodBill;
        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vVoucherType = (int) $vVoucherType;
        $vDateVoucher = $vDateVoucher;
        $vAmount = $vAmount;
        $vVoucherDesc = (string) $vVoucherDesc;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time()); 
        $vResultUpdateVoucher = $this->vDataBase->prepare("UPDATE
                                                                tb_cdlu_voucher
                                                                SET tb_cdlu_voucher.n_codpartner = :n_codpartner,
                                                                    tb_cdlu_voucher.n_codbill = :n_codbill,
                                                                    tb_cdlu_voucher.n_codchartofaccounts = :n_codchartofaccounts,
                                                                    tb_cdlu_voucher.n_vouchertype = :n_vouchertype,
                                                                    tb_cdlu_voucher.d_voucherdate = :d_voucherdate,
                                                                    tb_cdlu_voucher.n_voucheramount = :n_voucheramount,
                                                                    tb_cdlu_voucher.c_voucherdesc = :c_voucherdesc,
                                                                    tb_cdlu_voucher.c_usermod = :c_usermod,
                                                                    tb_cdlu_voucher.d_datemod = :d_datemod
                                                                WHERE tb_cdlu_voucher.n_codvoucher = :n_codvoucher;")
            ->execute(
                array(
                    ':n_codpartner' => $vCodPartner,
                    ':n_codbill' => $vCodBill,
                    ':n_codchartofaccounts' => $vCodChartOfAccount,
                    ':n_vouchertype' => $vVoucherType,
                    ':d_voucherdate' => $vDateVoucher,
                    ':n_voucheramount' => $vAmount,
                    ':c_voucherdesc' => $vVoucherDesc,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_codvoucher' => $vCodVoucher,
                )
            );
        return $vResultUpdateVoucher;
        $vResultUpdateVoucher->close();
    }    
    public function updateAccountingSeat($vCodAccountingSeat, $vDateAccountingSeat, $vDescAccountingSeat)
    {
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vDateAccountingSeat = $vDateAccountingSeat;
        $vDescAccountingSeat = (string) $vDescAccountingSeat;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time());

        $vResultUpdateAccountingSeat = $this->vDataBase->prepare("UPDATE
                                                                        tb_cdlu_accountingentries
                                                                    SET d_accountingseatdate = :d_accountingseatdate,
                                                                        c_accountingseatdesc = :c_accountingseatdesc,
                                                                        c_usermod = :c_usermod,
                                                                        d_datemod = :d_datemod
                                                                    WHERE n_codaccountingseat = :n_codaccountingseat;")
            ->execute(
                array(
                    ':d_accountingseatdate' => $vDateAccountingSeat,
                    ':c_accountingseatdesc' => $vDescAccountingSeat,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_codaccountingseat' => $vCodAccountingSeat,
                )
            );
        return $vResultUpdateAccountingSeat;
        $vResultUpdateAccountingSeat->close();
    }
    
    public function updateAccountingEntrieType($vCodAccountingSeat, $vTypeAccountingSeat)
    {
        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vTypeAccountingSeat = (int) $vTypeAccountingSeat;

        $vUserMod = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserEmail');
        $vDateMod = date("Y-m-d H:i:s", time());

        $vResultUpdateAccountingEntrieType = $this->vDataBase->prepare("UPDATE
                                                                            tb_cdlu_accountingentries
                                                                        SET tb_cdlu_accountingentries.n_accoutingseattype = :n_accoutingseattype,
                                                                            tb_cdlu_accountingentries.c_usermod = :c_usermod,
                                                                            tb_cdlu_accountingentries.d_datemod = :d_datemod
                                                                                WHERE tb_cdlu_accountingentries.n_codaccountingseat = :n_codaccountingseat;")
            ->execute(
                array(
                    ':n_accoutingseattype' => $vTypeAccountingSeat,
                    ':c_usermod' => $vUserMod,
                    ':d_datemod' => $vDateMod,
                    ':n_codaccountingseat' => $vCodAccountingSeat,
                )
            );
        return $vResultUpdateAccountingEntrieType;
        $vResultUpdateAccountingEntrieType->close();
    }    
    /* END UPDATE STATEMENT QUERY */
    /* BEGIN DELETE STATEMENT QUERY  */

    public function deleteChartOfAccount($vCodChartOfAccounts)
    {
        $vCodChartOfAccounts = (int) $vCodChartOfAccounts;

        $this->vDataBase->query("DELETE FROM tb_cdlu_chartofaccount WHERE tb_cdlu_chartofaccount.n_codchartofaccounts = $vCodChartOfAccounts;");
    }

    public function deleteVoucher($vCodVoucher)
    {
        $vCodVoucher = (int) $vCodVoucher;

        $this->vDataBase->query("DELETE FROM tb_cdlu_voucher WHERE tb_cdlu_voucher.n_codvoucher = $vCodVoucher;");
    }    
    /* END DELETE STATEMENT QUERY  */
}
