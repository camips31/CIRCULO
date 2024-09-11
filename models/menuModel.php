<?php

class menuModel extends IdEnModel
	{
		public function __construct() 
			{
				parent::__construct();
			}
		
		/* BEGIN SELECT STATEMENT QUERY  */
		public function getPrincipalMenuIdEn($vLevel, $vCodeMenu, $vUserRole)
			{
                $vLevel = (int) $vLevel;
                $vCodeMenu = (int) $vCodeMenu;
                $vUserRole = (string) $vUserRole;
				/*$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                tb_cdlu_menu.*
                                                            FROM tb_cdlu_menu
                                                                WHERE n_level$vLevel = 1
                                                                    AND n_active = 1
                                                                    AND n_codprofiletype in(1)                                                                
                                                                    AND n_parent = $vCodeMenu
                                                                ORDER BY n_positionmenu ASC;");
				return $vPrincipalMenuIdEn->fetchAll();
				$vPrincipalMenuIdEn->close();*/
				
				switch($vUserRole)
					{
						case 'superadministrator':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;
						case 'administrador':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;                        
						case 'creative-director':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador')
                                                                            ORDER BY n_positionmenu ASC;");                        
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;                   
						case 'community-manager':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador', 'creative-director')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;
						case 'graphic-designer':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador', 'creative-director', 'community-manager')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;                      
						case 'manager-client':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador', 'creative-director', 'community-manager', 'graphic-designer')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;
						case 'register':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador', 'creative-director', 'community-manager', 'graphic-designer', 'manager-client')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;
						case 'web':
							$vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                            tb_cdlu_menu.*
                                                                        FROM tb_cdlu_menu
                                                                            WHERE n_level$vLevel = 1
                                                                                AND n_active = 1
                                                                                AND n_codprofiletype in(1)                                                                
                                                                                AND n_parent = $vCodeMenu
                                                                                AND c_menutype not in('superadministrator', 'administrador', 'creative-director', 'community-manager', 'graphic-designer', 'manager-client', 'register')
                                                                            ORDER BY n_positionmenu ASC;");
							return $vPrincipalMenuIdEn->fetchall();
							$vPrincipalMenuIdEn->close();
						break;                        
                    }            
			}
            public function getMenuNotModule($vLevelNumber){
                $vLevelNumber = (int) $vLevelNumber;
				$vMenuNotModule = $this->vDataBase->query("SELECT tb_cdlu_menu.*
                                                                    FROM tb_cdlu_menu
                                                                        WHERE tb_cdlu_menu.n_level$vLevelNumber = 1
                                                                            AND tb_cdlu_menu.n_codmenu not in(SELECT
                                                                                                                    tb_cdlu_modules.n_codmenu
                                                                                                                FROM tb_cdlu_modules)");
				return $vMenuNotModule->fetchAll();
				$vMenuNotModule->close();
			}
            public function getMenuTitle($vCodeMenu){
                $vCodeMenu = (int) $vCodeMenu;
				$vResultMenuTitle = $this->vDataBase->query("SELECT tb_cdlu_menu.c_title
                                                                    FROM tb_cdlu_menu
                                                                        WHERE tb_cdlu_menu.n_codmenu = $vCodeMenu");
				return $vResultMenuTitle->fetchColumn();
				$vResultMenuTitle->close();
			}
            public function getMenuRole($vCodeMenu){
                $vCodeMenu = (int) $vCodeMenu;
				$vResultMenuRole = $this->vDataBase->query("SELECT tb_cdlu_menu.c_menutype
                                                                    FROM tb_cdlu_menu
                                                                        WHERE tb_cdlu_menu.n_codmenu = $vCodeMenu");
				return $vResultMenuRole->fetchColumn();
				$vResultMenuRole->close();
			}            
            public function getPrivilegeMenuIdEn($vLevel, $vCodeMenu, $vUserRole)
			{
                $vLevel = (int) $vLevel;
                $vCodeMenu = (int) $vCodeMenu;
                $vUserRole = (string) $vUserRole;
				
                $vPrincipalMenuIdEn = $this->vDataBase->query("SELECT
                                                                tb_cdlu_menu.*
                                                            FROM tb_cdlu_menu
                                                                WHERE n_level$vLevel = 1
                                                                    AND n_active = 1
                                                                    AND n_codprofiletype in(1)                                                                
                                                                    AND n_parent = $vCodeMenu
                                                                    AND c_menutype in ($vUserRole)
                                                                ORDER BY n_positionmenu ASC;");
				return $vPrincipalMenuIdEn->fetchAll();
				$vPrincipalMenuIdEn->close();         
			}            
    
		public function getIfMenuIsParent($vCodeMenu)
			{
                $vCodeMenu = (int) $vCodeMenu;
				$vResultMenuExists = $this->vDataBase->query("SELECT
                                                                COUNT(*)
                                                            FROM tb_cdlu_menu
                                                                WHERE tb_cdlu_menu.n_parent = $vCodeMenu;");
				return $vResultMenuExists->fetchcolumn();
				$vResultMenuExists->close();
			}    
    
		public function getMenuExists($vCodeMenu)
			{
                $vCodeMenu = (int) $vCodeMenu;
				$vResultMenuExists = $this->vDataBase->query("SELECT
                                                                COUNT(*)
                                                            FROM tb_cdlu_menu
                                                                WHERE tb_cdlu_menu.n_codmenu = $vCodeMenu;");
				return $vResultMenuExists->fetchcolumn();
				$vResultMenuExists->close();
			}    
    
		public function getListMenu()
			{
				$vResultListMenu = $this->vDataBase->query("SELECT
                                                                *
                                                            FROM tb_cdlu_menu
                                                                ORDER BY tb_cdlu_menu.n_codmenu ASC;");
				return $vResultListMenu->fetchall();
				$vResultListMenu->close();
			}    
    
		public function getDataItemMenu($vCodMenu)
			{
                $vCodMenu = (int) $vCodMenu;
				$vResultDataMenu = $this->vDataBase->query("SELECT
                                                                *
                                                            FROM tb_cdlu_menu
                                                                WHERE tb_cdlu_menu.n_codmenu = $vCodMenu;");
				return $vResultDataMenu->fetchall();
				$vResultDataMenu->close();
			}    
    
		public function getFirstLevelMenu($vUserRole)//UTILIZADO
			{
				$vUserRole = (string) $vUserRole;
				
				switch($vUserRole)
					{
						case 'superadministrator':
							$vFirstLevelMenu = $this->vDataBase->query("SELECT * 
                                                                                  FROM tb_cdlu_menu
                                                                                WHERE n_level1 = 1
                                                                                  AND n_level2 = 0
                                                                                  AND n_level3 = 0
                                                                                  AND n_level4 = 0
                                                                                  AND n_active = 1
                                                                                  AND n_codprofiletype in(1)
                                                                                ORDER BY n_parent, n_positionmenu ASC");
							return $vFirstLevelMenu->fetchall();
							$vFirstLevelMenu->close();
						break;
						case 'administrador':
							$vFirstLevelMenu = $this->vDataBase->query("SELECT * 
                                                                                  FROM tb_cdlu_menu
                                                                                WHERE n_level1 = 1
                                                                                  AND n_level2 = 0
                                                                                  AND n_level3 = 0
                                                                                  AND n_level4 = 0
                                                                                  AND n_active = 1
                                                                                  AND n_codprofiletype in(1)
                                                                                  AND c_menutype not in('superadministrator')
                                                                                ORDER BY n_parent, n_positionmenu ASC");
							return $vFirstLevelMenu->fetchall();
							$vFirstLevelMenu->close();
						break;
						case 'estudiante':
							$vFirstLevelMenu = $this->vDataBase->query("SELECT * 
                                                                                  FROM tb_cdlu_menu
                                                                                WHERE n_level1 = 1
                                                                                  AND n_level2 = 0
                                                                                  AND n_level3 = 0
                                                                                  AND n_level4 = 0
                                                                                  AND n_active = 1
                                                                                  AND c_menutype not in('superadministrator', 'administrador')
                                                                                  AND c_menutype = 'estudiante'
                                                                                ORDER BY n_parent, n_positionmenu ASC");
							return $vFirstLevelMenu->fetchall();
							$vFirstLevelMenu->close();
						break;
						case 'registrado':
							$vFirstLevelMenu = $this->vDataBase->query("SELECT * 
                                                                                  FROM tb_cdlu_menu
                                                                                WHERE n_level1 = 1
                                                                                  AND n_level2 = 0
                                                                                  AND n_level3 = 0
                                                                                  AND n_level4 = 0
                                                                                  AND n_active = 1
                                                                                  AND n_codprofiletype in(1)
                                                                                  AND c_menutype not in('superadministrator', 'administrador', 'estudiante')
                                                                                ORDER BY n_parent, n_positionmenu ASC");
							return $vFirstLevelMenu->fetchall();
							$vFirstLevelMenu->close();
						break;                        
                    }
			}    
    
		public function getMenuLevelAndParent()
			{
				$vMenuLevelAndParent = $this->vDataBase->query("SELECT
                                                                    tb_cdlu_menu.n_codmenu,
                                                                    CONCAT(
                                                                        '[',tb_cdlu_menu.n_level1,'][',
                                                                        tb_cdlu_menu.n_level2,'][',
                                                                        tb_cdlu_menu.n_level3,'][',
                                                                        tb_cdlu_menu.n_level4,'][',
                                                                        tb_cdlu_menu.n_parent,'][',
                                                                        tb_cdlu_menu.c_title,']') as c_menulevelandparent
                                                                    FROM tb_cdlu_menu;");
				return $vMenuLevelAndParent->fetchall();
				$vMenuLevelAndParent->close();
			}    
        /* END SELECT STATEMENT QUERY  */
    
        /* BEGIN INSERT STATEMENT QUERY  */
		public function insertMenu($vUserCode, $vLevel1, $vLevel2, $vLevel3, $vLevel4, $vParentMenu, $vPositionMenu, $vRoleMenu, $vIconMenu, $vNameMenu, $vDescMenu, $vControllerActive, $vMethodActive, $vURLMenu, $vSessionMenu, $vActiveMenu){
            
                $vUserCode = (int) $vUserCode;
                $vLevel1 = (int) $vLevel1;
                $vLevel2 = (int) $vLevel2;
                $vLevel3 = (int) $vLevel3;
                $vLevel4 = (int) $vLevel4;
                $vParentMenu = (int) $vParentMenu;
                $vPositionMenu = (int) $vPositionMenu;
                $vRoleMenu = (string) $vRoleMenu;
                $vIconMenu = (string) '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
                $vNameMenu = (string) $vNameMenu;
                $vDescMenu = (string) $vDescMenu;
                $vControllerActive = (string) $vControllerActive;
                $vMethodActive = (string) $vMethodActive;
                $vURLMenu = (string) $vURLMenu;
                $vProfileMenu = 1;
                $vSessionMenu = (int) $vSessionMenu;
                $vActiveMenu = (int) $vActiveMenu;

                $vUserCreate = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'username');
                $vDateCreate = date("Y-m-d H:i:s", time());         

				$vResultRegisterMenu = $this->vDataBase->prepare("INSERT INTO tb_cdlu_menu(n_coduser, n_level1, n_level2, n_level3, n_level4, n_parent, c_menutype, n_positionmenu, c_iconmenu, c_title, c_descmenu, c_controlleractive, c_methodactive, c_url, n_codprofiletype, n_session, n_active, c_usercreate, d_datecreate)
																VALUES(:n_coduser, :n_level1, :n_level2, :n_level3, :n_level4, :n_parent, :c_menutype, :n_positionmenu, :c_iconmenu, :c_title, :c_descmenu, :c_controlleractive, :c_methodactive, :c_url, :n_codprofiletype, :n_session, :n_active, :c_usercreate, :d_datecreate);")
								->execute(
										array(
                                            ':n_coduser' => $vUserCode,
                                            ':n_level1' => $vLevel1,
                                            ':n_level2' => $vLevel2,
                                            ':n_level3' => $vLevel3,
                                            ':n_level4' => $vLevel4,
                                            ':n_parent' => $vParentMenu,
                                            ':c_menutype' => $vRoleMenu,
                                            ':n_positionmenu' => $vPositionMenu,
                                            ':c_iconmenu' => $vIconMenu,
                                            ':c_title' => $vNameMenu,
                                            ':c_descmenu' => $vDescMenu,
                                            ':c_controlleractive' => $vControllerActive,
                                            ':c_methodactive' => $vMethodActive,
                                            ':c_url' => $vURLMenu,
                                            ':n_codprofiletype' => $vProfileMenu,
                                            ':n_session' => $vSessionMenu,
                                            ':n_active' => $vActiveMenu,
                                            ':c_usercreate' => $vUserCreate,
                                            ':d_datecreate' => $vDateCreate
										));
                return $vResultRegisterMenu = $this->vDataBase->lastInsertId();
                $vResultRegisterMenu->close();
			}
        /* END INSERT STATEMENT QUERY  */
    
        /* BEGIN UPDATE STATEMENT QUERY  */
		public function updateMenu($vCodMenu,$vUserCode, $vLevel1, $vLevel2, $vLevel3, $vLevel4, $vParentMenu, $vPositionMenu, $vRoleMenu, $vIconMenu, $vNameMenu, $vDescMenu, $vControllerActive, $vMethodActive, $vURLMenu, $vSessionMenu, $vActiveMenu){
            
                $vCodMenu = (int) $vCodMenu;
                $vUserCode = (int) $vUserCode;
                $vLevel1 = (int) $vLevel1;
                $vLevel2 = (int) $vLevel2;
                $vLevel3 = (int) $vLevel3;
                $vLevel4 = (int) $vLevel4;
                $vParentMenu = (int) $vParentMenu;
                $vPositionMenu = (int) $vPositionMenu;
                $vRoleMenu = (string) $vRoleMenu;
                //$vIconMenu = (string) $vIconMenu;
                $vIconMenu = (string) '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
                $vNameMenu = (string) $vNameMenu;
                $vDescMenu = (string) $vDescMenu;
                $vControllerActive = (string) $vControllerActive;
                $vMethodActive = (string) $vMethodActive;
                $vURLMenu = (string) $vURLMenu;
                $vProfileMenu = 1;
                $vSessionMenu = (int) $vSessionMenu;
                $vActiveMenu = (int) $vActiveMenu;
            
                $vUserMod = (string) IdEnSession::getSession(DEFAULT_USER_AUTHENTICATE.'username');
                $vDateMod = date("Y-m-d H:i:s", time());

                $vResultUpdateItemMenu = $this->vDataBase->prepare("UPDATE
                                                                            tb_cdlu_menu
                                                                        SET tb_cdlu_menu.n_coduser = :n_coduser,
                                                                            tb_cdlu_menu.n_level1 = :n_level1,
                                                                            tb_cdlu_menu.n_level2 = :n_level2,
                                                                            tb_cdlu_menu.n_level3 = :n_level3,
                                                                            tb_cdlu_menu.n_level4 = :n_level4,
                                                                            tb_cdlu_menu.n_parent = :n_parent,
                                                                            tb_cdlu_menu.c_menutype = :c_menutype,
                                                                            tb_cdlu_menu.n_positionmenu = :n_positionmenu,
                                                                            tb_cdlu_menu.c_title = :c_title,
                                                                            tb_cdlu_menu.c_descmenu = :c_descmenu,
                                                                            tb_cdlu_menu.c_controlleractive = :c_controlleractive,
                                                                            tb_cdlu_menu.c_methodactive = :c_methodactive,
                                                                            tb_cdlu_menu.c_url = :c_url,
                                                                            tb_cdlu_menu.n_codprofiletype = :n_codprofiletype,
                                                                            tb_cdlu_menu.n_session = :n_session,                                                                            
                                                                            tb_cdlu_menu.n_active = :n_active,
                                                                            tb_cdlu_menu.c_usermod = :c_usermod,
                                                                            tb_cdlu_menu.d_datemod = :d_datemod
                                                                        WHERE tb_cdlu_menu.n_codmenu = :n_codmenu;")
                                ->execute(
                                            array(
                                            ':n_coduser' => $vUserCode,
                                            ':n_level1' => $vLevel1,
                                            ':n_level2' => $vLevel2,
                                            ':n_level3' => $vLevel3,
                                            ':n_level4' => $vLevel4,
                                            ':n_parent' => $vParentMenu,
                                            ':c_menutype' => $vRoleMenu,
                                            ':n_positionmenu' => $vPositionMenu,
                                            ':c_title' => $vNameMenu,
                                            ':c_descmenu' => $vDescMenu,
                                            ':c_controlleractive' => $vControllerActive,
                                            ':c_methodactive' => $vMethodActive,
                                            ':c_url' => $vURLMenu,
                                            ':n_codprofiletype' => $vProfileMenu,
                                            ':n_session' => $vSessionMenu,
                                            ':n_active' => $vActiveMenu,
                                            ':c_usermod' => $vUserMod,
                                            ':d_datemod' => $vDateMod,
                                            ':n_codmenu'=>$vCodMenu
                                             )
                                         );            

                return $vResultUpdateItemMenu = $this->vDataBase->lastInsertId();
                $vResultUpdateItemMenu->close();
			}
        /* END UPDATE STATEMENT QUERY  */    
    
        /* BEGIN DELETE STATEMENT QUERY  */
        public function deleteItemMenu($vCodMenu){
				$vCodMenu = (int) $vCodMenu;				
				$this->vDataBase->query("DELETE FROM tb_cdlu_menu WHERE tb_cdlu_menu.n_codmenu = $vCodMenu;");
            }
        /* END DELETE STATEMENT QUERY  */
    }
?>