<?php namespace Controllers;

use DAO\CreditAccountDAO as CreditAccountDAO;
use Models\CreditAccount as CreditAccount; 

class CreditAccountController{


	private $creditAccountDao;
	private $creditAccount;
	private $creditAccountList;



	/*BORRAR LAS INNECESARIAS*/
	public function __construct(){
		$this->creditAccountDao = new CreditAccountDAO();
		$this->creditAccount = new CreditAccount();
		$this->creditAccountList = array();
	

	}

	public function getIdCreditAccount($companyName){
		$idCreditAccount=$this->creditAccountDao->getIdCreditAccount($companyName);
		return $idCreditAccount;

	}

	public function createCreditAccount($companyName){

		$this->creditAccount->setCompanyName($companyName);

		$this->creditCardPaymentDao->addDAO($this->creditAccount);

	}
}


 ?>