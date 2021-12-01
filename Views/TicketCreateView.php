<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Comprar entradas</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/purchase/selectCantTicket" method="POST">
                        <div class="">
                            <p class="text-head">Cine:</p>
                            <input type="text" name="cinemaName" class="input" placeholder="" required="" value ="<?php echo $cinemaName ?>" readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Numero de sala:</p>
                            <input type="number" name="roomNumber" class="input" placeholder="" required="" value="<?php echo $roomNumber ?>" readonly />
                        </div>
                        <div class="">
                            <p class="text-head">Precio individual:</p>
                            <input type="number" name="ticketPrice" class="input" placeholder="" required="" value="<?php echo $cinemaTicketPrice ?>" readonly/>
                        </div>
                        <div class="">
                            <p class="text-head">Película:</p>
                            <input type="text" name="filmTitle" class="input" placeholder="" required="" value="<?php echo $filmTitle ?>"readonly/>
                        </div>
                        <div class="">
                            Fecha - Hora: <br>&nbsp<br>
 
                            <input type="date" name="date" step="1" value="<?php echo $functionDate?>" readonly>
                            <input type="time" name="time" value ="<?php echo $functionTime ?>" readonly>
                        </div>
                        <div class="">
                            <p class="text-head">Cantidad de Entradas:</p>
                            <input type="number" name="ticketAmount" class="input" placeholder="" required="" min="1" max="<?php echo $availableTickets; ?>" />
                            <p class="text-head"><?php if(date('l', strtotime($functionDate))== 'Wednesday' or date('l', strtotime($functionDate)) == 'Tuesday'){
                                echo "Descuento del 25% comprando 2 Entradas o más";
                            } ?> </p>
                        </div>

                        <input type="hidden" name="idFunction" value="<?php echo $idFunction; ?>">
                    
                        <button type="submit" class="signinbutton btn">Siguiente</button>

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