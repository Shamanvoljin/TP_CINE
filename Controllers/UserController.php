<?php namespace Controllers;

    use DAO\UserDAO as UserDAO;
    //use JsonDAO\UserJsonDAO as UserDAO; // para poder usar json
    use Models\User as User;
    use Models\Role as Role;

    class UserController{

    	private $userDAO;
    	private $user;
    	private $token;
    	private $userList;

    	public function __construct($userDAO = null, $user = null, $token = null, $userList = null){

          if ($userDAO == null){
              $userDAO = new UserDAO();
          }
          $this->userDAO = $userDAO;

          if ($user == null){
              $user = new User();
          }
          $this->user = $user;

          $this->token = $token;

          if ($userList == null){
              $userList = array();
          }
          $this->userList = $userList;

      }

      public function getUserToken($token){

          $this->user = $this->userDAO->getUserDAO($token);
          return $this->user;
      }

      public function getIdUser($email){
        $idUser=$this->userDAO->getIdUserDAO($email);
        return $idUser;
      }

      public function getUserEmail($email){

          $this->user = $this->userDAO->getUserEmailDAO($email);
          return $this->user;
      }

      public function registerUser($email, $password, $role, $firstname, $lastname, $dni){

          $registerUser = $this->getUserEmail($email);
          if($registerUser == null){
              $token = $this->createToken();              
              $registerUser = new User($email, $password, $firstname, $lastname, $dni, $token, $role);
              $this->userDAO->addDAO($registerUser);
          }
          else {
            $registerUser = null;
          }
          return $registerUser;
      }

   		public function createToken(){
   			  $newToken = null;
   			  do {
   				   $controller = false;
   				   $newToken = $this->generateNumber();
   				   foreach($this->userList as $key => $value) {
   					    if($newToken == $value->getToken()){
   						      $controller = true;
   					    }
   				   }
			    }while($controller);
   			  return $newToken;
   		}

   		
   		public function generateNumber(){
   			  $key = '';
 			    $pattern = '1234567890';
 			    $max = strlen($pattern)-1;
 			    for($i=0; $i<6; $i++) {
              $key .= $pattern{mt_rand(0,$max)};
          } 				     
 			    return $key;
   		}
      
   		public function getUserDAO(){ 
   			return $this->userDAO;
   		}

   		public function getUser(){ 
   			return $this->user;
   		}

   		public function getToken(){
   			return $this->token;
   		}

   		public function getUserList(){
   			return $this->userList;
   		}
   		 
    }
    
    ?>

  