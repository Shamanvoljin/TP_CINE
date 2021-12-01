<?php namespace Controllers;

use DAO\RoomDAO as RoomDAO;
use Models\Room as Room;
use Controllers\FunctionController as FunctionController;

class RoomController{

	private $roomDao;
	private $room;
	private $roomList;

	public function __construct(){
		$this->roomDao = new RoomDAO();
		$this->room = new Room();
		$this->roomList = array();
	}

	public function getAll($idCinema){
		$this->roomList=$this->roomDao->getAllDAO($idCinema);
		return $this->roomList;

	}

	public function getRoom($cinemaName,$roomNumber){
		$this->room=$this->roomDao->getRoomDAO($cinemaName,$roomNumber);
		return $this->room;
	}

	/*LA NECESITO EN FUNCTION CONTROLLER*/
	public function getIdRoom($idCinema,$roomNumber){
		$idRoom=$this->roomDao->getIdRoomDAO($idCinema,$roomNumber);
		return $idRoom;
	}

	public function verifyRoom($roomNumber,$idCinema){
		$flag = true;
		$this->getAll($idCinema);
		foreach ($this->roomList as $value) {
			if($roomNumber == $value->getRoomNumber()){
				$flag=false;
			}
		}
	return $flag;
	}

	/*FUNCION QUE LA VISTA DE SALAS VA A LLAMAR, ENVIANDO DATO POR DATO Y CREANDO LAS SALAS DE A 1*/
	/*OJO CON EL ORDEN PARA PODER MANDAR EL ID DEL CINE Y QUE NO SE PIERDA*/
	public function createRoom($roomNumber,$seats,$idCinema,$flag){ 

			if($this->verifyRoom($roomNumber,$idCinema)){
				
				$this->room->setRoomNumber($roomNumber);
				$this->room->setSeats($seats);
                  
            	$this->roomDao->addDAO($idCinema,$this->room);
            	if($flag == 0){
					require_once ROOT_VIEWS."/headerHome.php";
               		require_once ROOT_VIEWS."/navHome.php";
               		require_once ROOT_VIEWS."/RoomCreateView.php";
               		require_once ROOT_VIEWS."/footerHome.php";

				}

				if($flag == 1){

					require_once ROOT_VIEWS."/headerHome.php";
         			require_once ROOT_VIEWS."/navHome.php";
        			require_once ROOT_VIEWS."/HomeView.php";
         			require_once ROOT_VIEWS."/footerHome.php";
				}
			}
			else{
					$msjError = "Ese número de sala ya existe.";
					require_once ROOT_VIEWS."/headerHome.php";
               		require_once ROOT_VIEWS."/navHome.php";
               		require_once ROOT_VIEWS."/RoomCreateView.php";
               		require_once ROOT_VIEWS."/footerHome.php";

			}
			
	}

	public function editRoom($roomNumber,$seats,$idCinema){
		
		/*TRAER LA SALA A PARTIR DEL ID DEL CINE Y EL NUMERO DE SALA*/
		$this->room=$this->roomDao->getRoomDAOById($idCinema,$roomNumber);
		
		//$this->room->setRoomNumber($roomNumber); // NO DEBERIA CAMBIARSE EL NUMERO DE SALA
		$this->room->setSeats($seats);
		
		$idRoom=$this->roomDao->getIdRoomDAO($idCinema,$roomNumber);
		
		$this->roomDao->updateDAO($idRoom,$this->room);

		/*DEVUELVE A LA LISTA DE SALAS*/
		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/HomeView.php";
        require_once ROOT_VIEWS."/footerHome.php";

	}



}

 ?>