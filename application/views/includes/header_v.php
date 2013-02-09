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
            <!-- user dropdown starts -->
            <div class="btn-group pull-right" >                
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i><span class="hidden-phone"> <?= lang('multi_nav_top_1') ?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#myModal" class="btn-setting" title=""> <i class="icon-edit"></i> <?= lang('multi_nav_top_2') ?></a></li>
                    <!--<li class="divider"></li>-->
                    <li><a data-toggle="modal" href="#avatar" class=""> <i class="icon-picture"></i>  <?= lang('multi_nav_top_3') ?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?= base_url() ?>backend/usuarios/cerrar_sesion"> <i class="icon-remove"></i> <?= lang('multi_nav_top_4') ?></a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <div class="top-nav nav-collapse">
                <ul class="nav">
                    <li><a href="#"><?= lang('multi_nav_top_5') ?></a></li>
                    <li>
                        <form class="navbar-search pull-left">
                            <input placeholder="Buscar en el sitio" class="search-query span2" name="query" type="text">
                        </form>
                    </li>                    
                </ul>
            </div><!--/.nav-collapse -->

            <div class="btn-group pull-right">                
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-flag"></i><span style="" class="hidden-phone"> <?= lang('multi_nav_top_6') ?></span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>                        
                        <!--
                            //base_url() . $this->lang->switch_uri('es')
                        -->
                        <a href="<?= base_url() . $this->lang->switch_uri('es') ?>"><img src="<?= base_url() ?>img/es.gif" alt="">&nbsp;&nbsp;&nbsp;&nbsp;Español</a>
                    </li>
                    <li class="divider"></li>
                    <li>                        
                        <!--
                            //base_url() . $this->lang->switch_uri('en') 
                        -->
                        <a href="<?= base_url() . $this->lang->switch_uri('en') ?>"><img src="<?= base_url() ?>img/en.gif" alt="">&nbsp;&nbsp;&nbsp;&nbsp;English</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- topbar ends -->


<!-- Contenido Modal -->
<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h2><?= lang('multi_nav_mod_1') ?></h2>
    </div>
    <div class="modal-body">
        <div>
            <h3><?= lang('multi_nav_mod_2') ?>:</h3>
            <ul style="color:black;list-style: none;margin-left: 0;">
                <li>
                    <img class="dashboard-avatar" alt="<?= $this->simple_sessions->get_value('nombre') ?>" src="<?= $this->simple_sessions->get_value('avatar') ?>">
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_3') ?>:</strong> <a href="#"> <?= $this->simple_sessions->get_value('nombre') ?></a><br>
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_4') ?>:</strong> <?= $this->simple_sessions->get_value('email') ?><br>
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_5') ?>:</strong>  <?= $this->simple_sessions->get_value('fecha_creacion') ?><br>                                  
                </li>
            </ul>
        </div>
        <div>
            <form class="form-horizontal" action="<?= site_url('backend/usuarios/edit') ?>" method="post">
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <h3><?= lang('multi_nav_mod_6') ?>:</h3>
                <div class="control-group">
                    <label class="control-label" style="color: #0099cc;" for="focusedInput"><?= lang('multi_nav_mod_7') ?></label>
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
                    <label class="control-label" style="color: #0099cc;" for="focusedInput"><?= lang('multi_nav_mod_8') ?></label>
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
                    <label class="control-label" style="color: #990000;" for="focusedInput"><?= lang('multi_nav_mod_9') ?></label>
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
                    <label class="control-label" style="color: #0099cc;" for="focusedInput"><?= lang('multi_nav_mod_10') ?></label>
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
                    <label class="control-label" style="color: #0099cc;" for="focusedInput"><?= lang('multi_nav_mod_11') ?></label>
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
                    <button id="submit_edit" style="margin-left: 65%;"  type="submit" class="btn btn-primary">&nbsp;&nbsp;<?= lang('multi_nav_mod_12') ?>&nbsp;&nbsp;</button>
                    <a href="#" data-dismiss="modal" class="btn"><?= lang('multi_nav_mod_13') ?></a>
                </div>
            </form>
        </div>
    </div>

</div><!-- FIN contenido Modal-->

<!--Modal bootstrap-->
<div id="avatar" class="modal hide fade in" style="display: none;">
    <div class="modal-header">
        <a data-dismiss="modal" class="close">×</a>
        <h2><?= lang('multi_nav_mod_14') ?></h2>
    </div>
    <div class="modal-body">
        <div>
            <h3><?= lang('multi_nav_mod_15') ?>:</h3>
            <ul style="color:black;list-style: none;margin-left: 0;">
                <li>
                    <img class="dashboard-avatar" alt="<?= $this->simple_sessions->get_value('nombre') ?>" src="<?= $this->simple_sessions->get_value('avatar') ?>">
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_3') ?>:</strong> <a href="#"> <?= $this->simple_sessions->get_value('nombre') ?></a><br>
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_4') ?>:</strong> <?= $this->simple_sessions->get_value('email') ?><br>
                    <strong style="color: #0099cc;"><?= lang('multi_nav_mod_5') ?>:</strong>  <?= $this->simple_sessions->get_value('fecha_creacion') ?><br>                                  
                </li>
            </ul>
        </div>
        <!-- Subir imagen -->
        <div>
            <?php echo form_open_multipart(site_url('backend/upload_avatar/do_upload')); ?>
            <div class="control-group"  style="color:black;">
                <h3><?= lang('multi_nav_mod_16') ?>:</h3>
                <div class="controls">
                    <input class="input-file uniform_on" id="fileInput" name="userfile" type="file">
                    &nbsp;&nbsp;&nbsp;
                </div>
            </div> 
        </div>
        <!-- FIN subir imagen --> 
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" name="subirr" value="<?= lang('multi_nav_mod_14') ?>" />
        <a href="#" data-dismiss="modal" class="btn"><?= lang('multi_nav_mod_13') ?></a>
    </div>

</form>
</div>