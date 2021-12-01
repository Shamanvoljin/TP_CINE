<?php namespace JsonDAO;

use JsonDAO\IJsonDAO as IJsonDAO;
use Models\Cinema as Cinema;
use Models\Room as Room;

class CinemaJsonDAO implements IJsonDAO{

	private $cinemaList=array();

	public function saveData(){

		$arrayToEncode=array();

		foreach ($this->cinemaList as $cinema) {
			
			$valuesArray["name"]=$cinema->getName();
			$valuesArray["adress"]=$cinema->getAdress();
			$valuesArray["ticketPrice"]=$cinema->getTicketPrice();

			/*Testeo de lista de salas*/
			$roomList=array();
			$roomList=$cinema->getRoomList();

			$valuesArray["roomList"]=array();
			$i=0;
			foreach ($roomList as $room) {
				
				$valuesArray["roomList"][$i]["seats"]=$room->getSeats(); // ver si se puede usar asi con multiples dimensiones
				$valuesArray["roomList"][$i]["roomNumber"]=$room->getRoomNumber();
				$i++;
			}
			/*Fin de testeo*/


			//$valuesArray["roomList"]=$cinema->getRoomList();
			// probar, roomList deberia hacer un array, donde cada elemento es otro array con los datos de los Room, y usar los get de Room para cargarlo

			array_push($arrayToEncode,$valuesArray);

		}
		$jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
		file_put_contents(ROOT."JsonDAO/Data/Cinema.json", $jsonContent);
	}

	public function retrieveData(){

		$this->cinemaList=array();
		
		$jsonPath=$this->getJsonFilePath();

		if (file_exists($jsonPath)){ // fijarse que nombre le ponemos a los archivos json
			
			$jsonContent=file_get_contents($jsonPath);

			$arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();

			foreach ($arrayToDecode as $key=>$valuesArray) {
				
				$cinema=new Cinema($valuesArray["name"],$valuesArray["adress"],$valuesArray["ticketPrice"]);

				// elimine el $valuesArray["roomList"] del constructor

				/*Testeo de lista de salas*/
				$roomList=array();
				foreach ($valuesArray["roomList"] as $value) {
					$room=new Room($value["seats"],$value["roomNumber"]);
					array_push($roomList,$room);
					$cinema->setRoomList($roomList);
				}



				/*fin de testeo*/

				// deberiamos hacer varios new Room recorriendo $valuesArray["roomList"] y utilizando los datos de cada uno para inicializarlo, guardarlos en un array de Rooms, y ahi los envio por parametro en el new Cinema, nose si hace falta un json de salas, porque deberian estar guardadas cada 1 en su cine, mientras que si necesitamos 1 dao(base de datos) de las salas				
				array_push($this->cinemaList,$cinema);
			}
		}  
	}

	public function addDAO($newCinema){
		$this->retrieveData();
		array_push($this->cinemaList, $newCinema);
		$this->saveData();
	}

	public function deleteDAO($newCinema){
		// completar, ver si eliminamos a traves del titulo de la pelicula
	}

	public function updateDAO($newCinema){
		$this->retrieveData();		
		foreach ($this->cinemaList as $key => $cinema){
			if($newCinema == $cinema){
				$cinema->setName($newCinema->getName());
				$cinema->setAdress($newCinema->getAdress());
				$cinema->setTicketPrice($newCinema->getTicketPrice());
				$cinema->setRoomList($newCinema->getRoomList());			
			}
		}
		$this->saveData();
	}

	public function getAllDAO(){
		$this->retrieveData();
		return $this->cinemaList;
	}

	public function getCinemaDAO($name){
		// completar, buscar pelicula por titulo y devolverla
	}

	public function getJsonFilePath(){

        $initialPath = ROOT."JsonDAO/Data/Cinema.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }


	

}


?>