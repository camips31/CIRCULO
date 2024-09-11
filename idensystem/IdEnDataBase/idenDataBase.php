<?Php

class IdEnDatabaseConnection extends PDO
	{
		public function __construct()
			{
				parent::__construct(
									'mysql:host='.DEFAULT_DB_HOST.';dbname='.DEFAULT_DB_NAME,
									DEFAULT_DB_ROOT_USER,
									DEFAULT_DB_ROOT_PASS,
									array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.DEFAULT_DB_CHARSET, PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
								   );
			}
	}
?>