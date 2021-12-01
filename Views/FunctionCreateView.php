
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Crear una nueva Funcion</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Function/create" method="POST">

                        <?php 

                        $date=getdate();   

                        ?>
                        <div class="">
                            <label for="room" >Sala Numero: </label>
                            <select name="Room" id = "room">
                                <?php foreach ($cinema->getRoomList() as $value) {?>
                                <option value=<?php echo $value->getRoomNumber(); ?>><?php echo $value->getRoomNumber(); ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                          
                          &nbsp
                        <?php /* 
                        <div class="">
                            Sala: 
                            <select name="select">
                                <?php /* Foreach con todas las salas del cine seleccionado. ?>
                                <option value="sala">Sala numero 1</option> 
                                <option value="sala2">Sala numero 2</option>
                                <option value="sala3">Sala numero 3</option>
                            </select>
                        </div>

                        
                        */?>

                        <div class="">     <?php /* Todas las peliculas disponibles */ ?>                        
                            Peliculas: 
                            <select name="film">
                                <?php foreach ($filmList as $value){?>
                                
                                <option value=<?php echo str_replace(" ", "_", $value->getFilmTitle()); ?>><?php echo $value->getFilmTitle(); ?></option>    
                                <?php }  ?>
                            </select>

                        </div>
                        &nbsp
                        <div class="">
                            Fecha - Hora: <br>&nbsp<br>
 
                            <input type="date" name="date" min="<?php echo $date["year"]."-".$date["mon"]."-".$date["mday"] ?>" max="" step="1" value="<?php echo $date["year"]."-".$date["mon"]."-".$date["mday"] ?>">
                            <input type="time" name="time" step="600">
                        </div>

                        <input type="hidden" name="cinemaName" value="<?php echo $cinema->getName(); ?>">
                        <button type="submit" class="signinbutton btn">Crear</button>
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

				<?php for ($i=0; $i < 10; $i++) { ?>
    				&nbsp<br>           
    			<?php } ?>

		 </div>

	</section>
