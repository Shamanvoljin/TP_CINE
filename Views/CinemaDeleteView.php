
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Eliminar Cine</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Cinema/delete" method="POST">
                        <div class="">
                            <p class="text-head">Nombre:</p>
                            <input type="text" name="deleteNameCinema" class="input" placeholder="" required="" value="<?php echo $nameDelete ?>"readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Direccion:</p>
                            <input type="text" name="deleteAdressCinema" class="input" placeholder="" required="" value="<?php echo $adressDelete ?>"readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Precio de Entrada:</p>
                            <input type="number" name="deleteTicketPriceCinema" class="input" placeholder="" required="" min="0" value="<?php echo $costDelete ?>"readonly/>
                        </div>
						<div class="">
                            <p class="text-head">Cantidad de Salas:</p>
                            <input type="number" name="deleteCantRoomsCinema" class="input" placeholder="" required="" min="0" value="<?php echo $cantRoomsDelete ?>"disabled/>
                        </div>

                        <button type="submit" class="signinbutton btn">Eliminar</button>

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
