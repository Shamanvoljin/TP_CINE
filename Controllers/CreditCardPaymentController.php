<?php namespace Controllers;

use DAO\CreditCardPaymentDAO as CreditCardPaymentDAO;
use Models\CreditCardPayment as CreditCardPayment; 
use Models\CreditAccount as CreditAccount;

class CreditCardPaymentController{


	private $creditCardPaymentDao;
	private $creditCardPayment;
	private $creditCardPaymentList;
	private $creditAccountController;



	/*BORRAR LAS INNECESARIAS*/
	public function __construct(){
		$this->creditCardPaymentDao = new CreditCardPaymentDAO();
		$this->creditCardPayment = new CreditCardPayment();
		$this->creditCardPaymentList = array();
		$this->creditAccountController = new CreditAccountController();

	}

	public function createCreditCardPayment($autorizationCode,$date,$totalPrice,$companyName){

		
		$idCreditAccount=$this->creditAccountController->getIdCreditAccount($companyName);
		

		$paymentNumber= $this->creditCardPaymentDao->getLastPaymentNumber()+1;
		

		$this->creditCardPayment->setPaymentNumber($paymentNumber);
		$this->creditCardPayment->setAutorizationCode($autorizationCode);
		$this->creditCardPayment->setDate($date);
		$this->creditCardPayment->setTotal($totalPrice);
	

		$this->creditCardPaymentDao->addDAO($idCreditAccount,$this->creditCardPayment);

		return $paymentNumber;

	}

	public function getIdCreditCardPayment($paymentNumber){
		$idCreditCardPayment=$this->creditCardPaymentDao->getIdCreditCardPayment($paymentNumber);
		return $idCreditCardPayment;
	}
}


 ?>