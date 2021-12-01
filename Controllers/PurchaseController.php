<?php namespace Controllers;

use DAO\PurchaseDAO as PurchaseDAO;
use Models\Purchase as Purchase; 
use Models\Ticket as Ticket;

class PurchaseController{

	/*BORRAR LAS INNECESARIAS*/
	private $purchaseDao;
	private $purchase;
	private $purchaseList;
	private $filmController;
	private $cinemaController;
	private $creditCardPaymentController;
	private $ticketController;
	private $userController;
	private $functionController;

	/*BORRAR LAS INNECESARIAS*/
	public function __construct(){
		$this->purchaseDao = new PurchaseDao();
		$this->purchase = new Purchase();
		$this->purchaseList = array();
		$this->filmController = new FilmController();
		$this->creditCardPaymentController = new CreditCardPaymentController();
		$this->ticketController = new TicketController();
		$this->cinemaController = new CinemaController();
		$this->userController = new UserController();
		$this->functionController = new FunctionController();
	}


	public function selectFilm(){

		// Tomo la URL que llega por GET:
		$url = $_SERVER['REQUEST_URI'];
		// La divido en un Array: 	
		$url = explode("/", $url); 
		// Cuento la cantidad de celdas en el Array:
		$count = count($url); 
		// Me quedo con la ultima Celda:
		$url = $url [$count-1];
		// Cambio los valores "%20" por espacios:
		$title = str_replace("%20", " ", $url);

		$film = $this->filmController->getFilm($title);
		
		$cinemaList=array();
		$cinemaList=$this->cinemaController->getAllFromFilm($title);

		$today = getdate();

		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/FilmFunctionsView.php";
        require_once ROOT_VIEWS."/footerHome.php";

		/* Se ven datos de la pelicula + Funciones disponibles */

		}

	public function selectFunction($cinemaName,$cinemaTicketPrice, $roomNumber,$roomSeats, $filmTitle, $functionDate, $functionTime,$idFunction){


		

		$cinemaName=str_replace("_", " ", $cinemaName);
		$filmTitle=str_replace("_", " ", $filmTitle);

		/*Consultar cantidad de tickets de esa funcion a la bdd*/
		/*cantidad de tickets disponibles, seria capacidad - cantidad de tickets de esa funcion*/

		$totalTickets=$this->ticketController->getTicketAmount($idFunction);
		$availableTickets=$roomSeats-$totalTickets;

		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/TicketCreateView.php";
        require_once ROOT_VIEWS."/footerHome.php";

		/* Se selecciona cantidad de ticket */
	}

	public function selectCantTicket($cinemaName,$roomNumber,$cinemaTicketPrice, $filmTitle, $functionDate, $functionTime,$ticketAmount,$idFunction){

		/*$ticketList=array();

		for ($i=0; $i < $ticketAmount; $i++) { 
			 $ticket=new Ticket();
			 $ticket->setQr("Random Qr");
			 array_push($ticketList, $ticket);
			 
		}

		var_dump($ticketList);*/
		$totalPrice=$cinemaTicketPrice*$ticketAmount;
		if((date('l', strtotime($functionDate))== 'Wednesday' or date('l', strtotime($functionDate)) == 'Tuesday') && $ticketAmount>=2){
			$totalPrice=$totalPrice*0.75;
		}

		


		/*PASAR EL ID FUNCTION HIDDEN EN EL SIGUIENTE FORM*/
		/*PASAR LA FECHA Y HORA EN EL SIGUIENTE FORM TAMBIEN, nose si hidden porque se podria mostrar o no*/
		/*PASAR TOTAL PRICE EN EL SIGUIENTE FORM, MOSTRARLO AL CLIENTE*/

		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/PurchaseCreateView.php";
        require_once ROOT_VIEWS."/footerHome.php";
		/* Se selecciona metodo de pago */
	}

