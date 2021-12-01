<?php namespace Models;

use Models\User as User;
use Models\Role as Role;

class User{ 

	private $email;
	private $password;
	private $firstName;
	private $lastName;
	private $dni;
	private $token;
	private $role;

	public function __construct($email = null, $password = null, $firstName = null, $lastName = null, $dni = null, $token = null, $role = null){

		$this->email     = $email;
		$this->password  = $password;
		$this->firstName = $firstName;
		$this->lastName  = $lastName;
		$this->dni       = $dni;
		$this->token     = $token;

		if ($role == null){
			$role = new Role();
		}
		$this->role = $role;
		
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function setFirstName($firstName){
		$this->firstName=$firstName;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function setLastName($lastName){
		$this->lastName=$lastName;
	}

	public function getDni(){
		return $this->dni;
	}

	public function setDni($dni){
		$this->dni=$dni;
	}

	public function getToken(){
		return $this->token;
	}

	public function setToken($token){
		$this->token=$token;
	}

	public function getRole(){
		return $this->role;
	}

	public function setRole($role){
		$this->role=$role;
	}




}



 ?>