<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\CreditCardPayment as CreditCardPayment;   
use DAO\Connection as Connection;

class CreditCardPaymentDAO{

	private $connection;
    private $tableName = "credit_card_payment";



    public function addDAO($idCreditAccount,$creditCardPayment){
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (id_credit_account, payment_number, autorization_code, date, total) VALUES (:id_credit_account, :payment_number, :autorization_code, :date, :total);";
                
                $parameters["id_credit_account"] = $idCreditAccount;
                $parameters["payment_number"] = $creditCardPayment->getPaymentNumber();
                $parameters["autorization_code"] = $creditCardPayment->getAutorizationCode();   
                $parameters["date"] = $creditCardPayment->getDate();   
                $parameters["total"] = $creditCardPayment->getTotal();        

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    	
    }

    public function getIdCreditCardPayment($paymentNumber){

    	try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".payment_number = ".$paymentNumber.";";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                

                foreach ($resultSet as $row)
                {           
                     $idPurchase=$row["id"];      
                }
                return $idPurchase;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function getLastPaymentNumber(){
    	try
            {
                
                /*VER QUE TRAE Y CORREGIR LA CONSULTA*/
                $query = "SELECT ".$this->tableName.".payment_number FROM ".$this->tableName." ORDER BY ".$this->tableName.".payment_number DESC LIMIT 1;";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $last = 0;
                foreach ($resultSet as $row) {
                    $last=$row["payment_number"];
                }
                
                return $last;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }
}



 ?>