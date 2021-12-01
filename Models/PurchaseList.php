<?php namespace Models;

use Models\PurchaseList as PurchaseList;


class PurchaseList{

	private $date;
	private $cinema;
	private $room_number;
	private $cant_tickets;
	private $discount;
	private $total;
	private $token;
	private $film;


	public function __construct($date = null, $cinema = null, $room_number = null, $cant_tickets = null, $discount = null, $total = null, $token = null, $film = null){  

		$this->date = $date;
		$this->cinema = $cinema;
		$this->room_number = $room_number;
		$this->cant_tickets = $cant_tickets;
		$this->discount = $discount;
		$this->total = $total;
		$this->token = $token;
		$this->film = $film;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function getCinema(){
		return $this->cinema;
	}

	public function setCinema($cinema){
		$this->cinema = $cinema;
	}

	public function getRoom_number(){
		return $this->room_number;
	}

	public function setRoom_number($room_number){
		$this->room_number = $room_number;
	}

	public function getCant_tickets(){
		return $this->cant_tickets;
	}

	public function setCant_tickets($cant_tickets){
		$this->cant_tickets = $cant_tickets;
	}

	public function getDiscount(){
		return $this->discount;
	}

	public function setDiscount($discount){
		$this->discount = $discount;
	}

	public function getTotal(){
		return $this->total;
	}

	public function setTotal($total){
		$this->total = $total;
	}

	public function getToken(){
		return $this->token;
	}

	public function setToken($token){
		$this->token = $token;
	}

	public function getFilm(){
		return $this->film;
	}

	public function setFilm($film){
		$this->film = $film;
	}



}

?>