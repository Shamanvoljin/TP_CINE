
	<section class="signin-form">
		<div class="overlay">
			<div class="form35">  
                <div id="main-container">
                	<h4 class="form-head2">Detalle de Pelicula para agregar</h4>

                	<?php 

                	/* BUSCAR ESOS DATOS PREVIAMENTE EN LA CONTRALADORA */

                	$filmTitle = $film->getFilmTitle();
                	$length = $film->getLength();
                	$language = $film->getLanguage();
                	/* Se puede transformar o mandar como array: */
                	$categoryList = $film->getCategoryList(); 
                	$image = $film->getImage();  

                    switch ($language) {

                                case 'cn':
                                    $language = "Chino";
                                break;

                                case 'en':
                                    $language = "Ingles";
                                break;

                                case 'es':
                                    $language = "Espanol";
                                break;

                                case 'ja':
                                    $language = "Japones";
                                break;

                                case 'ru':
                                    $language = "Ruso";
                                break;
                        
                                case 'ko':
                                   $language = "Coreano";
                                break;

                            }     

                	for($i=0; $i < 2; $i++) { 
					echo("&nbsp<br>");				
					} 

                	?>
       					
					<form action="<?php echo FRONT_ROOT ?>/Film/createFilm" method="POST">						

                        <div class="">
                            <p class="text-head">Titulo:</p>
                            <input type="text" name="filmTitle" class="input" placeholder="" required="" value="<?php echo $filmTitle ?>"readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Duracion:</p>
                            <input type="text" name="length" class="input" placeholder="" required="" value="<?php echo $length." min."?>"readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Lenguaje:</p>
                            <input type="text" name="language" class="input" placeholder="" required="" value="<?php echo $language ?>"readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Categorias:</p>
                            <input type="text" name="categoryList" class="input" placeholder="" required="" value="<?php foreach  ($categoryList as $value){echo " ".$value->getDescription();} ?>"readonly/>
                        </div>

                        <input type="hidden" name="image" value="<?php echo "$image"?>">
                                                 
                        <?php echo("&nbsp<br>"); ?>

                         <img src="<?php echo $image ?>" alt="<?php echo $filmTitle ?>" title="<?php echo $filmTitle ?>">

                        <button type="submit" class="signinbutton btn">Agregar</button>

                    </form>
				</div>
			</div>

	  <?php for($i=0; $i < 30; $i++) { 
				echo("&nbsp<br>");				
			} ?>	

 		</div>
	</section>



