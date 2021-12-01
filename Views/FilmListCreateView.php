
	<section class="signin-form">
		<div class="overlay">
			<div class="form35">  
                <div id="main-container">
                    <h4 class="form-head2">Listado de Peliculas Para Agregar</h4>
                    &nbsp
                    <br>
                    &nbsp  
                    <table>
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th colspan = "2">Acciones</th>
                            </tr>
                        </thead>

                  <?php foreach ($filmList as $key => $value) {

                            $filmTitle = $value->getFilmTitle();
                            /*$length = $value->getLength();
                            $image = $value->getImage();
                            $language = $value->getLanguage();
                            $categoryList = $value->getCategoryList();
                            $categoryListAux = serialize($categoryList);
                            $categoryListAux= base64_encode($categoryListAux);*/

                            /* Cambiar a la base de datos */ 


                 ?>

                            <tr>
                                <td><?php echo $filmTitle;?></td>

                                <td>
                                    <div class="form2">
                                        <button type="submit">  

                            	      <?php $filmTitle = str_replace(" ", "_", $filmTitle);
                            		        //var_dump($filmTitle);
                                             $filmTitle = str_replace("&","And", $filmTitle);/*$image=str_replace("/", "-", $image);*/?>

                                            <a href="<?php echo FRONT_ROOT ?>/Admin/createFilm/<?php echo $filmTitle."/".$key?>">

                                            <img src="../Views/img/add.png" /></a>   
                                        </button> 
                                    </div>  
                                </td>
                            </tr>
                <?php   } ?>

                    </table>
                </div>

		<?php for ($i=0; $i < 16; $i++) { ?>
    			&nbsp<br>           
    		<?php } ?>

		    </div>
        </div>
	</section>