
<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?> 

        <div class="form35">                   

                    &nbsp<br>           

                <h4 class="form-head2">Seleccionar cines o películas</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/nav/adminSeeListTickets" method="POST">
                         <div class="">
                            <label for="cinema" >Cine: </label>
                            <select name="Cinema">
                                <option value ="allCinemas" selected=""> Todos los cines </option>
                            <?php foreach ($cinemaList as $value) { 
                                    $cinema=$value->getName();?>
                                <option value="<?php echo $cinema; ?>"><?php echo $cinema; ?></option> 
                                <?php }?>
                            </select>
                        </div>
                        <br>

                        <div class="">     <?php /* Todas las peliculas disponibles */ ?>                        
                            Peliculas: 
                            <select name="film" >
                                <option value ="allMovies" selected=""> Todas las peliculas </option>
                                <?php foreach ($filmList as $value){
                                    $film=$value->getFilmTitle();?>
                                <option value="<?php echo $film; ?>"><?php echo $film;?></option>    
                                <?php } ?>
                            </select>

                        </div>
                        &nbsp

                        <button type="submit" class="signinbutton btn">Filtrar</button>
                        <?php 

                        if (isset($msjError)){         
                            echo "&nbsp";
                            echo "<div style='color:red'><b> ".$msjError." <b></div>";
                            echo "&nbsp";
                        }

                        ?>

                    </form>

                 <?php for ($i=0; $i < 2; $i++) { ?>
                    &nbsp<br>           
                <?php } ?>

        </div>  
        <?php if($cinemaFilter !=null){?>
		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Compras por Fecha</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Usuario</th> 
                            <th>Pelicula</th>
                            <th>Cine</th>
                            <th>Sala</th>
                            <th>Entradas</th>
                            <th>Descuento</th>
                            <th>Total</th>

                        </tr>
                    </thead>

                    <?php 
                    $ticketsTotal = 0;
                    foreach ($purchaseList as $key => $value) { 
                  
                    	if(($cinemaFilter == $value->getCinema() or $cinemaFilter=="allCinemas") && ($movieFilter == $value->getFilm() or $movieFilter=="allMovies")){
                            $date = $value->getDate();
                            $cinema = $value->getCinema();
                            $room = $value->getRoom_number();
                            $cantTickets = $value->getCant_Tickets();
                            $discount = $value->getDiscount();
                            if($discount == "1"){
                                $discount = "Si";
                            }
                            else {
                                $discount = "No";
                            }
                            $total = $value->getTotal();
                            $token = $value->getToken();
                            $ticketsTotal = $ticketsTotal + $total;
                            $film = $value->getFilm();
                    ?>

                    <tr>
                        <td><?php echo $date;?></td>
                        <td><?php echo $token;?></td>
                        <td><?php echo $film;?></td>
                        <td><?php echo $cinema;?></td>
                        <td><?php echo $room;?></td>
                        <td><?php echo $cantTickets;?></td>
                        <td><?php echo $discount;?></td>
                        <td><?php echo "$".$total;?></td>
                    </tr>

                <?php } }
                    if ($ticketsTotal != 0){?>
                    <tr>
                        <td colspan="8"></td>
                    </tr>  
                    <tfoot>
                        <td colspan = "7"><b>Cantidad Total:</b></td>
                        <td><b><?php echo "$".$ticketsTotal;?></b></td>                    
                    </tfoot>
                <?php } ?>
                </table>

            </div>
            &nbsp<br>&nbsp<br>
            &nbsp  
        </div>
        <?php }  ?>
    <?php  for ($i=0; $i < 13; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>
