<?php namespace JsonDAO;

use JsonDAO\IJsonDAO as IJsonDAO;
use Models\Category as Category;

class CategoryJsonDAO implements IJsonDAO{

	private $categoryList=array();

	
	public function saveData(){  // carga datos en archivo json
		
		$arrayToEncode =array();
		foreach ($this->categoryList as $category) {
			
			$valuesArray["description"]=$category->getDescription();
			
			array_push($arrayToEncode,$valuesArray);
		}
		$jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
		file_put_contents(ROOT."JsonDAO/Data/Category.json", $jsonContent);  // fijarse que nombre le vamos a poner a la carpeta y las rutas
	}

	public function retrieveData(){  // trae datos de json
		
		$this->categoryList=array();
		$jsonPath=$this->getJsonFilePath();
		if (file_exists($jsonPath)){ // fijarse que nombre le ponemos a los archivos json
			$jsonContent=file_get_contents($jsonPath);
			$arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
			
			foreach ($arrayToDecode as $valuesArray) {
				
				$category=new Category($valuesArray["description"]);
				
				array_push($this->categoryList,$category);
			}
		}  
	}

	public function addDAO($newCategory){

		$this->retrieveData();
		array_push($this->categoryList, $newCategory);
		$this->saveData();
	}

	public function deleteDAO($description){  // falta, depende si lo eliminamos por categoria o buscando la descripcion
		$this->retrieveData();
		$newList=array();
		foreach ($this->categoryList as $category) {
			if($category->getDescrpiton()!= $description){
				array_push($newList,$category);
			}
		}
		$this->categoryList =$newList;
		$this->saveData();
	}

	public function getAllDAO(){
		$this->retrieveData();
        return $this->categoryList;
	}

	public function getCategoryDAO($parameter){
		//completar
	}

	//Es necesario para evitar los problemas de requires por el ruteo
	// usar esto en el retrieve
	// $jsonPath = $this->GetJsonFilePath();
	// $jsonContent = file_get_contents('Data/Category.json');
	// $jsonContent = file_get_contents($jsonPath);
    public function getJsonFilePath(){

        $initialPath = ROOT."JsonDAO/Data/Category.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }


}



 ?>