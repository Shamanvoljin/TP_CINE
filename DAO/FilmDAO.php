<?php namespace DAO;

use \Exception as Exception;
use DAO\IDAO as IDAO; /* Usar una carpeta interfaz */
use Models\Film as Film;
use Models\Category as Category;    
use DAO\Connection as Connection;

class FilmDAO implements IDAO{

	private $connection;
    private $tableName = "film";

    public function addDAO($film){
    	try
            {
                $query = "INSERT INTO ".$this->tableName." (film_title, length, image, language) VALUES (:film_title, :length, :image, :language);"; 
                
                $parameters["film_title"] = $film->getFilmTitle();
                $parameters["length"] = $film->getLength();
                $parameters["image"] = $film->getImage();
                $parameters["language"] = $film->getLanguage();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function addFilmXCategory($idFilm,$idCategory){

        try
            {
                $query = "INSERT INTO film_x_category (id_film, id_category) VALUES (:id_film, :id_category);";

                $parameters["id_film"] = $idFilm;
                $parameters["id_category"] = $idCategory;

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
                /*CON LAS CATEGORIAS DE CADA PELICULA*/
                $query = "SELECT * FROM ".$this->tableName." JOIN film_x_category ON ".$this->tableName.".id = film_x_category.id_film JOIN category ON film_x_category.id_category = category.id ORDER BY ".$this->tableName.".film_title;"; 

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                $filmList = array();
                $categoryList=array();
                $category=null;
                $idFilm = null;
                foreach ($resultSet as $row)
                {                
                   if($idFilm!=$row["id_film"]){
                        
                        if(isset($film)){
                                $film->setCategoryList($categoryList);     
                                array_push($filmList, $film);
                                $categoryList=array();
                        }
                        
                   		$film = new Film();
                        /*PORQUE GUARDO LOS TITULOS CON COMILLA CON ? EN LA BDD, ENTONCES AL LEERLO HAY QUE REEMPLAZARLO*/
                        $row["film_title"] =str_replace("?", "'", $row["film_title"]);
                   		$film->setFilmTitle($row["film_title"]);
                   		$film->setLength($row["length"]); 
                   		$film->setImage($row["image"]);
                    	$film->setLanguage($row["language"]);

                        $idFilm=$row["id_film"];
                    	

                   }
                  $category = new Category($row["description"]);
                  array_push($categoryList, $category);
                 
                }
                $film->setCategoryList($categoryList);     
                array_push($filmList, $film);
                return $filmList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

     public function deleteDAO($filmTitle){ 
        try
            {

               $filmTitle =str_replace("'", "?", $filmTitle);

               $idTitle = $this->getIdFilmDAO($filmTitle);

               if ($idTitle != 0){

                    $query = "DELETE f, fxc FROM ".$this->tableName." AS f JOIN film_x_category AS fxc WHERE f.id  = '".$idTitle."' AND fxc.id_film = '".$idTitle."'";

                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->ExecuteNonQuery($query);
               }                          

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
     }

     public function getFilmDAO($filmTitle){ 
            
            try
            {
                $filmTitle =str_replace("'", "?", $filmTitle);
                /*Deberia traer 1 pelicula con todas sus categorias*/
                $query = "SELECT * FROM ".$this->tableName." JOIN film_x_category ON ".$this->tableName.".id = film_x_category.id_film JOIN category ON film_x_category.id_category = category.id WHERE film.film_title = '".$filmTitle."';";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);                
                $film=null;
                if($resultSet){
                    $film = new Film();
                    $resultSet[0]["film_title"] =str_replace("?", "'", $resultSet[0]["film_title"]);
                    $film->setFilmTitle($resultSet[0]['film_title']);
                    $film->setLength($resultSet[0]["length"]); 
                    $film->setImage($resultSet[0]["image"]);
                    $film->setLanguage($resultSet[0]["language"]);
                    $categoryList=array();
                    foreach ($resultSet as $value) {
                   
                        $category = new Category ($value["description"]);
                        array_push($categoryList, $category);
                        $film->setCategoryList($categoryList);
                    } 
                }
                
                return $film;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
            
        }

   /*FUNCION QUE A TRAVES DEL TITULO ME DEVUELVA LA ID DE LA PELICULA, LO NECESITAMOS PORQUE AL CREAR LA FUNCION EN LA VISTA ENVIAMOS EL TITULO DE LA PELICULA, Y HAY QUE BUSCAR EL ID PARA PODER CARGAR BIEN LA FUNCION EN EL DAO*/
    public function getIdFilmDAO($filmTitle){
        try
            {
                $filmTitle =str_replace("'", "?", $filmTitle);
                $query = "SELECT ".$this->tableName.".id FROM ".$this->tableName." WHERE ".$this->tableName.".film_title = '".$filmTitle."'";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $filmId=0;         

                foreach ($resultSet as $row)
                {           
                     $filmId=$row["id"];      
                }
                return $filmId;                 
                    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

           
    }

}

?>