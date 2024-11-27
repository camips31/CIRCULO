<?Php

class facturationController extends IdEnController
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
            $this->vFacturation = $this->LoadModel('facturation');

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

            $this->getLibrary('Codigos');
            $this->getLibrary('Sincronizacion');

            $this->vView->vControllerActive = 'facturation';
            $this->vView->vSubNavContent = '';

        }

        public function index(){
            $this->vView->allData = $this->vFacturation->M_listar_documentos();
            $this->vView->vMethodActive = 'index';
            $this->vView->visualize('index');
        }

        public function clients(){
            $this->vView->allData = $this->vFacturation->M_listar_documentos();
            $this->vView->visualize('clients');
        }

        public function products(){
            $this->vView->datacat = $this->vFacturation->get_categoria_cmb();
            $this->vView->datamarca = $this->vFacturation->get_marca_cmb();
            $this->vView->datacodsim = $this->vFacturation->get_codsim_cmb();
            $this->vView->allParametricas = $this->vFacturation->get_parametricas_cmb();
            $this->vView->visualize('products');
        }

        public function brands(){
            $this->vView->visualize('brands');
        }

        public function categories(){
            $this->vView->visualize('categories');
        }

        public function configuration(){
            $this->vView->dataSistem = $this->vFacturation->M_datos_sistema();
            $this->vView->visualize('configuration');
        }

        public function pointSale(){
            $this->vView->dataPoints = $this->vFacturation->M_fn_listar_punto_venta_todos();
            $this->vView->dataBranches = $this->vFacturation->M_listar_sucursales_activos();
            $this->vView->dataUbi = $this->vFacturation->listar_ubicaciones();
            $this->vView->visualize('pointSale');
        }

        public function branch(){
            $this->vView->visualize('branch');
        }

        //CONFIGURACION
        public function C_gestionar_sistema($btn) {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            $response_data = array();

            // Verificación de modalidad
            if ($_POST['modalidad'] == 1) {
                $config['allowed_types'] = 'pem|crt|p12';
                $config['max_size'] = 0;
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['overwrite'] = TRUE;

                if (empty($_FILES['archivo_crt']['name'][0]) || empty($_FILES['archivo_pk']['name'][0])) {
                    // Si no se subieron los archivos, muestra un mensaje de error
                    $response_data[] = (object) array(
                        'estado' => false,
                        'mensaje' => 'Es necesario subir ambos archivos .crt y .pk antes de continuar'
                    );
                    echo json_encode($response_data);
                    exit;
                }

                $extension_crt = $_FILES['archivo_crt']['name'][0];
                $destination = './llaves/' . $extension_crt;
                move_uploaded_file($_FILES['archivo_crt']['tmp_name'][0], $destination);

                $extension_pk = $_FILES['archivo_pk']['name'][0];
                $destination = './llaves/' . $extension_pk;
                move_uploaded_file($_FILES['archivo_pk']['tmp_name'][0], $destination);

                $this->vFacturation->M_modifcar_crt_pk($extension_crt, $extension_pk);
            }

            $id_facturacion = ($btn == 'add') ? 0 : $_POST['id_facturacion'];

            $facturacion = array(
                (object) array(
                    'cod_token'     => $_POST['token'],
                    'cod_ambiente'  => $_POST['ambiente'],
                    'cod_sistema'   => $_POST['codigo'],
                    'nit'           => $_POST['nit'],
                    'cod_sucursal'  => 0,
                    'cod_modalidad' => $_POST['modalidad'],
                )
            );

            // Solicitud de datos - CUIS
            $Codigos = new Codigos($facturacion);
            $puntoVentaInicial = 0;
            $respons = $Codigos->solicitudCuis($puntoVentaInicial);
            $success = $respons['success'];

            if ($success) {
                $response = json_decode($respons['response']);
                if ($response->RespuestaCuis->transaccion || $response->RespuestaCuis->mensajesList->codigo == '980') {

                    $data = array(
                        'id_facturacion' => $id_facturacion,
                        'nit' => $_POST['nit'],
                        'cod_sistema' => $_POST['codigo'],
                        'cod_ambiente' => $_POST['ambiente'],
                        'cod_modalidad' => $_POST['modalidad'],
                        'cod_emision' => 1,
                        'cod_token' => $_POST['token'],
                        'cod_cafc' => $_POST['cafc'],
                        'cafc_ini' => $_POST['cafc_ini'],
                        'cafc_fin' => $_POST['cafc_fin'],
                        'cod_cafc_tasas' => $_POST['cafc_tasas'],
                        'cafc_tasas_ini' => $_POST['cafc_tasas_ini'],
                        'cafc_tasas_fin' => $_POST['cafc_tasas_fin'],
                        'smtp_host' => $_POST['smtp_host'],
                        'smtp_port' => $_POST['smtp_port'],
                        'smtp_user' => $_POST['smtp_user'],
                        'smtp_pass' => $_POST['smtp_pass']
                    );

                    $data = $this->vFacturation->M_gestionar_sistema(json_encode($data));
                    $data = json_decode($data);

                    if ($data->estado == true && $btn == 'add') {
                        $sucursal = $this->vFacturation->M_sucursal_inicial();
                        $id_sucursal = $sucursal[0]->id_sucursal;
                        $data = $this->C_registrar_cuis($id_sucursal);
                        if ($data->estado == true) {
                            $data = $this->C_generar_cufd($id_sucursal);
                            if ($data->estado == true) {
                                $data = $this->C_sincronizar_catalogos($id_sucursal);
                            }
                        }
                    }
                } else {
                    // Maneja el error de respuesta CUIS
                    $response_data = array(
                        (object) array(
                            'estado' => false,
                            'mensaje' => $response->RespuestaCuis->mensajesList->descripcion,
                        )
                    );
                }
            } else {

                $response_data = array(
                    (object) array(
                        'estado' => false,
                        'mensaje' => $respons['error'],
                    )
                );
            }

            if (empty($response_data)) {
                $response_data[] = (object) array(
                    'estado' => true,
                    'mensaje' => ''
                );
            }

            $json_response = json_encode($response_data);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_last_error_msg();
                exit;
            }

            header('Content-Type: application/json');
            echo $json_response;
            exit;
        }

        function C_registrar_cuis($id_sucursal){
            $facturacion    = $this->vFacturation->M_informacion_facturacion($id_sucursal);
            $id_facturacion = $facturacion[0]->id_facturacion;
            $Codigos        = new Codigos($facturacion);
            $puntoVentaInicial  = 0;
            $respons        = $Codigos->solicitudCuis($puntoVentaInicial);
            $success        = $respons['success'];
            if ($success) {
                $response       = json_decode($respons['response']); // Convierte el JSON en un objeto PHP
                $codigo         = $response->RespuestaCuis->codigo; // Accede al valor del código
                $fechaVigencia  = $response->RespuestaCuis->fechaVigencia; // Accede al valor del código
                $array = array(
                    "id_punto_venta" => 0,
                    "id_facturacion" => $id_facturacion,
                    "id_sucursal"    => $id_sucursal,
                    "codigo"         => $codigo,
                    "fechaVigencia"  => $fechaVigencia,
                );
                $data = $this->vFacturation->M_registrar_cuis(json_encode($array));
            }else{
                $data = array(
                    (object) array(
                        'estado' => false,
                        'mensaje' => $respons['error'],
                    )
                );
            }
            return $data;
        }

        function C_generar_cufd($id_sucursal){
            // Valores
            date_default_timezone_set('America/La_Paz');
            $feccre         = date('Y-m-d H:i:s.v');
            $facturacion    = $this->vFacturation->M_informacion_facturacion($id_sucursal);
            $datos_cuis     = $this->vFacturation->M_datos_iniciales_cuis($id_sucursal);
            $Codigos        = new Codigos($facturacion);
            $respons        = $Codigos->solicitudCufd($datos_cuis[0]->cod_cuis,$datos_cuis[0]->cod_punto_venta);
            $success        = $respons['success'];
            if ($success) {
                $response   = json_decode($respons['response']);
                if ($response->RespuestaCufd->transaccion) {
                    $array_cufd = array(
                        'codpuntoventa' => $datos_cuis[0]->cod_punto_venta,
                        'cufd'          => $response->RespuestaCufd->codigo,
                        'idfacturacion' => $facturacion[0]->id_facturacion,
                        'idsucursal'    => $id_sucursal,
                        'codcontrol'    => $response->RespuestaCufd->codigoControl,
                        'direccion'     => $response->RespuestaCufd->direccion,
                        'feccre'        => $feccre,
                        'fecven'        => $response->RespuestaCufd->fechaVigencia,
                    );
                    $json_cufd = json_encode($array_cufd);
                    $data = $this->vFacturation->fn_registrar_cufd(($json_cufd));
                }else {
                    $data = array(
                        (object) array(
                            'estado' => false,
                            'mensaje' => $response->RespuestaCufd->mensajesList->descripcion,
                        )
                    );
                }
            }else{
                $data = array(
                    (object) array(
                        'estado' => false,
                        'mensaje' => $respons['error'],
                    )
                );
            }
        return $data;
        }

        function C_sincronizar_catalogos($id_sucursal){

            $facturacion    = $this->vFacturation->M_credenciales_facturacion(0,$id_sucursal);
            $Codigos        = new Sincronizacion($facturacion);

            $resultados = array();

            $resultados['idfacturacion'] = $facturacion[0]->id_facturacion;
            $resultados['idsucursal'] = $id_sucursal;
            $resultados['codpuntoventa'] = 0;

            $sincronizarActividades  = $Codigos->sincronizarActividades();
            if ($sincronizarActividades['success']) {
                $response       = json_decode($sincronizarActividades['response']);
                if ($response->RespuestaListaActividades->transaccion) {
                    $resultados['sincronizarActividades'] = $sincronizarActividades['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaActividades->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarActividades['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarFechaHora  = $Codigos->sincronizarFechaHora();
            if ($sincronizarFechaHora['success']) {
                $response       = json_decode($sincronizarFechaHora['response']);
                if ($response->RespuestaFechaHora->transaccion) {
                    $resultados['sincronizarFechaHora'] = $sincronizarFechaHora['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaFechaHora->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarFechaHora['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarListaActividadesDocumentoSector  = $Codigos->sincronizarListaActividadesDocumentoSector();
            if ($sincronizarListaActividadesDocumentoSector['success']) {
                $response       = json_decode($sincronizarListaActividadesDocumentoSector['response']);
                if ($response->RespuestaListaActividadesDocumentoSector->transaccion) {
                    $resultados['sincronizarListaActividadesDocumentoSector'] = $sincronizarListaActividadesDocumentoSector['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaActividadesDocumentoSector->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarListaActividadesDocumentoSector['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarListaLeyendasFactura  = $Codigos->sincronizarListaLeyendasFactura();
            if ($sincronizarListaLeyendasFactura['success']) {
                $response       = json_decode($sincronizarListaLeyendasFactura['response']);
                if ($response->RespuestaListaParametricasLeyendas->transaccion) {
                    $resultados['sincronizarListaLeyendasFactura'] = $sincronizarListaLeyendasFactura['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricasLeyendas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarListaLeyendasFactura['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarListaMensajesServicios  = $Codigos->sincronizarListaMensajesServicios();
            if ($sincronizarListaMensajesServicios['success']) {
                $response       = json_decode($sincronizarListaMensajesServicios['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarListaMensajesServicios'] = $sincronizarListaMensajesServicios['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarListaMensajesServicios['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarListaProductosServicios  = $Codigos->sincronizarListaProductosServicios();
            if ($sincronizarListaProductosServicios['success']) {
                $response       = json_decode($sincronizarListaProductosServicios['response']);
                if ($response->RespuestaListaProductos->transaccion) {
                    $resultados['sincronizarListaProductosServicios'] = $sincronizarListaProductosServicios['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaProductos->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarListaProductosServicios['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaEventosSignificativos  = $Codigos->sincronizarParametricaEventosSignificativos();
            if ($sincronizarParametricaEventosSignificativos['success']) {
                $response       = json_decode($sincronizarParametricaEventosSignificativos['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaEventosSignificativos'] = $sincronizarParametricaEventosSignificativos['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaEventosSignificativos['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaMotivoAnulacion  = $Codigos->sincronizarParametricaMotivoAnulacion();
            if ($sincronizarParametricaMotivoAnulacion['success']) {
                $response       = json_decode($sincronizarParametricaMotivoAnulacion['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaMotivoAnulacion'] = $sincronizarParametricaMotivoAnulacion['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaMotivoAnulacion['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaPaisOrigen  = $Codigos->sincronizarParametricaPaisOrigen();
            if ($sincronizarParametricaPaisOrigen['success']) {
                $response       = json_decode($sincronizarParametricaPaisOrigen['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaPaisOrigen'] = $sincronizarParametricaPaisOrigen['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaPaisOrigen['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoDocumentoIdentidad  = $Codigos->sincronizarParametricaTipoDocumentoIdentidad();
            if ($sincronizarParametricaTipoDocumentoIdentidad['success']) {
                $response       = json_decode($sincronizarParametricaTipoDocumentoIdentidad['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoDocumentoIdentidad'] = $sincronizarParametricaTipoDocumentoIdentidad['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoDocumentoIdentidad['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoDocumentoSector  = $Codigos->sincronizarParametricaTipoDocumentoSector();
            if ($sincronizarParametricaTipoDocumentoSector['success']) {
                $response       = json_decode($sincronizarParametricaTipoDocumentoSector['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoDocumentoSector'] = $sincronizarParametricaTipoDocumentoSector['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoDocumentoSector['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoEmision  = $Codigos->sincronizarParametricaTipoEmision();
            if ($sincronizarParametricaTipoEmision['success']) {
                $response       = json_decode($sincronizarParametricaTipoEmision['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoEmision'] = $sincronizarParametricaTipoEmision['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoEmision['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoHabitacion  = $Codigos->sincronizarParametricaTipoHabitacion();
            if ($sincronizarParametricaTipoHabitacion['success']) {
                $response       = json_decode($sincronizarParametricaTipoHabitacion['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoHabitacion'] = $sincronizarParametricaTipoHabitacion['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoHabitacion['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoMetodoPago  = $Codigos->sincronizarParametricaTipoMetodoPago();
            if ($sincronizarParametricaTipoMetodoPago['success']) {
                $response       = json_decode($sincronizarParametricaTipoMetodoPago['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoMetodoPago'] = $sincronizarParametricaTipoMetodoPago['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoMetodoPago['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoMoneda  = $Codigos->sincronizarParametricaTipoMoneda();
            if ($sincronizarParametricaTipoMoneda['success']) {
                $response       = json_decode($sincronizarParametricaTipoMoneda['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoMoneda'] = $sincronizarParametricaTipoMoneda['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoMoneda['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTipoPuntoVenta  = $Codigos->sincronizarParametricaTipoPuntoVenta();
            if ($sincronizarParametricaTipoPuntoVenta['success']) {
                $response       = json_decode($sincronizarParametricaTipoPuntoVenta['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTipoPuntoVenta'] = $sincronizarParametricaTipoPuntoVenta['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTipoPuntoVenta['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaTiposFactura  = $Codigos->sincronizarParametricaTiposFactura();
            if ($sincronizarParametricaTiposFactura['success']) {
                $response       = json_decode($sincronizarParametricaTiposFactura['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaTiposFactura'] = $sincronizarParametricaTiposFactura['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaTiposFactura['error'],
                    )
                );
                return $data;
                exit();
            }

            $sincronizarParametricaUnidadMedida  = $Codigos->sincronizarParametricaUnidadMedida();
            if ($sincronizarParametricaUnidadMedida['success']) {
                $response       = json_decode($sincronizarParametricaUnidadMedida['response']);
                if ($response->RespuestaListaParametricas->transaccion) {
                    $resultados['sincronizarParametricaUnidadMedida'] = $sincronizarParametricaUnidadMedida['response'];
                }else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                        )
                    );
                    return $data;
                    exit();
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => $sincronizarParametricaUnidadMedida['error'],
                    )
                );
                return $data;
                exit();
            }

            $data = $this->vFacturation->M_gestionar_catalogo_facturacion(json_encode($resultados, JSON_UNESCAPED_UNICODE));
            return $data;
        }

        //PUNTO DE VENTA

        function C_generar_cuis(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_facturacion = (int) $_POST['id_facturacion'];
                $id_punto_venta = (int) $_POST['id_punto_venta'];
                $id_sucursal = (int) $_POST['id_sucursal'];

                $facturacion    = $this->vFacturation->M_informacion_facturacion($id_sucursal);

                $Codigos            = new Codigos($facturacion);
                $respons            = $Codigos->solicitudCuis($id_punto_venta);
                $success            = $respons['success'];
                if ($success) {
                    $response       = json_decode($respons['response']); // Convierte el JSON en un objeto PHP
                    $codigo         = $response->RespuestaCuis->codigo; // Accede al valor del código
                    $fechaVigencia  = $response->RespuestaCuis->fechaVigencia; // Accede al valor del código
                    $array = array(
                        "id_punto_venta" => $id_punto_venta,
                        "id_facturacion" => $id_facturacion,
                        "id_sucursal"    => $id_sucursal,
                        "codigo"         => $codigo,
                        "fechaVigencia"  => $fechaVigencia,
                    );
                    $data = $this->vFacturation->M_registrar_cuis(json_encode($array));
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $respons['error'],
                        )
                    );
                }
            }
            echo json_encode($data);
        }

        function C_generar_cufds(){
            // Valores
            date_default_timezone_set('America/La_Paz');
            $feccre         = date('Y-m-d H:i:s.v');
            $datos = $this->vFacturation->M_fn_listar_punto_venta_todos();
            if ($datos) {
                foreach ($datos as $fila) {
                    if($fila->cuis!=''){
                        $facturacion    = $this->vFacturation->M_informacion_facturacion($fila->id_sucursal);
                        $Codigos        = new Codigos($facturacion);
                        $respons        = $Codigos->solicitudCufd($fila->cuis, $fila->cod_punto_venta);
                        $success        = $respons['success'];
                        if ($success) {
                            //$respons      = json_decode(json_encode($respons));
                            $response       = json_decode($respons['response']); // Convierte el JSON en un objeto PHP
                            if ($response->RespuestaCufd->transaccion) {
                                $array_cufd = array(
                                    'codpuntoventa' => $fila->cod_punto_venta,
                                    'cufd'          => $response->RespuestaCufd->codigo,
                                    'idfacturacion' => $fila->id_facturacion,
                                    'idsucursal'    => $fila->id_sucursal,
                                    'codcontrol'    => $response->RespuestaCufd->codigoControl,
                                    'direccion'     => $response->RespuestaCufd->direccion,
                                    'feccre'        => $feccre,
                                    'fecven'        => $response->RespuestaCufd->fechaVigencia,
                                );
                                $json_cufd = json_encode($array_cufd);
                                $data = $this->vFacturation->M_registrar_cufd($json_cufd);
                            } else {
                                $data = array(
                                    (object) array(
                                        'oboolean' => 'f',
                                        'omensaje' => $response->RespuestaCufd->mensajesList->descripcion,
                                    )
                                );
                            }
                        } else {
                            $data = array(
                                (object) array(
                                    'oboolean' => 'f',
                                    'omensaje' => $respons['error'],
                                )
                            );
                        }
                    }else {
                        break;
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => 'Verifique que los codigos Cuis de todos los puntos de venta esten generados',
                            )
                        );

                    }
                }
            }else{
                $data = array(
                    (object) array(
                        'oboolean' => 'f',
                        'omensaje' => 'No existen puntos de venta',
                    )
                );
            }
            echo json_encode($data);
        }

        function C_lst_punto_venta() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_sucursal = (int) $_POST['id_sucursal'];
                $this->vView->dataBranch = $this->vFacturation->M_listar_punto_venta($id_sucursal);
                error_log(print_r($this->vView->dataBranch, true));

                if ($this->vView->dataBranch) {
                    echo json_encode($this->vView->dataBranch);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'No se encontraron puntos de venta para la sucursal.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Método no permitido.'
                ]);
            }
        }

        function C_generar_catalogo(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_facturacion = (int) $_POST['id_facturacion'];
                $id_punto_venta = (int) $_POST['id_punto_venta'];
                $id_sucursal = (int) $_POST['id_sucursal'];

                $facturacion    = $this->vFacturation->M_credenciales_facturacion($id_punto_venta, $id_sucursal);
                $Codigos        = new Sincronizacion($facturacion);

                $resultados = array();

                $resultados['idfacturacion'] = $id_facturacion;
                $resultados['idsucursal'] = $id_sucursal;
                $resultados['codpuntoventa'] = $id_punto_venta;

                $sincronizarActividades  = $Codigos->sincronizarActividades();
                if ($sincronizarActividades['success']) {
                    $response       = json_decode($sincronizarActividades['response']);
                    if ($response->RespuestaListaActividades->transaccion) {
                        $resultados['sincronizarActividades'] = $sincronizarActividades['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaActividades->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarActividades['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarFechaHora  = $Codigos->sincronizarFechaHora();
                if ($sincronizarFechaHora['success']) {
                    $response       = json_decode($sincronizarFechaHora['response']);
                    if ($response->RespuestaFechaHora->transaccion) {
                        $resultados['sincronizarFechaHora'] = $sincronizarFechaHora['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaFechaHora->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarFechaHora['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarListaActividadesDocumentoSector  = $Codigos->sincronizarListaActividadesDocumentoSector();
                if ($sincronizarListaActividadesDocumentoSector['success']) {
                    $response       = json_decode($sincronizarListaActividadesDocumentoSector['response']);
                    if ($response->RespuestaListaActividadesDocumentoSector->transaccion) {
                        $resultados['sincronizarListaActividadesDocumentoSector'] = $sincronizarListaActividadesDocumentoSector['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaActividadesDocumentoSector->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarListaActividadesDocumentoSector['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarListaLeyendasFactura  = $Codigos->sincronizarListaLeyendasFactura();
                if ($sincronizarListaLeyendasFactura['success']) {
                    $response       = json_decode($sincronizarListaLeyendasFactura['response']);
                    if ($response->RespuestaListaParametricasLeyendas->transaccion) {
                        $resultados['sincronizarListaLeyendasFactura'] = $sincronizarListaLeyendasFactura['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricasLeyendas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarListaLeyendasFactura['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarListaMensajesServicios  = $Codigos->sincronizarListaMensajesServicios();
                if ($sincronizarListaMensajesServicios['success']) {
                    $response       = json_decode($sincronizarListaMensajesServicios['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarListaMensajesServicios'] = $sincronizarListaMensajesServicios['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarListaMensajesServicios['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarListaProductosServicios  = $Codigos->sincronizarListaProductosServicios();
                if ($sincronizarListaProductosServicios['success']) {
                    $response       = json_decode($sincronizarListaProductosServicios['response']);
                    if ($response->RespuestaListaProductos->transaccion) {
                        $resultados['sincronizarListaProductosServicios'] = $sincronizarListaProductosServicios['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaProductos->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarListaProductosServicios['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaEventosSignificativos  = $Codigos->sincronizarParametricaEventosSignificativos();
                if ($sincronizarParametricaEventosSignificativos['success']) {
                    $response       = json_decode($sincronizarParametricaEventosSignificativos['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaEventosSignificativos'] = $sincronizarParametricaEventosSignificativos['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaEventosSignificativos['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaMotivoAnulacion  = $Codigos->sincronizarParametricaMotivoAnulacion();
                if ($sincronizarParametricaMotivoAnulacion['success']) {
                    $response       = json_decode($sincronizarParametricaMotivoAnulacion['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaMotivoAnulacion'] = $sincronizarParametricaMotivoAnulacion['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaMotivoAnulacion['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaPaisOrigen  = $Codigos->sincronizarParametricaPaisOrigen();
                if ($sincronizarParametricaPaisOrigen['success']) {
                    $response       = json_decode($sincronizarParametricaPaisOrigen['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaPaisOrigen'] = $sincronizarParametricaPaisOrigen['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaPaisOrigen['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoDocumentoIdentidad  = $Codigos->sincronizarParametricaTipoDocumentoIdentidad();
                if ($sincronizarParametricaTipoDocumentoIdentidad['success']) {
                    $response       = json_decode($sincronizarParametricaTipoDocumentoIdentidad['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoDocumentoIdentidad'] = $sincronizarParametricaTipoDocumentoIdentidad['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoDocumentoIdentidad['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoDocumentoSector  = $Codigos->sincronizarParametricaTipoDocumentoSector();
                if ($sincronizarParametricaTipoDocumentoSector['success']) {
                    $response       = json_decode($sincronizarParametricaTipoDocumentoSector['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoDocumentoSector'] = $sincronizarParametricaTipoDocumentoSector['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoDocumentoSector['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoEmision  = $Codigos->sincronizarParametricaTipoEmision();
                if ($sincronizarParametricaTipoEmision['success']) {
                    $response       = json_decode($sincronizarParametricaTipoEmision['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoEmision'] = $sincronizarParametricaTipoEmision['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoEmision['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoHabitacion  = $Codigos->sincronizarParametricaTipoHabitacion();
                if ($sincronizarParametricaTipoHabitacion['success']) {
                    $response       = json_decode($sincronizarParametricaTipoHabitacion['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoHabitacion'] = $sincronizarParametricaTipoHabitacion['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoHabitacion['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoMetodoPago  = $Codigos->sincronizarParametricaTipoMetodoPago();
                if ($sincronizarParametricaTipoMetodoPago['success']) {
                    $response       = json_decode($sincronizarParametricaTipoMetodoPago['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoMetodoPago'] = $sincronizarParametricaTipoMetodoPago['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoMetodoPago['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoMoneda  = $Codigos->sincronizarParametricaTipoMoneda();
                if ($sincronizarParametricaTipoMoneda['success']) {
                    $response       = json_decode($sincronizarParametricaTipoMoneda['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoMoneda'] = $sincronizarParametricaTipoMoneda['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoMoneda['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTipoPuntoVenta  = $Codigos->sincronizarParametricaTipoPuntoVenta();
                if ($sincronizarParametricaTipoPuntoVenta['success']) {
                    $response       = json_decode($sincronizarParametricaTipoPuntoVenta['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTipoPuntoVenta'] = $sincronizarParametricaTipoPuntoVenta['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTipoPuntoVenta['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaTiposFactura  = $Codigos->sincronizarParametricaTiposFactura();
                if ($sincronizarParametricaTiposFactura['success']) {
                    $response       = json_decode($sincronizarParametricaTiposFactura['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaTiposFactura'] = $sincronizarParametricaTiposFactura['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaTiposFactura['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $sincronizarParametricaUnidadMedida  = $Codigos->sincronizarParametricaUnidadMedida();
                if ($sincronizarParametricaUnidadMedida['success']) {
                    $response       = json_decode($sincronizarParametricaUnidadMedida['response']);
                    if ($response->RespuestaListaParametricas->transaccion) {
                        $resultados['sincronizarParametricaUnidadMedida'] = $sincronizarParametricaUnidadMedida['response'];
                    } else {
                        $data = array(
                            (object) array(
                                'oboolean' => 'f',
                                'omensaje' => $response->RespuestaListaParametricas->mensajesList->descripcion,
                            )
                        );
                        return $data;
                        exit();
                    }
                } else {
                    $data = array(
                        (object) array(
                            'oboolean' => 'f',
                            'omensaje' => $sincronizarParametricaUnidadMedida['error'],
                        )
                    );
                    return $data;
                    exit();
                }

                $data = $this->vFacturation->M_gestionar_catalogo_facturacion(json_encode($resultados));
                echo json_encode($data);
            }
        }

        public function C_generar_lista_actividades(){
            $id_facturacion = (int) $_POST['id_facturacion'];
            $cod_punto_venta = (int) $_POST['cod_punto_venta'];
            $id_sucursal = (int) $_POST['id_sucursal'];
            $data = $this->vFacturation->M_generar_lista_actividades($id_facturacion, $id_sucursal, $cod_punto_venta);
            echo json_encode($data);
        }

        public function C_agregar_actividad(){
            $id_facturacion = (int) $_POST['id_facturacion_act'];
            $id_sucursal = (int) $_POST['id_sucursal_act'];
            $cod_punto_venta = (int) $_POST['cod_punto_venta_act'];
            $cod_actividad = (int) $_POST['actividad'];
 
    
            $array_actividad = array(
                'cod_actividad'     => $cod_actividad,
                'id_facturacion'    => $id_facturacion,
                'id_sucursal'       => $id_sucursal,
                'cod_punto_venta'   => $cod_punto_venta,
            );
            
            $data = $this->vFacturation->M_agregar_actividad(json_encode($array_actividad));
            echo json_encode($data);
        }

        // PRODUCTOS
            // MARCA
            public function datos_marca($id_mar){
                $data = $this->vFacturation->get_datos_marca($id_mar);
                $rewriteKeys = array(
                    'oidmarca' => 'id_marca',
                    'ocodigo' => 'codigo',
                    'odescripcion' => 'descripcion',
                    'ogarantia' => 'garantia',
                    'otiempo_garantia' => 'tiempo_garantia',
                    'ofeccre' => 'feccre',
                    'ousucre' => 'usucre',
                    'ofecmod' => 'fecmod',
                    'ousumod' => 'usumod',
                    'oapiestado' => 'apiestado',
                    'oimagen' => 'imagen',
                    'omostrar' => 'mostar'
                );

                $datos = array();

                foreach ($data as $key => $value) {
                    $datos[$rewriteKeys[$key]] = $value;
                }

                echo json_encode($datos);
            }

            //CATEGORIA

    // VENTA-FACTURADA
    public function verifica_cliente(){
      $nit =(int) $_POST['valor_nit'];
      $correo =(string) $_POST['correo'];
      $valor = $this->vFacturation->verifica_cliente($nit, $correo);
      echo json_encode($valor);
    }

    public function C_registrar_cliente(){
      $docs_identidad = $_POST['docs_identidad'];
      $id_documento = $this->ventaFacturada->M_id_documento($docs_identidad);

      //Agrupar las variables relacionadas en un arreglo
      $data = array(
        'id_cliente'    => 0,
        'nombres'       => $this->input->post('razonSocial'),
        'apellidos'     => '',
        'tipo_documento' => $id_documento[0]->id_catalogo,
        'documento'     => $this->input->post('valor_nit'),
        'valid_docs'    => 'false',
        'valid_excep'   => 'false',
        'correo'        => $this->input->post('correo_venta'),
        'movil'         => '',
        'direccion'     => '',
        'descripcion'   => '',
        'latitud'       => '0',
        'longitud'      => '0',
        'id_ubicacion'  => $this->session->userdata('ubicacion'),
      );

      $data = $this->vFacturation->M_registrar_cliente(json_encode($data));

      echo json_encode($data);
    }

    public function datos_nombre(){
      $nombre =  $_POST['buscar'];
      $idInvLote =  $_POST['idInvLote'];
      $stock_prod = $this->vFacturation->verificar_cantidad($nombre);
      if ($stock_prod[0]->cantidad > 0) {
        $data = $this->vFacturation->get_datos_nombre($nombre, $idInvLote);
      } else {
        $data = array('error' => 'Validación fallida');
      }
      echo json_encode($data);
    }

  public function datos_producto(){
    $id_producto = $_POST['buscar'];
    $stock_prod = $this->vFacturation->verificar_cantidad($id_producto);
    if ($stock_prod[0]->cantidad > 0) {
      $data = $this->vFacturation->get_datos_producto($id_producto);
    } else {
      $data = array('error' => 'Validación fallida');
    }

    echo json_encode($data);
  }

    public function mostrar_producto(){
      $nombre = $this->vFacturation->mostrar_producto();
      echo json_encode($nombre);
    }

    // function registrar_factura(){
    //     date_default_timezone_set('America/La_Paz');

    //     $usuario          = IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
    //     $id_venta         = $this->ventaFacturada->id_venta($usuario);
    //     $id_venta         = $id_venta[0]->id_venta;
    //     $descuento        = $_POST['descuento'];
    //     $tipopago         = $_POST['tipopago'];
    //     $pago_efectivo    = $_POST['pago_efectivo'];
    //     $pago_tarjeta     = $_POST['pago_tarjeta'];
    //     $pago_gift        = $_POST['pago_gift'];
    //     $pago_otros       =$_POST['pago_otros'];
    //     $montoTasa        = $_POST['monto_tasa'];
    //     $numeroTarjeta    = $_POST['nro_tarjeta'];
    //     /* Tipo de facturas adicionales */
    //     // Factura de alquiler
    //     $periodo = $_POST('periodo');
    //     // Factura de sector educativo
    //     $estudiante = $this->input->post('estudiante');
    //     $periodo_est = $this->input->post('periodo_est');
    //     $dato_adicional_descripcion = $this->input->post('dato_adicional_descripcion');
    //     $dato_adicional = $this->input->post('dato_adicional');
    //     $datos = array(
    //     'idventa'        => $id_venta,
    //     'efectivo'       => $pago_efectivo,
    //     'tarjeta'        => $pago_tarjeta,
    //     'gift'           => $pago_gift,
    //     'otros'          => $pago_otros,
    //     'descuento'      => $descuento
    //     );

    //     $datos_venta        = $this->ventaFacturada->datos_venta(json_encode($datos));


    //     $lstas_datos_venta  = json_decode($datos_venta[0]->fn_datos_venta);

    //     // valores que se deberian recuperar con el documento de identidad
    //     $nombre_rsocial   = $this->input->post('razonSocial');
    //     $ci_nit_completo           = $this->input->post('valor_nit');
    //     $complemento      = $this->input->post('complemento');
    //     $codigoExcepcion  = $this->input->post('codigoExcepcion');
    //     $docs_identidad   = $this->input->post('docs_identidad');
    //     $lst_pedidos      = $lstas_datos_venta->pedidos;
    //     $datos            = $this->ventaFacturada->datos_cliente($ci_nit_completo);
    //     $correo           = $datos[0]->correo;
    //     $ci_nit           = $datos[0]->nit_ci;
    //     $cod_cliente      = $datos[0]->cod_cliente;

    //     // no se deberia guardar nada si no hay correo;
    //     if (!$correo) {
    //     $correo = 'No se asigno un correo electronico';
    //     }

    //     $nitEmisor            = $lstas_datos_venta->nit_emisor;
    //     $razonSocialEmisor    = $lstas_datos_venta->rsocial_emisor;
    //     $municipio            = $lstas_datos_venta->municipio;
    //     $telefono             = $lstas_datos_venta->telefono;
    //     $direccion            = $lstas_datos_venta->direccion;
    //     $tipofactura              = $this->input->post('tipofactura');
    //     $tipofacturadocumento   = '1';
    //     $codigodocumentosector  = '1';

    //     $this->session->unset_userdata('tipo_factura');
    //     $this->session->set_userdata('dato_adicional', $dato_adicional);
    //     $this->session->set_userdata('dato_adicional_descripcion', $dato_adicional_descripcion);
    //     switch ($tipofactura) {
    //     case 1:
    //         $codigodocumentosector  = '1';
    //         break;
    //     case 2:
    //         $this->session->set_userdata('tipo_factura', '2');
    //         $this->session->set_userdata('periodo', $periodo);
    //         $codigodocumentosector  = '1'; //Cambiar cuando aprueben facturas de alquiler
    //         break;
    //     case 3:
    //         $this->session->set_userdata('tipo_factura', '3');
    //         $this->session->set_userdata('estudiante', $estudiante);
    //         $this->session->set_userdata('periodo_est', $periodo_est);
    //         $codigodocumentosector  = '1'; //Cambiar cuando aprueben facturas de alquiler
    //         break;
    //     case 41:
    //         $codigodocumentosector  = '41';
    //         break;

    //     default:
    //         $codigodocumentosector  = '1';
    //         break;
    //     }


    //     $facturacion        = $this->ventaFacturada->datos_facturacion();
    //     $leyenda            = $this->ventaFacturada->M_lista_leyendas_facturacion();
    //     // Obtenemos un índice aleatorio de la tabla $leyenda
    //     $randomIndex = array_rand($leyenda);
    //     // Utilizamos el índice aleatorio para obtener el elemento correspondiente
    //     $descripcionleyenda = $leyenda[$randomIndex]->odescripcionleyenda;

    //     $codigoPuntoVenta   = $facturacion[0]->cod_punto_venta;
    //     $codigo_control     = $facturacion[0]->cod_control;
    //     $nit                = $facturacion[0]->nit;
    //     $codigoSucursal     = $facturacion[0]->cod_sucursal;
    //     $codigoModalidad    = $facturacion[0]->cod_modalidad;
    //     $codigoAmbiente     = $facturacion[0]->cod_ambiente;

    //     $nfactura           = $this->ventaFacturada->nro_factura($codigoSucursal);
    //     $nfactura           = $nfactura[0]->id_lote;

    //     $codigoEmision      = $this->ventaFacturada->M_cod_estado();

    //     if ($codigoEmision[0]->cod_estado == '0') {
    //     $codigo_emision = 1;
    //     } else {
    //     $codigo_emision = 2;
    //     }

    //     $DatosCuf = array(
    //     'Nit'                 => $nit,
    //     'CodigoSucursal'      => $codigoSucursal,
    //     'CodigoModalidad'     => $codigoModalidad,
    //     'CodigoEmision'       => $codigo_emision,
    //     'TipoFactura'         => $tipofacturadocumento,
    //     'TipoDocumentoSector' => $codigodocumentosector,
    //     'CodigoPuntoVenta'    => $codigoPuntoVenta,
    //     'CodigoControl'       => $codigo_control,
    //     );

    //     $codigoCuf = new GeneradorCuf($DatosCuf);
    //     $ArrayCuf = $codigoCuf->generarCuf($nfactura);
    //     $success = $ArrayCuf['success'];
    //     if ($success) {

    //     $cuf                = $ArrayCuf['cuf'];
    //     $fechaEnvio         = $ArrayCuf['fecha'];
    //     $cufd               = $facturacion[0]->cod_cufd;
    //     $fechaHora          = str_replace(' ', 'T', date('Y-m-d H:i:s.v'));
    //     $nombre_rsocial     = $nombre_rsocial ?? "SIN NOMBRE";
    //     $ci_nit             = $ci_nit ?? 777;

    //     $codigoMetodoPago   = $this->input->post('tipo_documento');
    //     $codigoMetodoPago   = $this->ventaFacturada->MetodoPago($codigoMetodoPago);

    //     $codigoMetodoPago   = $codigoMetodoPago[0]->codigo;
    //     $Cabecera_Array = array(
    //         'cod_cliente'         => $cod_cliente,
    //         'nitEmisor'           => $nitEmisor,
    //         'razonSocialEmisor'   => $razonSocialEmisor,
    //         'municipio'           => $municipio,
    //         'telefono'            => $telefono,
    //         'direccion'           => $direccion,
    //         'numeroFactura'       => $nfactura,
    //         'cuf'                 => $cuf,
    //         'cufd'                => $cufd,
    //         'cafc'                => '',
    //         'codigoSucursal'      => $codigoSucursal,
    //         'codigoPuntoVenta'    => $codigoPuntoVenta,
    //         'fechaEmision'        => $fechaEnvio,
    //         'nombreRazonSocial'   => $nombre_rsocial,
    //         'numeroDocumento'     => $ci_nit,
    //         'complemento'         => $complemento,
    //         'codigoExcepcion'     => $codigoExcepcion,
    //         'docs_identidad'      => $docs_identidad,
    //         'numeroTarjeta'       => $numeroTarjeta,
    //         'codigoMetodoPago'    => $codigoMetodoPago,
    //         'montoTotal'          => number_format(($lstas_datos_venta->subTotal), 2),
    //         'montoTotalSujetoIva' => number_format(($lstas_datos_venta->total - $montoTasa), 2),
    //         'montoTotalMoneda'    => number_format(($lstas_datos_venta->subTotal), 2),
    //         'montoGiftCard'       => number_format($lstas_datos_venta->gift_card, 2),
    //         'descuentoAdicional'  => number_format($lstas_datos_venta->descuento, 2),
    //         'usuario'             => $usuario,
    //         'leyenda'             => $descripcionleyenda
    //     );

    //     $xml = new GeneradorXml();
    //     if ($codigoModalidad == 2) {
    //         if ($codigodocumentosector == '1') {
    //         $factura_XML = $xml->CompraVentaComputarizada($Cabecera_Array, $lst_pedidos);
    //         } else {
    //         $factura_XML = $xml->CompraVentaTasas($Cabecera_Array, $lst_pedidos, $montoTasa);
    //         }
    //     } else {
    //         if ($codigodocumentosector == '1') {
    //         $factura_XML = $xml->CompraVentaElectronica($Cabecera_Array, $lst_pedidos);
    //         } else {
    //         $factura_XML = $xml->CompraVentaElectronicaTasas($Cabecera_Array, $lst_pedidos, $montoTasa);
    //         }
    //     }

    //     $facturacion_ubicacion = $this->ventaFacturada->datos_ubicacion_facturacion();

    //     $namefactura = $cuf . '.xml';
    //     $FacturacionCompraVenta = new FacturacionCompraVenta($facturacion);
    //     if ($codigo_emision == 1) {
    //         $tipo   = $this->input->post('tipo_documento');
    //         $ci_nit = $ci_nit . '';
    //         $factura_XML = '';
    //         if ($codigoModalidad == 2) {
    //         $rutaXml = FCPATH . 'assets/facturasxml/' . $cuf . '.xml';
    //         $respons      = $FacturacionCompraVenta->solicitudRecepcionFactura($rutaXml, $fechaHora, $codigodocumentosector);
    //         $success      = $respons['success'];
    //         $response     = json_decode($respons['response']);
    //         $respons      = ($response);
    //         } else {
    //         $rutaXml = FCPATH . 'assets/facturasfirmadasxml/' . $cuf . '.xml';
    //         $llaves       = $this->ventaFacturada->M_llaves();
    //         $privateKey   = $llaves[0]->oprivatekey;
    //         $publicKey    = $llaves[0]->opublickey;
    //         $dirs = array(
    //             'nombreArchivo' => $cuf,
    //             'privateKeyPem' => $privateKey,
    //             'publicKeyPem'  => $publicKey,
    //         );


    //         $respons      = $FacturacionCompraVenta->firmadorFacturaElectronicaPruebas($dirs);
    //         if ($respons['success'] == 'true') {
    //             $respons      = $FacturacionCompraVenta->solicitudRecepcionFactura($rutaXml, $fechaHora, $codigodocumentosector);
    //             $success      = $respons['success'];
    //             $response     = json_decode($respons['response']);
    //             $respons      = ($response);
    //         } else {
    //             $success      = $respons['success'];
    //             $data = array(
    //             (object) array(
    //                 'oboolean' => 'f',
    //                 'omensaje' => $respons['error'],
    //             )
    //             );
    //             echo json_encode($data);
    //             return;
    //         }
    //         }
    //         $codigoRecepcion = $respons->RespuestaServicioFacturacion->codigoRecepcion;
    //         if ($codigoRecepcion) {
    //         $val = array(
    //             'id_lote'           => $nfactura,
    //             'cuf'               => $cuf,
    //             'codigoRecepcion'   => $codigoRecepcion,
    //             'namefactura'       => $namefactura,
    //             'xmlfactura'        => $factura_XML,
    //             'nombre_rsocial'    => str_replace("'", "''", $nombre_rsocial),
    //             'numero_documento'  => $ci_nit_completo,
    //             'correo'            => $correo,
    //             'total'             => str_replace(',', '', number_format(($lstas_datos_venta->subTotal), 2)),
    //             'tipofacturadocumento' => $tipofacturadocumento,
    //             'codigodocumentosector' => $codigodocumentosector,
    //             'fechaHora'         => $fechaHora,
    //             'estado'            => 'ACEPTADO',
    //             'id_facturacion'    => $facturacion[0]->id_facturacion,
    //             'id_sucursal'       => $facturacion_ubicacion[0]->id_sucursal,
    //             'cod_punto_venta'   => $facturacion_ubicacion[0]->codigo_punto_venta,
    //         );
    //         $tipo_modalidad = "";
    //         $tipo_seleccion = $this->input->post('seleccion', true);
    //         foreach ($tipo_seleccion as $seleccion) {
    //             if ($seleccion == 'deuda') {
    //             $tipo_modalidad = 'A Deuda';
    //             }
    //         }
    //         $cobro  = $this->ventaFacturada->realizar_cobro_factura($tipo, $ci_nit_completo, $nfactura, $tipopago, $tipo_modalidad );  //GAN-MS-B0-1545, SDegado, 22/04/2024
    //         $val = $this->ventaFacturada->M_registrar_factura(json_encode($val));
    //         }
    //         $transaccion = false;
    //     } else {
    //         $tipo    = $this->input->post('tipo_documento');
    //         $ci_nit  = $ci_nit . '';
    //         $factura_XML = '';
    //         $codigoRecepcion = 'SIN LINEA';

    //         if ($codigoModalidad != 2) {
    //         $llaves       = $this->ventaFacturada->M_llaves();
    //         $privateKey   = $llaves[0]->oprivatekey;
    //         $publicKey    = $llaves[0]->opublickey;
    //         $dirs = array(
    //             'nombreArchivo' => $cuf,
    //             'privateKeyPem' => $privateKey,
    //             'publicKeyPem'  => $publicKey,
    //         );
    //         $respons      = $FacturacionCompraVenta->firmadorFacturaElectronicaPruebas($dirs);
    //         };

    //         $val = array(
    //         'id_lote'         => $nfactura,
    //         'cuf'             => $cuf,
    //         'codigoRecepcion' => $codigoRecepcion,
    //         'namefactura'     => $namefactura,
    //         'xmlfactura'      => $factura_XML,
    //         'nombre_rsocial'  => str_replace("'", "''", $nombre_rsocial),
    //         'numero_documento' => $ci_nit_completo,
    //         'correo'          => $correo,
    //         'total'           => str_replace(',', '', number_format(($lstas_datos_venta->subTotal), 2)),
    //         'tipofacturadocumento' => $tipofacturadocumento,
    //         'codigodocumentosector' => $codigodocumentosector,
    //         'fechaHora' => $fechaHora,
    //         'estado' => 'PENDIENTE',
    //         'id_facturacion'    => $facturacion[0]->id_facturacion,
    //         'id_sucursal'       => $facturacion_ubicacion[0]->id_sucursal,
    //         'cod_punto_venta'   => $facturacion_ubicacion[0]->codigo_punto_venta,
    //         );
    //         $tipo_modalidad = "";
    //         $tipo_seleccion = $this->input->post('seleccion', true);
    //         foreach ($tipo_seleccion as $seleccion) {
    //         if ($seleccion == 'deuda') {
    //             $tipo_modalidad = "A Deuda";
    //         }
    //         }
    //         $cobro  = $this->ventaFacturada->realizar_cobro_factura($tipo, $ci_nit_completo, $nfactura, $tipopago,$tipo_modalidad);  //GAN-MS-B0-1545, SDegado, 22/04/2024
    //         $val = $this->ventaFacturada->M_registrar_factura(json_encode($val));
    //         $respons = "SIN CONEXION";
    //         $transaccion = true;
    //     }
    //     $data = array(
    //         'idventa' => $id_venta,
    //         'transaccion' => $transaccion,
    //         'cobro' => json_encode($cobro),
    //         'val' => json_encode($val),
    //         'respons'   => json_encode($respons),
    //         'resources' => json_encode(array('fechaEnvio' => $fechaEnvio, 'cuf' => $cuf)),
    //     );
    //     } else {
    //     $data = array(
    //         (object) array(
    //         'oboolean' => 'f',
    //         'omensaje' => $ArrayCuf['error'],
    //         )
    //     );
    //     }
    //     echo json_encode($data);
    // }

    // function verificar_nit(){

    //     $nitVerificar       = $this->input->post('documento');
    //     $facturacion        = $this->vFacturation->datos_facturacion();
    //     $lib_Codigo         = new Codigos($facturacion);

    //     $data = $lib_Codigo->solicitudVerificarNit($nitVerificar);

    //     echo json_encode($data);
    // }



    }
