    <section class="signin-form">
        <div class="overlay">
            <div class="wrapper">
                <div class="logo text-center top-bottom-gap">
                    <a class="brand-logo" href="">TP Final - MoviePass</a>
                    <!-- if logo is image enable this   
			<a class="brand-logo" href="#index.html">
			    <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
			</a> -->
                </div>
                <div class="form34">
                    <h4 class="form-head"> TP FINAL (SIGN IN)</h4>
                    <p class="form-para">Ingresar usando Facebook o Google</p>
                    <div class="main-div">
                        <a href="#facebook">
                            <div class="signin facebook">
                                <span class="fa fa-facebook" aria-hidden="true"></span>
                                <p class="action">Facebook</p>
                            </div>
                        </a>
                        <a href="#google-plus">
                            <div class="signin google-plus">
                                <span class="fa fa-google-plus" aria-hidden="true"></span>
                                <p class="action">Google</p>
                            </div>
                        </a>
                    </div>
                    <div class="form-34or">
                        <span class="pros">
                            <span>O</span>
                        </span>
                    </div>
                    <form action="<?php echo FRONT_ROOT ?>/sign/login" method="POST">
                        <div class="">
                            <p class="text-head">Correo Electrónico</p>
                            <input type="email" name="username" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Contraseña</p>
                            <input type="password" name="password" class="input" placeholder="" required="" />
                        </div>
                        <?php /*
                        <label class="remember">
                            <input type="checkbox">
                            <span class="checkmark"></span>Recordar
                        </label>
                        */ ?>

                        <button id="btn" type="submit" class="signinbutton btn">Iniciar Sesión</button>
                        <p class="signup">¿Aún no tienes una cuenta?<a href="login/register" class="signuplink">Regístrate</a>
                        </p>

                        <!-- Esto como si no existiera -->
                        

                        <?php 

                        if (isset($msjError)){         
                            echo "&nbsp";
                            echo "<div style='color:red'><b> ".$msjError." <b></div>";
                            echo "&nbsp";
                        }   

                        ?>
                    </form>
                </div>
                &nbsp
                <?php /* INICIO SEGUNDO FORMULARIO: REGISTRO */ ?>
                 <div class="form34">
                    <h4 class="form-head">TP FINAL (SIGN UP)</h4>
                    <form action="<?php echo FRONT_ROOT ?>/sign/register" method="POST">
                        <div class="">
                            <p class="text-head">Nombre:</p>
                            <input type="text" name="newFirstname" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Apellido:</p>
                            <input type="text" name="newLastname" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">DNI:</p>
                            <input type="number" name="newDni" class="input" placeholder="" required=""/>
                        </div>
                        <div class="">
                            <p class="text-head">Correo Electrónico:</p>
                            <input type="email" name="newUsername" class="input" placeholder="" required="" />
                        </div>
                        <div class="">
                            <p class="text-head">Contraseña:</p>
                            <input type="password" name="newPassword" class="input" placeholder="" required="" />
                        </div>

                        <button type="submit" class="signinbutton btn">Regístrarse</button>

                    </form>
                </div>
                <?php /* FIN DEL SEGUNDO FORMULARIO: REGISTRO */?>
            </div>            
        </div>
    </section>
    
    <?php /*comienzo*/ /*?>
            <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php /*asd*/ ?>
