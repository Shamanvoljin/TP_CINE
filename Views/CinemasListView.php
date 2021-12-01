
<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Cines Actuales</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Precio de entrada</th>
                            <th>Cantidad de Salas</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>

                    <?php 
                    foreach ($cinemaList as $key => $value) { 
                    $cantRooms=0;    
                    $name = $value->getName();
                    $adress = $value->getAdress();
                    $cost = $value->getTicketPrice();
                    $cantRooms = count($value->getRoomList());
                    


                    ?>

                    <tr>
                        <td><?php echo $name;?></td>
                        <td><?php echo $adress;?></td>
                        <td><?php echo "$".$cost;?></td>
                        <td><?php echo $cantRooms;?></td>
                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/editCinema/<?php echo $name."/".str_replace(" ", "_", $adress)."/".$cost."/".$cantRooms ?>">
                                    <img src="../Views/img/edit.png" /></a>   
                            </button> 
                            </div>                             
                        </td>

                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/deleteCinema/<?php echo $name."/".str_replace(" ", "_", $adress)."/".$cost."/".$cantRooms ?>">
                                    <img src="../Views/img/delete.png" /></a>   
                            </button> 
                            </div>  
                        </td>

                    </tr>

                <?php } ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            <a class="form2" href="<?php echo FRONT_ROOT ?>/admin/createCinema">Agregar un nuevo Cine</a>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 10; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>
