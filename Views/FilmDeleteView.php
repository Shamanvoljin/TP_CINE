
	<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Eliminar Pelicula</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/Film/deleteFilm" method="POST">
                        <div class="">
                            <p class="text-head">Titulo:</p>
                            <input type="text" name="deleteFilmTitle" class="input" placeholder="" required="" value="<?php echo $filmTitleDelete ?>"readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Duracion:</p>
                            <input type="text" name="deleteLength" class="input" placeholder="" required="" value="<?php echo $lengthDelete." min."?>"readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Lenguaje:</p>
                            <input type="text" name="deleteLanguage" class="input" placeholder="" required="" value="<?php echo $languageDelete ?>"readonly/>
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