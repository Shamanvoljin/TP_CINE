<?php namespace Models;
use Models\CreditCardPayment as CreditCardPayment;
use Models\CreditAccount as CreditAccount; // por si necesitamos hacer un new CredditAccount


class CreditCardPayment{

	private $paymentNumber;
	private $autorizationCode;
	private $date;
	private $total;
	private $creditAccount;

	public function __construct($paymentNumber = null, $autorizationCode = null ,$date = null ,$total = null ,$creditAccount = null){ // ver si har un new creditAccount

		$this->paymentNumber=$paymentNumber;
		$this->autorizationCode=$autorizationCode;
		$this->date=$date;		// misma fecha que purchase
		$this->total=$total; // viene por el total de purchase
		$this->creditAccount=$creditAccount;
	}

	public function getPaymentNumber(){
		return $this->paymentNumber;
	}

	public function setPaymentNumber($paymentNumber){
		$this->paymentNumber=$paymentNumber;
	}

	public function getAutorizationCode(){
		return $this->autorizationCode;
	}

	public function setAutorizationCode($autorizationCode){
		$this->autorizationCode=$autorizationCode;
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

	public function getCreditAccount(){
		return $this->creditAccount;
	}

	public function setCreditAccount($creditAccount){
		$this->creditAccount=$creditAccount;
	}

}


 ?>