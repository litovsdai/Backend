
<div class="row-fluid sortable">
    <div class="box span7">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-camera"></i> Seleccione imágenes</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <!-- Formulario de subida -->
                <?= form_open_multipart(site_url('backend/multi_upload/multi_upload_start')); ?>

                <input style="overflow-x: auto;" type="file" name="files[]" multiple />
                &nbsp;&nbsp;<img id="o" style="display: none;" src="<?= base_url() ?>img/ajax-loaders/load-indicator.gif">
                <br><br>
                <input id="ajax" type="submit" class="btn btn-primary"  name="subir" value="Subir imagen/es" />
                </form>
                <?php
                if (isset($datos)) {
                    echo '<div class="alert alert-success" style="width:400px;"><p>';
                    echo '<h4 style="color:green;">Número de imágenes subidas satisfactoriamente (' . count($datos) . '): </h4>';
                    for ($i = 0; $i < count($datos); $i++) {
                        $temp = $i + 1;
                        echo '<b>' . $temp . ')</b>. ' . $datos[$i] . '<br>';
                    }
                    echo '</p></div>';
                }
                if (isset($error_images)) {
                    echo '<div class="alert alert-error" style="width:400px;"><p>';
                    echo $error_images;
                    if ($error_images === '') {
                        echo 'Ha surgido algún error inesperado, vuelve a intentarlo.';
                    }
                    echo '</p></div>';
                }
                ?>
            </div>

        </div>                   
    </div>

