
<section class="signin-form">
    <div class="overlay">

    <?php  for ($i=0; $i < 4; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>   

        <div class="form35">  
            <div id="main-container">
                <h4 class="form-head2">Listado de Compras por Fecha</h4>
                    &nbsp
                    <br>
                    &nbsp  
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pelicula</th>
                            <th>Cine</th>
                            <th>Sala</th>                            
                            <th>Entradas</th>
                            <th>Descuento</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <?php 
                    foreach ($purchaseList as $key => $value) { 
                  
                        $date = $value->getDate();
                        $cinema = $value->getCinema();
                        $room = $value->getRoom_number();
                        $cantTickets = $value->getCant_Tickets();
                        $discount = $value->getDiscount();
                        if($discount == "1"){
                            $discount = "Si";
                        }
                        else {
                            $discount = "No";
                        }
                        $total = $value->getTotal();
                        $token = $value->getToken();
                        $film = $value->getFilm();

                    ?>

                    <tr>
                        <td><?php echo $date;?></td>
                        <td><?php echo $film;?></td>
                        <td><?php echo $cinema;?></td>
                        <td><?php echo $room;?></td>
                        <td><?php echo $cantTickets;?></td>
                        <td><?php echo $discount;?></td>
                        <td><?php echo "$".$total;?></td>
                    </tr>

                <?php } ?>

                </table>
            </div>
            &nbsp<br>&nbsp<br>
            &nbsp  
        </div>


    <?php  for ($i=0; $i < 13 ; $i++) {;?>
                &nbsp<br>           
    <?php  } ?>  

    </div>
</section>
