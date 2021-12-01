<?php namespace Controllers;

    class NavController
    {

    	public function home(){
    		require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/HomeView.php";
            require_once ROOT_VIEWS."/footerHome.php";
    	}    	

    	public function films(){
            
            $filmController = new FilmController();
            $filmList = $filmController->getAll();

            $categoryController = new CategoryController();
            $categoryList = $categoryController->getAll();

            $functionController = new FunctionController();
            $functionList = $functionController->getAll();
            
    		require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/FilmsView.php";
            require_once ROOT_VIEWS."/footerHome.php";
    	}

    	public function adminCinemas(){

            $cinemaController = new CinemaController();
            $cinemaList = array();
            $cinemaList = $cinemaController->getAll();
     
    		require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/CinemasListView.php";
            require_once ROOT_VIEWS."/footerHome.php";
    	}

        public function adminFilms(){

            $filmController = new FilmController();
            $filmList = array();
            $filmList = $filmController->getAll();
            require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/FilmsListView.php";
            require_once ROOT_VIEWS."/footerHome.php";
        }

        public function adminFunctions(){
                        
            /*DEBERIAMOS TRAER TODOS LOS CINES, CON TODAS SUS SALAS, Y LAS FUNCIONES CORRESPONDIENTES A CADA UNA*/
            $cinemaController = new CinemaController();
            $cinemaList = array();
            $cinemaList = $cinemaController->getAll();

            $ticketController= new TicketController();
            $ticketAmount=0;
            $sellsList=array();

            foreach ($cinemaList as $value) {
                $idCinema= $cinemaController->getIdCinema($value->getName());
                foreach ($value->getRoomList() as $value2) {

                    $functionController = new FunctionController();
                    $functionList = array();
                    $functionList = $functionController->getAllFromRoom($idCinema,$value2->getRoomNumber());
                    $value2->setFunctionList($functionList);

                    /*foreach ($functionList as $key => $value3) {
                        $ticketAmount= $ticketController->getTicketAmount($key);
                        var_dump($ticketAmount);
                    }*/
                }
            }
          

            $today=getdate();
            require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/FunctionsListView.php";
            require_once ROOT_VIEWS."/footerHome.php";
        }

    	public function adminSeeListTickets($cinemaFilter = null, $movieFilter = null){ 

            $purchaseController = new PurchaseController();
            $purchaseList = array();
            $purchaseList = $purchaseController->getAll();

            $cinemaController = new CinemaController();
            $cinemaList = array();
            $cinemaList = $cinemaController->getAll();

            $filmController = new FilmController();
            $filmList = array();
            $filmList = $filmController->getAll();

            require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/TicketAdminListView.php";
            require_once ROOT_VIEWS."/footerHome.php";
    	}

        public function clientSeeListTickets(){ 

            $user = $_SESSION['user'];
            $userController = new userController();
            $user_id = $userController->getIdUser($user->getEmail());

            $purchaseController = new PurchaseController();
            $purchaseList = array();
            $purchaseList = $purchaseController->getAllUser($user_id);

            require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/TicketClientListView.php";
            require_once ROOT_VIEWS."/footerHome.php";
        }
        
    	public function logout(){

            unset($_SESSION['user']);
            

    		require_once ROOT_VIEWS."/headerLogin.php";
            require_once ROOT_VIEWS."/SignView.php";
            require_once ROOT_VIEWS."/footerLogin.php";

            	
    	}

    }




?>
    