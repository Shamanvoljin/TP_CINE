<?php namespace JsonDAO;

use JsonDAO\IJsonDAO as IJsonDAO;
use Models\Film as Film;
use Models\Category as Category;

class FilmJsonDAO implements IJsonDAO{

	private $filmList=array();


	public function saveData(){

		$arrayToEncode=array();
		foreach ($this->filmList as $film) {
			
			$valuesArray["filmTitle"]=$film->getFilmTitle();
			$valuesArray["length"]=$film->getLength();
			$valuesArray["image"]=$film->getImage();
			$valuesArray["language"]=$film->getLanguage();

			/*Testeo de lista de categorias*/
			$categoryList=array();
			$categoryList=$film->getCategoryList();
			

			$valuesArray["categoryList"]=array();
			$i=0;
			foreach ($categoryList as $category) {
				
				$valuesArray["categoryList"][$i]["description"]=$category->getDescription(); // ver si se puede usar asi con multiples dimensiones
				$i++;
			}
			/*Fin de testeo*/

			//$valuesArray["categoryList"]=$film->getCategoryList(); // ver
			// probar, categoryList deberia hacer un array, donde cada elemento es otro array con los datos de las categorias, y usar los get de Category para cargarlo


			array_push($arrayToEncode,$valuesArray);
		}
		$jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
		file_put_contents(ROOT."JsonDAO/Data/Film.json",$jsonContent);
	}

	public function retrieveData(){

		$this->filmList=array();
		$jsonPath=$this->getJsonFilePath();
		if(file_exists($jsonPath)){
			$jsonContent=file_get_contents($jsonPath);
			$arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
			
			foreach ($arrayToDecode as $valuesArray) {
				
				$film=new Film($valuesArray["filmTitle"],$valuesArray["length"],$valuesArray["image"],$valuesArray["language"]);

				// elimine el $valuesArray["categoryList"] del constructor

				/*Testeo de lista de categorias*/
				$categoryList=array();
				foreach ($valuesArray["categoryList"] as $value) {
					$category=new Category($value["description"]);
					array_push($categoryList,$category);
					$film->setCategoryList($categoryList);
				}



				/*fin de testeo*/

				// deberiamos hacer varios new Category recorriendo $valuesArray["categoryList"] y utilizando los datos de cada uno para inicializarlo, guardarlos en un array de Category, y ahi los envio por parametro en el new Film
				
				
				array_push($this->filmList,$film);
			}
		}
	}

	public function addDAO($newFilm){
		$this->retrieveData();
		array_push($this->filmList, $newFilm);
		$this->saveData();
	}

	public function deleteDAO($newFilm){
		// completar, ver si eliminamos a traves del titulo de la pelicula
	}

	public function getAllDAO(){
		$this->retrieveData();
		return $this->filmList;
	}

	public function getFilmDAO($filmTitle){
		// completar, buscar pelicula por titulo y devolverla
	}

	public function getJsonFilePath(){

        $initialPath = ROOT."JsonDAO/Data/Film.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }

}


 ?>