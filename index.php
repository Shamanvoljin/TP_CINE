<?php  

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;


	use Controllers\SignController as SignController;

	Autoload::start();

	session_start();

	if (isset($_SESSION['user'])){		
		$signController = new SignController();
		$signController->checkSession();
	}

	Router::Route(new Request());

	
?>
 
