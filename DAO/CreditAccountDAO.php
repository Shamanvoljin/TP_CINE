<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\CreditAccount as CreditAccount;   
use DAO\Connection as Connection;

class CreditAccountDAO{

	private $connection;
    private $tableName = "credit_account";



    public function addDAO($creditAccount){
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (company_name) VALUES (:company_name);";
                
                $parameters["company_name"] = $creditAccount->getCompanyName();
               

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    	
    }

    public function getIdCreditAccount($companyName){

    	try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".company_name = '".$companyName."';";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                

                foreach ($resultSet as $row)
                {           
                     $idCreditAccount=$row["id"];      
                }
                return $idCreditAccount;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }
}



 ?>