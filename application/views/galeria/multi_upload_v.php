
<div class="row-fluid sortable">
    <div class="box span5">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-camera"></i> Subir imágenes</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <div class="alert alert-block" id="object" style="text-align: left;z-index:100;width: 25%;height: 22%;position: absolute;margin-left: 200px;opacity: .7;">
                    <img style="margin-left: 8px;float: right;border-radius: .2em;" src="<?= base_url() ?>img/completo.gif" id="imgover" alt="Tecla-control">
                    <span>Pulse la tecla <strong>Ctrl</strong> y maténgala pulsada para hacer una selección múltiple de imágenes y recuerda que sólo se adminten formatos de imágenes <strong>jpg, jpeg, png o gif</strong>.</span>
                </div>
                <style>#objectEvent{
                        width: 80px;
                    }</style>
                    <?php
                    $string = base_url() . 'backend/b_gallery_c/multi_upload_start';
                    echo form_open_multipart($string);
                    $data = array('name' => 'archivos[]', 'class' => 'info-ctrl', 'style' => 'width:100px;', 'id' => 'objectEvent', 'multiple' => 'multiple');
                    echo ("<label for='archivos'>Seleccione las imágenes deseadas:</label>" . form_upload($data));
                    echo '<br><br>';
                    ?> 
                <input type="submit" class="btn btn-primary"  name="subir" value="Subir imagen" />
                </form>

            </div>
            <?php
            if (isset($excess)) {
                echo '<div class="alert alert-error">
                        <strong>Posibles errores</strong>
                        <ul>
                            <li>Ha <strong>superado el límite</strong> de capacidad de subida de imágenes.</li>
                            <li>O <strong>no seleccionó</strong> ninguna imagen.</li>
                        </ul>
                        <p><strong>Ruego que disculpe las molestias.</strong></li > </div>';
            }
            if (isset($error) && !empty($error)) {
                echo '<div class="alert alert-error">
                        <ul style="list-style:none;">
                        <strong>Transferencias erróneas:</strong>';
                foreach ($error as $item) {
                    echo '<li>' . $item . '</li>';
                }
                echo '</ul></div>';
            }
            if (isset($ok) && !empty($ok)) {
                echo '<div class="alert alert-success"><ul style="list-style:none;">';
                echo '<strong>Transferencias satisfactorias:</strong>';
                foreach ($ok as $item) {
                    echo '<li><i class="icon-ok"></i>&nbsp;&nbsp;' . $item . '</li>';
                }
                echo '</ul></div>';
            }
            ?>
        </div>                   
    </div>

