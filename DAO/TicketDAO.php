<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\Ticket as Ticket;
use DAO\Connection as Connection;


class TicketDAO{

	private $connection;
    private $tableName = "ticket";


    public function addDAO($idPurchase, $idFunction,$ticket){ // NECESITO ENVIARLE LAS ID
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (id_purchase, id_function, ticket_number, qr) VALUES (:id_purchase, :id_function, :ticket_number, :qr);"; // faltariam las categorias porque necesitamos una tabla de relacion
                
                $parameters["id_purchase"] = $idPurchase;
                $parameters["id_function"] = $idFunction;
                $parameters["ticket_number"] = $ticket->getTicketNUmber();
                $parameters["qr"] = $ticket->getQr();

                // faltan categorias

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function updateDAO($idPurchase,$idFunction,$ticket){
        try
            {

                /*HACER QUERY QUE ACTUALIZE*/
                // $query=
                
                $parameters["id_purchase"] = $idPurchase;
                $parameters["id_function"] = $idFunction;
                $parameters["ticket_number"] = $ticket->getTicketNUmber();
                $parameters["qr"] = $ticket->getQr();


                /* VER SI LE VAMOS A PONER ID A TODO PARA MANEJARLO MAS FACIL Y NO ENVIARLO POR PARAMETRO*/
                /*$parameters["id_film"] = $function->getFilm()->getIdFilm();*/
                

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function deleteDAO(){ // VER A TRAVES DE QUE PARAMETRO ELIMINAMOS EL TICKET

        try
            {
                
                /*HACER QUERY QUE BORRRE EL TICKET 
                //$query =
                
                /*HACER UNA BAJA LOGICA*/

                // $parameters = 
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }

    /*TRAE TODOS LOS TICKETSS ASOCIADOS A UNA COMPRA, CON SU FUNCION Y SU PELICULA*/
    public function getAllDAO(){
            try
            {
                
				/*VER QUE TRAE Y CORREGIR LA CONSULTA*/
                $query = "SELECT * FROM ".$this->tableName." JOIN function ON ".$this->tableName.".id_function = function.id JOIN film ON function.id_film = film.id JOIN purchase ON ".$this->tableName.".id_purchase = purchase.id";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $function=null;
                $film=null;
                $ticketList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $ticket = new Ticket();
                        $ticket->setTicketNumber($row["ticket_number"]);
                        $ticket->setQr($row["qr"]);
                        $function = new Functions();
                      	$function->setDate($row["date"]);
                        $film=new Film();
                        $film->setFilmTitle($row["film_title"]);
                        /*COMPLETAR LOS DATOS RESTANTES DE LA PELICULA SI LOs NECESITAMOS*/
                        /*$film->setLength
                        $film->setLanguage
                        $film->setImage*/
                    
                        $function->setFilm($film);
                        $ticket->setFunction($function);
                        array_push($ticketList, $ticket);
                }
                return $ticketList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function getTicketAmount($idFunction){
         try
            {
                
                /*VER QUE TRAE Y CORREGIR LA CONSULTA*/
                $query = "SELECT COUNT(ticket.id_function) as total FROM ".$this->tableName." WHERE ".$this->tableName.".id_function = ".$idFunction.";";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $total = 0;
                foreach ($resultSet as $row) {
                    $total=$row["total"];
                }
                
                return $total;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

}


?>