<?php namespace Models;
use Models\Film as Film;
use Models\Category as Category; // para el addCategory por si necesita tipado

class Film{

	private $filmTitle;
	private $length;
	private $image;
	private $language;
	private $categoryList;

	public function __construct($filmTitle=null,$length=null,$image=null,$language=null,$categoryList=null){
		$this->filmTitle=$filmTitle;
		$this->length=$length;
		$this->image=$image;
		$this->language=$language;
		$this->categoryList=$categoryList;
	}

	public function getFilmTitle(){
		return $this->filmTitle;
	}

	public function setFilmTitle($filmTitle){
		$this->filmTitle=$filmTitle;
	}

	public function getLength(){
		return $this->length;
	}

	public function setLength($length){
		$this->length=$length;
	}

	public function getImage(){
		return $this->image;
	}

	public function setImage($image){
		$this->image=$image;
	}

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language=$language;
	}

	public function getCategoryList(){
		return $this->categoryList;
	}

	public function setCategoryList($categoryList){
		$this->categoryList=$categoryList;
	}

	public function addCategory($category){   // ver si hace falta
		array_push($this->categoryList, $category);
	}

}



 ?>