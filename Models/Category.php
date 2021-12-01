<?php namespace Models;

use Models\Category as Category;

class Category{

	private $description;

	public function __construct($description=null){
		$this->description=$description;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	
}
		

 ?>