<!-- topbar starts -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#"> <img alt="Charisma Logo" src="<?= base_url() ?>img/logo20.png" /> <span>Backend</span></a>

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
                    <li><a href="#" class="btn-setting" title="Pulsa sobre la imagen ara cambiarla">Perfil</a></li>
                    <li class="divider"></li>
                    <li><a href="<?= base_url() ?>backend/b_usuario_c/cerrar_sesion">Cerrar sesión</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->


            <!-- Contenido Modal -->
            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h2>Edición de perfil</h2>
                </div>
                <div class="modal-body">
                    <h3>Datos actuales:</h3>
                    <ul style="color:black;list-style: none;margin-left: 0;">
                        <li>
                            <img class="dashboard-avatar" alt="<?= $this->simple_sessions->get_value('nombre') ?>" src="<?= $this->simple_sessions->get_value('avatar') ?>">
                            <strong style="color: #0099cc;">Nombre:</strong> <a href="#"> <?= $this->simple_sessions->get_value('nombre') ?></a><br>
                            <strong style="color: #0099cc;">Correo:</strong> <?= $this->simple_sessions->get_value('email') ?><br>
                            <strong style="color: #0099cc;">Desde:</strong>  <?= $this->simple_sessions->get_value('fecha_creacion') ?><br>                                  
                        </li>
                    </ul>
                    <hr style="border-color: #0074cc;">
                    <!-- Subir imagen -->
                    <?php $string = base_url() . 'backend/upload/do_upload'; ?>
                    <?php echo form_open_multipart($string); ?>
                    <div class="control-group"  style="color:black;">
                        <h3>Subir nuevo avatar:</h3>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
                            &nbsp;&nbsp;&nbsp;
                            <input type="submit" style="float: right;margin-right: 20px;" class="btn btn-primary" name="subirr" value="Subir imagen" />
                        </div>
                    </div> 
                    </form>
                    <hr style="border-color: #0074cc;">
                    <!-- FIN subir imagen -->
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
                        <button id="submit_edit" style="float: right;margin-right: 20px;" type="submit" class="btn btn-primary">&nbsp;&nbsp;Almacenar&nbsp;&nbsp;</button>
                    </form>
                </div>

            </div><!-- FIN contenido Modal-->


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