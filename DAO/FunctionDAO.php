<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */  
use DAO\Connection as Connection;
use Models\Functions as Functions;
use Models\Film as Film;

class FunctionDAO{

	private $connection;
    private $tableName = "function";

    /*AGREGA UNA FUNCION A LA BASE DE DATO CON SU CORRESPONDIENTE ID DE SALA E ID DE PELICULA*/
    public function addDAO($idRoom,$idFilm,$function) 
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (id_room, id_film, date) VALUES (:id_room, :id_film, :date);";
                
                $parameters["id_room"] = $idRoom;
                $parameters["id_film"] = $idFilm;
                $parameters["date"] = $function->getDate();     

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

    public function updateDAO($idFunction,$idRoom,$idFilm,$function){
        try
            {
                
                $query = "UPDATE ".$this->tableName." SET id_room = :id_room, id_film = :id_film, date = :date WHERE ".$this->tableName.".id = ".$idFunction.";";
                
                $parameters["id_room"] = $idRoom;
                $parameters["id_film"] = $idFilm;
                $parameters["date"] = $function->getDate();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function deleteDAO(){ // VER A TRAVES DE QUE PARAMETRO ELIMINAMOS LA FUNCION, Y VER QUE PASARIA CON LAS ENTRADAS RELACIONADAS A LA MISMA

        try
            {
                
                /*HACER QUERY QUE BORRRE LA FUNCION, Y VER QUE PASA CON LAS ENTRADAS*/
                //$query =
                
                /*HACER UNA BAJA LOGICA*/

                // $parameters = 
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }

    public function deleteOldDates(){
        /*ELIMINAR FUNCIONES DE FECHAS DESACTUALIZADAS*/
    }

    /*TRAE TODAS LAS FUNCIONES ASOCIADAS A UNA SALA Y SU PELICULA*/
    public function getAllDAO(){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN film ON ".$this->tableName.".id_film = film.id JOIN room ON ".$this->tableName.".id_room = room.id";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $film=null;
                $functionList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $function = new Functions();
                        $function->setDate($row["date"]);
                        $film=new Film();
                        $row["film_title"] =str_replace("?", "'", $row["film_title"]);
                        $film->setFilmTitle($row["film_title"]);
                        /*COMPLETAR LOS DATOS RESTANTES*/
                        $film->setLength($row["length"]);
                        $film->setLanguage($row["language"]);
                        $film->setImage($row["image"]);
                    
                        $function->setFilm($film);
                        array_push($functionList, $function);
                }
                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function getAllFromRoom($idCinema,$roomNumber){
        try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN film ON ".$this->tableName.".id_film = film.id JOIN room ON ".$this->tableName.".id_room = room.id WHERE room.id_cinema =".$idCinema." AND room.room_number = ".$roomNumber." ORDER BY ".$this->tableName.".date;";
                
               
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $film=null;
                $functionList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $function = new Functions();
                        $function->setDate($row["date"]);
                        $film=new Film();
                        $row["film_title"] =str_replace("?", "'", $row["film_title"]);
                        $film->setFilmTitle($row["film_title"]);
                        /*COMPLETAR LOS DATOS RESTANTES*/
                        $film->setLength($row["length"]);
                        $film->setLanguage($row["language"]);
                        $film->setImage($row["image"]);
                    
                        $function->setFilm($film);
                        $functionList[$row[0]]= $function;
                }
                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    /*public function getAllCinema($filmTitle){
        try
            {
                $query = "SELECT cinema.name FROM ".$this->tableName." JOIN film ON ".$this->tableName.".id_film = film.id JOIN room ON ".$this->tableName.".id_room = room.id JOIN cinema ON room.id_cinema = cinema.id WHERE film.film_title = '".$filmTitle."';";
                
               
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $cinema=null;
                $cinemaList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        if($cinema!= $row["name"]){


                            $cinema = $row["name"];
                      
                            array_push($cinemaList, $cinema);
                        }
                }
                return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }*/

   /* public function getAllFromFilm($filmTitle){
        try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN film ON ".$this->tableName.".id_film = film.id JOIN room ON ".$this->tableName.".id_room = room.id WHERE film.film_title = '".$filmTitle."' ORDER BY room.id, ".$this->tableName.".date;";
                
               
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $film=null;
                $functionList = array();
        
                foreach ($resultSet as $row)
                {                
               
                        $function = new Functions();
                        $function->setDate($row["date"]);
                        $film=new Film();
                        $row["film_title"] =str_replace("?", "'", $row["film_title"]);
                        $film->setFilmTitle($row["film_title"]);
                        $film->setLength($row["length"]);
                        $film->setLanguage($row["language"]);
                        $film->setImage($row["image"]);
                    
                        $function->setFilm($film);
                        //$functionList["id_room"]=$function;
                        array_push($functionList, $function);
                }
                return $functionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }*/

    /*Funcion que devuelva el id de la funcion para saber cual editar*/
    public function getIdFunctionDAO($idRoom,$idFilm,$date){

        try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".id_room = ".$idRoom." AND ".$this->tableName.".id_film = ".$idFilm." AND ".$this->tableName.".date = '".$date."';";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach ($resultSet as $row)
                {           
                     $idFunction=$row["id"];      
                }
                return $idFunction;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

    }

    public function getFunctionDAO($idFunction){
        try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN film ON ".$this->tableName.".id_film = film.id JOIN room ON ".$this->tableName.".id_room = room.id WHERE ".$this->tableName.".id = ".$idFunction.";";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $film=null;
                $function=null;
                foreach ($resultSet as $row)
                {                
               
                        $function = new Functions();
                        $function->setDate($row["date"]);
                        $film=new Film();
                        $row["film_title"] =str_replace("?", "'", $row["film_title"]);
                        $film->setFilmTitle($row["film_title"]);
                        /*COMPLETAR LOS DATOS RESTANTES*/
                        $film->setLength($row["length"]);
                        $film->setLanguage($row["language"]);
                        $film->setImage($row["image"]);
                    
                        $function->setFilm($film);
                }
                return $function;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


}

 ?>