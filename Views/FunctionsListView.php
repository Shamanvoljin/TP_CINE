
<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Funciones</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Cine</th>
                            <th>Sala </th>
                            <th>Pelicula </th>
                            <th>Fecha - Hora</th>
                            <th>Vendidas</th>
                            <th>Restantes</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>

                    <?php 
                    foreach ($cinemaList as $key => $value) { 

                    $cinema = $value->getName();
                        foreach ($value->getRoomList() as $value2) {
                            $room= $value2->getRoomNumber();
                            foreach ($value2->getFunctionList() as $key => $value3) {
                                 $date = $value3->getDate(); 
                                 $film = $value3->getFilm()->getFilmTitle();
                                 $ticketAmount= $ticketController->getTicketAmount($key);
                                 $remaining=$value2->getSeats()-$ticketAmount;
                    ?>

                    <tr>
                        <td><?php echo $cinema;?></td>
                        <td><?php echo $room;?></td>
                        <td><?php echo $film;?></td>
                        <td><?php echo $date;?></td>
                        <td><?php echo $ticketAmount; ?></td>
                        <td><?php echo $remaining; ?></td>
                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/editFunction/<?php echo str_replace(" ", "_", $cinema)."/".$room."/".str_replace(" ", "_", $film)."/".str_replace(" ", "_", $date) ?>">
                                    <img src="../Views/img/edit.png" /></a>   
                            </button> 
                            </div>                             
                        </td>

                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/deleteFunction/<?php echo str_replace(" ", "_", $cinema)."/".$room."/".str_replace(" ", "_", $film)."/".str_replace(" ", "_", $date) ?>">
                                    <img src="../Views/img/delete.png" /></a>   
                            </button> 
                            </div>  
                        </td>

                    </tr>

                <?php       }
                        }
                    }
                 ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            <a class="form2" href="<?php echo FRONT_ROOT ?>/admin/listCinemaForFunction">Agregar una nueva Funcion</a>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 11; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>
