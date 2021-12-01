
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Crear una Nueva Sala</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Room/createRoom" method="POST">
                        <div class="">
                            <p class="text-head">Numero de Sala: </p>
                            <input type="number" name="roomNumber" class="input" placeholder="" required="" min="0"/>
                        </div>
                        <div class="">
                            <p class="text-head">Capacidad: </p>
                            <input type="number" name="seats" class="input" placeholder="" required="" min="0"/>
                        </div>
                        <div>
                            <input type="hidden" name="IdCinema" value="<?php echo $idCinema ?>"/>
                        </div>

                        <button type="submit" name= "next" value = "0" class="signinbutton btn">Siguiente Sala</button>

                        <button type="submit" name= "end" value = "1" class="signinbutton btn">Finalizar</button> 

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