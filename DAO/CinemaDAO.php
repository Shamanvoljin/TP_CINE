<?php namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
    use Models\Cinema as Cinema;    
    use Models\Room as Room;
    use Models\Functions as Functions;
    use Models\Film as Film;

    class CinemaDAO implements IDAO{
        
        private $connection;
        private $tableName = "cinema";

        public function addDAO($value) /* $value = Objeto de tipo Cinema */
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (name, adress_name, adress_number, ticket_price) VALUES (:name, :adress_name, :adress_number, :ticket_price);";
                
                $parameters["name"] = $value->getName();
                /*PROVISORIO SEPARA LA DIRECCION POR UN ESPACIO*/
                $adress=array();
                $adress=explode(" ", $value->getAdress());

                /*LA DIRECCION ESTA SEPARADA SOLO POR UN ESPACIO Y DEBERIA SER CUANDO ENCUENTRE 1 NUMERO*/
                $parameters["adress_name"] = $adress[0]; // Separar la direccion
                $parameters["adress_number"] = $adress[1];
               
                $parameters["ticket_price"] = $value->getTicketPrice();

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
                $query = "SELECT * FROM ".$this->tableName." LEFT JOIN room ON ".$this->tableName.".id = room.id_cinema"; 
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $cinemaList = array();
                $idCinema=null;
                $room=null;
                $roomlist=array();
                foreach ($resultSet as $row)
                {                
                        
                        if($idCinema!=$row[0]){ // comparo con el id de los cines para crear cines solo cuando sean distintos

                              if(isset($cinema)){
                                     $cinema->setRoomList($roomlist);
                                     array_push($cinemaList, $cinema);
                                     $roomlist=array();
                               }

                               $cinema = new Cinema();
                               $cinema->setName($row["name"]);
                               $cinema->setAdress($row["adress_name"]." ".$row["adress_number"]); // ver como queda
                               $cinema->setTicketPrice($row["ticket_price"]);   

                               $idCinema=$row[0];
                        }
                        if($row["seats"]!=null){
                            $room = new Room ($row["seats"],$row["room_number"]); // deberia ir en un bucle creando salas y agregandolas a lista de salas del cine
                            array_push($roomlist, $room);
                        }
                        
                }
             $cinema->setRoomList($roomlist);
             array_push($cinemaList, $cinema);
             return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function deleteDAO($cinema){ 
            try
            {
                
                /*HACER QUERY QUE BORRRE EL CINE, JUNTO A LAS SALAS ASOCIADAS AL MISMO Y LAS FUNCIONES*/
                //$query =
                
                /*HACER UNA BAJA LOGICA*/

                //var_dump($cinema);
                //$this->connection = Connection::GetInstance();
                //$this->connection->ExecuteNonQuery($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }



        }
        /*TRAIGO EL ID DEL CINE A TRAVES DEL NOMBRE PARA PODER USARLO EN EL DAO DE SALA*/
        public function getIdCinemaDAO($name){
            try
            {
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".name = '".$name."';";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                

                foreach ($resultSet as $row)
                {           
                     $cinemaId=$row["id"];      
                }
                return $cinemaId;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            
        }




        public function getCinemaDAO($name){ 
            try
            {
                $query = "SELECT * FROM ".$this->tableName." LEFT JOIN room ON ".$this->tableName.".id = room.id_cinema WHERE ".$this->tableName.".name = '".$name."'";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $cinema = null; 
                if($resultSet){
                       
                        $cinema = new Cinema();
                        $cinema->setName($resultSet[0]['name']);
                        $cinema->setAdress($resultSet[0]["adress_name"]." ".$resultSet[0]["adress_number"]);
                        $cinema->setTicketPrice($resultSet[0]["ticket_price"]);
                        $roomlist=array();
                }              
              
                foreach ($resultSet as $key => $value) {
                    
                    
                    $room = new Room ($value["seats"],$value["room_number"]);// bucle para agregar todas las salas
                    array_push($roomlist, $room);
                }
                if(isset($cinema)){
                    $cinema->setRoomList($roomlist);
                }
                return $cinema;
                
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

        public function updateDAO($cinema){
            try
            {
                $query = "UPDATE ".$this->tableName." SET name = :name, adress_name = :adress_name, adress_number = :adress_number, ticket_price = :ticket_price WHERE ".$this->tableName.".name = '".$cinema->getName()."';";
                

                $parameters["name"] = $cinema->getName();
                /*PROVISORIO SEPARA LA DIRECCION POR UN ESPACIO*/
                $adress=array();
                $adress=explode(" ", $cinema->getAdress());

                /*LA DIRECCION ESTA SEPARADA SOLO POR UN ESPACIO Y DEBERIA SER CUANDO ENCUENTRE 1 NUMERO*/
                $parameters["adress_name"] = $adress[0]; // Separar la direccion
                $parameters["adress_number"] = $adress[1];
               
                $parameters["ticket_price"] = $cinema->getTicketPrice();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }


        }

        public function getAllFromFilm($filmTitle){

             try
            {
                $query = "SELECT * FROM ".$this->tableName." JOIN room ON ".$this->tableName.".id = room.id_cinema JOIN function ON room.id = function.id_room JOIN film ON function.id_film = film.id WHERE film.film_title = '".$filmTitle."'ORDER BY cinema.id, room.id, function.date;";
                
               
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $cinemaList = array();
                $idCinema=null;
                $idRoom=null;
                $room=null;
                $roomlist=array();
                $functionList=array();
                foreach ($resultSet as $row)
                {                
                        
                        if($idCinema!=$row[0]){ // comparo con el id de los cines para crear cines solo cuando sean distintos

                              if(isset($cinema)){
                                     $room->setFunctionList($functionList);
                                     array_push($roomlist,$room);
                                     $functionList=array();
                                     $cinema->setRoomList($roomlist);
                                     array_push($cinemaList, $cinema);
                                     $roomlist=array();
                                     $room =null;
                               }

                               $cinema = new Cinema();
                               $cinema->setName($row["name"]);
                               /*$cinema->setAdress($row["adress_name"]." ".$row["adress_number"]); // ver como queda*/
                               $cinema->setTicketPrice($row["ticket_price"]);   

                               $idCinema=$row[0];
                        }
                        if($idRoom != $row[5]){

                            if (isset($room)){
                                $room->setFunctionList($functionList);
                                array_push($roomlist,$room);
                                $functionList=array();
                            }
                            $room = new Room ($row["seats"],$row["room_number"]); // deberia ir en un bucle creando salas y agregandolas a lista de salas del cine
                            $idRoom=$row[5];
                        }
                        $function = new Functions();
                        $function->setDate($row["date"]);
                        $functionList[$row[9]]=$function;
                        //array_push($functionList, $function);
                        
                }
             if(isset($room)){
                 $room->setFunctionList($functionList);
                 array_push($roomlist,$room);   
             }
             if(isset($cinema)){
                $cinema->setRoomList($roomlist);
                array_push($cinemaList, $cinema);
             }
             return $cinemaList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>