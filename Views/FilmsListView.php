
<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Peliculas Actuales</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Duracion</th>
                            <th>Lenguaje</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>

                    <?php 
                    
                    /*DEBERIA IR EN ADMIN FILMS DE NAV CONTROLLER*/
                   /* $filmController = new FilmController();
                    $filmList = array();
                    $filmList = $filmController->getAll();*/

                    foreach ($filmList as $key => $value) { 

                    $filmTitle = $value->getFilmTitle();
                    $length = $value->getLength();
                    $language = $value->getLanguage();

                    /* Cambiar a la base de datos */ 

                    if ($length == null){
                        $length = "Unknown";
                    }
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
                    }
                    
                    ?>

                    <tr>
                        <td><?php echo $filmTitle;?></td>
                        <td><?php echo $length." min.";?></td>
                        <td><?php echo $language;?></td>

                        <td>
                            <div class="form2">
                            <button type="submit"> 
                                <?php $filmTitle=str_replace(" ", "_", $filmTitle);
                                ?> 
                                <a href="<?php echo FRONT_ROOT ?>/admin/deleteFilm/<?php echo $filmTitle."/".$length."/".$language?>">
                                    <img src="../Views/img/delete.png" /></a>   
                            </button> 
                            </div>  
                        </td>

                    </tr>

                <?php } ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            <a class="form2" href="<?php echo FRONT_ROOT ?>/admin/createListFilm">Agregar una nueva Pelicula</a>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>