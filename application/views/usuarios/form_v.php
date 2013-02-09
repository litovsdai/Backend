<?php
if ($this->simple_sessions->get_value('super') === '1') {
    ?>     
    <div class="row-fluid sortable">
        <div class="box span8">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-plus"></i> <?= lang('multi_menuIzq_nuevo') ?></h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">

                <!-- Fomulario de Nuevo Usuario -->
                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                <form class="form-horizontal" action="<?= site_url('backend/usuarios/almacenar_nuevo') ?>" method="post">
                    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                    <div class="alert-error" style="padding: 0;border-radius: 5px;margin-bottom: 10px;">
                        <?= validation_errors() ?>
                    </div>
                    <?php if (isset($nombre_error)) echo '<p class="alert alert-error">' . lang('multi_usu_new_1', $nombre_error) . '</p>'; ?>
                    <?php if (isset($email_error)) echo '<p class="alert alert-error">' . lang('multi_usu_new_2', $email_error) . '</p>'; ?>
                    <?php if (isset($form_ok) /* || isset($this->simple_sessions->get_value('form_ok')) */) echo '<p class="alert alert-success">' . lang('multi_usu_new_3', $form_ok) . '</p>'; ?>
                    <?php if (isset($error_db)) echo '<p class="alert alert-error">' . lang('multi_usu_new_4') . '</p>'; ?>
                    <?php if (isset($mail_ok)) echo '<p class="alert alert-success">' . $mail_ok . '</p>'; ?>
                    <?php if (isset($mail_err)) echo '<p class="alert alert-errors">' . $mail_err . '</p>'; ?>
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput"><?= lang('multi_nav_mod_3') ?></label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="nombre" name="nombre" class="input-xlarge focused" type="text" 
                                       data-original-title="<?= lang('multi_usu_new_5') ?>" data-rel='tooltip' 
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
                            <label class="control-label" for="focusedInput"><?= lang('multi_usu_new_6') ?></label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="email" name="email" class="input-xlarge focused" type="text"
                                       data-original-title="<?= lang('multi_usu_new_7') ?>" data-rel='tooltip'
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
                            <label class="control-label" for="focusedInput"><?= lang('multi_usu_new_8') ?></label>
                            <div class="controls">
                                <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                <input id="password" name="password" class="input-xlarge focused" 
                                       type="password" data-rel='tooltip' data-original-title="<?= lang('multi_usu_new_9') ?>"
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
                            <label class="control-label" for="focusedInput"><?= lang('multi_usu_new_10') ?></label>
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
                            <button id="submit_nuevo" type="submit" class="btn btn-primary"><?= lang('multi_usu_new_11') ?></button>
                            <!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                            <?= form_reset(array('class' => 'btn'), lang('multi_usu_new_12')) ?>
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