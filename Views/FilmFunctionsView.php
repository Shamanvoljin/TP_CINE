
<section class="signin-form">
	<div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

		<div class="form35">  
            <div id="main-container">
                <div class="center">
                             <br>
                                <table>
                                    <tr>
                                        <th><h2><?php echo $title; ?></h2> </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><img src="<?php echo $film->getImage(); ?>" alt="<?php echo $film->getFilmTitle(); ?>" title="<?php echo $film->getFilmTitle(); ?>" ></td>
                                    </tr>
                                    <tr>
                                        <td><b>Duración: </b><?php echo $film->getLength()." min.";?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Lenguaje: </b> <?php echo $film->getLanguage(); ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Categorías:</b><?php foreach ($film->getCategoryList() as $value){
                                                       echo " ".$value->getDescription();}?></b></td>
                                    </tr>
                                        
                                      
                                </table>
                               
                </div>
                &nbsp
                <br>
                &nbsp
                <?php if(!empty($cinemaList)){ ?> 
                <h4 class="form-head2">Listado de Funciones</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Cine</th>
                            <th>Sala </th>
                            <th>Fecha - Hora</th>
                            <th colspan = "2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($cinemaList as $key => $value) { 

                    $cinema = $value->getName();

                        foreach ($value->getRoomList() as $value2) {
                            $room= $value2->getRoomNumber();
                            $seats= $value2->getSeats();
                            foreach ($value2->getFunctionList() as $key => $value3) {

                                 $fullDate = explode(" ", $value3->getDate());
                                 $date= $fullDate[0];
                                 $time= $fullDate[1];
                                 $day = date('l', strtotime($date)); 
                                 $dayNumber= date('j',strtotime($date));
                                 $month = date('F', strtotime($date));
                                 $year = date('Y', strtotime($date));

                                 //if($today["year"]."-".$today["mon"]."-".$today["mday"]<= $date){
                    ?>
                    <tr>
                        <td><?php echo $cinema;?></td>
                        <td><?php echo $room;?></td>
                        <td><?php echo $day.", ".$month." ".$dayNumber.", ".$year." ".$time;?></td>
                        <td>
                            <div class="form2">
                            <button type="submit">  
                                <a href="<?php echo FRONT_ROOT ?>/purchase/selectFunction/<?php echo str_replace(" ", "_", $cinema)."/".$value->getTicketPrice()."/".$room."/".$seats."/".str_replace(" ", "_", $title)."/".$date."/".$time."/".$key?>"> <b>Comprar</b>
                                </a>   
                            </button> 
                            </div>                             
                        </td>


                    </tr>

                <?php        
                            }
                        }
                    }
                 ?>
             </tbody>

                </table>
            <?php }else{ ?>
                <div><b>No hay funciones disponibles para esta película</b></div>
            <?php  } ?>
            </div>
            &nbsp<br>&nbsp<br>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 11; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

 	</div>
</section>