
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Eliminar Funcion</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Function/delete" method="POST">
                        <div class="">
                            <p class="text-head">Cine:</p>
                            <input type="select" name="cinema" class="input" placeholder="" required="" value="<?php echo $cinema ?>"readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Sala:</p>
                            <input type="text" name="room" class="input" placeholder="" required="" value="<?php echo $room ?>"readonly />
                        </div>
                        

                        <div class="">
                            <p class="text-head">Pelicula:</p>
                            <input type="text" name="film" class="input" placeholder="" required=""  value="<?php echo $film ?>"readonly/>
                        </div>
						<div class="">
                            <p class="text-head">Fecha - Hora:</p><br>
                            <input type="text" name="date" class="input" placeholder="" required="" value="<?php echo $date ?>"readonly/>
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
