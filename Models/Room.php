<?php namespace Models;
use Models\Room as Room;

class Room{

	private $seats;
	private $roomNumber;
	private $functionList;

	public function __construct($seats = null,$roomNumber = null){  // la lista de funciones inicia vacia
		$this->seats=$seats;
		$this->roomNumber=$roomNumber;
		$this->functionList=array();
	}

	public function getSeats(){
		return $this->seats;
	}

	public function setSeats($seats){
		$this->seats=$seats;
	}

	public function getRoomNumber(){
		return $this->roomNumber;
	}

	public function setRoomNumber($roomNumber){
		$this->roomNumber=$roomNumber;
	}

	public function getFunctionList(){
		return $this->functionList;
	}

	public function setFunctionList($functionList){
		$this->functionList=$functionList;
	}

	public function addFunction($function){   // agrega una function a la lista, ver si va aca o en controladora
		array_push($this->functionList, $function);
	}


}




 ?>