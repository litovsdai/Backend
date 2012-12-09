<div class="container-fluid">
    <div class="row-fluid">

        <div class="row-fluid">
            <div class="span12 center login-header">
                <h2>Bienvenido a su backend personal</h2>
            </div><!--/span-->
        </div><!--/row-->
        <div class="row-fluid">
            <div class="well span5 center login-box">
                <div class="alert alert-info">
                    Por favor introduce tu nombre de usuario y contraseña.
                </div>
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <form class="form-horizontal" action="<?= base_url() ?>login/login_c/login" method="post">
                    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                   <div class="alert alert-error">
                       Correo electrónico o contraseña incorrectos ! 
                   </div>
                    <fieldset>
                        <div class="input-prepend" title="correo electrónico" data-rel="tooltip">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <input autofocus class="input-large span10" name="email" id="email" type="text" placeholder="correo electrónico"
                                   value="<?php echo set_value('email'); ?>" />
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                        <div class="clearfix"></div>
                        <div class="input-prepend" title="Contraseña" data-rel="tooltip">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <input class="input-large span10" name="password" id="password" type="password" placeholder="contraseña"
                                   value="<?php echo set_value('password'); ?>" />
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend">
                            <label class="remember" for="remember">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input type="checkbox" id="remember"
                                       <?php echo set_checkbox('mi_casilla', '2'); ?> />Recordarme</label>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                        <div class="clearfix"></div>

                        <p class="center span5">
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <button type="submit" class="btn btn-primary">Acceso</button>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </p>
                    </fieldset>
                </form>
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->
</div><!--/.fluid-container-->