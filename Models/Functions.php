<?php namespace Models;
use Models\Functions as Functions;
use Models\Film as Film; // por si necesitamos un new Film

class Functions{

	private $date;  // dia y hora
	private $film;

	// ver si tiene lista de tickets

	public function __construct($date = null,$film = null){
		$this->date=$date;
		$this->film=$film;
	}


	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function getFilm(){
		return $this->film;
	}

	public function setFilm($film){
		$this->film=$film;
	}



}



 ?>