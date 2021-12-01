
<section class="signin-form">
	<div class="overlay">

  <?php 

    $search = "0";

    if (isset($_POST['search'])){
        $search = $_POST['search'];
    }

    $categorysSearch = "0";

    if (isset($_POST['categorysSearch'])){
        $categorysSearch = $_POST['categorysSearch'];
    }

    $dateSearch = "0";

    if (isset($_POST['dateSearch'])){
        $dateSearch = $_POST['dateSearch'];
    } 

    for ($i=0; $i < 5; $i++){
            echo("&nbsp<br>");                           
    } ?> 

            <div class="form35">  
            <form action="" method="POST">
                <h4 class="form-head1">Buscar Lista de peliculas</h4>
                <div class="boxselect">                    
                    <select name="search"> 

                        <option value="0">Seleccionar tipo de Busqueda </option>

                  <?php if ($search == "date"){ ?> 
                            <option value="date" selected> Busqueda por Fecha </option>   
                  <?php }else{  ?>
                            <option value="date"> Busqueda por Fecha </option>
                  <?php } ?>

                  <?php if ($search == "category"){ ?> 
                            <option value="category" selected> Busqueda por Categorias </option>   
                  <?php }else{  ?>
                            <option value="category"> Busqueda por Categorias </option>
                  <?php } ?>

                    </select>

                </div>

        <?php   if($search == "category"){ 
                    echo("<div class = 'center'>");
                    echo("<b>Seleccione Categorias de Busqueda: &nbsp <br> &nbsp <br></b>");
                    foreach ($categoryList as $key => $value) {
                        $category = $value->getDescription();?>
                        <input type="checkbox" name="categorysSearch[]" id="categorysSearch[<?php echo $key?>]" value="<?php echo($category) ?>" />
                        <label for = "categorysSearch[<?php echo $key?>]"> <?php echo($category) ?> </label>   
              <?php }
                    echo("</div>");
               }               
                if($search == "date"){  ?>
                    <div class="center">
                     <label for="start"> <b> Seleccione fecha de funcion para buscar: &nbsp <b></label>

                    <input type="date" id="dateSearch" name="dateSearch" min="2019-01-01" max="2021-12-31">   
                    </div>
                    

          <?php } ?>
             
                <button type="submit" class="filmbutton btn">Buscar Peliculas</button>
            </form>
        </div>

<?php for ($i=0; $i < 5; $i++){
            echo("&nbsp<br>");                           
    } ?>  

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Peliculas Actuales</h4>

         <?php  for ($i=0; $i < 2; $i++) {;?>
                &nbsp<br>           
         <?php  }   

                $filmsShown = 0; /* Cantidad de peliculas mostradas en pantalla */

                foreach ($filmList as $value):
                    
                    $title = $value->getFilmTitle();                

                    if ($search == "0"){
                        $filmsShown++;
                        ?>                        
                        <div class="center">
                            <h2><?php echo $title ?></h2> <br>
                            <a href="<?php echo FRONT_ROOT ?>/purchase/selectFilm/<?php echo $title?>"><img src="<?php echo $value->getImage() ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" ></a>
                        </div>

                        <?php for ($i=0; $i < 3; $i++){
                            echo("&nbsp<br>");                           
                        }?>  

            <?php   }

                    if ($search == "date" ){                        
                        if ($dateSearch != 0){   
                            $flagDate = false;                         
                            foreach ($functionList as $key => $function) {
                                if ($function->getFilm()->getFilmTitle() == $title){
                                    $date = $function->getDate();
                                    list($date) = explode(" ", $date);
                                    if ($date == $dateSearch){
                                        $flagDate = true;
                                    }
                                }                                
                            }
                            if ($flagDate){
                                    $filmsShown++;
                                    ?>                            
                                    <div class="center">
                                        <h2><?php echo $title ?></h2> <br>
                                        <a href="<?php echo FRONT_ROOT ?>/purchase/selectFilm/<?php echo $title?>"><img src="<?php echo $value->getImage() ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" ></a>
                                    </div>
                            <?php   for ($i=0; $i < 3; $i++){
                                        echo("&nbsp<br>");                           
                                    }  
                                }
                        }  
                        else { 
                            $filmsShown++;
                            ?>                            
                            <div class="center">
                                <h2><?php echo $title ?></h2> <br>
                                <a href="<?php echo FRONT_ROOT ?>/purchase/selectFilm/<?php echo $title?>"><img src="<?php echo $value->getImage() ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" ></a>
                            </div>
                    <?php   for ($i=0; $i < 3; $i++){
                            echo("&nbsp<br>");                           
                            }  
                        }
                    }

                    if ($search == "category"){
                        $categorys = $value->getCategoryList();
                        if ($categorysSearch != 0){
                            $flagCategory = true;
                            foreach ($categorysSearch as $key => $categorySearch) {
                                if ($flagCategory){
                                    $flagCategory = false;
                                    foreach ($categorys as $key => $category) {
                                        $category = $category->getDescription();
                                        if ($category == $categorySearch){
                                            $flagCategory = true;
                                        }
                                    }                                    
                                }
                            }
                            if ($flagCategory){ 
                                $filmsShown++;
                                ?>
                                <div class="center">
                                    <h2><?php echo $title ?></h2> <br>
                                    <a href="<?php echo FRONT_ROOT ?>/purchase/selectFilm/<?php echo $title?>"><img src="<?php echo $value->getImage() ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" ></a>
                                </div>
                    <?php       for ($i=0; $i < 3; $i++){
                                    echo("&nbsp<br>");                           
                                }  
                            }                             
                        }
                        else{ 
                            $filmsShown++;
                            ?>
                                <div class="center">
                                    <h2><?php echo $title ?></h2> <br>
                                    <a href="<?php echo FRONT_ROOT ?>/purchase/selectFilm/<?php echo $title?>"><img src="<?php echo $value->getImage() ?>" alt="<?php echo $title ?>" title="<?php echo $title ?>" ></a>
                                </div>
                    <?php   for ($i=0; $i < 3; $i++){
                            echo("&nbsp<br>");                           
                            }  

                        }
                    } 
                       
                    ?>              
                          
          <?php endforeach ?>

          <?php 
          if ($filmsShown == 0){ ?>
              <div class="center"> 
                  <label><b>No se encontraron Peliculas en la Busqueda.</b></label>
              </div>
    <?php }
          for ($i=0; $i < 3; $i++){
              echo("&nbsp<br>");                           
          } ?>  

         </div>

 	</div>

    <?php  for ($i=0; $i < 1; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>



</section>



