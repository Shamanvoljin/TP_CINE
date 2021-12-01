<?php namespace DAO;

    use \Exception as Exception;
    use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
    use Models\User as User;    
    use DAO\Connection as Connection;
    use Models\Role as Role;

    class UserDAO implements IDAO{
        
        private $connection;
        private $tableName = "user";

        public function addDAO($value) /* $value = Objeto de tipo User */
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (token, id_role, email, password, firstName, lastName, dni) VALUES (:token, :id_role, :email, :password, :firstName, :lastName, :dni);";
                
                $parameters["token"] = $value->getToken();
                $parameters["id_role"] = $value->getRole()->getIdRole();
                $parameters["email"] = $value->getEmail();
                $parameters["password"] = $value->getPassword();
                $parameters["firstName"] = $value->getFirstName();
                $parameters["lastName"] = $value->getLastName();
                $parameters["dni"] = $value->getDni();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function getAllDAO(){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN role WHERE ".$this->tableName.".id_role = role.id";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $userList = array();
                foreach ($resultSet as $row)
                {                
                    $user = new User();
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["password"]); 
                    $user->setDni($row["dni"]);
                    $user->setToken($row["token"]);
                    $role = new Role ($row["role_name"],$row["id_role"]);
                    $user->setRole($role);                                 
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    array_push($userList, $user);
                }
                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function deleteDAO($token){ 

        }

        public function getUserDAO($token){ 
            try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN role WHERE ".$this->tableName.".id_role = role.id && ".$this->tableName.".token = ".$token;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
                $user = null;

                foreach ($resultSet as $key => $value) {
                    $user = new User();
                    $user->setEmail($value['email']);
                    $user->setPassword($value["password"]); 
                    $user->setDni($value["dni"]);
                    $user->setToken($value["token"]);
                    $role = new Role ($value["role_name"],$value["id_role"]);
                    $user->setRole($role);                               
                    $user->setFirstName($value["firstName"]);
                    $user->setLastName($value["lastName"]);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            return $user;
        }

        public function getIdUserDAO($email){
            try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".email = '".$email."';";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                

                foreach ($resultSet as $row)
                {           
                     $idUser=$row["id"];      
                }
                return $idUser;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getUserEmailDAO($email){
           try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN role WHERE ".$this->tableName.".id_role = role.id && ".$this->tableName.".email = "."'".$email."'";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
                $user = null;

                foreach ($resultSet as $key => $value) {
                    $user = new User();
                    $user->setEmail($value['email']);
                    $user->setPassword($value["password"]); 
                    $user->setDni($value["dni"]);
                    $user->setToken($value["token"]);
                    $role = new Role ($value["role_name"],$value["id_role"]);
                    $user->setRole($role);                               
                    $user->setFirstName($value["firstName"]);
                    $user->setLastName($value["lastName"]);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            return $user;
        }

    }
?>