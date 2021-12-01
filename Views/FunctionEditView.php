<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Editar Funcion</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Function/edit" method="POST">
                        <?php 

                        $currentDate=getdate();   

                        ?>
                        <div class="">
                            <p class="text-head">Cine:</p>
                            <input type="select" name="cinema" class="input" placeholder="" required="" value="<?php echo $cinema->getName(); ?>"readonly/>
                        </div>
                        <br>
                         <div class="">
                            <label for="room" >Sala Numero: </label>
                            <select name="Room">
                                <option value="<?php echo $room; ?>" selected> <?php echo $room ?> </option> 
                                <?php foreach ($cinema->getRoomList() as $value) {
                                    if($value->getRoomNumber()!=$room){   ?>
                                <option value=<?php echo $value->getRoomNumber(); ?>><?php echo $value->getRoomNumber(); ?></option> 
                                <?php } }?>
                            </select>
                        </div>
                        <br>

                        <div class="">     <?php /* Todas las peliculas disponibles */ ?>                        
                            Peliculas: 
                            <select name="film" >
                                <option value="<?php echo $film; ?>" selected> <?php echo $film ?> </option> 
                                <?php foreach ($filmList as $value){
                                    if($value->getFilmTitle()!=$film){?>
                                
                                <option value=<?php echo str_replace(" ", "_", $value->getFilmTitle()); ?>><?php echo $value->getFilmTitle(); ?></option>    
                                <?php } } ?>
                            </select>

                        </div>
						&nbsp
                        <div class="">
                            <?php $dateArray=explode(" ", $date); ?>
                            Fecha - Hora:<br>&nbsp<br> 
                            <input type="date" name="date" min="<?php echo $currentDate["year"]."-".$currentDate["mon"]."-".$currentDate["mday"]; ?>" max="" step="1" value="<?php echo $dateArray[0];?>">
                            <input type="time" name="time" step="600" value ="<?php echo $dateArray[1]; ?>">
                        </div>

                            <input type="hidden" name="idFunction" value="<?php echo $idFunction ?>">
                        <button type="submit" class="signinbutton btn">Editar</button>
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