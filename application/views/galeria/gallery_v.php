<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> Ver imágenes</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <p class="center">
                <button id="toggle-fullscreen" class="btn btn-large btn-primary visible-desktop" data-toggle="button">Cambiar a pantalla completa</button>
                <br><br>
                <button  class="submit_delete_img btn btn-small btn-warning" >Eliminar imágenes que estén en ON</button>
                <br>
                <img class="ajax_load" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="margin: 0 2% 0 3%;display:none;">
            <div class="resp_del_img" style="position: absolute;"></div>
            </p>
            <br/>              
            <?php
            $con = 0;

            if (isset($categ) && isset($all_category) && $all_category !== 0) {
                foreach ($categ as $array) {
                    echo '<h3>' . $all_category[$con] . '</h3>';
                    echo '<ul class="thumbnails gallery">';
                    $con++;
                    foreach ($array as $categoria) {
                        foreach ($categoria as $key => $valor) {
                            //echo $key . ': ' . $valor . '<br>';
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
                        <li class="thumbnail">
                            <a class="visor" style="background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                                <img class="grayscale" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                            </a>                            
                            <input data-no-uniform="true" name="nameCheckBox" value="<?= $name ?>" class="iphone-toggle check" type="checkbox" >
                        </li>
                        <?php
                    }
                    echo '</ul>';
                }
            } else {
                echo '<p style="text-align:center;color:red;">No hay categorías que contengan imágenes.</p>';
            }

            if (isset($img_sin) && $img_sin !== 0) {
                echo '<h3>Imágenes sin categoría</h3>';
                echo '<ul class="thumbnails gallery">';
                foreach ($img_sin as $array) {
                    foreach ($array as $key => $valor) {
                        //echo $key . ' ' . $valor . '<br>';
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
                    <li class="thumbnail">
                        <a style="margin-bottom: 2%;" class="visor" style="background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                            <img class="grayscale img_delete" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                        </a>
                        <input data-no-uniform="true" name="nameCheckBox" value="<?= $name ?>" class="iphone-toggle check" type="checkbox" >
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            ?>
            </ul>
            <br>
            <div class="resp_del_img" style="position: absolute;"></div>
            <p class="center">              
                <button class="submit_delete_img btn btn-small btn-warning" >Eliminar imágenes que estén en ON</button>
                <br>
                <img class="ajax_load" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="margin: 0 2% 0 3%;display:none;">

            </p>
            <br/>   
        </div>
    </div><!--/span-->

</div><!--/row-->