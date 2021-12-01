
<?php   

		if (!isset($_SESSION['user'])){

			require_once ROOT_VIEWS."/headerLogin.php";
            require_once ROOT_VIEWS."/SignView.php";
            require_once ROOT_VIEWS."/footerLogin.php";
		}

		else {
			$id_role = $_SESSION['user']->getRole()->getIdRole();			
		}	

 		if ($id_role == 1){?>

			<div id="header">
				<ul class="nav">
					<li><a href="<?php echo FRONT_ROOT ?>/nav/home">Home</a></li>

					<li>
						<a>Cliente</a>
						<ul> 
						<a href="<?php echo FRONT_ROOT ?>/nav/films">Peliculas Actuales</a>		
						<a href="<?php echo FRONT_ROOT ?>/nav/clientSeeListTickets">Historial de Compras</a>	
						</ul>	
					</li>
					
					<li>
						<a>Administrar</a>
						<ul> 
						<a href="<?php echo FRONT_ROOT ?>/nav/adminCinemas">Administrar Cines</a> 
						<a href="<?php echo FRONT_ROOT ?>/nav/adminFilms">Administrar Peliculas</a>
						<a href="<?php echo FRONT_ROOT ?>/nav/adminFunctions">Administrar Funciones</a>
						<a href="<?php echo FRONT_ROOT ?>/nav/adminSeeListTickets">Administrar Compras</a>					
						</ul>

					</li>
					<li>
						<a href="<?php echo FRONT_ROOT ?>/nav/logout">Desloguearse</a>
					</li>				
				</ul>
				<ul class="nav2"> 
					<li></li>
				</ul>
			</div>

<?php   }
	    if ($id_role == 2){?>

			<div id="header">
				<ul class="nav">
					<li><a href="<?php echo FRONT_ROOT ?>/nav/home">Home</a></li>
					<li>
						<a>Administrar</a>

						<ul> 
						<a href="<?php echo FRONT_ROOT ?>/nav/adminCinemas">Administrar Cines</a> 
						<a href="<?php echo FRONT_ROOT ?>/nav/adminFilms">Administrar Peliculas</a>
						<a href="<?php echo FRONT_ROOT ?>/nav/adminFunctions">Administrar Funciones</a>
						<a href="<?php echo FRONT_ROOT ?>/nav/adminSeeListTickets">Administrar Tickets</a>					
						</ul>

					</li>
					<li>
						<a href="<?php echo FRONT_ROOT ?>/nav/logout">Desloguearse</a>
					</li>				
				</ul>
				<ul class="nav2"> 
					<li></li>
				</ul>
			</div>

<?php   }

	    if ($id_role == 3){?>
	    	
	    <div id="header" >
				<ul class="nav">
					<li><a href="<?php echo FRONT_ROOT ?>/nav/home">Home</a></li>
					<li>
						<a>Cliente</a>
						<ul> 
						<a href="<?php echo FRONT_ROOT ?>/nav/films">Peliculas Actuales</a>		
						<a href="<?php echo FRONT_ROOT ?>/nav/clientSeeListTickets">Historial de Compras</a>	
						</ul>	
					</li>
					<li><a href="<?php echo FRONT_ROOT ?>/nav/logout">Desloguearse</a></li>				
				</ul>
				<ul class="nav2"> 
					<li></li>
				</ul>
			</div>
<?php   } ?>