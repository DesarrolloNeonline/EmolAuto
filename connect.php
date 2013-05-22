<?php

error_reporting(E_ALL ^ E_NOTICE);

/*=========== Database Wordpress==========*/

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'od4043od';
$db_name = 'automoviles';

$folder_web= '/var/www/emol_automovil';

$folder_frontend = 'http://club.mersap.com/emol_automovil_merge';
$folder_backend = 'http://club.mersap.com/backend_automoviles';
/*=========== Tiempo Max Ejecucion Query==========*/
set_time_limit(260);

	try {
	
	 	$conn = mysql_connect("$db_host","$db_user","$db_pass");
		mysql_select_db("$db_name",$conn)or die ('<h7> #Error 100.- Pro Error no se puede ejecutar la consulta (Error coneccion Base de Datos)</h7>');

		}
		
		catch(PDOException $e) {
		error_log($e->getMessage());
		die('A database error was encountered');
	}
?>