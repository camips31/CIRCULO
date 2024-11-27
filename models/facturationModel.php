<?php

class facturationModel extends IdEnModel
	{
		public function __construct() 
			{
				parent::__construct();
			}
		
		//listar tipo de documentos
		public function M_listar_documentos(){
			$vResultDocs = $this->vDataBase->query("Call fn_listar_documentos();");
			return $vResultDocs->fetchAll();
			$vResultDocs->close();
		}

		//insert en la tabla clientes
		public function insertClient($vNombres, $vApellidos, $vIDDocumento, $vDocumento, $vComplemento, $vCorreo, $vMovil, $vDireccion, $vDescripcion){
				
				$vNombres = (string) $vNombres;
				$vApellidos = (string) $vApellidos;
				$vDocumento = (string) $vDocumento;
				$vIDDocumento = (int) $vIDDocumento;
				$vComplemento = (string) $vComplemento;
				$vCorreo = (string) $vCorreo;
				$vMovil = (int) $vMovil;
				$vDireccion = (string) $vDireccion;
				$vDescripcion = (string) $vDescripcion;
			
				$vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
				$vDateCreate = date("Y-m-d H:i:s", time());
			
				$query = "INSERT INTO tb_cdlu_clients(nombre_rsocial, apellidos_sigla, id_documento, nit_ci, correo, movil, direccion, descripcion, feccre, usucre, complemento) 
						VALUES (:nombre_rsocial, :apellidos_sigla, :id_documento, :nit_ci, :correo, :movil, :direccion, :descripcion, :feccre, :usucre, :complemento)";
			
				$stmt = $this->vDataBase->prepare($query);
				$vResultRegister = $stmt->execute(array(
					':nombre_rsocial' => $vNombres,
					':apellidos_sigla' => $vApellidos,
					':id_documento' => $vIDDocumento,
					':nit_ci' => $vDocumento,
					':correo' => $vCorreo,
					':movil' => $vMovil,
					':direccion' => $vDireccion,
					':descripcion' => $vDescripcion,
					':feccre' => $vDateCreate,
					':usucre' => $vUserCreate,
					':complemento' => $vComplemento
				));
			
				if ($vResultRegister) {
					return $this->vDataBase->lastInsertId();
				} else {
					return false;
				}
		}
			
		//data de la tabla clientes para el listado de clientes
		public function getClients(){
            $vResultClients = $this->vDataBase->query("SELECT tb_cdlu_clients.* FROM tb_cdlu_clients;");
            return $vResultClients->fetchAll();
            $vResultClients->close();            
        }

		public function datos_facturacion(){
			$idlogin = $this->session->userdata('id_usuario');
			$query = $this->db->query("SELECT * FROM fn_datos_facturacion($idlogin)");
			return $query->result();
		  }

		//insert en la tabla brand - marca
		public function InsertBrand($code_brand, $description_brand, $warranty_brand, $time_warranty_brand, $img_brand) {
				$code_brand = (string) $code_brand;
				$description_brand = (string) $description_brand;
				$warranty_brand = (string) $warranty_brand;
				$time_warranty_brand = (int) $time_warranty_brand;
				$img_brand = (string) $img_brand;
				
				$vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
				$vDateCreate = date("Y-m-d H:i:s", time());
			
				$query = "INSERT INTO tb_cdlu_brand(codigo, descripcion, garantia, tiempo_garantia, feccre, usucre, imagen) 
						  VALUES (:codigo, :descripcion, :garantia, :tiempo_garantia, :feccre, :usucre, :imagen)";
			
				$stmt = $this->vDataBase->prepare($query);
				$vResultRegister = $stmt->execute(array(
					':codigo' => $code_brand,
					':descripcion' => $description_brand,
					':garantia' => $warranty_brand,
					':tiempo_garantia' => $time_warranty_brand,
					':feccre' => $vDateCreate,
					':usucre' => $vUserCreate,
					':imagen' => $img_brand
				));
			
				if ($vResultRegister) {
					return $this->vDataBase->lastInsertId();
				} else {
					return false;
				}
		}
	
		//data de la tabla brand para el listado de marca
		public function getBrands(){
				$vResultBrands = $this->vDataBase->query("SELECT tb_cdlu_brand.* FROM tb_cdlu_brand;");
				return $vResultBrands->fetchAll();
				$vResultBrands->close();            
		}

		//insert en la tabla categories - categoria
		public function InsertCategories($code_cat, $descrp_cat, $img_cat, $codsin, $unities_cat) {
			$code_cat = (string) $code_cat;
			$descrp_cat = (string) $descrp_cat;
			$img_cat = (string) $img_cat;
			$codsin = (int) $codsin;
			$unities_cat = (string) $unities_cat;
			
			$vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserEmail');
			$vDateCreate = date("Y-m-d H:i:s", time());
		
			$query = "INSERT INTO tb_cdlu_category(codigo, descripcion, feccre, usucre, imagen, codigo_sin, id_unidad) 
					  VALUES (:codigo, :descripcion, :feccre, :usucre, :imagen, :codigo_sin, :id_unidad)";

			$stmt = $this->vDataBase->prepare($query);
			$vResultRegister = $stmt->execute(array(
				':codigo' => $code_cat,
				':descripcion' => $descrp_cat,
				':feccre' => $vDateCreate,
				':usucre' => $vUserCreate,
				':imagen' => $img_cat,
				':codigo_sin' => $codsin,
				':id_unidad' => $unities_cat,
			));
		
			if ($vResultRegister) {
				return $this->vDataBase->lastInsertId();
			} else {
				return false;
			}
		}

		//data de la tabla categories para el listado de categoria
		public function getCategory(){
            $vResultCategory = $this->vDataBase->query("SELECT tb_cdlu_category.* FROM tb_cdlu_category;");
            return $vResultCategory->fetchAll();
            $vResultCategory->close();            
        }

		//data de la tabla de configuracion del sistema
		public function M_datos_sistema(){
			$ResultSistem = $this->vDataBase->query("SELECT id_facturacion ,nit,cod_sistema ,cod_ambiente ,cod_modalidad ,cod_emision ,cod_token ,cod_cafc, cafc_ini, cafc_fin, cod_cafc_tasas, cafc_tasas_ini, cafc_tasas_fin, tc.descripcion, smtp_host ,smtp_port ,smtp_user ,smtp_pass 
                                    FROM tb_cdlu_facturation tf,tb_cdlu_catalogo tc  
                                    WHERE tf.apiestado LIKE 'ELABORADO'
                                    and tc.catalogo ='cat_sistema'
                                    and tc.codigo='informacion'");
			return $ResultSistem->fetchAll();
			$ResultSistem->close();     
		}

		//CONFIGURACION

			public function M_sucursal_inicial(){
					$ResultNewBranch = $this->vDataBase->query("SELECT tcb.id_sucursal FROM tb_cdlu_branch tcb WHERE tcb.codigo_sucursal = 0 AND tcb.id_facturacion = (SELECT tcf.id_facturacion FROM tb_cdlu_facturation tcf WHERE tcf.apiestado LIKE 'ELABORADO')");
					$sucursal = $ResultNewBranch->fetchAll(PDO::FETCH_OBJ);
					return $sucursal;
			}

			public function M_gestionar_sistema($json){
				$data = json_decode($json, true);
					$idlogin = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
					
					$pIdFacturacion = (int) $data['id_facturacion'];
					$pNit = $data['nit'];
					$pCodSistema = $data['cod_sistema'];
					$pCodAmbiente = (int) $data['cod_ambiente'];
					$pCodModalidad = (int) $data['cod_modalidad'];
					$pCodEmision = (int) $data['cod_emision'];
					$pCodToken = $data['cod_token'];
					$pCodCafc = $data['cod_cafc'];
					$pCafcIni = (int) $data['cafc_ini'];
					$pCafcFin = (int) $data['cafc_fin'];
					$pCodCafcTasas = $data['cod_cafc_tasas'];
					$pCafcTasasIni = (int) $data['cafc_tasas_ini'];
					$pCafcTasasFin = (int) $data['cafc_tasas_fin'];
					$pSmtpHost = $data['smtp_host'];
					$pSmtpPort = (int) $data['smtp_port'];
					$pSmtpUser = $data['smtp_user'];
					$pSmtpPass = $data['smtp_pass'];
					
					try {
						// Ejecutamos la llamada al procedimiento almacenado
						$query_result = $this->vDataBase->query("CALL fn_gestionar_sistema(
							$idlogin, 
							$pIdFacturacion, 
							'$pNit', 
							'$pCodSistema',
							$pCodAmbiente, 
							$pCodModalidad, 
							$pCodEmision, 
							'$pCodToken', 
							'$pCodCafc', 
							$pCafcIni, 
							$pCafcFin, 
							'$pCodCafcTasas',
							$pCafcTasasIni, 
							$pCafcTasasFin, 
							'$pSmtpHost', 
							$pSmtpPort, 
							'$pSmtpUser', 
							'$pSmtpPass', 
							@oMensaje, 
							@oBoolean
						)");
				
						// Recuperamos los valores de salida
						$query_result->closeCursor(); // Asegúrate de liberar el cursor para obtener las variables de salida
						$output = $this->vDataBase->query("SELECT @oMensaje AS mensaje, @oBoolean AS estado")->fetch(PDO::FETCH_ASSOC);
				
						$mensaje = $output['mensaje'];
						$estado = ($output['estado'] == '1' || $output['estado'] > 0) ? true : false;
				
						// Retornamos el resultado como JSON
						return json_encode([
							'mensaje' => $mensaje,
							'estado' => $estado
						]);
					} catch (Exception $e) {
						// Manejo de errores
						echo "Error: " . $e->getMessage();
						return json_encode([
							'mensaje' => 'Error al ejecutar la función',
							'estado' => false
						]);
					}
			}
			
			public function M_modifcar_crt_pk($crt_filename,$pk_filename){
					$idlogin= (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
					$ResultCTR_PK = $this->vDataBase->query("CALL fn_modificar_crt_pk('$idlogin','$crt_filename','$pk_filename');");
					$result = $ResultCTR_PK->fetch(PDO::FETCH_ASSOC);
					$response = [
						'mensaje' => $result['mensaje'],
						'estado' => $result['estado'] == 1 ? true : false
					];
					$ResultCTR_PK->closeCursor();
					return $response;  
			}
			
			public function M_informacion_facturacion($id_sucursal) {
				$id_sucursal = (int) $id_sucursal;
				$ResultInfFac = $this->vDataBase->query("Call fn_informacion_facturacion($id_sucursal);");
				if ($ResultInfFac) {
					$data = $ResultInfFac->fetchAll(PDO::FETCH_OBJ);
					$ResultInfFac->closeCursor();
					return $data;
				} else {
					return [];
				}
			}

			public function M_datos_iniciales_cuis($id_sucursal){
				$ResultCUISInit = $this->vDataBase->query("SELECT oc.id_facturacion, oc.cod_punto_venta, oc.cod_cuis 
									FROM ope_cuis oc 
									WHERE oc.apiestado LIKE 'ELABORADO' 
									AND oc.cod_punto_venta = 0 
									AND id_facturacion = (SELECT cf.id_facturacion 
									FROM tb_cdlu_facturation cf WHERE apiestado LIKE 'ELABORADO')
									AND id_sucursal = $id_sucursal;");
				if ($ResultCUISInit) {
					$data = $ResultCUISInit->fetchAll(PDO::FETCH_OBJ);
					$ResultCUISInit->closeCursor();
					return $data;
				} else {
					return [];
				}	
			}

			public function M_registrar_cuis($json) {
				$id_usuario = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
				$ResultCUIS = $this->vDataBase->query("call fn_registrar_cuis($id_usuario, '$json');");
				$data = $ResultCUIS->fetch(PDO::FETCH_ASSOC);
				$ResultCUIS->closeCursor(); 
				if ($data) {
					return (object) array(
						'estado' => $data['success'] == true,
						'mensaje' => $data['message'],
						'data' => $data
					);
				} else {
					return (object) array(
						'estado' => false,
						'mensaje' => 'No se pudo registrar el CUIS.'
					);
				}
			}
			
			public function fn_registrar_cufd($json){
				$id_usuario = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
				$ResultCUFD = $this->vDataBase->query("call fn_registrar_cufd($id_usuario, '$json');");
				$data = $ResultCUFD->fetch(PDO::FETCH_ASSOC);
				$ResultCUFD->closeCursor(); 
				if ($data) {
					return (object) array(
						'estado' => $data['success'] == true, 
						'mensaje' => $data['message'], 
						'data' => $data
					);
				} else {
					return (object) array(
						'estado' => false,
						'mensaje' => 'No se pudo registrar el CUFD.'
					);
				}
			}

			public function M_credenciales_facturacion($codPuntoVenta,$id_sucursal) {
				$id_sucursal = (int) $id_sucursal;
				$ResultCredentials= $this->vDataBase->query("Call fn_credenciales_facturacion($codPuntoVenta,$id_sucursal);");
				if ($ResultCredentials) {
					$data = $ResultCredentials->fetchAll(PDO::FETCH_OBJ);
					$ResultCredentials->closeCursor();
					return $data;
				} else {
					return [];
				}
			}

			public function M_gestionar_catalogo_facturacion($json) {
				$id_usuario = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
			
				try {
					// Decodificar el JSON principal
					$decodedJson = json_decode($json, true);
			
					// Procesar el campo anidado 'sincronizarActividades' si existe
					if (isset($decodedJson['sincronizarActividades'])) {
						$decodedJson['sincronizarActividades'] = json_decode($decodedJson['sincronizarActividades'], true);
						$decodedJson['sincronizarActividades'] = json_encode($decodedJson['sincronizarActividades'], JSON_UNESCAPED_UNICODE);
					}
			
					// Procesar el campo anidado 'sincronizarFechaHora' si existe
					if (isset($decodedJson['sincronizarFechaHora'])) {
						$decodedJson['sincronizarFechaHora'] = json_decode($decodedJson['sincronizarFechaHora'], true);
						$decodedJson['sincronizarFechaHora'] = json_encode($decodedJson['sincronizarFechaHora'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarListaActividadesDocumentoSector' si existe
					if (isset($decodedJson['sincronizarListaActividadesDocumentoSector'])) {
						$decodedJson['sincronizarListaActividadesDocumentoSector'] = json_decode($decodedJson['sincronizarListaActividadesDocumentoSector'], true);
						$decodedJson['sincronizarListaActividadesDocumentoSector'] = json_encode($decodedJson['sincronizarListaActividadesDocumentoSector'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'RespuestaListaParametricasLeyendas' si existe
					if (isset($decodedJson['RespuestaListaParametricasLeyendas'])) {
						$decodedJson['RespuestaListaParametricasLeyendas'] = json_decode($decodedJson['RespuestaListaParametricasLeyendas'], true);
						$decodedJson['RespuestaListaParametricasLeyendas'] = json_encode($decodedJson['RespuestaListaParametricasLeyendas'], JSON_UNESCAPED_UNICODE);
					}
					
					// Procesar el campo anidado 'sincronizarListaMensajesServicios' si existe
					if (isset($decodedJson['sincronizarListaMensajesServicios'])) {
						$decodedJson['sincronizarListaMensajesServicios'] = json_decode($decodedJson['sincronizarListaMensajesServicios'], true);
						$decodedJson['sincronizarListaMensajesServicios'] = json_encode($decodedJson['sincronizarListaMensajesServicios'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarListaProductosServicios' si existe
					if (isset($decodedJson['sincronizarListaProductosServicios'])) {
						$decodedJson['sincronizarListaProductosServicios'] = json_decode($decodedJson['sincronizarListaProductosServicios'], true);
						$decodedJson['sincronizarListaProductosServicios'] = json_encode($decodedJson['sincronizarListaProductosServicios'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaEventosSignificativos' si existe
					if (isset($decodedJson['sincronizarParametricaEventosSignificativos'])) {
						$decodedJson['sincronizarParametricaEventosSignificativos'] = json_decode($decodedJson['sincronizarParametricaEventosSignificativos'], true);
						$decodedJson['sincronizarParametricaEventosSignificativos'] = json_encode($decodedJson['sincronizarParametricaEventosSignificativos'], JSON_UNESCAPED_UNICODE);
					}

					
					// Procesar el campo anidado 'sincronizarParametricaMotivoAnulacion' si existe
					if (isset($decodedJson['sincronizarParametricaMotivoAnulacion'])) {
						$decodedJson['sincronizarParametricaMotivoAnulacion'] = json_decode($decodedJson['sincronizarParametricaMotivoAnulacion'], true);
						$decodedJson['sincronizarParametricaMotivoAnulacion'] = json_encode($decodedJson['sincronizarParametricaMotivoAnulacion'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaPaisOrigen' si existe
					if (isset($decodedJson['sincronizarParametricaPaisOrigen'])) {
						$decodedJson['sincronizarParametricaPaisOrigen'] = json_decode($decodedJson['sincronizarParametricaPaisOrigen'], true);
						$decodedJson['sincronizarParametricaPaisOrigen'] = json_encode($decodedJson['sincronizarParametricaPaisOrigen'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaTipoDocumentoIdentidad' si existe
					if (isset($decodedJson['sincronizarParametricaTipoDocumentoIdentidad'])) {
						$decodedJson['sincronizarParametricaTipoDocumentoIdentidad'] = json_decode($decodedJson['sincronizarParametricaTipoDocumentoIdentidad'], true);
						$decodedJson['sincronizarParametricaTipoDocumentoIdentidad'] = json_encode($decodedJson['sincronizarParametricaTipoDocumentoIdentidad'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaTipoDocumentoSector' si existe
					if (isset($decodedJson['sincronizarParametricaTipoDocumentoSector'])) {
						$decodedJson['sincronizarParametricaTipoDocumentoSector'] = json_decode($decodedJson['sincronizarParametricaTipoDocumentoSector'], true);
						$decodedJson['sincronizarParametricaTipoDocumentoSector'] = json_encode($decodedJson['sincronizarParametricaTipoDocumentoSector'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaTipoEmision' si existe
					if (isset($decodedJson['sincronizarParametricaTipoEmision'])) {
						$decodedJson['sincronizarParametricaTipoEmision'] = json_decode($decodedJson['sincronizarParametricaTipoEmision'], true);
						$decodedJson['sincronizarParametricaTipoEmision'] = json_encode($decodedJson['sincronizarParametricaTipoEmision'], JSON_UNESCAPED_UNICODE);
					}
					// Procesar el campo anidado 'sincronizarParametricaTipoHabitacion' si existe
					if (isset($decodedJson['sincronizarParametricaTipoHabitacion'])) {
						$decodedJson['sincronizarParametricaTipoHabitacion'] = json_decode($decodedJson['sincronizarParametricaTipoHabitacion'], true);
						$decodedJson['sincronizarParametricaTipoHabitacion'] = json_encode($decodedJson['sincronizarParametricaTipoHabitacion'], JSON_UNESCAPED_UNICODE);
					}
					// Procesar el campo anidado 'sincronizarParametricaTipoMetodoPago' si existe
					if (isset($decodedJson['sincronizarParametricaTipoMetodoPago'])) {
						$decodedJson['sincronizarParametricaTipoMetodoPago'] = json_decode($decodedJson['sincronizarParametricaTipoMetodoPago'], true);
						$decodedJson['sincronizarParametricaTipoMetodoPago'] = json_encode($decodedJson['sincronizarParametricaTipoMetodoPago'], JSON_UNESCAPED_UNICODE);
					}
					// Procesar el campo anidado 'sincronizarParametricaTipoMoneda' si existe
					if (isset($decodedJson['sincronizarParametricaTipoMoneda'])) {
						$decodedJson['sincronizarParametricaTipoMoneda'] = json_decode($decodedJson['sincronizarParametricaTipoMoneda'], true);
						$decodedJson['sincronizarParametricaTipoMoneda'] = json_encode($decodedJson['sincronizarParametricaTipoMoneda'], JSON_UNESCAPED_UNICODE);
					}
					// Procesar el campo anidado 'sincronizarParametricaTipoPuntoVenta' si existe
					if (isset($decodedJson['sincronizarParametricaTipoPuntoVenta'])) {
						$decodedJson['sincronizarParametricaTipoPuntoVenta'] = json_decode($decodedJson['sincronizarParametricaTipoPuntoVenta'], true);
						$decodedJson['sincronizarParametricaTipoPuntoVenta'] = json_encode($decodedJson['sincronizarParametricaTipoPuntoVenta'], JSON_UNESCAPED_UNICODE);
					}
					// Procesar el campo anidado 'sincronizarParametricaTiposFactura' si existe
					if (isset($decodedJson['sincronizarParametricaTiposFactura'])) {
						$decodedJson['sincronizarParametricaTiposFactura'] = json_decode($decodedJson['sincronizarParametricaTiposFactura'], true);
						$decodedJson['sincronizarParametricaTiposFactura'] = json_encode($decodedJson['sincronizarParametricaTiposFactura'], JSON_UNESCAPED_UNICODE);
					}

					// Procesar el campo anidado 'sincronizarParametricaUnidadMedida' si existe
					if (isset($decodedJson['sincronizarParametricaUnidadMedida'])) {
						$decodedJson['sincronizarParametricaUnidadMedida'] = json_decode($decodedJson['sincronizarParametricaUnidadMedida'], true);
						$decodedJson['sincronizarParametricaUnidadMedida'] = json_encode($decodedJson['sincronizarParametricaUnidadMedida'], JSON_UNESCAPED_UNICODE);
					}

					
					$jsonFinal = json_encode($decodedJson, JSON_UNESCAPED_UNICODE);
			

					$stmt = $this->vDataBase->prepare("CALL fn_gestionar_catalogo_facturacion(:id_usuario, :json_data)");
					$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
					$stmt->bindParam(':json_data', $jsonFinal, PDO::PARAM_STR);
			
					$stmt->execute();
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
					return $data;
			
				} catch (Exception $e) {
					error_log("Error en la llamada a la base de datos: " . $e->getMessage());
					return (object) array(
						'estado' => false,
						'mensaje' => 'Error en la llamada a la base de datos: ' . $e->getMessage()
					);
				}
			}
			
			
		//PUNTO DE VENTA

			public function M_listar_punto_venta($id_sucursal) {
				$id_sucursal = (int) $id_sucursal;
				$ResultBranch = $this->vDataBase->query("CALL fn_listar_punto_venta($id_sucursal);");
				if ($ResultBranch) {
					$data = $ResultBranch->fetchAll(PDO::FETCH_OBJ);
					$ResultBranch->closeCursor();
					return $data;
				} else {
					return [];
				}
			}		

			public function M_listar_sucursales_activos() {
				$ResultAllBranch = $this->vDataBase->query("Call fn_listar_sucursal_activos();");
				return $ResultAllBranch->fetchAll();
				$ResultAllBranch->close(); 
			}

			public function M_fn_listar_punto_venta_todos() {
				$ResultAllPoints = $this->vDataBase->query("call fn_listar_punto_venta_todos();");
				return $ResultAllPoints->fetchAll();
				$ResultAllPoints->close(); 
			} 

			public function M_generar_lista_actividades($id_facturacion, $id_sucursal, $cod_punto_venta) {
				$ResultListActivities = $this->vDataBase->query("call fn_lista_actividades_facturacion($id_facturacion, $id_sucursal, $cod_punto_venta);");
				return $ResultListActivities->fetchAll(PDO::FETCH_ASSOC);
			}

			public function M_agregar_actividad($json){
				$id_usuario = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
				$ResultAddActivities = $this->vDataBase->query("SELECT fn_agregar_actividad($id_usuario, '$json')");
				return $ResultAddActivities->fetchAll();
			}
			
			public function listar_ubicaciones(){
				$ResultUbi = $this->vDataBase->query("call fn_listar_ubicaciones_libres();");
				return $ResultUbi->fetchAll();
				$ResultUbi->close();   
			}   
		
		//PRODUCTOS 

			//MARCA
				public function get_datos_marca($id_mar){
					$ResultBrand = $this->vDataBase->query("CALL get_datos_marca($id_mar);");
					return $ResultBrand->fetchAll();
					$ResultBrand->close(); 
				}

			//CATEGORIAS
				
			//PRODUCTS
				public function get_categoria_cmb(){
					$stmt = $this->vDataBase->query("SELECT * FROM tb_cdlu_category WHERE apiestado = 'ELABORADO'");
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					return $result; 
				}
			
				public function get_marca_cmb(){
					$stmt = $this->vDataBase->query("SELECT * FROM tb_cdlu_brand WHERE apiestado = 'ELABORADO'");
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 	
					return $result; 
				}
		  
				public function get_codsim_cmb() {
					$idlogin = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
					$ResultCodSim = $this->vDataBase->query("SELECT fn_get_codsim_productos($idlogin)");
					return $ResultCodSim->fetchAll(PDO::FETCH_ASSOC);				  
				}
				
				public function get_parametricas_cmb(){
					$idlogin = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'UserCode');
					$ResultCmb = $this->vDataBase->query("call fn_get_parametricas($idlogin)"); 
					$resultArray = $ResultCmb->fetchAll(PDO::FETCH_ASSOC);

					if (count($resultArray) == 0) {
						$ResultAllUni = $this->vDataBase->query("call fn_get_all_unidades1($idlogin)");
						return $ResultAllUni->fetchAll(PDO::FETCH_ASSOC);
					} else {
						return $resultArray;
					}
				}

				public function insertProduct($data, $adicionales){
					$idcategoria = $data['id_categoria'];
					$id_marca = $data['id_marca'];
					$codigo = $data['codigo'];
					$codigo_alt = $data['codigo_alt'];
					$descripcion = preg_replace('/\s+/', ' ', trim($data['descripcion']));
					$descripcion = str_replace(array("'", '"'), array("'||chr(39)||'", "'||chr(34)||'"), $data['descripcion']);
					$caracteristica = preg_replace('/\s+/', ' ', trim($data['caracteristica']));
					$imagen = 0;
					$codsin = $data['codsin'];
					$id_unidades = $data['unidades'];
					$usucre = $data['usucre'];
					$garantia = $data['garantia'];
					$servicios = $data['servicios'];
					$precio_compra = $data['precio_compra'];
					$precio_venta = $data['precio'];
					$price_status = $data['price_status'];
				
					if ($codsin == NULL) {
						$codsin = 0;
					}
					if ($precio_compra == NULL) {
						$precio_compra = 0;
					}
					if ($precio_venta == NULL) {
						$precio_venta = 0;
					}
					if ($id_unidades == null) {
						$id_unidades = 0;
					}
					$renovaciones = $data['renovaciones'];
					$receta = $data['con_receta'];
			
					$query_str = "CALL fn_registrar_productos($idcategoria, $id_marca, $id_unidades, '$codigo', '$codigo_alt', '$descripcion', '$caracteristica', $codsin, '$imagen', '$usucre', '$garantia', '$servicios', $precio_compra, $precio_venta, '$price_status', '$renovaciones', '$receta', '$adicionales')";
				
					$query = $this->vDataBase->query($query_str);
					return $query->result();
				}
				
		//VENTA-FACTURADA
		
			public function verifica_cliente($nit, $correo){
				$ResultVClient = $this->vDataBase->query("Call fn_verifica_cliente('$nit','$correo'); ");
				return $ResultVClient->result();
			}
		
			public function M_registrar_cliente($json){
			  $idlogin =(int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
			  $ResultRClient = $this->vDataBase->query("CALL fn_registrar_cliente_venta_facturada($idlogin,'$json'::JSON)");
			  return $ResultRClient->result();
			}

			public function mostrar_producto(){
				$id_usuario = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
				$permiso = (($this->vDataBase->query("SELECT descripcion FROM tb_cdlu_catalogo cc WHERE catalogo = 'cat_sistema' AND codigo = 'lotes_activos'"))->row())->descripcion;
				if ($permiso == 'true') {
				$query = $this->vDataBase->query(
					"SELECT *  FROM(
					SELECT (trim(cp.descripcion)||'||'||trim(cp.caracteristica)||'| CATEGORIA:'||cc.descripcion||' PRECIO:'||mp.prec_venta||' STOCK:'||mi.cantidad ||' #L:'|| coalesce(mi.lote::text,'')|| '-'|| coalesce(mi.lote_alt::text,'') ||' #FV:'|| coalesce(mi.fecven::text,'') ||'<span style=\"display: none;\"> ID:'||mi.id_invetario_lote || '</span>')::varchar as descripcion
					FROM tb_cdlu_product cp
					JOIN (select id_producto, case when cantidad =0 then 0 else round((precio_venta/cantidad),5) end prec_venta
						FROM (
						SELECT id_producto, precio_venta, cantidad, 
								ROW_NUMBER() OVER (PARTITION BY id_producto ORDER BY feccre DESC) AS row_num
						FROM mov_provision
						WHERE apiestado <>'ANULADO'
								and id_ubicacion in (select id_ubicacion
													from tb_cdlu_ubicaciones cu
													where id_ubicacion = 1
													)
						) sub
						WHERE row_num = 1
						) mp ON cp.id_producto = mp.id_producto
					JOIN mov_inventario_lotes mi ON cp.id_producto = mi.id_producto
					join cat_categoria cc on cp.id_categoria =cc.id_categoria
					WHERE cp.apiestado <>'ANULADO' 
					AND cp.apiestado <>'ELIMINADO' 
					and cp.garantia is false
					AND mi.id_ubicacion = (SELECT id_proyecto 
								FROM seg_usuario 
								WHERE id_usuario = $id_usuario)
					AND mi.cantidad >0)as p WHERE p.descripcion <> '';"
				);
				} else {
				$query = $this->vDataBase->query(
					"SELECT *  FROM(
					SELECT (trim(cp.descripcion)||'||'||trim(cp.caracteristica)||'| CATEGORIA:'||cc.descripcion||' PRECIO:'||mp.prec_venta||' STOCK:'||mi.cantidad)::varchar as descripcion
					FROM cat_producto cp
					JOIN (select id_producto, case when cantidad =0 then 0 else round((precio_venta/cantidad),5) end prec_venta
						FROM (
						SELECT id_producto, precio_venta, cantidad, 
								ROW_NUMBER() OVER (PARTITION BY id_producto ORDER BY feccre DESC) AS row_num
						FROM mov_provision
						WHERE apiestado <>'ANULADO'
								and id_ubicacion in (select id_ubicacion
													from cat_ubicaciones cu
													where id_relacion = (select case when id_relacion=0 then id_ubicacion  else id_relacion end
																from cat_ubicaciones
																where id_ubicacion =(select id_proyecto from seg_usuario where id_usuario=$id_usuario ))
														or id_ubicacion =(select case when id_relacion=0 then id_ubicacion  else id_relacion end
																from cat_ubicaciones
																where id_ubicacion =(select id_proyecto from seg_usuario where id_usuario=$id_usuario))
													)
						) sub
						WHERE row_num = 1
						) mp ON cp.id_producto = mp.id_producto
					JOIN mov_inventario mi ON cp.id_producto = mi.id_producto
					join cat_categoria cc on cp.id_categoria =cc.id_categoria
					WHERE cp.apiestado <>'ANULADO' 
					AND cp.apiestado <>'ELIMINADO' 
					and cp.garantia is false
					AND mi.id_ubicacion = (SELECT id_proyecto 
								FROM seg_usuario 
								WHERE id_usuario = $id_usuario)
					AND mi.cantidad >0)as p WHERE p.descripcion <> '';"
				);
				}

				return $query->result();
			}
			
			public function verificar_cantidad($producto){
			  $id_ubicacion = 1;
			  $query = $this->vDataBase->query("SELECT cantidad FROM mov_inventario mi WHERE id_producto = (SELECT id_producto from tb_cdlu_product cp where codigo ='$producto' or descripcion = '$producto') and id_ubicacion = $id_ubicacion");
			  return $query->result();
			}

			public function get_datos_producto($id_producto){
				$id_usuario = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');
				$query = $this->vDataBase->query("Call c($id_usuario,'$id_producto')");
				return $query->result();
			}

			public function get_datos_nombre($nombre){
				$id_usuario = (int) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE . 'UserCode');  
				$sql = "SELECT descripcion FROM tb_cdlu_product WHERE descripcion LIKE ?";
				$stmt = $this->vDataBase->prepare($sql);
				$searchTerm = "%" . $nombre . "%";
				$stmt->bind_param("s", $searchTerm);
				$stmt->execute();
				$result = $stmt->get_result();

				$data = $result->fetch_all(MYSQLI_ASSOC);
				echo json_encode($data); 
			}			
		
    }