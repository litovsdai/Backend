
<div class="row-fluid sortable">
    <div class="box span7">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-camera"></i> <?= lang('multi_upload_1') ?></h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <!-- Formulario de subida -->
                <?= form_open_multipart(site_url('backend/multi_upload/multi_upload_start')); ?>


                <input data-content="<?=lang('multi_upload_2')?>" data-rel="popover" href="#" data-original-title="<?=lang('multi_upload_3')?>" style="overflow-x: auto;" type="file" name="files[]" multiple />

                &nbsp;&nbsp;<img id="o" style="display: none;" src="<?= base_url() ?>img/ajax-loaders/load-indicator.gif">
                <br><br>

                <input id="ajax" type="submit" class="btn btn-primary"  name="subir" value="<?=lang('multi_upload_4')?>" />

                </form>
                <?php
                if (isset($datos) && count($datos) > 0) {
                    echo '<div class="alert alert-success"><p>';
                    echo '<h4 style="color:green;">'.lang('multi_upload_5').' (' . count($datos) . '): </h4>';
                    for ($i = 0; $i < count($datos); $i++) {
                        $temp = $i + 1;
                        echo '<b>' . $temp . ')</b>. ' . $datos[$i] . '<br>';
                    }
                    echo '</p></div>';
                }
                if (isset($error_images)) {
                    echo '<div class="alert alert-error"><p>';
                    echo $error_images;
                    if ($error_images === '') {
                        echo lang('multi_upload_6');
                    }
                    echo '</p></div>';
                }
                ?>
            </div>

        </div>                   
    </div>

