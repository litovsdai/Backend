<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> Ver imágenes</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content" style="text-align: center;"> 
            <button class="btn show_"><i class="icon-edit"></i> EDITAR DATOS</button>    
            <br />
            <img class="ajax_load" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="display:none;">
            <br />
            <div class="resp_del_img"></div>

            <?php
            $con = 0;

            if (isset($categ) && isset($all_category) && $all_category !== 0) {
                foreach ($categ as $array) {
                    echo '<h1 style="text-decoration:underline;">' . $all_category[$con] . '</h1>';
                    echo '<ul class="thumbnails gallery">';
                    $con++;
                    foreach ($array as $categoria) {
                        foreach ($categoria as $key => $valor) {
                            if($key === 'id'){
                                $id = $valor;
                            }
                            if ($key === 'name') {
                                $name = $valor;
                            }
                            if ($key === 'ruta') {
                                $ruta = $valor;
                            }
                            if ($key === 'ruta_thumb') {
                                $ruta_thumb = $valor;
                            }
                            if ($key === 'padre') {
                                $padre = $valor;
                            }
                        }
                        ?>
                    <li class="thumbnail" id="<?= $id ?>">
                        <span style="margin-bottom: 1%;display: none;" title="Editar <?= $name ?>?" value="<?= $name ?>" class="show_edit ed_img btn"><i class="icon-edit"></i></span>
                        <span style="display: none;" value="<?= $id ?>" class="btn show_edit delete_one"><i class="icon-remove"></i></span>
                        <a class="visor" style="margin-bottom: 2%;background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                            <img class="grayscale img_delete" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                        </a>
                    </li>
                        <?php
                    }
                    echo '</ul>';
                }
            } else {
                echo '<p style="text-align:center;color:red;">No hay categorías que contengan imágenes.</p>';
            }

            if (isset($img_sin) && $img_sin !== 0) {
                echo '<h2 style="text-decoration:underline;">Imágenes sin categoría</h2>';
                echo '<ul class="thumbnails gallery">';
                foreach ($img_sin as $array) {
                    foreach ($array as $key => $valor) {
                        if($key === 'id'){
                            $id = $valor;
                        }
                        if ($key === 'name') {
                            $name = $valor;
                        }
                        if ($key === 'ruta') {
                            $ruta = $valor;
                        }
                        if ($key === 'ruta_thumb') {
                            $ruta_thumb = $valor;
                        }
                        if ($key === 'padre') {
                            $padre = $valor;
                        }
                        if (isset($padre) && $padre === '0') {
                            $padre = 'Sin categoría';
                        }
                    }
                    ?>
                    <li class="thumbnail" id="<?= $id ?>">
                        <span style="margin-bottom: 1%;display: none;" title="Editar <?= $name ?>?" value="<?= $name ?>" class="show_edit ed_img btn"><i class="icon-edit"></i></span>
                        <span style="display: none;" value="<?= $id ?>" class="btn show_edit delete_one"><i class="icon-remove"></i></span>
                        <a class="visor" style="margin-bottom: 2%;background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                            <img class="grayscale img_delete" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                        </a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            ?>   
            <div class="resp_del_img"></div>
            <img class="ajax_load" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="display:none;">
            <br /><br />
            <button class="btn show_"><i class="icon-edit"></i> EDITAR DATOS</button> 
            <br /><br />
        </div>
    </div><!--/span-->

</div><!--/row-->