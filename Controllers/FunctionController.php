<?php namespace Controllers;

use DAO\FunctionDAO as FunctionDAO;
use Models\Functions as Functions; 
use Models\Film as Film;

class FunctionController{

	private $functionDao;
	private $function;
	private $functionList;
	private $filmController;
	private $roomController;

	public function __construct(){
		$this->functionDao = new FunctionDAO();
		$this->function = new Functions();
		$this->functionList = array();
		$this->filmController = new FilmController();
		$this->roomController = new RoomController();
	}

	public function getAll(){
		$this->functionList=$this->functionDao->getAllDAO();
		return $this->functionList;
	}

	public function getFunction($idFunction){
		$this->function=$this->functionDao->getFunctionDAO($idFunction);
		return $this->function;
	}

	public function getAllFromRoom($idCinema,$roomNumber){
		$this->functionList=$this->functionDao->getAllFromRoom($idCinema,$roomNumber);
		return $this->functionList;
	}
	/*public function getAllCinema($filmTitle){
		$cinemaList= $this->functionDao->getAllCinema($filmTitle);
		return $cinemaList;
	}*/

	/*public function getAllFromFilm($filmTitle){
		$this->functionList=$this->functionDao->getAllFromFilm($filmTitle);
		return $this->functionList;
	}*/

	public function getIdFunction($idRoom,$idFilm,$date){
		$idFunction=$this->functionDao->getIdFunctionDAO($idRoom,$idFilm,$date);
		return $idFunction;
	}

	/*FUNCION QUE LA VISTA DE FUNCTIONES VA A LLAMAR, ENVIANDO DATO POR DATO Y CREANDO LAS FUNCIONES DE A 1*/
	public function create($roomNumber,$filmTitle,$date,$time,$cinemaName){ 

			/*POR PROBLEMAS DEL SELECT*/
			$filmTitle=str_replace("_", " ", $filmTitle);


			
			$idFilm=$this->filmController->getIdFilm($filmTitle);

			$film =$this->filmController->getFilm($filmTitle);

			
			$completeDate=$date." ".$time;

			$completeDate=strtotime($completeDate);


			$cinemaController = new CinemaController();
			$idCinema = $cinemaController->getIdCinema($cinemaName);
           


            $idRoom=$this->roomController->getIdRoom($idCinema,$roomNumber);



            $this->functionList=$this->functionDao->getAllFromRoom($idCinema,$roomNumber);
           	

            //$flag=true;
            $flag=$this->verifyHour($this->functionList,$film,$completeDate);
			

			if($flag){
				$completeDate=$date." ".$time;
				$this->function->setDate($completeDate);


				$this->functionDao->addDAO($idRoom,$idFilm,$this->function);

            	require_once ROOT_VIEWS."/headerHome.php";
            	require_once ROOT_VIEWS."/navHome.php";
            	require_once ROOT_VIEWS."/HomeView.php";
            	require_once ROOT_VIEWS."/footerHome.php";
			}
			else{
				$this->cinemaController=new CinemaController();
                $cinema = $this->cinemaController->getCinema($cinemaName); 
                $this->filmController=new FilmController();
                $filmList=$this->filmController->getAll();
				$msjError = "Ese horario en esa sala no esta disponible";
				require_once ROOT_VIEWS."/headerHome.php";
            	require_once ROOT_VIEWS."/navHome.php";
            	require_once ROOT_VIEWS."/FunctionCreateView.php";
            	require_once ROOT_VIEWS."/footerHome.php";
			}

            





            
		


	}

	public function edit($cinemaName,$roomNumber,$filmTitle,$date,$time,$oldIdFunction){

		/*POR PROBLEMAS DEL SELECT*/
			$filmTitle=str_replace("_", " ", $filmTitle);
			
			$idFilm=$this->filmController->getIdFilm($filmTitle);

			$film =$this->filmController->getFilm($filmTitle);

			
			
			$newDate=strtotime($date);
			$newTime=strtotime($time);

			$completeDate=$date." ".$time;

			$completeDate=strtotime($completeDate);


			$cinemaController = new CinemaController();
			$idCinema = $cinemaController->getIdCinema($cinemaName);



            $idRoom=$this->roomController->getIdRoom($idCinema,$roomNumber);

            $this->functionList=$this->functionDao->getAllFromRoom($idCinema,$roomNumber);
            $this->function=$this->functionDao->getFunctionDAO($oldIdFunction);
           
            $flag=$this->verifyHour($this->functionList,$film,$completeDate,$this->function);

            $completeDate=$date." ".$time;
			
			if($flag){

				

				$this->function->setDate($completeDate);

				$this->functionDao->updateDAO($oldIdFunction,$idRoom,$idFilm,$this->function);

            	require_once ROOT_VIEWS."/headerHome.php";
            	require_once ROOT_VIEWS."/navHome.php";
            	require_once ROOT_VIEWS."/HomeView.php";
            	require_once ROOT_VIEWS."/footerHome.php";
			}
			else{
				$this->cinemaController=new CinemaController();
                $cinema = $this->cinemaController->getCinema($cinemaName); 
                $this->filmController=new FilmController();
                $filmList=$this->filmController->getAll();

      
                $date=$completeDate;
                $idFunction=$oldIdFunction;
                $room=$roomNumber;
                $film=$filmTitle;


				$msjError = "Ese horario en esa sala no esta disponible";
				require_once ROOT_VIEWS."/headerHome.php";
            	require_once ROOT_VIEWS."/navHome.php";
            	require_once ROOT_VIEWS."/FunctionEditView.php";
            	require_once ROOT_VIEWS."/footerHome.php";
			}


            
	}

	public function delete($cinemaName,$roomNumber,$filmTitle,$date,$time){ // VER A TRAVES DE QUE DATO LA ELIMINAMOS
			require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/HomeView.php";
            require_once ROOT_VIEWS."/footerHome.php";
	}

	public function verifyHour($functionList, $film, $newTime,$function = null){

            $flag=true;
            foreach ($functionList as $value) {

				$dateDAO=strtotime($value->getDate());
				//$dateDAO=strtotime($fullDate[0]); 	//dia
				//$timeDAO=strtotime($fullDate[1]);	//hora
				
				if($function != $value){
					
						if($dateDAO > $newTime){	// si la funcion ya guardada empieza mas tarde que la que quiero ingresar
						
							$newTime=strtotime("+".$film->getLength()." minute",$newTime);	// le sumo la duracion de la pelicula a la que quiero ingresar
						
							$newTime=strtotime("+15 minute",$newTime); // los 15 min de intermedio de requisito
					
							if($newTime>=$dateDAO){	// si despues de realizar la suma la nueva pelicula termina mas tarde que el inicio de la que ya estaba guardada no dejo ingresar la funcion
								$flag=false;
							}
						}
						elseif ($dateDAO < $newTime)	// si la funcion guardada empieza mas temprano que la que quiero ingresar
						{
							$dateDAO=strtotime("+".$value->getFilm()->getLength()." minute",$dateDAO); // le sumo la duracion de la pelicula a la que ya estaba guardada

							$dateDAO=strtotime("+15 minute",$dateDAO); // los 15 min de intermedio de requisito

							if($dateDAO >=$newTime){ // despues de la suma, si la funcion ya guardada termina mas tarde que el inicio de la nueva a ingresar, no dejamos ingresar la funcion
								$flag=false;
							}
						}
						elseif ($dateDAO == $newTime) { // si es a la misma hora no dejamos ingresar, y no hace falta realizar sumas
							$flag=false;
						}
				}
				
			}
			return $flag;
	}

} 

 ?>