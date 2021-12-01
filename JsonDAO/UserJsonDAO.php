<?php namespace JsonDAO;

use JsonDAO\IJsonDAO as IJsonDAO;
use Models\User as User;
use Models\Role as Role;

class UserJsonDAO implements IJsonDAO{

	private $userList=array();

	public function saveData(){

		$arrayToEncode=array();

		foreach ($this->userList as $user) {
			
			$valuesArray["email"]=$user->getEmail();
			$valuesArray["password"]=$user->getPassword();
			$valuesArray["firstName"]=$user->getFirstName();
			$valuesArray["lastName"]=$user->getLastName();
			$valuesArray["dni"]=$user->getDni();
			$valuesArray["token"]=$user->getToken();

			/*Testeo de role*/
			$role=$user->getRole();

			$valuesArray["role"]=array();
			$valuesArray["role"]["roleName"]=$role->getRoleName(); // ver si se puede usar asi con multiples dimensiones
			$valuesArray["role"]["idRole"]=$role->getIdRole();
			
			/*Fin de testeo*/

			//$valuesArray["role"]=$user->getRole();
			// puede que $valuesArray["role"] tenga que ser un array, y que contenga los datos de role llamando a $user->getRole()->getRoleName y $user->getRole()->getIdRole();

			array_push($arrayToEncode, $valuesArray);
		}

		$jsonContent=json_encode($arrayToEncode,JSON_PRETTY_PRINT);
		file_put_contents(ROOT."JsonDAO/Data/User.json", $jsonContent);
	}

	public function retrieveData(){

		$this->userList=array();
		$jsonPath=$this->getJsonFilePath();

		if (file_exists($jsonPath)){ // fijarse que nombre le ponemos a los archivos json
			$jsonContent=file_get_contents($jsonPath);
			$arrayToDecode=($jsonContent) ? json_decode($jsonContent,true):array();
			
			foreach ($arrayToDecode as $valuesArray) {
					
				/*POR EL CONSTRUCTOR QUE TENEMOS*/	
				//$user=new User($valuesArray["email"],$valuesArray["password"],$valuesArray["firstName"],$valuesArray["lastName"],$valuesArray["dni"],$valuesArray["token"]);
				// saque el $valuesArray["role"] del constructor

				
				/*MODIFICAR CONSTRUCTOR*/
				$user=new User();
				$user->setEmail($valuesArray["email"]);
				$user->setPassword($valuesArray["password"]);
				$user->setFirstName($valuesArray["firstName"]);
				$user->setLastName($valuesArray["lastName"]);
				$user->setDni($valuesArray["dni"]);
				$user->setToken($valuesArray["token"]);


				/*Testeo de role*/
				$role=new Role($valuesArray["role"]["roleName"],$valuesArray["role"]["idRole"]);
				$user->setRole($role);

				/*fin de testeo*/

				// deberia hacerse un new Role con los datos que hay en $valuesArray["role"], y despues en el constructor de user, envio ese role como parametro
				
				array_push($this->userList,$user);
			}
		}  
	}

	public function addDAO($newUser){
		$this->retrieveData();
		array_push($this->userList, $newUser);
		$this->saveData();

	}

	public function deleteDAO($token){
		// completar, eliminamos a traves del token
	}

	public function getAllDAO(){
		$this->retrieveData();
		return $this->userList;
	}

	public function getUserDAO($token){ // busca por token
		// completar, tiene que devolver 1 user
		$this->retrieveData();
		$user=null;
		foreach ($this->userList as $value) {
			if($value->getToken()==$token){
				$user=$value;
			}
		}
		return $user;
	}

	public function getJsonFilePath(){

        $initialPath = ROOT."JsonDAO/Data/User.json";
        if(file_exists($initialPath)){
            $jsonFilePath = $initialPath;
        }else{
            $jsonFilePath = "../".$initialPath;
        }

        return $jsonFilePath;
    }


}

 ?>