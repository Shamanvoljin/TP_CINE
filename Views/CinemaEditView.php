
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Editar Cine</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Cinema/edit" method="POST">
                        <div class="">
                            <p class="text-head">Nombre:</p>
                            <input type="text" name="newNameCinema" class="input" placeholder="" required="" value="<?php echo $nameEdit ?>" readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Calle:</p>
                            <input type="text" name="newAdressName" class="input" placeholder="" required="" value="<?php echo $adressName ?>" />
                        </div>
                        <div class="">
                            <p class="text-head">Numero:</p>
                            <input type="number" name="newAdressNumber" class="input" placeholder="" required="" value="<?php echo $adressNumber ?>" min="0"/>
                        </div>
                        <div class="">
                            <p class="text-head">Precio de Entrada:</p>
                            <input type="number" name="newTicketPriceCinema" class="input" placeholder="" required="" min="0" value="<?php echo $costEdit ?>"/>
                        </div>

                        <button type="submit" class="signinbutton btn">Siguiente</button>

                    </form>

                 <?php for ($i=0; $i < 3; $i++) { ?>
    				&nbsp<br>           
    			<?php } ?>

			</div>

				<?php for ($i=0; $i < 10; $i++) { ?>
    				&nbsp<br>           
    			<?php } ?>

		 </div>

	</section>

