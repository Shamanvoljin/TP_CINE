<?php namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\Purchase as Purchase; 
use Models\PurchaseList as PurchaseList;  


class PurchaseDAO{

	private $connection;
    private $tableName = "purchase";

    public function addDAO($idUser,$idCreditCardPayment,$purchase){
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (id_credit_card_payment, id_user, purchase_number, number_of_tickets, discount, date, total) VALUES (:id_credit_card_payment, :id_user, :purchase_number, :number_of_tickets, :discount, :date, :total);";
                
                $parameters["id_credit_card_payment"] = $idCreditCardPayment;
                $parameters["id_user"] = $idUser;
                $parameters["purchase_number"] = $purchase->getPurchaseNumber();
                $parameters["number_of_tickets"] = $purchase->getNumberOfTickets();   
                $parameters["discount"] = $purchase->getDiscount();   
                $parameters["date"] = $purchase->getDate();   
                $parameters["total"] = $purchase->getTotal();        

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    	
    }

    public function getLastPurchaseNumber(){
    	try
            {
                
                /*VER QUE TRAE Y CORREGIR LA CONSULTA*/
                $query = "SELECT ".$this->tableName.".purchase_number FROM ".$this->tableName." ORDER BY ".$this->tableName.".purchase_number DESC LIMIT 1;";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $last = 0;
                foreach ($resultSet as $row) {
                    $last=$row["purchase_number"];
                }
                
                return $last;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function getIdPurchaseDAO($purchaseNumber){
    	try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".purchase_number = ".$purchaseNumber.";";
                
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

    public function getAllDAO(){
        try
        {
            $query = "SELECT purchase.date AS date, cinema.name AS name, room.room_number AS room_number, purchase.number_of_tickets AS cant_tickets, purchase.discount AS discount, purchase.total AS total, user.token AS token, film.film_title AS film
                FROM purchase 
                JOIN ticket ON purchase.id = ticket.id_purchase 
                JOIN function ON function.id = ticket.id_function
                JOIN room ON room.id = function.id_room
                JOIN cinema ON cinema.id = room.id_cinema
                JOIN user ON user.id = purchase.id_user
                JOIN film ON film.id = function.id_film
                GROUP BY purchase.id ORDER BY purchase.date;";
                
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 

            $purchaseList = array();           

            foreach ($resultSet as $row)
            {     

            $purchase = new PurchaseList();

            $purchase->setDate($row["date"]);
            $purchase->setCinema($row["name"]);
            $purchase->setRoom_number($row["room_number"]);
            $purchase->setCant_tickets($row["cant_tickets"]); 
            $purchase->setDiscount($row["discount"]); 
            $purchase->setTotal($row["total"]);
            $purchase->setToken($row["token"]); 
            $purchase->setFilm($row["film"]); 
            
            array_push($purchaseList, $purchase);
            }
            
            return $purchaseList;                 
                    
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

public function getAllUserDAO($id){
    
        try
        {
            $query = "SELECT purchase.date AS date, cinema.name AS name, room.room_number AS room_number, purchase.number_of_tickets AS cant_tickets, purchase.discount AS discount, purchase.total AS total, user.token AS token, film.film_title AS film
                FROM purchase 
                JOIN ticket ON purchase.id = ticket.id_purchase 
                JOIN function ON function.id = ticket.id_function
                JOIN room ON room.id = function.id_room
                JOIN cinema ON cinema.id = room.id_cinema
                JOIN user ON user.id = purchase.id_user
                JOIN film ON film.id = function.id_film
                WHERE user.id = ".$id." 
                GROUP BY purchase.id ORDER BY purchase.date;";
                
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 

            $purchaseList = array();           

            foreach ($resultSet as $row)
            {     

            $purchase = new PurchaseList();

            $purchase->setDate($row["date"]);
            $purchase->setCinema($row["name"]);
            $purchase->setRoom_number($row["room_number"]);
            $purchase->setCant_tickets($row["cant_tickets"]); 
            $purchase->setDiscount($row["discount"]); 
            $purchase->setTotal($row["total"]);
            $purchase->setToken($row["token"]); 
            $purchase->setFilm($row["film"]); 
            
            array_push($purchaseList, $purchase);
            }
            
            return $purchaseList;                 
                    
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

}


 ?>