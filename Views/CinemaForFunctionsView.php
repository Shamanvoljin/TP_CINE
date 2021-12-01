<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Elija un cine para agregar su función</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Cantidad de Salas</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>

                    <?php 
                    foreach ($cinemaList as $key => $value) { 
                    $cantRooms=0;    
                    $name = $value->getName();
                    $adress = $value->getAdress();
                    $cantRooms = count($value->getRoomList());
                    


                    ?>

                    <tr>
                        <td><?php echo $name;?></td>
                        <td><?php echo $adress;?></td>
                        <td><?php echo $cantRooms;?></td>
                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/admin/createFunction/<?php echo $name?>">
                                    <img src="../Views/img/add.png" /></a>   
                            </button> 
                            </div>                             
                        </td>
                    </tr>

                <?php } ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 10; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>