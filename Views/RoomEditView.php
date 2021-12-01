<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Editar una Sala</h4>
                    &nbsp
                    <br>
                    &nbsp
                    <form action="<?php echo FRONT_ROOT ?>/Room/editRoom" method="POST">
                        <div class="">
                            <p class="text-head">Numero de Sala: </p>
                            <input type="number" name="roomNumberEdit" class="input" placeholder="" required="" value="<?php echo $roomNumberEdit ?>" min="0" readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Capacidad: </p>
                            <input type="number" name="seatsEdit" class="input" placeholder="" required="" value="<?php echo $seatsEdit ?>" min="0"/>
                        </div>
                        <div>
                            <input type="hidden" name="IdCinema" value="<?php echo $idCinema ?>"/>
                        </div>

                        <button type="submit" class="signinbutton btn">Siguiente</button> 


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