<?Php

class IdEnSession
	{
		public static function iniSession()
			{
				/*session_start();*/
				/*session_save_path("/var/www/html/tmp_session");*/
                session_id();
				session_start();
                session_name();
			}
		
		public static function sessionDestroy($vSessionkey = false)
			{
				if($vSessionkey)/*si se envia una clave*/
					{
						
						if(is_array($vSessionkey))/* revisa si es un arreglo */
							{
								/* recorre cada uno */
								for($i=0;$i<count($vSessionkey);$i++)
									{
										/* si existe alguna variable */
										if(isset($_SESSION[$vSessionkey[$i]]))
											{
												/* luego destruye cada segun el array*/
												unset($_SESSION[$vSessionkey[$i]]);
											}
									}
							}
						else
							{
								/* si no es un array verifica si existe un valor*/
								if(isset($_SESSION[$vSessionkey]))
									{
										/* destruye el valor de la clave como session*/
										unset($_SESSION[$vSessionkey]);
									}
							}
					}
				else
					{
						session_destroy();
					}
			}
			
		public static function setSession($vSessionkey, $vValor)
			{
				/* ASIGNA LA VARIABLE DE LA CLAVE AL VALOR SI EXISTE*/
				if(!empty($vSessionkey))
					{
						$_SESSION[$vSessionkey] = $vValor;
					}
			}
			
		public static function getSession($vSessionkey)
			{
				if(isset($_SESSION[$vSessionkey]))
					{
						return $_SESSION[$vSessionkey];
					}
			}
			
		public static function acceso($vLevelUser)
			{
				/* controla nivel de usuario segun jerarquia*/
				if(!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE))
					{
						header('Location: '.BASE_VIEW_URL.'error/access/500');
						exit;
					}
					
				IdEnSession::timeSession();
				
				if(IdEnSession::getLevelUser($vLevelUser) > IdEnSession::getLevelUser(IdEnSession::getSession('level')))
					{
						header('Location: '.BASE_VIEW_URL.'error/access/1001');
						exit;						
					}
			}
			
		public static function timeSession()
			{
				if((!IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'TimeSession')) || (!defined('DEFAULT_SESSION_USER_TIME')))
					{
						throw new Exception('Tiempo de Session no Definido!');
					}
					
				if(DEFAULT_SESSION_USER_TIME == 0)
					{
						return;
					}
					
				if(time() - IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'TimeSession') > (DEFAULT_SESSION_USER_TIME * 60))/*resta tiempo actual menos el tiempo de session del usuario*/
					{
                        IdEnSession::setSession(DEFAULT_USER_AUTHENTICATE, false);
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE);
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'UserCode');
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'UserEmail');
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'UserRole');
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'ProfileName');
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'ProfileCode');
                        IdEnSession::sessionDestroy(DEFAULT_USER_AUTHENTICATE.'TimeSession');
						header('Location: '.BASE_VIEW_URL.'error/sessionTimeExpired');
					}
				else
					{
						IdEnSession::setSession(DEFAULT_USER_AUTHENTICATE.'TimeSession', time());
					}
			}
	}
?>