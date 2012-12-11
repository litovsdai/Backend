<div class="row-fluid sortable">

    <div class="box span12">

        <div class="box-content">  
            <div class="tooltip-demo well">
                <p class="muted" style="margin-bottom: 0;">
                    <i class="icon-warning-sign"></i>&nbsp;&nbsp;Ponga a 
                    <a href="#" data-rel="tooltip" data-original-title="Sólo las imágenes a las que le desee asignarles categoría">
                        ON
                    </a> 
                    las imágenes que desee asignarles una categoría, y seleccione la categoría deseada, sólo una categoría por grupo de imágenes.
                </p>
            </div>
            <div class="control-group">
                <h4>Selecciona categoría</h4>
                <div class="controls">
                    <select id="selectError" data-rel="chosen">
                        <?php if (isset($categories) && $categories !== 0) { ?>
                            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                <option><?= $categories[$i] ?></option>   
                            <?php } ?>
                        <?php } else { ?>
                            <option>No hay categorías</option>
                        <?php } ?>
                    </select>
                    <input type="submit" class="btn btn-large btn-primary" style="margin-left: 8%;margin-top: -2%;" value="Asignar categorías">                        
                </div>
            </div>
            <br>
            <?php
            if (isset($img_sin) && $img_sin !== 0) {
                echo '<h4>Imágenes sin categoría</h4>';
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
                        <a class="visor" style="margin-bottom: 5px;background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                            <img class="grayscale" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                        </a>
                        <input data-no-uniform="true" type="checkbox" name="" class="iphone-toggle">
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            ?>
            </ul>
        </div>                   
    </div>
</div><!--/span-->
</div><!--/row-->