<?php namespace Models;
use Models\Cinema as Cinema;
use Models\Room as Room;

class Cinema{

	private $name;
	private $adress;
	private $ticketPrice;
	private $roomList;
	// saque la capacidad porque me parecia innecesaria

	public function __construct($name=null,$adress=null,$ticketPrice=null,$roomList=null){
		$this->name=$name;
		$this->adress=$adress;
		$this->ticketPrice=$ticketPrice;
		$this->roomList=$roomList;  // ver si la inicializamos la lista de salas vacia
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function getAdress(){
		return $this->adress;
	}

	public function setAdress($adress){
		$this->adress=$adress;
	}

	public function getTicketPrice(){
		return $this->ticketPrice;
	}

	public function setTicketPrice($ticketPrice){
		$this->ticketPrice=$ticketPrice;
	}

	public function getRoomList(){
		return $this->roomList;
	}

	public function setRoomList($roomList){
		$this->roomList=$roomList;
	}

	public function addRoom($room){   // para agregar 1 nueva sala, ver si va aca o en controller
		array_push($this->roomList, $room);
	}


}


 ?>