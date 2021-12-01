<?php   namespace Controllers;

use DAO\CinemaDAO as CinemaDAO;
//use JsonDAO\CinemaJsonDAO as CinemaDAO; // importante para que funcione con ambos
use DAO\RoomDAO as RoomDAO;
use Models\Cinema as Cinema; 
use Models\Room as Room;


class CinemaController{

	private $cinemaDao;
	private $cinema;
	private $cinemaList;
   private $roomController;

	public function __construct(){
		$this->cinemaDao = new CinemaDAO();
		$this->cinema = new Cinema();
      $this->roomController = new RoomController();
		$this->cinemaList = array();
	}

	/* Funcion que trae del dao, devuelve una lista y la guarda en la lista de controller*/
	public function getAll(){

		$this->cinemaList=$this->cinemaDao->getAllDAO();
      /*EL GETALL DEL CINEMA YA TRAE LAS SALAS*/
		return $this->cinemaList;
	}

   public function getAllFromFilm($filmTitle){
      $this->cinemaList=$this->cinemaDao->getAllFromFilm($filmTitle);
      return $this->cinemaList;
   }

   /*LA NECESITO EN FUNCTION CONTROLLER*/
   public function getIdCinema($cinemaName){
      $idCinema=$this->cinemaDao->getIdCinemaDAO($cinemaName);
      return $idCinema;
   }

   public function getCinema($cinemaName){
      $this->cinema=$this->cinemaDao->getCinemaDAO($cinemaName);
      return $this->cinema;
   }


   /*Verifica que un cine no exista en una lista*/
	public function verifyCinema($name){
		$flag = true;
		$this->getAll();
		foreach ($this->cinemaList as $value) {
			if($name == $value->getName()){
				$flag=false;
			}
		}
	return $flag;
	}

	  /* Carga un cine */
   	public function create($name, $adressName, $adressNumber, $ticketPrice){

   		if($this->verifyCinema($name)){ // modificar este verificar
   				$this->cinema->setName($name);
               $adressName=str_replace(" ", "-", $adressName); // por si el nombre de la calle llega con espacios
   				$this->cinema->setAdress($adressName." ".$adressNumber);
   				$this->cinema->setTicketPrice($ticketPrice);
   			
               /*Agrego el cine a la base de datos*/
   				$this->cinemaDao->addDAO($this->cinema);

               /*Traigo el id generado del cine*/
               $idCinema=$this->cinemaDao->getIdCinemaDAO($name);

               /*ACA SE DEBERIA LLAMAR LA VISTA DEL FORMULARIO DE SALAS Y ESA MISMA ENVIAR LOS DATOS (ID CINEMA Y LOS DATOS DE LA SALA QUE LLEGAN POR POST A ESA CONTROLADORA) AL METODO CREATEROOM DE LA CONTROLADORA DE SALAS */

               require_once ROOT_VIEWS."/headerHome.php";
               require_once ROOT_VIEWS."/navHome.php";
               require_once ROOT_VIEWS."/RoomCreateView.php";
               require_once ROOT_VIEWS."/footerHome.php";



   		}
   		else{
   			$msjError = "Ese nombre de cine no esta disponible.";
   			require_once ROOT_VIEWS."/headerHome.php";
            require_once ROOT_VIEWS."/navHome.php";
            require_once ROOT_VIEWS."/CinemaCreateView.php";
            require_once ROOT_VIEWS."/footerHome.php";
   		}
   	}



   	public function edit($name, $adressName,$adressNumber, $ticketPrice){ 
         

         /*TRAE EL CINE A PARTIR DEL NOMBRE Y LO EDITA*/
         $this->cinema =$this->cinemaDao->getCinemaDAO($name);
         $this->cinema->setAdress($adressName." ".$adressNumber);
         $this->cinema->setTicketPrice($ticketPrice);
         $this->cinemaDao->updateDAO($this->cinema);
         
         $idCinema=$this->cinemaDao->getIdCinemaDAO($name);      
         /*DEBERIA MANDARSE A LA VISTA DE RoomListView que llamara a AdminController para llamar a RoomEditView*/
         /*VISTAS*/
         require_once ROOT_VIEWS."/headerHome.php";
         require_once ROOT_VIEWS."/navHome.php";
         require_once ROOT_VIEWS."/RoomsListView.php";
         require_once ROOT_VIEWS."/footerHome.php";




   	}

      public function delete($name, $adressName,$adressNumber, $ticketPrice){

         /*VER A TRAVES DE QUE DATO ELIMINAMOS EL CINE, Y REALIZAR UNA BAJA LOGICA*/
         $this->cinema->setName($name);
         $this->cinema->setAdress($adressName." ".$adressNumber);
         $this->cinema->setTicketPrice($ticketPrice);

         /*BORRAR UN CINE DEBERIA BORRAR TODAS LAS SALAS Y LAS FUNCIONES ASOCIADAS AL MISMO*/
         $this->cinemaDao->deleteDAO($this->cinema);
      }

}
?>