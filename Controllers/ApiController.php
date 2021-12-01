<?php namespace Controllers;

use Controllers\CategoryController as CategoryController;
use Controllers\FilmController as FilmController;
use Models\Film as Film;
use Models\Category as Category;

class ApiController{
	private $categoryController;
	private $filmController;
	private $filmListAPI;

	public function __construct(){
		$this->categoryController=new CategoryController();
		$this->filmController=new filmController();
	}


	/*llama a getApi y envia toda la URL correspondiente concatenada*/
	public function setCategoryList(){
		$categoryList=$this->getAPI(API_URL."/genre/movie/list?api_key=".API_KEY);
		$this->categoryController->createCategoryList($categoryList);


	}

	public function getCategoryController(){
		return $this->categoryController;
	}


	public function setFilmList(){
		$filmListAux=$this->getAPI(API_URL."/movie/now_playing?api_key=".API_KEY);
		$this->filmListAPI=$this->filmController->createListApi($filmListAux);
	}

	public function getFilmController(){
		return $this->filmController;
	}

	public function getFilmListAPI(){
		return $this->filmListAPI;
	}

	public function getFilmDetails($filmTitle,$idFilm){	
		$apiDetails= $this->getAPI(API_URL."/movie/".$idFilm."?api_key=".API_KEY);
		$film = new Film();
		$film->setFilmTitle($apiDetails["title"]);
		$film->setLanguage($apiDetails["original_language"]);
		$film->setImage(API_IMG.$apiDetails["poster_path"]);
		$film->setLength($apiDetails["runtime"]);

		$categoryList=array();
		foreach ($apiDetails["genres"] as $categoryApi) {
			$category=new Category();
			$category->setDescription($categoryApi['name']);
			array_push($categoryList, $category);

		}
		$film->setCategoryList($categoryList);
		/*foreach ($apiDetails as $key => $value) {

		    
		   	switch ($key) {
		   		case 'genres':
		   			$categoryList=array();
		   			foreach ($value as $categoryApi) {
						$category=new Category();
						$category->setDescription($categoryApi['name']);
						array_push($categoryList, $category);

					}
					$film->setCategoryList($categoryList);

		   			break;

		   		case 'original_language':
		   			$film->setLanguage($value);
		   			break;
		   		case 'poster_path':
		   			$film->setImage(API_IMG.$value);
		   			break;
		   		case 'runtime':
		   			$film->setLength($value);
		   			break;
		   		case 'title':
		   			$film->setFilmTitle($value);
		   			break;
		   	}
		}*/
		return $film;

	}

	/*Funcion que recibe una URL de la API, y transforma el archivo json en un array */
	public function getAPI($url){
		$movieList=array();
        $jsonContent=file_get_contents($url);
        
		$arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
		foreach($arrayToDecode as $key => $valuesArray)
         {
        	$movieList[$key]=$valuesArray;
        	//array_push($movieList,$valuesArray);
         }
         return $movieList;
	}

}


 ?>