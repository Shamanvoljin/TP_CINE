<?php namespace Controllers; 
    use Models\Film as Film;
    /* Crear restrinciones mediante datos null o que no existan / $_SESSION */

	class AdminController 
	{
		private $filmController;
        private $functionController;
        private $cinemaController;

        public function deleteCinema($nameDelete, $adressDelete, $costDelete, $cantRoomsDelete=0){
                $adressDelete = str_replace("_", " ", $adressDelete);
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/CinemaDeleteView.php";
                require_once ROOT_VIEWS."/footerHome.php";
    	} 

    	public function editCinema($nameEdit, $adressEdit, $costEdit, $cantRoomsEdit = 0){
                $adressEdit = str_replace("_", " ", $adressEdit);
                $adress=explode(" ", $adressEdit);
                $adressName=$adress[0];
                $adressName=str_replace("-", " ", $adressName);
                $adressNumber=$adress[1];
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/CinemaEditView.php";
                require_once ROOT_VIEWS."/footerHome.php";
    	}  

    	public function createCinema(){
    		    require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/CinemaCreateView.php";
                require_once ROOT_VIEWS."/footerHome.php";
    	}

        public function deleteRoom(){
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/RoomDeleteView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function editRoom($roomNumberEdit,$seatsEdit,$idCinema){
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/RoomEditView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function createRoom($idCinema){
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/RoomCreateView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function deleteFilm($filmTitleDelete, $lengthDelete, $languageDelete){

                $filmTitleDelete=str_replace("_", " ", $filmTitleDelete);
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FilmDeleteView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        /* Muestra de forma no tan detallada las peliculas que se pueden agregar */

        public function createListFilm(){
                
                $apiController = new ApiController();
                $filmList = array();
                $apiController->setFilmList();
                $filmList = $apiController->getFilmListAPI();
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FilmListCreateView.php";
                require_once ROOT_VIEWS."/footerHome.php";

        }

        /* Muestra en detalladamente la pelicula antes de agregarla */

        public function createFilm($filmTitle,$idFilm){

            /* Mediante la Id se buscarian los datos necesarios para mostrar */
                $apiController = new ApiController();
                $film = new Film();
                $film = $apiController->getFilmDetails($filmTitle,$idFilm);
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FilmCreateView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function deleteFunction($cinema, $room, $film, $date){

                $cinema=str_replace("_", " ", $cinema);
                $film=str_replace("_", " ", $film);
                $date=str_replace("_", " ", $date);
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FunctionDeleteView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function editFunction($cinemaName, $room, $film, $date){
                $cinemaName=str_replace("_", " ", $cinemaName);
                $film=str_replace("_", " ", $film);
                $date=str_replace("_", " ", $date);

                $this->cinemaController=new CinemaController();
                $cinema = $this->cinemaController->getCinema($cinemaName); 
                $this->filmController=new FilmController();
                $filmList=$this->filmController->getAll();


                $roomController=new RoomController();
                $this->functionController=new FunctionController();


                $idFilm=$this->filmController->getIdFilm($film);
                $idCinema=$this->cinemaController->getIdCinema($cinemaName);
                $idRoom=$roomController->getIdRoom($idCinema,$room);

                $idFunction=$this->functionController->getIdFunction($idRoom,$idFilm,$date);
                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FunctionEditView.php";
                require_once ROOT_VIEWS."/footerHome.php";

        }

        public function createFunction($cinemaName){

                
        
                $this->cinemaController=new CinemaController();
                $cinema = $this->cinemaController->getCinema($cinemaName); 
                $this->filmController=new FilmController();
                $filmList=$this->filmController->getAll();
                

                require_once ROOT_VIEWS."/headerHome.php";
                require_once ROOT_VIEWS."/navHome.php";
                require_once ROOT_VIEWS."/FunctionCreateView.php";
                require_once ROOT_VIEWS."/footerHome.php";
        }

        public function listCinemaForFunction(){
            
            $this->cinemaController=new CinemaController();
            $cinemaList=$this->cinemaController->getAll();
            require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/CinemaForFunctionsView.php";
            require_once ROOT_VIEWS."/footerHome.php";
        }   


	}


?>

