<?php namespace Controllers;

use DAO\TicketDAO as TicketDAO;
use Models\Ticket as Ticket; 
use Models\Functions as Functions;

class TicketController{

	private $ticketDao;
	private $ticket;
	private $ticketList;
	private $functionController; // nose si lo necesitamos

	public function __construct(){
		$this->ticketDao = new TicketDAO();
		$this->ticket = new Ticket();
		$this->ticketList = array();
		$this->funtionController = new FunctionController(); // VER SI HACE FALTA
	}

	public function getAll(){
		$this->ticketList=$this->ticketDao->getAllDAO();
		return $this->ticketList;
	}

	public function getTicketAmount($idFunction){
		$totalTickets=$this->ticketDao->getTicketAmount($idFunction);
		return $totalTickets;
	}

	public function createTicket($idPurchase, $idFunction,$ticket){
		$this->ticketDao->addDAO($idPurchase,$idFunction,$ticket);

	}



}



?>