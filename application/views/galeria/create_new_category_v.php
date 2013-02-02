
<div class="box span4">
    <div class="box-header well" data-original-title>
        <h2><i class="icon-plus"></i> Nueva categoría</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">  
        <div class="control-group">
            <div id="resp_new_cat"></div>
            <label class="control-label" for="focusedInput">Nombre:</label>
            <div class="controls">
                <input class="input-xlarge focused" id="n_cat" name="n_cate" id="focusedInput" type="text" placeholder="Nombre de la categoría"><br>
                <a style="margin-top: 3%;" id="myForm" class="btn btn-small btn-primary">Añadir categoría</a>
                <img id="img_new_cat" src="<?= base_url() ?>img/ajax-loaders/load-indicator.gif"  style="display:none;margin: 3% 0 0 5%;"><br>
            </div>
        </div>
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
            <div id="resp_del"></div>
            <label class="control-label" for="selectError1">Seleccione todas las categorías que desee eliminar:</label>
            <div class="controls">
                <span id="refresh_delete">
                    <select id="sel" class="selectError1" name="delete_cats[]" multiple="multiple" data-rel="chosen">
                        <?php if (isset($categories) && $categories !== 0) { ?>
                            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                <option value="<?= $categories[$i] ?>"><?= $categories[$i] ?></option>   
                            <?php } ?>
                        <?php } else { ?>
                            <option>No hay categorías</option>
                        <?php } ?>
                    </select>
                </span>
                <button id="submit_delete" style="margin-top: 15px;" class="btn btn-small btn-danger">Eliminar categoría</button>
                <img id="img_del" src="<?= base_url() ?>img/ajax-loaders/load-indicator.gif" style="display:none;margin: 3% 0 0 5%;"><br>

            </div>

        </div>
    </div>                   
</div>
</div>