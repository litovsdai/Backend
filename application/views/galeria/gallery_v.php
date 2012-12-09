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
                        if($padre==='0'){
                            $padre='Sin categoría';
                        }
                    }
                    ?>
                    <li class="thumbnail">
                        <a class="visor" style="background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                            <img class="grayscale" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                        </a>
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            ?>
            </ul>
        </div>
    </div><!--/span-->

</div><!--/row-->