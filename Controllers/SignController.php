<?php namespace Controllers;

    use Controllers\UserController as UserController;

    use Models\User as User;    
    use Models\Role as Role;

    class SignController
    {       

        public function checkSession(){
            
            $userSession = $_SESSION['user'];
            $userController = new UserController();
            $userCurrent = $userController->getUserToken($userSession->getToken());
            if ($userSession != $userCurrent){
                unset($_SESSION['user']); 
                require_once ROOT_VIEWS."/headerLogin.php";
                require_once ROOT_VIEWS."/SignView.php";
                require_once ROOT_VIEWS."/footerLogin.php";
            }   
        }

        public function login($user = null, $pass = null){ 

        	if ($user != null && $pass != null){ 

     		    $verify = false;			
                $userController = new UserController();
                $userLogin = $userController->getUserEmail($user);

                if($userLogin->getPassword() == $pass){
                    $verify = true;
                }

                if ($verify){

                    $_SESSION["user"] = $userLogin;

                    require_once ROOT_VIEWS."/headerHome.php";
                    require_once ROOT_VIEWS."/navHome.php";
                    require_once ROOT_VIEWS."/HomeView.php";
                    require_once ROOT_VIEWS."/footerHome.php";
            	}
            	else {

                    $msjError = "La cuenta y/o contraseña es incorrecta.";                 
                    require_once ROOT_VIEWS."/headerLogin.php";
                    require_once ROOT_VIEWS."/SignView.php";
                    require_once ROOT_VIEWS."/footerLogin.php";
            	}
            	
        	}
        	else{ 

                if (!isset($_SESSION['user'])){
                    require_once ROOT_VIEWS."/headerLogin.php";
                    require_once ROOT_VIEWS."/SignView.php";
                    require_once ROOT_VIEWS."/footerLogin.php";
                }
                else {
                    require_once ROOT_VIEWS."/headerHome.php";
                    require_once ROOT_VIEWS."/navHome.php";
                    require_once ROOT_VIEWS."/HomeView.php";
                    require_once ROOT_VIEWS."/footerHome.php";
                }
        	}
        }

        public function register($newFirstname = null, $newLastname = null, $newDni = null,$newUsername = null, $newPassword = null){

            if ($newFirstname != null && $newLastname != null && $newDni != null && $newUsername != null && $newPassword != null  ){

                $newRole = new Role();
                $userController = new UserController(); 

                $userRegister = $userController->registerUser($newUsername, $newPassword, $newRole, $newFirstname, $newLastname, $newDni);

                if ($userRegister != NULL){                  

                    $_SESSION["user"] = $userRegister;                    
               
                    require_once ROOT_VIEWS."/headerHome.php";
                    require_once ROOT_VIEWS."/navHome.php";
                    require_once ROOT_VIEWS."/HomeView.php";
                    require_once ROOT_VIEWS."/footerHome.php";

                }
                else {

                    $msjError = "Error al registrar el usuario.";                  
                    require_once ROOT_VIEWS."/headerLogin.php";
                    require_once ROOT_VIEWS."/SignView.php";
                    require_once ROOT_VIEWS."/footerLogin.php";
   
                }

            }
            else{ // En caso de poner la URL de forma manual se mandaria al Login de vuelta.
                    require_once ROOT_VIEWS."/headerLogin.php";
                    require_once ROOT_VIEWS."/SignView.php";
                    require_once ROOT_VIEWS."/footerLogin.php";
            }            
        } 
    } 

?>
