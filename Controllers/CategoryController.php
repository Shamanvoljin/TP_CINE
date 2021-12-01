<?php namespace Controllers;

use DAO\CategoryDao as CategoryDao;
//use JsonDAO\CategoryJsonDAO as CategoryDao; 
use Models\Category as Category;

class CategoryController{

	private $categoryDao;
	private $category;
	private $categoryList;

	public function __construct(){
		$this->categoryDao=new CategoryDao();
		$this->category=new Category();
		$this->categoryList=array();
	}

	
	/* Funcion que trae del dao, devuelve una lista y la guarda en la lista de controller*/
	public function getAll(){
		$this->categoryList=$this->categoryDao->getAllDAO();
		return $this->categoryList;
	}
	
	/*LA NECESITO EN FILM CONTROLLER*/
	public function getIdCategory($description){
		$idCategory=$this->categoryDao->getIdCategoryDAO($description);
		return $idCategory;
	}
	/*Funcion que llama a GETAPI, recorre el array, y va agregando las categorias correspondientes al DAO o JSON DAO*/
	public function createCategoryList($categoryList){
		foreach ($categoryList as $value) {
			foreach ($value as $value2) {
				$this->category->setDescription($value2["name"]);
	
				if($this->verifyCategory($this->category,$this->getAll())){
					$this->categoryDao->addDAO($this->category);
				}
				
			}
			
		}
		
	}

	
	/*Verifica que una categoria no exista en una lista*/
	public function verifyCategory($category,$categoryList){
		$flag = true;
		foreach ($categoryList as $value) {
			if($category == $value){
				$flag=false;
			}
		}
		return $flag;

	}

}
		



 ?>