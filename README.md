En la carpeta idensystem en el archivo idenSetUp.php debes configurar las rutas:

//define('BASE_VIEW_URL','https://circulodelaunion.ideas-envision.com/');/* RUTA POR DEFECTO DE LA VISTAS */
define('BASE_VIEW_URL','http://localhost/circulodelaunion.ideas-envision.com/');/* RUTA POR DEFECTO DE LA VISTAS */

y luego la base de datos

define('DEFAULT_DB_HOST','localhost');
define('DEFAULT_DB_ROOT_USER','root');
define('DEFAULT_DB_ROOT_PASS','');
define('DEFAULT_DB_NAME','tapedigi_mut_circulo');

Luego en los javascript:

en la carpeta views->layout->assets->backend->js->custom archivo llamado iden.script.js

//localStorage.setItem(globalURLCirculo, 'https://circulodelaunion.ideas-envision.com/');
localStorage.setItem(globalURLCirculo, 'http://localhost/circulodelaunion.ideas-envision.com/');    
var globalURLCirculo = localStorage.getItem(globalURLCirculo);

En estos dos archivos las rutas del local deben estar configurados iguales

base de datos

En la carpeta Database encontraras un archivo .sql solo debes ejecutarlo el nombre de la base de datos es: tapedigi_mut_circulo

y Listo! =)
