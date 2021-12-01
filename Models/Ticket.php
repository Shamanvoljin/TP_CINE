<?php namespace Models;
use Models\Ticket as Ticket;
use Models\Functions as Functions; // por si necesitamos hacer un new Function

class Ticket{

	private $ticketNumber;
	private $qr;
	private $function; // ver si ticket contiene funcion o funcion contiene lista de tickets


	public function __construct($ticketNumber = null,$qr = null,$function = null){
		$this->ticketNumber=$ticketNumber;
		$this->qr=$qr;
		$this->function=$function;

	}

	public function getTicketNumber(){
		return $this->ticketNumber;
	}

	public function setTicketNumber($ticketNumber){
		$this->ticketNumber=$ticketNumber;
	}

	public function getQr(){
		return $this->qr;
	}

	public function setQr($qr){
		$this->qr=$qr;
	}

	public function getFunction(){
		return $this->function;
	}

	public function setFunction($function){
		$this->function=$function;
	}



}



 ?>