<?php namespace Controllers;

use DAO\FilmDAO as FilmDAO;
//use JsonDAO\FilmJsonDAO as FilmDAO; // importante para que funcione con ambos
use Models\Film as Film; 
use Models\Category as Category;
	
class FilmController{

	private $filmDao;
	private $film;
	private $filmList;

	public function __construct(){
		$this->filmDao=new FilmDAO();
		$this->film=new Film();
		$this->filmList=array();	
	}

	/* Funcion que trae del dao, devuelve una lista y la guarda en la lista de controller*/
	public function getAll(){
		$this->filmList=$this->filmDao->getAllDAO();
		return $this->filmList;
	}

	/*LA NECESITO EN FUNCTION CONTROLLER*/
	public function getIdFilm($filmTitle){
		$idFilm=$this->filmDao->getIdFilmDAO($filmTitle);
		return $idFilm;
	}

	public function getFilm($filmTitle){
		$this->film=$this->filmDao->getFilmDAO($filmTitle);
		return $this->film;
	}

	// ya no agrega al dao, sino que devuelve todas las nuevas que no existan en nuestro dao,lo usamos en api controller, que es llamado por filmcreateview para mostrar la lista de peliculas

	public function createListApi($filmList){
		$filmListAux=array();
        foreach ($filmList["results"] as $value) {
        		
        		$categoryList=array(); 
 				$this->film=new Film(); // para reiniciarlo
				$this->film->setFilmTitle($value["title"]);
				if($this->filmDao->getFilmDAO(str_replace("'", "?", $this->film->getFilmTitle()))== null){ 
						$filmListAux[$value["id"]]=$this->film;				
				}
        	}
 
		return $filmListAux;	
			
	}

	public function createFilm($filmTitle, $length, $language, $categoryList,$image){ // agrega una pelicula al dao, ver la lista de categorias, si va dato por dato 
		
		/*ESTO ERA AL PASAR POR GET*/
		//$categoryListAux=base64_decode($categoryList);
		//$categoryListAux2=unserialize($categoryListAux);
	
		//$filmTitle=str_replace("_", " ", $filmTitle); // POR GET
		$filmTitle=str_replace("'", "?", $filmTitle); // PORQUE LA COMILLA EN ALGUNOS TITULOS DE PELICULAS TRAIA PROBELMAS EN LA CONSULTA SQL


		/*PORQUE VIENEN CON UN ESPACIO*/
		if($this->filmDao->getFilmDAO($filmTitle)== null){

			$categoryListAux=explode(" ", $categoryList);

			/*USO UNSET EN LA PRIMER POSICION POR EL ESPACIO QUE VENIA, TAMBIEN SE PODRIA USAR array_shift*/
			unset($categoryListAux[0]);
	
			//$image=str_replace("-", "/", $image);	// POR GET
			$length=str_replace(" min.", "", $length); // PARA ELIMINAR EL MIN.
	
			$newFilm= new Film($filmTitle,$length,$image,$language);

			$this->filmDao->addDAO($newFilm);

			//llamar dao de film y que me devuelva el id a traves del titulo de la pelicula
			$idFilm=$this->getIdFilm($filmTitle);
			//llamar dao de category y que me devuelva los id de la lista de categorias

			$categoryController = new CategoryController();

			foreach ($categoryListAux as $value) {
				$idCategory=$categoryController->getIdCategory($value);
				$this->filmDao->addFilmXCategory($idFilm,$idCategory);
			}
        }
        require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/HomeView.php";
        require_once ROOT_VIEWS."/footerHome.php";	
		
	}

	/*DEBERIAMOS ELIMINAR A PARTIR DEL TITULO SOLAMENTE*/
	public function deleteFilm($filmTitle, $length, $language){

		$this->filmDao->deleteDAO($filmTitle);
				
		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/HomeView.php";
        require_once ROOT_VIEWS."/footerHome.php";		
	}


}
?>