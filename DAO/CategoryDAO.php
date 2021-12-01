<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\Category as Category;    
use DAO\Connection as Connection;

class CategoryDAO implements IDAO{

	private $connection;
    private $tableName = "category";

    public function addDAO($category){
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (description) VALUES (:description);";
                
                $parameters["description"] = $category->getDescription();

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
                $categoryList = array();
                foreach ($resultSet as $row)
                {                
                    $category = new Category();
                    $category->setDescription($row["description"]);
                    array_push($categoryList, $category);
                }
                return $categoryList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }
    public function deleteDAO($description){ 
    	// no deberia hacer falta
    }

    public function getCategoryDAO($description){ 
          	try
          	{
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".description = ".$description;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
                $category = null;

                foreach ($resultSet as $key => $value) {
                    $category = new Category();
                    $category->setDescription($value['description']);
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            return $category;
    }

    public function getIdCategoryDAO($description){
        try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".description = '".$description."'";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);       
                $categoryId=0;         

                foreach ($resultSet as $row)
                {           
                     $categoryId=$row["id"];      
                }
                return $categoryId;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


}

 ?>