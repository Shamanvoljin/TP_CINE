<?php namespace Models;
use Models\Purchase as Purchase;
use Models\User as User;
use Models\CreditCardPayment as CreditCardPayment;
use Models\Ticket as Ticket; // para el add 1 ticket por si va el tipado en el parametro

class Purchase{

	private $purchaseNumber; // numero de compra
	private $numberOfTickets; // cant count ticketList ??
	private $discount;
	private $date;
	private $total;
	private $ticketList; // puede ser 1 solo
	private $user;  // va a tener los datos del ciente, pero no la contraseña
	private $creditCardPayment;

	public function __construct($purchaseNumber = null, $numberOfTickets = null , $discount = null, $date = null, $total = null){  // ver si usamos todos los datos o no
		$this->purchaseNumber=$purchaseNumber;
		$this->numberOfTickets=$numberOfTickets;
		$this->discount=$discount;
		$this->date=$date;
		$this->total=$total;   // total deberia calcularse
		$this->ticketList= array();
		$this->user= new User();
		$this->creditCardPayment= new CreditCardPayment();
	}

	public function getPurchaseNumber(){
		return $this->purchaseNumber;
	}

	public function setPurchaseNumber($purchaseNumber){
		$this->purchaseNumber=$purchaseNumber;
	}

	public function getNumberOfTickets(){
		return $this->numberOfTickets;
	}

	public function setNumberOfTickets($numberOfTickets){
		$this->numberOfTickets=$numberOfTickets;
	}

	public function getDiscount(){
		return $this->discount;
	}

	public function setDiscount($discount){
		$this->discount=$discount;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function getTotal(){
		return $this->total;
	}

	public function setTotal($total){
		$this->total=$total;
	}

	public function getTicketList(){
		return $this->ticketList;
	}

	public function setTicketList($ticketList){  // setea todos los tickets
		$this->ticketList=$ticketList;
	}

	public function addTicketList($ticket){ // para agregar 1 ticket a la lista // ver
		array_push($this->ticketList, $ticket);
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){  // preguntar si mandamos User $user por parametro / enviar el user sin pass
		$this->user=$user;
	}

	public function getCreditCardPayment(){
		return $this->creditCardPayment;
	}

	public function setCrediCardPayment($creditCardPayment){
		$this->creditCardPayment=$creditCardPayment;
	}


}





 ?>