	public function selectPaymentMethod($filmTitle,$functionDate,$functionTime,$ticketAmount,$totalPrice, $companyName,$cardNumber,$expireDate,$cvv ,$cardOwner,$idFunction){ // VER EL ORDEN DE LOS PARAMETROS
		/* Se efectua la compra */

		
		/*cardNumber,$expireDate,$cc y $cardOwner son los datos que usariamos para verificar la tarjeta*/
		/*ACA SE DEBERIA VERIFICAR SI EL PAGO DE LA TARJETA ES CORRECTO Y LUEGO SE PROCEDE A CREAR*/
		/*Y por el else vuelvo a la misma vista seteando el msj de error*/

		
		$date=getdate();
		$fullDate= $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"];


		$autorizationCode = $this->generateNumber();

		$paymentNumber=$this->creditCardPaymentController->createCreditCardPayment($autorizationCode,$fullDate,$totalPrice,$companyName);

		$idCreditCardPayment = $this->creditCardPaymentController->getIdCreditCardPayment($paymentNumber);
		
		/*Traigo el id del usuario en session*/
		$idUser=$this->userController->getIdUser($_SESSION['user']->getEmail());

		$this->purchase=new Purchase();
		
		/*Traigo el ultimo numero de compra para asignarle el siguiente*/
		$purchaseNumber = $this->purchaseDao->getLastPurchaseNumber()+1;


		$this->purchase->setPurchaseNumber($purchaseNumber);
		

		$this->purchase->setNumberOfTickets($ticketAmount);
		

		/*Necesito enviar fecha y hora*/


		$this->purchase->setDate($fullDate);

		/*Descuento dias martes y miercoles comprando 2 o mas entradas*/
		if((date('l', strtotime($functionDate))== 'Wednesday' or date('l', strtotime($functionDate)) == 'Tuesday') && $ticketAmount>=2){
			$this->purchase->setDiscount(true);
		}
		else{
			$this->purchase->setDiscount(false);
		}


		/*Ya llega con el descuento porque lo muestro en la vista anterior*/
		$this->purchase->setTotal($totalPrice);




		/*Agrego compra al dao, necesito la id de usuario y la id del credit card payment*/
		$this->purchaseDao->addDAO($idUser,$idCreditCardPayment,$this->purchase);

		/*Traigo el id a partir del numero de compra que deberia ser unico*/
		$idPurchase=$this->purchaseDao->getIdPurchaseDAO($purchaseNumber);

		/*Idfunction llega por hidden */
		
		/*Recorro la lista de tickets, y voy seteando el numero de ticket, trayendo la cantidad de tickets de esa function, despues agrego al dao el ticket en la compra correspondiente*/
		$ticketList=array();
		for ($i=0; $i < $ticketAmount ; $i++) { 
			$ticket=new Ticket();
			$full= $this->ticketController->getTicketAmount($idFunction);
			$ticket->setTicketNumber($full+1);
			$ticket->setQr(QR_URL.$ticket->getTicketNumber()."-".$idFunction);
			$this->ticketController->createTicket($idPurchase,$idFunction,$ticket);
			array_push($ticketList, $ticket);
		}

		/*$function = $this->functionController->getFunction($idFunction);
		var_dump($function);*/


		$this->sendMail($filmTitle,$functionDate,$functionTime,$ticketList);

		require_once ROOT_VIEWS."/headerHome.php";
        require_once ROOT_VIEWS."/navHome.php";
        require_once ROOT_VIEWS."/HomeView.php";
        require_once ROOT_VIEWS."/footerHome.php";
		
	
	}

	public function sendMail($filmTitle,$functionDate,$functionTime,$ticketList){

		$mail = new PHPMailer();  
        $mail->setFrom(EMAIL, 'Movie Pass');     
                   
        $mail->addAddress($_SESSION['user']->getEmail(), $_SESSION['user']->getFirstName());     
                   
        $mail->Subject = 'Envio de Entradas';        
               
        $mail->isHTML(true);

        foreach ($ticketList as $value) {
        	$mail->Body.="<b> Entrada </b> <br>";
        	$mail->Body.="<b>Fecha</b> : ".$functionDate."<br>";
        	$mail->Body.="<b>Hora</b> : ".$functionTime."<br>";
       		$mail->Body.="<b>Pelicula</b> : ".$filmTitle."<br>";
       		$mail->Body.="<b>Numero de Ticket</b> : ".$value->getTicketNumber()."<br>";
       		$mail->Body.="<b>Codigo Qr</b> :<br> <img src=".$value->getQr()." alt =".$value->getQr()."> <br>";
       		$mail->Body.="<br><br><br>";
        }
        

           
        $mail->Username = EMAIL;        
               
        $mail->Password = PASS;        
               

        $mail->SMTPDebug = 0;
        

        $mail->isSMTP();        
               
        $mail->Host = 'smtp.gmail.com';     
        
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;     
               
              
        /* Finally send the mail. */    
        $mail->send();
      
	}

	public function generateNumber(){
   		$key = '';
 		$pattern = '1234567890';
 		$max = strlen($pattern)-1;
 		for($i=0; $i<6; $i++) {
              $key .= $pattern{mt_rand(0,$max)};
        } 				     
 	    return $key;
    }

    public function getAll(){
    	$this->purchaseList = $this->purchaseDao->getAllDAO();
		return $this->purchaseList;
    }

    public function getAllUser($id){
    	$this->purchaseList = $this->purchaseDao->getAllUserDAO($id);
		return $this->purchaseList;    
	}

}

?>
