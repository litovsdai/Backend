<?php
if ($this->simple_sessions->get_value('super') === 1) {
    ?>     
    <div class="row-fluid sortable">
        <div class="box span8">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-plus"></i> Nuevo Usuario</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">

                <!-- Fomulario de Nuevo Usuario -->
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <form class="form-horizontal" action="<?= base_url() ?>backend/b_usuario_c/almacenar_nuevo" method="post">
                    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    <?= validation_errors('<p class="alert alert-error">', '</p>') ?>
                    <?php if (isset($nombre_error)) echo '<p class="alert alert-error">El usuario <b>' . $nombre_error . '</b> ya existe en la base de datos</p>'; ?>
                    <?php if (isset($email_error)) echo '<p class="alert alert-error">El correo electrónio <b>' . $email_error . '</b> ya existe en la base de datos </p>'; ?>
                    <?php if (isset($form_ok) /* || isset($this->simple_sessions->get_value('form_ok')) */) echo '<p class="alert alert-success">El usuario <b>' . $form_ok . '</b> se almacenó satisfactoriamente</p>'; ?>
                    <?php if (isset($error_db)) echo '<p class="alert alert-error">En la inserción de los datos ocurrió un error inesperado,<br> <b>rogamos se ponga en contacto con el administrador.</b></p>'; ?>
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Nombre</label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="nombre" name="nombre" class="input-xlarge focused" type="text" 
                                       data-original-title="Máximo 45 caracteres" data-rel='tooltip' 
                                       <?php if (!isset($form_ok)) { ?>
                                           value="<?= set_value('nombre') ?>"
                                           <?php
                                       } else {
                                           echo 'value=""';
                                       }
                                       ?>
                                       >
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Correo electrónico</label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="email" name="email" class="input-xlarge focused" type="text"
                                       data-original-title="Máximo 80 caracteres" data-rel='tooltip'
                                       <?php if (!isset($form_ok)) { ?>
                                           value="<?= set_value('email') ?>"
                                           <?php
                                       } else {
                                           echo 'value=""';
                                       }
                                       ?>
                                       >
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Contraseña</label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="password" name="password" class="input-xlarge focused" 
                                       type="password" data-rel='tooltip' data-original-title="Por motivos de seguridad crear una contraseña segura que contenga Símbolos especiales como (!, +, ], ?, etc) o valores numéricos como (1, 2, 4.. 9)"
                                       <?php if (!isset($form_ok)) { ?>
                                           value="<?= set_value('password') ?>"
                                           <?php
                                       } else {
                                           echo 'value=""';
                                       }
                                       ?>
                                       >
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Repita contreseña</label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="repassword" name="repassword" class="input-xlarge focused"
                                       type="password"  data-rel='tooltip' 
                                       <?php if (!isset($form_ok)) { ?>
                                           value="<?= set_value('repassword') ?>"
                                           <?php
                                       } else {
                                           echo 'value=""';
                                       }
                                       ?>
                                       >
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            </div>
                        </div>
                        <div class="form-actions">
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <button id="submit_nuevo" type="submit" class="btn btn-primary">Almacenar</button>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <?= form_reset(array('class' => 'btn'), 'Vaciar campos') ?>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                        </div>
                    </fieldset>
                </form>
                <!-- FIN Formulario -->
            </div>
        </div><!--/span-->
    </div>
    <?php
}
?>     