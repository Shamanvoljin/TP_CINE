
<section class="signin-form">
	<div class="overlay">
		<?php  // Trabajar aca el administrar cines ?>
		<div class="form34">
                    <h4 class="form-head">Agregar Cine</h4>
                    <form action="<?php echo FRONT_ROOT ?>/cinema/create" method="POST"> <?php // Controladora de cine,ver metodo que vamos a utilizar ?>
                        <div class="">
                            <p class="text-head">Nombre:</p>
                            <input type="text" name="newName" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Direccion:</p>
                            <input type="text" name="newAdress" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Precio de Entrada:</p>
                            <input type="number" name="newTicketPrice" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Cantidad de Salas:</p>
                            <input type="number" name="newRoomNumber" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Capacidad por Sala:</p> <?php // Cada sala deberia tener su propia capacidad ?>
                            <input type="number" name="newSeats" class="input" placeholder="" required="" />
                        </div>

                        <button type="submit" class="signinbutton btn">Agregar</button>

                    </form>
        </div>
 	</div>
</section>
