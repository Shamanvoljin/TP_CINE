<?php namespace Models;
use Models\CreditAccount as CreditAccount;

class CreditAccount{

	private $companyName;

	public function __construct($companyName = null){
		$this->companyName=$companyName;
	}

	public function getCompanyName(){
		return $this->companyName;
	}

	public function setCompanyName($companyName){
		$this->companyName=$companyName;
	}
}



 ?>