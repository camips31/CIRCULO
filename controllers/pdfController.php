<?Php

class pdfController extends IdEnController
{
    public function __construct()
    {

        parent::__construct();
        /* BEGIN VALIDATION TIME SESSION USER */
        /*if(!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE)){
        $this->redirect('auth');
        } else {
        IdEnSession::timeSession();
        }*/
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
        $this->vCodProfileLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'ProfileCode');
        $this->vCodUserLogged = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
        $this->vView->vCodUserLogged = $this->vCodUserLogged;
        /********************************/
        /* END AUTHENTICATE USER ACTIVE */
        /********************************/

        /* LIBRERIA DE */
        $this->getLibrary('NumeroALetras');
        $this->vNumALetras = new NumeroALetras(); 
        $this->vNumALetras->apocope = true; 
        $this->vNumALetras->conector = false;
    }

    public function index()
    {
        $this->vView->visualize('index');
    }

   
    public function accountingSeat($vCodAccountingSeat = 0, $vNumAccountingEntrie = '')
    {

        $vCodAccountingSeat = (int) $vCodAccountingSeat;
        $vNumAccountingEntrie = (string) $vNumAccountingEntrie;

        $this->vDataAccountingEntrie = $this->vFinancesData->getAccountingEntrie($vCodAccountingSeat);
        $this->vDataMainAccountingBook = $this->vFinancesData->getVouchersFromAccountingSeat($vCodAccountingSeat);

        for($i=0;$i<count($this->vDataAccountingEntrie);$i++):
            $vDateAccountingEntrie = $this->spanishLiteralDate($this->vDataAccountingEntrie[$i]['d_accountingseatdate']);
            $vDescAccountingEntrie = $this->vDataAccountingEntrie[$i]['c_accountingseatdesc'];
            $vDescAccountingEntrie = $this->vDataAccountingEntrie[$i]['c_accountingseatdesc'];
            $vTypeAccountingEntrie = $this->vDataAccountingEntrie[$i]['n_accoutingseattype'];

            /*if($vTypeAccountingEntrie == 1){
                $vType = 'I0'.$vNumAccountingEntrie;
            } else if($vTypeAccountingEntrie == 2){
                $vType = 'E0'.$vNumAccountingEntrie;
            } else if($vTypeAccountingEntrie == 3){
                $vType = 'T0'.$vNumAccountingEntrie;
            } else {
                $vType = 'N/S'.$vNumAccountingEntrie;
            }*/

            //$vNumAccountingEntrie = date('Y',strtotime($this->vDataAccountingEntrie[$i]['d_accountingseatdate'])).date('m',strtotime($this->vDataAccountingEntrie[$i]['d_accountingseatdate'])).$vType;
        endfor;

        $this->vListadoKardexIngresos = array(1,2,3,4,5,6,7,8,9,10);//$this->vInsumosData->getKardexIngresoProducto($vCodProduct); 
        $this->vListadoKardexSalidas = array(11,12,13,14,15,16,17,18,19,20);//$this->vInsumosData->getKardexSalidaProducto($vCodProduct);

        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Asiento Contable');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Pagina {PAGENO} de {nb}');
        // Inicio cuerpo

        $vPdfContentHtml1 .= '<tbody>';

                    if(isset($this->vDataMainAccountingBook) && count($this->vDataMainAccountingBook)):
                        $vCount = 1;
                        $vTotalDebe = $vTotalHaber = 0;
                        for($i=0;$i<count($this->vDataMainAccountingBook);$i++):
                            
                            if($vCount%2==0){
                                $vBGColor = '#f8f8f8';
                            } else{
                                $vBGColor = '#f0f0f0';
                            }

                            $vPdfContentHtml1 .= '<tr code="'.$this->vDataMainAccountingBook[$i]['n_codvoucher'].'" style="font-size: 6pt; padding-top: 5px;" bgcolor="'.$vBGColor.'">';
                                //$vPdfContentHtml1 .= '<th align="right" style="font-size: 8pt">'.$vCount.'</th>';
                                $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.$this->vDataMainAccountingBook[$i]['n_chartofaccountname'].'</th>';
                                $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.$this->vDataMainAccountingBook[$i]['c_chartofaccountname'].'</th>';
                                if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
                                    $vPdfContentHtml1 .= '<th align="center" style="font-size: 6pt; padding-top: 5px;">'.number_format($this->vDataMainAccountingBook[$i]['n_voucheramount'], 2,',','.').'</th>';
                                    $vPdfContentHtml1 .= '<th align="center" style="font-size: 6pt; padding-top: 5px;">-</th>';
                                    $vTotalDebe = $vTotalDebe + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                                } else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
                                    $vPdfContentHtml1 .= '<th align="center" style="font-size: 6pt; padding-top: 5px;">-</th>';
                                    $vPdfContentHtml1 .= '<th align="center" style="font-size: 6pt; padding-top: 5px;">'.number_format($this->vDataMainAccountingBook[$i]['n_voucheramount'], 2,',','.').'</th>';    
                                    $vTotalHaber = $vTotalHaber + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                                }                            
                                
                                //$vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt">'.$this->spanishLiteralDate($this->vDataMainAccountingBook[$i]['d_voucherdate']).'</th>';
                                //$vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt">'.$this->vDataMainAccountingBook[$i]['c_voucherdesc'].'</th>';
                            $vPdfContentHtml1 .= '</tr>';
                            ++$vCount;                                            
                        endfor;
                    endif;
                    $vPdfContentHtml1 .= '<tr style="font-size: 8pt" bgcolor="#727272">';
                        $vPdfContentHtml1 .= '<td align="right" style="font-size: 8pt; padding: 5px;" colspan="2"><font color="white"><strong>Totales</strong></td>';
                        $vPdfContentHtml1 .= '<td align="center" style="font-size: 8pt; padding: 5px;"><font color="white">'.number_format($vTotalDebe, 2,',','.').'</td>';
                        $vPdfContentHtml1 .= '<td align="center" style="font-size: 8pt; padding: 5px;"><font color="white">'.number_format($vTotalHaber, 2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';                    
        $vPdfContentHtml1 .= '</tbody>
                        </table>';

        $vPdfContentHtml1 .= '<table width="100%" style="margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>REPRESENTANTE Contable</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>ADMINISTRATIVO</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>GERENTE GENERAL EMPRESA</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>RECIBI CONFORME</strong></td>
                                    </tr>                                        
                                </tbody>
                            </table>';                        

        if($vTypeAccountingEntrie == 1){
            $vType = 'INGRESO';
        } else if($vTypeAccountingEntrie == 2){
            $vType = 'EGRESO';
        } else if($vTypeAccountingEntrie == 3){
            $vType = 'TRASPASO';
        } else {
            $vType = 'SIN ASIGNAR';
        }

        $this->vPDFPrint->WriteHTML('<h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">COMPROBANTE DE '.$vType.'</h2>
            <p style="font-size: 10pt; text-align: center; margin-top: 0.2em; margin-bottom: 1em;">Asiento Contable N°-'.$vNumAccountingEntrie.'</p>
            <table width="100%" style="margin-bottom: 1em;">
                <tr>
                    <td width="10%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Fecha: </strong></p></td>
                    <td width="60%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;">'.$vDateAccountingEntrie.'</p></td>
                    <td width="10%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>N°: </strong></p></td>
                    <td width="20%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;">'.$vNumAccountingEntrie.'</p></td>
                </tr>
                <tr>
                    <td width="10%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Glosa: </strong></p></td>
                    <td width="40%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;">'.$vDescAccountingEntrie.'</p></td>
                    <td width="10%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Página: </strong></p></td>
                    <td width="40%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;">{PAGENO} de {nb}</p></td>                    
                </tr>                
            </table>

			<table class="table" border="0" cellspacing="2" width="100%">

                <thead>
                    <tr bgcolor="#727272">
                        <td width="20%" style="font-size: 8pt; padding: 8px;" align="right"><font color="white"><strong>N° Cuenta Contable</strong></td>
                        <td width="40%" style="font-size: 8pt; padding: 8px;" align="right"><font color="white"><strong>Nombre Cuenta Contable</strong></td>
						<td width="20%" style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Debe</strong></td>
						<td width="20%" style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Haber</strong></td>
                    </tr>

               </thead>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('AsientoInicial.pdf', 'I');
    }

    public function mainAccountingBook($vCodChartOfAccount = 0, $vMonth)
    {

        $vCodChartOfAccount = (int) $vCodChartOfAccount;
        $vMonth = (int) $vMonth;

        $this->vDataMainAccountingBook = $this->vFinancesData->getMainAccountingBook($vCodChartOfAccount, $vMonth);

        //$this->vDataAccountingEntrie = $this->vFinancesData->getAccountingEntrie($vCodChartOfAccount);
        //$this->vDataMainAccountingBook = $this->vFinancesData->getVouchersFromAccountingSeat($vCodChartOfAccount);

        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Asiento Contable');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

        $vPdfContentHtml1 .= '<tbody>';

        if(isset($this->vDataMainAccountingBook) && count($this->vDataMainAccountingBook)):
            $vCount = 1;
            $vTotalDebe = $vTotalHaber = $vTotalSaldo = $Debe = $Haber = 0;
            for($i=0;$i<count($this->vDataMainAccountingBook);$i++):

                if($vCount%2==0){
                    $vBGColor = '#f8f8f8';
                } else{
                    $vBGColor = '#f0f0f0';
                }

                $vPdfContentHtml1 .= '<tr code="'.$this->vDataMainAccountingBook[$i]['n_codvoucher'].'" style="font-size: 6pt; padding-top: 5px;" bgcolor="'.$vBGColor.'">';
                    $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.$vCount.'</th>';
                    $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.$this->vDataMainAccountingBook[$i]['n_chartofaccountname'].'<br>'.$this->vDataMainAccountingBook[$i]['c_chartofaccountname'].'</td>';

                    if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
                        $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($this->vDataMainAccountingBook[$i]['n_voucheramount'], 2,',','.').'</td>';
                        $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">0</td>';
                        $vTotalDebe = $vTotalDebe + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                        $Debe = $Debe + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                    } else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
                        $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">0</td>';
                        $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($this->vDataMainAccountingBook[$i]['n_voucheramount'], 2,',','.').'</td>';
                        $vTotalHaber = $vTotalHaber + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                        $Haber = $Haber + $this->vDataMainAccountingBook[$i]['n_voucheramount'];
                    }

                    //$vTotalSaldo = $vTotalHaber + $vTotalDebe;

                    if($vCount == 1){
                        if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
                            $vTotalSaldo = $vTotalHaber + $vTotalDebe;
                            $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($vTotalSaldo, 2,',','.').'</td>';
                        } else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
                            $vTotalSaldo = $vTotalHaber + $vTotalDebe;
                            $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($vTotalSaldo, 2,',','.').'</td>';																					
                        }
                    } else{
                        if($this->vDataMainAccountingBook[$i]['n_taccount'] == 1){
                            $vTotalSaldo = $vTotalDebe - $vTotalHaber;
                            $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($vTotalSaldo, 2,',','.').'</td>';
                        } else if($this->vDataMainAccountingBook[$i]['n_taccount'] == 2){
                            $vTotalSaldo = $vTotalDebe - $vTotalHaber;
                            $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.number_format($vTotalSaldo, 2,',','.').'</td>';																					
                        }
                    }                                
                    $vPdfContentHtml1 .= '<th align="right" style="font-size: 6pt; padding-top: 5px;">'.$this->vDataMainAccountingBook[$i]['c_voucherdesc'].'</th>';
                $vPdfContentHtml1 .= '</tr>';
                ++$vCount;                                            
            endfor;
        endif;        


                    $vPdfContentHtml1 .= '<tr style="font-size: 8pt" bgcolor="#727272">';
                        $vPdfContentHtml1 .= '<th colspan="2" align="right" style="font-size: 8pt; padding: 5px;"><font color="white"><strong>Totales</strong></th>';
                        $vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt; padding: 5px;"><font color="white">'.number_format($Debe, 2,',','.').'</th>';
                        $vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt; padding: 5px;"><font color="white">'.number_format($Haber, 2,',','.').'</th>';
                        $vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt; padding: 5px;"><font color="white">'.number_format($vTotalSaldo, 2,',','.').'</th>';
                        $vPdfContentHtml1 .= '<th align="center" style="font-size: 8pt; padding: 5px;"><font color="white"></th>';
                    $vPdfContentHtml1 .= '</tr>';                 
        $vPdfContentHtml1 .= '</tbody>
                        </table>';

        $this->vPDFPrint->WriteHTML('
        <h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">Libro Mayor</h2>
            <table width="100%">
                <!--<tr>
                    <td width="10%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Fecha: </strong></p></td>
                    <td width="90%"><p style="font-size: 10pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.3em;">'.$vDateAccountingEntrie.'</p></td>
                </tr>-->
            </table>

			<table class="table" border="0" cellspacing="2" width="100%">

                <thead>
                    <tr bgcolor="#727272">
						<th style="font-size: 8pt; padding: 8px;" align="right"><font color="white"><strong>N°</strong></th>
						<th style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Cuenta Contable</strong></th>
                        <th style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Debe</strong></th>
                        <th style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Haber</strong></th>
                        <th style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Saldo</strong></th>
						<th style="font-size: 8pt; padding: 8px;" align="center"><font color="white"><strong>Glosa</strong></th>
                    </tr>

               </thead>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('AsientoInicial.pdf', 'I');
    }
    
    public function debtorPartners()
    {

        $this->vDataPartners = $this->vPartnerData->getPartnersGroupDebts();
        //$this->vDataPartners = $this->vPartnerData->getPartners();
        //$this->vDataPartner = $this->vPartnerData->getPartner($vCodPartner);
        //$this->vDataPartnersDebt = $this->vPartnerData->getPartnersDebt($vCodPartner);

        //$this->vDataAccountingEntrie = $this->vFinancesData->getAccountingEntrie($vCodChartOfAccount);
        //$this->vDataMainAccountingBook = $this->vFinancesData->getVouchersFromAccountingSeat($vCodChartOfAccount);

        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo
        $vVotalMensuales = $vTotalMortuorias = $vTotalParticipacion = 0;

        if(isset($this->vDataPartners) && count($this->vDataPartners)):
            $vCount = 1;
            for($i=0;$i<count($this->vDataPartners);$i++):

                    $vPdfContentHtml1 .= '<p style="font-size: 8pt; text-align: left; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>N° Acción: </strong>'.$this->vDataPartners[$i]['n_numaccion'].'</p>';

                    if($this->vDataPartners[$i]['n_categoria'] == 1){
                        $vType = 'Activo Presente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 2){
                        $vType = 'Emérito Presente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 3){
                        $vType = 'Corporativo';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 4){
                        $vType = 'Activo Ausente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 5){
                        $vType = 'Emérito Ausente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 6){
                        $vType = 'Especial';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 7){
                        $vType = 'Diplomático';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 8){
                        $vType = 'Congelado';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 9){
                        $vType = 'Exento';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 10){
                        $vType = 'Concesionario';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 11){
                        $vType = 'Emérito No Aportante';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 12){
                        $vType = 'Exento';
                    } else {
                        $vType = '¡Error! {'.$this->vDataPartners[$i]['n_categoria'].'}';
                    }

                    $vPdfContentHtml1 .= '<p style="font-size: 8pt; text-align: left; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Categoría Socio: </strong>'.$vType.'</p>';
                    $vPdfContentHtml1 .= '<p style="font-size: 8pt; text-align: left; margin-top: 0.1em; margin-bottom: 0.3em;"><strong>Nombre Completo: </strong>'.$this->vDataPartners[$i]['t_nombres'].'</p>';

                    /******************************************/
                    $this->vDataPartnersDebt = $this->vPartnerData->getPartnersDebt($this->vDataPartners[$i]['n_codpartner']);
                    if(isset($this->vDataPartnersDebt) && count($this->vDataPartnersDebt)):
                        $vCountB = 1;
                        $vPdfContentHtml1 .= '<table width="100%">';
                            $vPdfContentHtml1 .= '<thead>';
                                $vPdfContentHtml1 .= '<tr bgcolor="#727272">';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>N° - '.$this->vDataPartners[$i]['n_codpartner'].'</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Tipo</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Mes</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Fecha</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Monto</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Descripción</strong></th>';
                                    $vPdfContentHtml1 .= '<th style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Estado</strong></th>';
                                $vPdfContentHtml1 .= '</tr>';
                            $vPdfContentHtml1 .= '</thead>';
                        for($j=0;$j<count($this->vDataPartnersDebt);$j++):

                            if($vCountB%2==0){
                                $vBGColor = '#f8f8f8';
                            } else{
                                $vBGColor = '#f0f0f0';
                            }

                            $vPdfContentHtml1 .= '<tr bgcolor="'.$vBGColor.'">';
                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$vCountB.'</p></td>';

                                if($this->vDataPartnersDebt[$j]['n_typedebt'] == 0){
                                    $vType2 = '¡ERROR!';
                                } else if($this->vDataPartnersDebt[$j]['n_typedebt'] == 1){
                                    $vType2 = 'Montos Iniciales';
                                } else if($this->vDataPartnersDebt[$j]['n_typedebt'] == 2){
                                    $vType2 = 'Cuota Mensual';
                                    $vVotalMensuales = $vVotalMensuales + $this->vDataPartnersDebt[$j]['n_debttotal'];
                                } else if($this->vDataPartnersDebt[$j]['n_typedebt'] == 3){
                                    $vType2 = 'Cuota Mortuoria';
                                    $vTotalMortuorias = $vTotalMortuorias + $this->vDataPartnersDebt[$j]['n_debttotal'];                                    
                                } else if($this->vDataPartnersDebt[$j]['n_typedebt'] == 4){
                                    $vType2 = 'Cuota Participación';                                                                                                             
                                    $vTotalParticipacion = $vTotalParticipacion + $this->vDataPartnersDebt[$j]['n_debttotal'];
                                } else if($this->vDataPartnersDebt[$j]['n_typedebt'] == 5){
                                    $vType2 = 'Cuota Ingreso';                                     
                                } else {
                                    $vType2 = 'Otra Categoría {'.$this->vDataPartnersDebt[$j]['n_typedebt'].'}';
                                }

                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$vType2.'</p></td>';

                                if($this->vDataPartnersDebt[$j]['n_month'] == 1){
                                    $vMonth = 'Enero '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 2){
                                    $vMonth = 'Febrero '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 3){
                                    $vMonth = 'Marzo '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 4){
                                    $vMonth = 'Abril '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 5){
                                    $vMonth = 'Mayo '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 6){
                                    $vMonth = 'Junio '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 7){
                                    $vMonth = 'Julio '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 8){
                                    $vMonth = 'Agosto '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 9){
                                    $vMonth = 'Septiembre '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 10){
                                    $vMonth = 'Octubre '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 11){
                                    $vMonth = 'Noviembre '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                } else if($this->vDataPartnersDebt[$j]['n_month'] == 12){
                                    $vMonth = 'Diciembre '.date('Y',strtotime($this->vDataPartnersDebt[$j]['d_debtdate']));
                                }

                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$vMonth.'</p></td>';
                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$this->vDataPartnersDebt[$j]['d_debtdate'].'</p></td>';
                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$this->vDataPartnersDebt[$j]['n_debttotal'].'</p></td>';
                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$this->vDataPartnersDebt[$j]['c_debtdesc'].'</p></td>';
                                $vPdfContentHtml1 .= '<td><p style="font-size: 7pt; align: right; margin-top: 0.1em; margin-bottom: 0.3em;" align="right">'.$this->vDataPartnersDebt[$j]['n_status'].'</p></td>';
                            $vPdfContentHtml1 .= '</tr>';
                            ++$vCountB;
                            
                        endfor;
                        $vPdfContentHtml1 .= '</table>';
                        $vPdfContentHtml1 .= '<hr><br>';
                    endif;
                    /******************************************/

                ++$vCount;                                            
            endfor;
        endif;

        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<tr>';
                $vPdfContentHtml1 .= '<td bgcolor="#727272" style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Total Monto Mensuales</strong></td>';
                $vPdfContentHtml1 .= '<td bgcolor="#BDBDBD" style="font-size: 7pt; padding: 8px;" align="right">'.$vVotalMensuales.'</td>';            
            $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '<tr>';
                $vPdfContentHtml1 .= '<td bgcolor="#727272" style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Total Monto Mortuorias</strong></td>';
                $vPdfContentHtml1 .= '<td bgcolor="#BDBDBD" style="font-size: 7pt; padding: 8px;" align="right">'.$vTotalMortuorias.'</td>';            
            $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '<tr>';
                $vPdfContentHtml1 .= '<td bgcolor="#727272" style="font-size: 7pt; padding: 8px;" align="right"><font color="white"><strong>Total Monto Participación</strong></td>';
                $vPdfContentHtml1 .= '<td bgcolor="#BDBDBD" style="font-size: 7pt; padding: 8px;" align="right">'.$vTotalParticipacion.'</td>';            
            $vPdfContentHtml1 .= '</tr>';                
        $vPdfContentHtml1 .= '</table>';        

        $this->vPDFPrint->WriteHTML('<h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">Listado de Deudas</h2>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('SociosDeudores.pdf', 'I');
    }


    public function sumsAndBalances($vMonth)
    {
        $vMonth = (int) $vMonth;
        $this->vDataSumsAndBalances = $this->vFinancesData->getSumsAndBalances($vMonth);

        //$this->vDataAccountingEntrie = $this->vFinancesData->getAccountingEntrie($vCodChartOfAccount);
        //$this->vDataMainAccountingBook = $this->vFinancesData->getVouchersFromAccountingSeat($vCodChartOfAccount);

        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3"></th>';
                    $vPdfContentHtml1 .= '<th colspan="2" class="align-middle border-bottom border-end w-200px">Sumas</th>';
                    $vPdfContentHtml1 .= '<th colspan="2" class="align-middle border-bottom border-end w-200px">Saldos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Debe</th>';
                    $vPdfContentHtml1 .= '<th>Haber</th>';
                    $vPdfContentHtml1 .= '<th>Debe</th>';
                    $vPdfContentHtml1 .= '<th>Haber</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';


            
            if(isset($this->vDataSumsAndBalances) && count($this->vDataSumsAndBalances)):
                $vCount = 1;
                $vSumasDebe = $vSumasHaber = $vSaldosDebe = $vSaldosHaber = 0;
                for($i=0;$i<count($this->vDataSumsAndBalances);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataSumsAndBalances[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataSumsAndBalances[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataSumsAndBalances[$i]['n_chartofaccountname'] == '1116011*'){
                            $n_sumas_debe = $this->vDataSumsAndBalances[$i]['n_sumas_debe'];
                            $n_sumas_haber = $this->vDataSumsAndBalances[$i]['n_sumas_haber'];
                            $n_saldos_debe = $this->vDataSumsAndBalances[$i]['n_saldos_debe'];
                            $n_saldos_haber = $this->vDataSumsAndBalances[$i]['n_saldos_haber'];
                            //$vMontoEnDolares = $this->vDataSumsAndBalances[$i]['n_voucheramount'];
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

                        $vPdfContentHtml1 .= '<td>'.number_format($vMontoFinalSumasDebe,2,',','.').'</td>';
                        $vPdfContentHtml1 .= '<td>'.number_format($vMontoFinalSumasHaber,2,',','.').'</td>';
                        $vPdfContentHtml1 .= '<td>'.number_format($vMontoFinalSaldosDebe,2,',','.').'</td>';
                        $vPdfContentHtml1 .= '<td>'.number_format($this->vDataSumsAndBalances[$i]['n_saldos_haber'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    $vSumasDebe = $vSumasDebe + $vMontoFinalSumasDebe;
                    $vSumasHaber = $vSumasHaber + $vMontoFinalSumasHaber;
                    $vSaldosDebe = $vSaldosDebe + $vMontoFinalSaldosDebe;
                    $vSaldosHaber =  $vSaldosHaber + $vMontoFinalSaldosHaber;

                    ++$vCount;                                            
                endfor;
            endif;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumasDebe,2,',','.').'</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumasHaber,2,',','.').'</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSaldosDebe,2,',','.').'</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSaldosHaber,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table>';

        $vPdfContentHtml1 .= '<table width="100%" style="margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>REPRESENTANTE Contable</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>ADMINISTRATIVO</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>GERENTE GENERAL EMPRESA</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>RECIBI CONFORME</strong></td>
                                    </tr>                                        
                                </tbody>
                            </table>';         

        
        $this->vPDFPrint->WriteHTML('<h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">Reporte Sumas y Saldos</h2>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('SumasYSaldos.pdf', 'I');
    }


    public function incomeStatement($vMonth)
    {
        $vMonth = (int) $vMonth;
        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        
        $vTotalIncomeStatement = 0;

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(1,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Ingresos Operativos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(2,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Gastos Administrativos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementB = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br><br><br><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(3,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Servicios Financieros</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementC = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(4,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Gastos Operativos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementD = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(5,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Gastos Generales</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementE = $vSumas;
            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getIncomeStatement(6,$vMonth);
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">OTROS</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementF = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/      

        $vPdfContentHtml1 .= '<table width="100%" style="margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>REPRESENTANTE Contable</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>ADMINISTRATIVO</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>GERENTE GENERAL EMPRESA</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>RECIBI CONFORME</strong></td>
                                    </tr>                                        
                                </tbody>
                            </table>';         

        
        $this->vPDFPrint->WriteHTML('<h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">Estado de Resultados</h2>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('EstadoDeResultados.pdf', 'I');
    }
    
    public function accountingBalance()
    {
        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 25, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        
        $vTotalIncomeStatement = 0;

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('111');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('1121');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Realizable</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('113');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Exigible Corto Plazo Moneda Nacional</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/        

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('114');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Exigible Corto Plazo Moneda Extranjera</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/     
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('115');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Intangible</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/        

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('118');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Diferido Corto Plazo</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('125');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Fijo I</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('126');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Fijo II</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('129');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Otros Activos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/

        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('210');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Pasivo Exigible</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('212');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Pasivo Exigible Corto Plazo Moneda Extranjera y Nacional</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('223');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Previsiones e Indemnizaciones</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/
        
        /***********************************************************/
        $this->vDataIncomeStatementRep1 = $this->vFinancesData->getAccountingBalance('229');
        $vPdfContentHtml1 .= '<table width="100%">';
            $vPdfContentHtml1 .= '<thead>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="4">Activo Netos</th>';
                $vPdfContentHtml1 .= '</tr>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th>Num</th>';
                    $vPdfContentHtml1 .= '<th>Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Descripción Cuenta</th>';
                    $vPdfContentHtml1 .= '<th>Total</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</thead>';
            
            if(isset($this->vDataIncomeStatementRep1) && count($this->vDataIncomeStatementRep1)):
                $vCount = 1;
                $vSumas = 0;
                for($i=0;$i<count($this->vDataIncomeStatementRep1);$i++):
                    $vPdfContentHtml1 .= '<tr bgcolor="#E4E4E4">';
                        $vPdfContentHtml1 .= '<td>'.$vCount.'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['n_chartofaccountname'].'</td>';
                        $vPdfContentHtml1 .= '<td>'.$this->vDataIncomeStatementRep1[$i]['c_chartofaccountname'].'</td>';

                        if($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_haber'];
                        } else if($this->vDataIncomeStatementRep1[$i]['n_saldos_haber'] == 0){
                            $vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_saldos_debe'],2,',','.').'</td>';
                            $vSumas = $vSumas + $this->vDataIncomeStatementRep1[$i]['n_saldos_debe'];
                        }                        

                        //$vPdfContentHtml1 .= '<td>'.number_format($this->vDataIncomeStatementRep1[$i]['n_sumas_debe'],2,',','.').'</td>';
                    $vPdfContentHtml1 .= '</tr>';

                    

                    ++$vCount;                                            
                endfor;
            endif;

            $vTotalIncomeStatementA = $vSumas;

            $vPdfContentHtml1 .= '<tfoot>';
                $vPdfContentHtml1 .= '<tr bgcolor="#A3A3A3">';
                    $vPdfContentHtml1 .= '<th colspan="3" class="text-nowrap align-end">Totales:</th>';
                    $vPdfContentHtml1 .= '<th class="text-danger fs-3">'.number_format($vSumas,2,',','.').'</th>';
                $vPdfContentHtml1 .= '</tr>';
            $vPdfContentHtml1 .= '</tfoot>';

        $vPdfContentHtml1 .= '</table><br><br>';
        /***********************************************************/        
        

        $vPdfContentHtml1 .= '<table width="100%" style="margin-top: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>REPRESENTANTE Contable</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>ADMINISTRATIVO</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>GERENTE GENERAL EMPRESA</strong></td>
                                        <td width="25%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" rowspan="4"><strong>RECIBI CONFORME</strong></td>
                                    </tr>                                        
                                </tbody>
                            </table>';         

        
        $this->vPDFPrint->WriteHTML('<h2 style="font-size: 12pt; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">Balance General</h2>');

        $this->vPDFPrint->WriteHTML($vPdfContentHtml1, 2);
        $this->vPDFPrint->Output('Balance.pdf', 'I');
    }

    public function debtorPartners123()
    {
        $this->vDataPartnersDebtsGroupByChartOfAccount = $this->vPartnerData->getPartnersDebtsGroupByChartOfAccount();
        $this->vDataPartnersDebts = $this->vPartnerData->getPartnersDebts();
        
        $vLogoImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR;
        $vQRCodeImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'billing'.DIR_SEPARATOR.'qr'.DIR_SEPARATOR;
            
        $vPdfContentHtml1 .= '
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td rowspan="2" class="top width-500"><img src="'.$vLogoImageRoot.'circulodelaunion-logo.png" class="logo"/></td>
                        <td rowspan="2" class="width-100"></td>
                        <td class="well1 width-400">
                            <div align="left">
                                <p>Junio 2024</p>
                                <p></p>
                                <p></p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="well2 width-400">
                            <div>
                                <p class="title-1"></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="well3" colspan="3"><strong>Listado de Deudores</strong><br/><span class="billingActivity">Mes de Junio 2024</span></td>
                    </tr>
                </tbody>
            </table>
        ';

        if(isset($this->vDataPartnersDebtsGroupByChartOfAccount) && count($this->vDataPartnersDebtsGroupByChartOfAccount)):
            for($k=0;$k<count($this->vDataPartnersDebtsGroupByChartOfAccount);$k++):

                $vPdfContentHtml1 .= '<table border="0">
                                        <tbody>                            
                                            <tr>
                                            <td colspan="3" width="100%" style="text-align=center; font-size:10pt; border: 1px solid #3D3D3D;" >'.$this->vDataPartnersDebtsGroupByChartOfAccount[$k]['n_chartofaccountname'].' - '.$this->vDataPartnersDebtsGroupByChartOfAccount[$k]['c_chartofaccountname'].'</td>
                                            </tr>';

                                            $vPdfContentHtml1 .= '
                                                <tr>
                                                    <td width="20%" style="text-align=center; font-size:8pt; border: 1px solid #3D3D3D;" >Nº</td>
                                                    <td width="60%" style="text-align=center; font-size:8pt; border: 1px solid #3D3D3D;" >Socio</td>
                                                    <td width="20%" style="text-align=center; font-size:8pt; border: 1px solid #3D3D3D;" >Saldo Bs.</td>
                                                </tr>';
                                        
                                                if(isset($this->vDataPartnersDebts) && count($this->vDataPartnersDebts)):
                                                    $vCount = 1;
                                                    $vTotal = 0;
                                                    for($i=0;$i<count($this->vDataPartnersDebts);$i++):
                                                        if($this->vDataPartnersDebtsGroupByChartOfAccount[$k]['n_chartofaccountname'] == $this->vDataPartnersDebts[$i]['n_chartofaccountname']){
                                                            $vPdfContentHtml1 .= '<tr>';
                                                            $vPdfContentHtml1 .= '<td width="20%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" >'.$vCount.'</td>';
                                                            //$vPdfContentHtml1 .= '<td>'.$this->spanishLiteralDate($this->vDataPartnersDebts[$i]['d_debtdate']).'</td>';
                                                            $vPdfContentHtml1 .= '<td width="60%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" ><strong>'.$this->vDataPartnersDebts[$i]['n_numaccion'].' - '.$this->vDataPartnersDebts[$i]['t_nombres'].'</strong><br>'.$this->vDataPartnersDebts[$i]['c_debtdesc'].'</td>';
                                                            $vPdfContentHtml1 .= '<td width="20%" style="text-align=center; font-size:6pt; border: 1px solid #3D3D3D;" >'.$this->vDataPartnersDebts[$i]['n_debttotal'].'</td>';
                                                            $vPdfContentHtml1 .= '</tr>';
                                                            $vTotal = $vTotal + $this->vDataPartnersDebts[$i]['n_debttotal'];
                                                            ++$vCount;
                                                        }                                            
                                                    endfor;
                                                endif;
                                                            
                                                $vPdfContentHtml1 .= '                            
                                                            <tr>
                                                                <td colspan="2" width="80%" style="text-align=center; font-size:8pt; border: 1px solid #3D3D3D;" >Monto total</td>
                                                                <td width="20%" style="text-align=center; font-size:8pt; border: 1px solid #3D3D3D;" >'.number_format($vTotal, 2, '.', '').'</td>
                                                            </tr>';                                            

                    $vPdfContentHtml1 .= '</tbody>
                                    </table>';
            endfor;
        endif;
    
        $vPdfContentHtml1 .= '
            <div class="myfixed1">
                <p></p>
                <p></p>
                <br/>
                <p class="system-billing-generatedData">USER: 1 | DATETIME: 29/05/2024</p>
            </div>
        ';


        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 15, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $stylesheet = file_get_contents(ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR.'invoice-letter-pdf.css');
        $this->vPDFPrint->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->vPDFPrint->WriteHTML($vPdfContentHtml1,\Mpdf\HTMLParserMode::HTML_BODY);        
        
        //$this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,2);
        $this->vPDFPrint->Output('factura-2.pdf','I');        

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

    }    

    public function pdfReceipt($vCodReceipt){
        
        $vCodReceipt = (int) $vCodReceipt;
        $this->vDataReceipt = $this->vFinancesData->getReceipt($vCodReceipt);
        for($i=0;$i<count($this->vDataReceipt);$i++):
            $n_codreceipt = $this->vDataReceipt[$i]['n_codreceipt'];
            $n_coduser = $this->vDataReceipt[$i]['n_coduser'];
            $n_numreceipt = $this->vDataReceipt[$i]['n_numreceipt'];
            $c_typereceipt = $this->vDataReceipt[$i]['c_typereceipt'];
            $n_numaccion = $this->vDataReceipt[$i]['n_numaccion'];
            $t_nombres = $this->vDataReceipt[$i]['t_nombres'];
            $c_categoria = $this->vDataReceipt[$i]['c_categoria'];
            $n_totalreceipt = $this->vDataReceipt[$i]['n_totalreceipt'];
            $d_datereceipt = $this->vDataReceipt[$i]['d_datereceipt'];
            $c_descreceipt = $this->vDataReceipt[$i]['c_descreceipt'];
            $n_status = $this->vDataReceipt[$i]['n_status'];
            $c_usercreate = $this->vDataReceipt[$i]['c_usercreate'];
            $d_datecreate = $this->vDataReceipt[$i]['d_datecreate'];
        endfor;        

        $vLogoImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR;
        //$vQRCodeImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'billing'.DIR_SEPARATOR.'qr'.DIR_SEPARATOR;
            
        $htmlPDFHeader = '
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td rowspan="2" class="top width-600"><img src="'.$vLogoImageRoot.'circulodelaunion-logo.png" class="logo"/></td>
                        <td rowspan="2" class="width-100"></td>
                        <td class="well1 width-400">
                            <div align="right">
                                <p><strong>DIRECCIÓN OFICINA CENTRAL</strong></p>
                                <p>CASA MATRIZ</p>
                                <p>Calle Agustin Aspiazu #333</p>
                                <p>Telefono: 77200968</p>
                                <p>La Paz</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="well1 width-400"></td>
                    </tr>
                    <tr>
                        <td class="well3" colspan="3">
                            <h2><strong>RECIBO N° '.$n_numreceipt.'</strong></h2>
                            <p><strong>Lugar y fecha de emisión:</strong> '.$this->spanishLiteralDate($d_datereceipt).'</p>                          
                        </td>
                    </tr>                   
                </tbody>
            </table>
            
            <table border="0" class="border-detail">
                <tbody>                            
                    <tr class="headerrowdetail">
                        <td colspan="3" class="title-detail width-400"><strong>Datos del Socio</strong></td>
                    </tr>

                    <tr class="headerrowdetail">
                        <td class="title-detail width-10"><strong>N° Acción</strong></td>
                        <td class="title-detail width-10"><strong>Categoría</strong></td>
                        <td class="title-detail width-400"><strong>Nombre Socio</strong></td>
                    </tr>                    
                    
                    <tr class="headerrowdetail">
                        <td class="title-detail data-billing">'.$n_numaccion.'</td>
                        <td class="title-detail data-billing">'.$c_categoria.'</td>
                        <td class="title-detail data-billing">'.$t_nombres.'</td>
                    </tr>

                    <tr>
                        <td class="well3" colspan="3"></td>
                    </tr>
                    
                </tbody>
            </table>
        ';
    
        $vhtmlPDFDetail = '
            <table border="0" class="border-detail">
                <tbody>
                    <tr class="headerrowdetail">
                        <td class="title-detail width-30"><strong>Nº</strong></td>
                        <td class="title-detail width-30"><strong>Cantidad</strong></td>
                        <td class="title-detail width-300"><strong>Descripción</strong></td>
                        <td class="title-detail width-50"><strong>Precio Unitario Bs.</strong></td>
                        <td class="title-detail width-50"><strong>Precio Total Bs.</strong></td>
                    </tr>
        ';
    
        $vhtmlPDFDetail .= '<tr class="rowdetail">';
            $vhtmlPDFDetail .= '<td class="text-detail padding-10">'.$i.'</td>';
            $vhtmlPDFDetail .= '<td class="text-detail padding-10">'.$i.'</td>';
            $vhtmlPDFDetail .= '<td class="text-detail padding-10">';
                $vhtmlPDFDetail .= '<h3 class="h3-detail">'.$c_typereceipt.'</h3>';
                $vhtmlPDFDetail .= '<p>'.$c_descreceipt.'</p>';
            $vhtmlPDFDetail .= '</td>';
            $vhtmlPDFDetail .= '<td class="text-detail padding-10">'.$n_totalreceipt.'</td>';
            $vhtmlPDFDetail .= '<td class="text-detail padding-10">'.number_format(($i*$n_totalreceipt), 2, '.', '').'</td>';
        $vhtmlPDFDetail .= '</tr>';
        
        $formatter = new NumeroALetras();
        $vtotal = $formatter->toMoney(($i*$n_totalreceipt), 2, 'BOLIVIANOS', 'CENTAVOS');

        /*<td class="text-billing">'.$this->num2letras(number_format(($i*$n_totalreceipt), 2, '.', ''),2).'</td>*/
                    
        $vhtmlPDFDetail .= '
                </tbody>
            </table>
            <br>
            <table border="0">
                <tbody>                            
                    <tr class="headerrowdetail">
                        <td class="title-billing width-600"><strong>Monto total literal</strong></td>
                        <td class="title-billing width-200"><strong>Monto total numeral</strong></td>
                    </tr>
                    
                    <tr>
                        <td class="text-billing">'.$vtotal.'</td>
                        <td class="text-billing">'.number_format(($i*$n_totalreceipt), 2, '.', '').'</td>
                    </tr>                            
                </tbody>
            </table>
                    
        ';
    
        $vhtmlPDFFooter .= '
            <div class="myfixed1">
                <p>El presente documento es un recibo oficial de pago por el servicio realizado por nuestra empresa a sus socios</p>
                <br/>
                <p class="system-billing-generatedData">USER: '.$n_coduser.' | DATETIME: '.$d_datecreate.'</p>
            </div>
        ';


        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 15, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $stylesheet = file_get_contents(ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR.'invoice-letter-pdf.css');
        $this->vPDFPrint->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,\Mpdf\HTMLParserMode::HTML_BODY);        
        
        //$this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,2);
        $this->vPDFPrint->Output('Recibo_'.$n_numreceipt.'_'.$n_numaccion.'.pdf','I');        

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

    }
    
    public function pdfPartnerPayments(){
        
        $vCodReceipt = (int) $vCodReceipt;
        $this->vDataPartnerPayments = $this->vPartnerData->getPartnerPayments();


        $vLogoImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR;
        //$vQRCodeImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'billing'.DIR_SEPARATOR.'qr'.DIR_SEPARATOR;
            
        $htmlPDFHeader = '
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td rowspan="2" class="top width-600"><img src="'.$vLogoImageRoot.'circulodelaunion-logo.png" class="logo"/></td>
                        <td rowspan="2" class="width-100"></td>
                        <td class="well1 width-400">
                            <div align="right">
                                <p><strong>DIRECCIÓN OFICINA CENTRAL</strong></p>
                                <p>CASA MATRIZ</p>
                                <p>Calle Agustin Aspiazu #333</p>
                                <p>Telefono: 77200968</p>
                                <p>La Paz</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="well1 width-400"></td>
                    </tr>
                    <tr>
                        <td class="well3" colspan="3">
                            <h2><strong>Listado de Pagos Anuales</strong></h2>
                            <p><strong>Lugar y fecha de emisión:</strong> '.$this->spanishLiteralDate(date('Y-m-d')).'</p>                          
                        </td>
                    </tr>                   
                </tbody>
            </table>
            
            <table border="0" class="border-detail">
                <tbody>                            
                    <tr class="headerrowdetail">
                        <td class="title-detail"><strong>N°</strong></td>
                        <td class="title-detail"><strong>N° Acción</strong></td>
                        <td class="title-detail"><strong>Categoría</strong></td>
                        <td class="title-detail"><strong>Nombre Socio</strong></td>
                        <td class="title-detail"><strong>Gestión</strong></td>
                        <td class="title-detail"><strong>Tipo</strong></td>
                        <td class="title-detail"><strong>Cuenta Contable</strong></td>
                        <td class="title-detail"><strong>Descripción</strong></td>
                        <td class="title-detail"><strong>Monto Bs</strong></td>
                        <td class="title-detail"><strong>Estado</strong></td>
                    </tr>';
                    $vCount = 1;
                    $vMontoTotal = 0;
                    for($i=0;$i<count($this->vDataPartnerPayments);$i++):

                        if($this->vDataPartnerPayments[$i]['n_categoria'] == 1){
                            $vType = 'Activo Presente';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 2){
                            $vType = 'Emérito Presente';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 3){
                            $vType = 'Corporativo';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 4){
                            $vType = 'Activo Ausente';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 5){
                            $vType = 'Emérito Ausente';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 6){
                            $vType = 'Especial';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 7){
                            $vType = 'Diplomático';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 8){
                            $vType = 'Congelado';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 9){
                            $vType = 'Exento';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 10){
                            $vType = 'Concesionario';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 11){
                            $vType = 'Emérito No Aportante';
                        } else if($this->vDataPartnerPayments[$i]['n_categoria'] == 12){
                            $vType = 'Exento';
                        } else {
                            $vType = '¡Error! {'.$this->vDataPartnerPayments[$i]['n_categoria'].'}';
                        }                        

                        $vhtmlPDFDetail .= '<tr class="headerrowdetail">
                                        <td class="title-detail data-billing">'.$vCount.'</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['n_numaccion'].'</td>
                                        <td class="title-detail data-billing">'.$vType.'</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['t_nombres'].'</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['n_management'].'</td>
                                        <td class="title-detail data-billing">Pago Adelantado</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['n_chartofaccountname'].' - '.$this->vDataPartnerPayments[$i]['c_chartofaccountname'].'</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['c_descpayment'].'</td>
                                        <td class="title-detail data-billing">'.$this->vDataPartnerPayments[$i]['n_payment'].'</td>
                                        <td class="title-detail data-billing">Pagado</td>
                                    </tr>';
                                    $vCount++;
                                    $vMontoTotal = $vMontoTotal + $this->vDataPartnerPayments[$i]['n_payment'];
                    endfor;                    
                    

                    $vhtmlPDFDetail .= '<tr>
                        <td class="well3" colspan="3"></td>
                    </tr>
                    
                </tbody>
            </table>
        ';

        
        //$formatter = new NumeroALetras();
        //$vtotal = $formatter->toMoney(($i*$n_totalreceipt), 2, 'BOLIVIANOS', 'CENTAVOS');

        /*<td class="text-billing">'.$this->num2letras(number_format(($i*$n_totalreceipt), 2, '.', ''),2).'</td>*/
                    
        $vhtmlPDFDetail .= '
                </tbody>
            </table>
            <br>
            <table border="0">
                <tbody>
                    <tr>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"></td>
                        <td class="well1 text-billing"><strong>TOTAL</strong></td>
                        <td class="well1 text-billing"><strong>'.number_format($vMontoTotal, 2, '.', '').'</strong></td>
                        <td class="well1 text-billing"></td>
                    </tr>                            
                </tbody>
            </table>
                    
        ';
    
        $vhtmlPDFFooter .= '
            <div class="myfixed1">
                <p>El presente documento es un recibo oficial de pago por el servicio realizado por nuestra empresa a sus socios</p>
                <br/>
                <p class="system-billing-generatedData">USER: '.$n_coduser.' | DATETIME: '.$d_datecreate.'</p>
            </div>
        ';


        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 15, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $stylesheet = file_get_contents(ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR.'invoice-letter-pdf.css');
        $this->vPDFPrint->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,\Mpdf\HTMLParserMode::HTML_BODY);        
        
        //$this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,2);
        $this->vPDFPrint->Output('factura-2.pdf','I');        

        $this->vPDFPrint->SetTitle('Socios Deudores');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

    }

    public function pdfPartners(){
               
        $this->vDataPartnersByShare = $this->vPartnerData->getPartnersByShare();
        $this->vDataPartners = $this->vPartnerData->getPartners();
        $vLogoImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR;
        //$vQRCodeImageRoot = ROOT_APPLICATION.'views'.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'billing'.DIR_SEPARATOR.'qr'.DIR_SEPARATOR;
            
        $htmlPDFHeader = '
            <table border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td rowspan="2" class="top width-600"><img src="'.$vLogoImageRoot.'circulodelaunion-logo.png" class="logo"/></td>
                        <td rowspan="2" class="width-100"></td>
                        <td class="well1 width-400">
                            <div align="right">
                                <p><strong>DIRECCIÓN OFICINA CENTRAL</strong></p>
                                <p>CASA MATRIZ</p>
                                <p>Calle Agustin Aspiazu #333</p>
                                <p>Telefono: 77200968</p>
                                <p>La Paz</p>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="well1 width-400"></td>
                    </tr>
                    <tr>
                        <td class="well3" colspan="3">
                            <h2><strong>Lista de Socios</strong></h2>
                            <p><strong>Lugar y fecha de emisión:</strong> '.$this->spanishLiteralDate(date('Y-m-d')).'</p>
                            <p><strong>Cantidad Socios</strong> '.count($this->vDataPartners).'</p>                          
                        </td>
                    </tr>                   
                </tbody>
            </table>
            
            <table border="0" class="border-detail">
                <tbody>';

                
                for($i=0;$i<count($this->vDataPartners);$i++):

                    if($this->vDataPartners[$i]['n_categoria'] == 1){
                        $vType = 'Activo Presente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 2){
                        $vType = 'Emérito Presente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 3){
                        $vType = 'Corporativo';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 4){
                        $vType = 'Activo Ausente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 5){
                        $vType = 'Emérito Ausente';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 6){
                        $vType = 'Especial';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 7){
                        $vType = 'Diplomático';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 8){
                        $vType = 'Congelado';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 9){
                        $vType = 'Exento';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 10){
                        $vType = 'Concesionario';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 11){
                        $vType = 'Emérito No Aportante';
                    } else if($this->vDataPartners[$i]['n_categoria'] == 12){
                        $vType = 'Exento';
                    } else {
                        $vType = '¡Error! {'.$this->vDataPartners[$i]['n_categoria'].'}';
                    }

                    $vhtmlPDFDetail .= '                
                    <tr class="headerrowdetail">
                        <td colspan="6" class="title-detail width-400"><strong>Datos del Socio</strong></td>
                    </tr>

                    <tr class="headerrowdetail">
                        <td class="title-detail width-10"><strong>N° Acción</strong></td>
                        <td class="title-detail data-billing">'.$this->vDataPartners[$i]['n_numaccion'].'</td>
                        <td class="title-detail width-10"><strong>Categoría</strong></td>
                        <td class="title-detail data-billing">'.$vType.'</td>
                        <td class="title-detail width-10"><strong>Fecha de Ingreso</strong></td>
                        <td class="title-detail data-billing">'.$this->vDataPartners[$i]['d_fechaingreso'].'</td>                        
                    </tr>
                    <tr class="headerrowdetail">
                        <td class="title-detail width-10"><strong>Nombre Completo</strong></td>
                        <td class="title-detail data-billing" colspan="5">'.$this->vDataPartners[$i]['t_nombres'].'</td>
                    </tr>
                    <tr class="headerrowdetail">
                        <td class="title-detail width-10"><strong>Fecha Nacimiento</strong></td>
                        <td class="title-detail data-billing">'.$this->vDataPartners[$i]['n_numaccion'].'</td>
                        <td class="title-detail width-10"><strong>Sexo</strong></td>
                        <td class="title-detail data-billing">'.$this->vDataPartners[$i]['n_sexo'].'</td>                        
                        <td class="title-detail width-10"><strong>Carnet de Identidad</strong></td>
                        <td class="title-detail data-billing">'.$this->vDataPartners[$i]['t_carnetidentidad'].'</td>
                    </tr>                    

                    <tr>
                        <td class="well3" colspan="3"></td>
                    </tr>';

                endfor;
            $vhtmlPDFDetail .= '                    
                </tbody>
            </table>
        ';
    
                    
        $vhtmlPDFFooter .= '
            <div class="myfixed1">
                <p>El presente documento es un recibo oficial de pago por el servicio realizado por nuestra empresa a sus socios</p>
                <br/>
                <p class="system-billing-generatedData">USER: '.$n_coduser.' | DATETIME: '.$d_datecreate.'</p>
            </div>
        ';


        require_once ROOT_APPLICATION . 'libs' . DIR_SEPARATOR . 'mpdf8' . DIR_SEPARATOR . 'vendor' . DIR_SEPARATOR . 'autoload.php';

        $vRootURLLogoImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/logos/';
        $vRootURLPDFImages = BASE_VIEW_URL . 'views/layout/assets/backend/media/pdf/';

        $this->vPDFPrint = new Mpdf\Mpdf(['format' => 'Letter', // tamaño de papel carta
            'margin_left' => 10, // margen izquierdo valor en milimetros
            'margin_right' => 10, // margen derecho valor en milimetros
            'margin_top' => 15, // margen superior valor en milimetros
            'margin_bottom' => 15, // margen inferior valor en milimetros
            'margin_footer' => 10, // margen pie de página valor en milimetros
            //'mirrorMargins' => true // para que la impresión sea a doble cara
        ]);

        $stylesheet = file_get_contents(ROOT_APPLICATION.'views'.DIR_SEPARATOR.'layout'.DIR_SEPARATOR.DEFAULT_VIEW_LAYOUT.DIR_SEPARATOR.'backend'.DIR_SEPARATOR.'css'.DIR_SEPARATOR.'invoice'.DIR_SEPARATOR.'invoice-letter-pdf.css');
        $this->vPDFPrint->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,\Mpdf\HTMLParserMode::HTML_BODY);        
        
        //$this->vPDFPrint->WriteHTML($htmlPDFHeader.$vhtmlPDFDetail.$vhtmlPDFFooter,2);
        $this->vPDFPrint->Output('Reporte_ListadoDeSocios_'.date('Y-m-d').'.pdf','I');        

        $this->vPDFPrint->SetTitle('Listado de Socios Registrados');
        $this->vPDFPrint->SetDefaultBodyCSS('background', "url('views/layout/assets/backend/media/pdf/membretado-vertical-1.png')");
        $this->vPDFPrint->SetDefaultBodyCSS('background-image-resize', 6);
        $this->vPDFPrint->setFooter('Página {PAGENO} de {nb}');
        // Inicio cuerpo

    }    

}
