
<div class="row-fluid sortable">
    <div class="box span5">
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
                <?php
                $string = base_url() . 'backend/b_gallery_c/multi_upload_start';
                echo form_open_multipart($string);
                for ($i = 1; $i <= 5; $i++) {
                    ?>
                    <label for="userfile<?= $i ?>">Imagen <?= $i ?>:
                        <input type="file" name="userfile<?= $i ?>" size="1" class="input-large" /></label>
                <?php } ?> 
                <img id="o" style="display: none;" src="<?= base_url() ?>img/ajax-loaders/ajax-loader-6.gif">
                <br><br>
                <input id="ajax" type="submit" class="btn btn-primary"  name="subir" value="Subir imagen/es" />
                </form>

            </div>
            <!-- Posibles errores o sucesos satisfactorios-->
            <?php if (isset($error) && !empty($error)) { ?>
                <div class="alert alert-error">
                    <strong>Transferencias erróneas:</strong> 
                    <ul>
                        <?php foreach ($error as $item) { ?>
                            <?php foreach ($item as $valor) { ?>
                                <li><?= $valor ?></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if (isset($success) && !empty($success)) { ?>
                <div class="alert alert-success">
                    <strong>Transferencias satisfactorias:</strong>                                      
                    <ul>
                        <?php foreach ($success as $item) { ?>
                            <?php foreach ($item as $valor) { ?>
                                <?php foreach ($valor as $key => $val) { ?>
                                    <?php if ($key === 'file_name') { ?>
                                        <li><?= $val ?></li>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if (isset($err_145X100)) { ?>
                <?php print_r($err_145X100) ?>
            <?php } ?>
            <?php if (isset($err_800X600)) { ?>
                <?php print_r($err_800X600) ?>
            <?php } ?>
        </div>                   
    </div>

