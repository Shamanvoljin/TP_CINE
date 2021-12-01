<?php namespace Config;

/* Carpeta del proyecto en la computadora (Ruta del servidor) */
define("ROOT", dirname(__DIR__) . "/");
define("ROOT_VIEWS", ROOT . "/Views");

/* Url del proyecto (Ruta del cliente) */
//define("FRONT_ROOT", "http://localhost/TP-CINE");
define("FRONT_ROOT", "http://localhost:8080/TP-CINE"); // Distinto localhost para otra pc
define("VIEWS_PATH", FRONT_ROOT . "/Views");
define("CSS_PATH",VIEWS_PATH."/css");
define("JS_PATH", VIEWS_PATH."/js");

/* Constantes para la conexion de la base de datos */ 
//define("DB_HOST", "localhost:3307"); // Puerto local
define("DB_HOST", "localhost:3306");
define("DB_NAME", "base_cine");
define("DB_USER", "root");
define("DB_PASS", "");

/* Constantes de la API */
define("API_KEY", "8e6aae61ef373487c7cc9eb39cd4d77b");
define("API_URL", "https://api.themoviedb.org/3");
define("API_IMG", "https://image.tmdb.org/t/p/w300"); // direccion inicial para las imagenes, el w300 es el tamaño

/*Constantes del mail*/
define("EMAIL","moviepassenterprise@gmail.com");
define("PASS","sistema123");

/*Constantes del qr*/
define("QR_URL","https://chart.googleapis.com/chart?cht=qr&chs=160x160&chl=");
?>