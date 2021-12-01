<?php namespace DAO;

    use \Exception as Exception;
    use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
    use Models\Role as Role;    
    use DAO\Connection as Connection;

    class RoleDAO implements IDAO{
        
        private $connection;
        private $tableName = "role";

        public function addDAO($value) /* $value = Objeto de tipo Role */
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id, role_name) VALUES (:id, :role_name);";
                
                $parameters["id"] = $value->getRole()->getIdRole();
                $parameters["role_name"] = $value->getRole()->getRoleName();

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
                $query = "SELECT * FROM ".$this->tableName;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $roleList = array();
                foreach ($resultSet as $row)
                {                
                    $role = new Role();
                    $role->setRoleName($row["role_name"]);
                    $role->setIdRole($row["id"]); 
                    array_push($roleList, $user);
                }
                return $roleList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function deleteDAO($idRole){ 

        }

        public function getRoleDAO($idRole){ 
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id = ".$idRole;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
                $role = null;

                foreach ($resultSet as $key => $value) {
                    $role = new Role();
                    $role->setIdRole($value['id']);
                    $role->setRoleName($value["role_name"]); 
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            return $role;
        }

    }
?>