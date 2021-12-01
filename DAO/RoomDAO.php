<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */  
use DAO\Connection as Connection;
use Models\Room as Room;

class RoomDAO{

	private $connection;
    private $tableName = "room";


    /*AGREGA UNA SALA A LA BASE DE DATOs CON SU CORRESPONDIENTE ID DE CINE*/
    public function addDAO($idCinema,$value) 
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_cinema, room_number, seats) VALUES (:id_cinema, :room_number, :seats);";
                
                $parameters["id_cinema"] = $idCinema;
                $parameters["room_number"] = $value->getRoomNumber();
                
                $parameters["seats"] = $value->getSeats();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }


        /*TRAE TODAS LAS SALAS ASOCIADAS A UN CINE POR ID*/
    public function getAllDAO($idCinema){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".id_cinema = ".$idCinema;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $roomList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $room = new Room();
                        $room->setSeats($row["seats"]);
                        $room->setRoomNumber($row["room_number"]); 

                        array_push($roomList, $room);
                    


                }
                return $roomList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    /*TRAE 1 SALA A TRAVES DE SU NUMERO DE SALA Y NOMBRE DEL CINE AL QUE PERTENECE*/
    public function getRoomDAO($cinemaName,$roomNumber){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN cinema WHERE cinema.name = '".$cinemaName."' AND ".$this->tableName.".room_number = ".$roomNumber;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $roomList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $room = new Room();
                        $room->setSeats($row["seats"]);
                        $room->setRoomNumber($row["room_number"]); 

                    


                }
                return $room;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    /*TRAE 1 SALA A TRAVES DE SU NUMERO DE SALA E ID DEL CINE AL QUE PERTENECE*/
    public function getRoomDAOByID($idCinema,$roomNumber){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN cinema WHERE cinema.id = ".$idCinema." AND ".$this->tableName.".room_number = ".$roomNumber;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $roomList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $room = new Room();
                        $room->setSeats($row["seats"]);
                        $room->setRoomNumber($row["room_number"]); 

                    


                }
                return $room;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    /*TRAE EL ID DE 1 SALA A TRAVES DE SU NUMERO DE SALA Y EL ID DEL CINE AL QUE PERTENECE*/
    public function getIdRoomDAO($idCinema,$roomNumber){
            try
            {
                
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." JOIN cinema ON ".$this->tableName.".id_cinema = cinema.id WHERE ".$this->tableName.".room_number = ".$roomNumber." AND ".$this->tableName.".id_cinema = ".$idCinema.";";

                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $idRoom=0;
        
                foreach ($resultSet as $row)
                {                
                   $idRoom = $row["id"]; 

                }
                return $idRoom;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function updateDAO($idRoom,$room){
        try
            {
                $query = "UPDATE ".$this->tableName." SET room_number = :room_number, seats = :seats WHERE ".$this->tableName.".id = ".$idRoom.";";
                

                $parameters["room_number"] = $room->getRoomNumber();
                $parameters["seats"] = $room->getSeats();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


}

 ?>