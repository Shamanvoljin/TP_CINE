<?php namespace JsonDAO;

use JsonDAO\IJsonDAO as IJsonDAO;
use Models\Role as Role;

class RoleJsonDAO implements IJsonDAO{

	private $roleList=array();

	public function saveData(){

		$arrayToEncode=array();

		foreach ($this->roleList as $role) {
			
			$valuesArray["roleName"]=$role->getRoleName();
			$valuesArray["idRole"]=$role->getIdRole();

			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
		file_put_contents(ROOT."JsonDAO/Data/Role.json", $jsonContent);
	}

	public function retrieveData(){

		$this->roleList=array();
		$jsonPath=$this->getJsonFilePath();

		if (file_exists($jsonPath)){ 
			$jsonContent=file_get_contents($jsonPath);
			$arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
			
			foreach ($arrayToDecode as $valuesArray) {
				
				$role=new Role($valuesArray["roleName"],$valuesArray["idRole"]);
				
				array_push($this->roleList,$role);
			}
		}  

	}

	public function addDAO($newRole){
		$this->retrieveData();
		array_push($this->roleList, $newRole);
		$this->saveData();

	}
	public function deleteDAO($newRole){
		// completar, ver si eliminamos a traves del nombre del role
	}

	public function getAllDAO(){
		$this->retrieveData();
		return $this->roleList;
	}

	public function getRoleDAO($idRole){ // busca por id de role
		// completar
	}

	public function getJsonFilePath(){

        $initialPath = ROOT."JsonDAO/Data/Role.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }
} 


 ?>