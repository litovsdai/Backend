
<div class="box span4">
    <div class="box-header well" data-original-title>
        <h2><i class="icon-plus"></i> Nueva categoría</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">  
        <?= form_open() ?>
        <div class="control-group">
            <div id="resp_new_cat"></div>
            <label class="control-label" for="focusedInput">Nombre:</label>
            <div class="controls">
                <input class="input-xlarge focused" id="n_cat" name="n_cate" id="focusedInput" type="text" placeholder="Nombre de la categoría"><br>
                <img id="img_new_cat" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="display:none;"><br>
                <a style="margin-top: 3%;" id="myForm" class="btn btn-small btn-primary">Añadir categoría</a>
                <a href="<?= base_url() ?>backend/b_gallery_c/category" style="margin-top: 3%;" class="btn btn-small">
                    <i class="icon-refresh"></i>&nbsp;Actualizar cambios
                </a>
            </div>
        </div>
        <?= form_close() ?>
    </div>                   
</div>
<div class="box span4">
    <div class="box-header well" data-original-title>
        <h2 style="color:tomato;"><i class="icon-remove"></i> Eliminar categoría</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="box-content"> 
        <div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">
                ×
            </button><strong>
                <i class="icon-warning-sign"></i>&nbsp;Tenga cuidado!
            </strong>
            Si elimina una categoría, se eliminarán todas las imágenes que contenga.

        </div>
        <div class="control-group">
            <?= form_open(base_url() . 'backend/b_gallery_c/') ?>
            <label class="control-label" for="selectError1">Seleccione todas las categorías que desee eliminar:</label>
            <div class="controls">
                <select id="selectError1" name="delete_cats[]" multiple data-rel="chosen">
                    <?php if (isset($categories) && $categories !== 0) { ?>
                        <?php for ($i = 0; $i < count($categories); $i++) { ?>
                            <option><?= $categories[$i] ?></option>   
                        <?php } ?>
                    <?php } else { ?>
                        <option>No hay categorías</option>
                    <?php } ?>
                </select>
                <button style="margin-top: 15px;" class="btn btn-small btn-danger">Eliminar categoría</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>                   
</div>
</div>