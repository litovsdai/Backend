<!-- topbar starts -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#"> <span>casualWeb</span></a>

            <!-- theme selector starts -->
            <!--            <div class="btn-group pull-right theme-container" >
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-tint"></i><span class="hidden-phone"> Elegir tema / cambiar</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" id="themes">
                                <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                                <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                                <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
                                <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                                <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
                                <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
                                <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
                                <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
                                <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                            </ul>
                        </div>-->
            <!-- theme selector ends -->

            <!-- user dropdown starts -->
            <div class="btn-group pull-right" >
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i><span class="hidden-phone"> Administrador</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#myModal" class="btn-setting" title=""> <i class="icon-edit"></i> Editar datos personales</a></li>
                    <!--<li class="divider"></li>-->
                    <li><a data-toggle="modal" href="#avatar" class=""> <i class="icon-picture"></i>  Cambiar avatar</a></li>
                    <li class="divider"></li>
                    <li><a href="<?= base_url() ?>backend/b_usuario_c/cerrar_sesion"> <i class="icon-remove"></i>  Cerrar sesión</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <div class="top-nav nav-collapse">
                <ul class="nav">
                    <li><a href="#">Visitar sitio web</a></li>
                    <li>
                        <form class="navbar-search pull-left">
                            <input placeholder="Buscar en el sitio" class="search-query span2" name="query" type="text">
                        </form>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- topbar ends -->


<!-- Contenido Modal -->
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h2>Edición de perfil</h2>
    </div>
    <div class="modal-body">
        <div>
            <h3>Datos actuales:</h3>
            <ul style="color:black;list-style: none;margin-left: 0;">
                <li>
                    <img class="dashboard-avatar" alt="<?= $this->simple_sessions->get_value('nombre') ?>" src="<?= $this->simple_sessions->get_value('avatar') ?>">
                    <strong style="color: #0099cc;">Nombre:</strong> <a href="#"> <?= $this->simple_sessions->get_value('nombre') ?></a><br>
                    <strong style="color: #0099cc;">Correo:</strong> <?= $this->simple_sessions->get_value('email') ?><br>
                    <strong style="color: #0099cc;">Desde:</strong>  <?= $this->simple_sessions->get_value('fecha_creacion') ?><br>                                  
                </li>
            </ul>
        </div>
        <div>
            <form class="form-horizontal" action="<?= base_url() ?>backend/b_usuario_c/edit" method="post">
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <h3>Editar datos:</h3>
                <div class="control-group">
                    <label class="control-label" style="color: #0099cc;" for="focusedInput">Nombre</label>
                    <div class="controls">
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        <input id="nombre" name="nombre" class="input-xlarge focused" type="text" 
                               data-original-title="Máximo 45 caracteres" data-rel='tooltip' 
                               <?php if (!isset($edit_ok)) { ?>
                                   value="<?= $this->simple_sessions->get_value('nombre') ?>"

                               <?php } ?>>
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="color: #0099cc;" for="focusedInput">Correo electrónico</label>
                    <div class="controls">
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        <input id="email" name="email" class="input-xlarge focused" type="text"
                               data-original-title="Máximo 80 caracteres" data-rel='tooltip'
                               <?php if (!isset($edit_ok)) { ?>
                                   value="<?= $this->simple_sessions->get_value('email') ?>"

                               <?php } ?>>
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="color: #990000;" for="focusedInput">Viejo password</label>
                    <div class="controls">
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        <input id="password" name="oldpassword" class="input-xlarge focused" 
                               type="password" data-rel='tooltip' data-original-title="Su antiguo password"
                               <?php if (!isset($edit_ok)) { ?>
                                   value="<?= set_value('oldpassword') ?>"
                                   <?php
                               }
                               ?>
                               >
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="color: #0099cc;" for="focusedInput">Nueva contraseña</label>
                    <div class="controls">
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        <input id="password" name="password" class="input-xlarge focused" 
                               type="password" data-rel='tooltip' data-original-title="Por motivos de seguridad crear una contraseña segura que contenga Símbolos especiales como (!, +, ], ?, etc) o valores numéricos como (1, 2, 4.. 9)"
                               <?php if (!isset($edit_ok)) { ?>
                                   value="<?= set_value('password') ?>"
                                   <?php
                               }
                               ?>
                               >
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="color: #0099cc;" for="focusedInput">Repita nueva contreseña</label>
                    <div class="controls">
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        <input id="repassword" name="repassword" class="input-xlarge focused"
                               type="password"  data-rel='tooltip' 
                               <?php if (!isset($edit_ok)) { ?>
                                   value="<?= set_value('repassword') ?>"
                               <?php } ?>
                               >
                        <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_edit" style="margin-left: 65%;"  type="submit" class="btn btn-primary">&nbsp;&nbsp;Almacenar&nbsp;&nbsp;</button>
                    <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                </div>
            </form>
        </div>
    </div>

</div><!-- FIN contenido Modal-->

<!--Modal bootstrap-->
<div id="avatar" class="modal hide fade in" style="display: none;">
    <div class="modal-header">
        <a data-dismiss="modal" class="close">×</a>
        <h2>Cambiar avatar</h2>
    </div>
    <div class="modal-body">
        <div>
            <h3>Datos actuales:</h3>
            <ul style="color:black;list-style: none;margin-left: 0;">
                <li>
                    <img class="dashboard-avatar" alt="<?= $this->simple_sessions->get_value('nombre') ?>" src="<?= $this->simple_sessions->get_value('avatar') ?>">
                    <strong style="color: #0099cc;">Nombre:</strong> <a href="#"> <?= $this->simple_sessions->get_value('nombre') ?></a><br>
                    <strong style="color: #0099cc;">Correo:</strong> <?= $this->simple_sessions->get_value('email') ?><br>
                    <strong style="color: #0099cc;">Desde:</strong>  <?= $this->simple_sessions->get_value('fecha_creacion') ?><br>                                  
                </li>
            </ul>
        </div>
        <!-- Subir imagen -->
        <div>
            <?php $string = base_url() . 'backend/upload/do_upload'; ?>
            <?php echo form_open_multipart($string); ?>
            <div class="control-group"  style="color:black;">
                <h3>Seleccione nuevo avatar:</h3>
                <div class="controls">
                    <input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
                    &nbsp;&nbsp;&nbsp;
                </div>
            </div> 
        </div>
        <!-- FIN subir imagen --> 
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" name="subirr" value="Cambiar avatar" />
        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
    </div>

</form>
</div>