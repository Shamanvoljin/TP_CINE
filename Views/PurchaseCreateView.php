<section class="signin-form">

		<div class="overlay">

			<div class="form34">                   

    				&nbsp<br>           

				<h4 class="form-head2">Completar Compra</h4>
                    &nbsp
                    <br>
                    &nbsp 

                     <form action="<?php echo FRONT_ROOT ?>/purchase/selectPaymentMethod" method="POST">
                        <div class="">
                            <p class="text-head">Pelicula:</p>
                            <input type="text" name="filmTitle" class="input" placeholder="" required="" value="<?php echo $filmTitle ?>"readonly/>
                        </div>
                        <div class="">
                            Fecha - Hora: <br>&nbsp<br>
 
                            <input type="date" name="date" step="1" value="<?php echo $functionDate?>" readonly>
                            <input type="time" name="time" value ="<?php echo $functionTime ?>" readonly>
                        </div>
                         <div class="">
                            <p class="text-head">Cantidad de Entradas:</p>
                            <input type="number" name="ticketAmount" class="input" placeholder="" required="" value="<?php echo $ticketAmount; ?>" readonly/>
                            <p class="text-head"><?php if((date('l', strtotime($functionDate))== 'Wednesday' or date('l', strtotime($functionDate)) == 'Tuesday') && $ticketAmount>=2){
                                echo "Descuento del 25% aplicado";
                            } ?> </p>
                        </div>
                        <div class="">
                            
                            <input type="number" name="price" class="input" placeholder="" required="" value ="<?php echo $totalPrice ?>" readonly />
                        </div>

                        <div class="">
                            <label for="companyName" >Compañia de tarjeta: </label>
                            <select name="companyName" id ="companyName" class="input">
                                <option> Visa </option> 
                                <option> MasterCard </option> 
                            </select>
                        </div>
                         <div class="">
                            <p class="text-head">Numero de Tarjeta:</p>
                            <input type="number" name="cardNumber" class="input" placeholder="" required="" min="1000000000000000" max="9999999999999999"/>
                        </div>
                        <div class="">
                            <p class="text-head">Fecha de Vencimiento:</p>
 
                            <input type="month" name="month" step="1" min="2019-12" value="2019-12" >
                         
                        </div>
                         <div class="">
                            <p class="text-head">CVV:</p>
                            <input type="number" name="cvv" class="input" placeholder="" required="" min="100" max="999"/>
                        </div>
                        <div class="">
                            <p class="text-head">Titular de la Tarjeta:</p>
                            <input type="text" name="cardOwner" class="input" placeholder="" required=""/>
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