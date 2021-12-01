<?php namespace Models;
use Models\Role as Role;

class Role{

	private $roleName;
	private $idRole;

	public function __construct($roleName = "Cliente", $idRole = "3"){
		$this->roleName=$roleName;
		$this->idRole=$idRole;
	}

	public function getRoleName(){
		return $this->roleName;
	}

	public function setRoleName($roleName){
		$this->roleName=$roleName;
	}

	public function getIdRole(){
		return $this->idRole;
	}

	public function setIdRole($idRole){
		$this->idRole=$idRole;
	}
}

 ?>