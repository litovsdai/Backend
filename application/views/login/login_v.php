<div class="container-fluid">
    <div class="row-fluid">        
        <div class="row-fluid">
            <div class="span12 center login-header">
                <h2>Backend propiedad <span style="color:#F60;text-decoration: underline;">casualweb.org</span></h2>
                <blockquote><a href="https://twitter.com/soy_lito" title="@soy_lito">@soy_lito</a>|
                <span>Backend totalmente personalizable según las necesidades del cliente.</span>
                <small>Administre su Front subiendo imágenes, productos, artículos de cualquier tipo creando categorías y subcategorías..</small>
            </blockquote></div><!--/span-->
        </div><!--/row-->
        <div class="row-fluid">
            <div class="well span5 center login-box">
                <?php if(isset($active)) echo '<div class="alert alert-success">'.$active.'</div>'; ?>       
                 <div class="alert alert-info"> Bienvenido !  </div>
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <form class="form-horizontal" action="<?= site_url('login/login_c/login') ?>" method="post">
                    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    <?= validation_errors('<div class="alert alert-error">', '</div>') ?>
                    <fieldset>
                        <div class="input-prepend" title="correo electrónico" data-rel="tooltip">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <input autofocus class="input-large span10" name="email" id="email" type="text" placeholder="correo electrónico"
                                   value="lito@gmail.com" />
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                        <div class="clearfix"></div>
                        <div class="input-prepend" title="Contraseña" data-rel="tooltip">
                            <span class="add-on"><i class="icon-lock"></i></span>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <input class="input-large span10" name="password" id="password" type="password" placeholder="contraseña"
                                   value="lito" />
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                        <div class="clearfix"></div>
                        <p class="center span5">
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <button type="submit" id="submit_log" class="btn btn-primary">Acceso</button>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </p>
                    </fieldset>
                </form>
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->
</div><!--/.fluid-container-->