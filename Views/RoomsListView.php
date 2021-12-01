<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Salas del Cine</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Numero de Sala</th>
                            <th>Capacidad</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>

                    <?php
                    if($this->cinema->getRoomList()[0]->getRoomNumber()){
                        foreach ($this->cinema->getRoomList() as $value) {     
                            $roomNumber = $value->getRoomNumber();
                            $seats = $value->getSeats();                    
                    ?>

                    <tr>
                        <td><?php echo $roomNumber;?></td>
                        <td><?php echo $seats;?></td>
                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/editRoom/<?php echo $roomNumber."/".$seats."/".$idCinema ?>">
                                    <img src="../Views/img/edit.png" /></a>   
                            </button> 
                            </div>                             
                        </td>

                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/deleteRoom/<?php echo $roomNumber."/".$seats."/".$idCinema ?>">
                                    <img src="../Views/img/delete.png" /></a>   
                            </button> 
                            </div>  
                        </td>

                    </tr>

                <?php }
                } ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            <a class="form2" href="<?php echo FRONT_ROOT ?>/admin/createRoom/<?php echo $idCinema ?>">Agregar una nueva Sala</a>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 10; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>