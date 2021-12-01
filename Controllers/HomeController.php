<?php namespace Controllers;

    class HomeController
    {

        public function index($message = "")
        {
            
            if (!isset($_SESSION['token'])){

			    require_once ROOT_VIEWS."/headerLogin.php";
                require_once ROOT_VIEWS."/SignView.php";
	            require_once ROOT_VIEWS."/footerLogin.php";

    		}
    		else { // si session esta con un usuario/token se lo lleva a la vista home

    			require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/HomeView.php";
                require_once ROOT_VIEWS."/footerHome.php";

    		}
            
        }          
      
    }

?>

 
