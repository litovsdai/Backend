
<div class="row-fluid sortable">
    <div class="box span8">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-picture"></i> Asignar categorías</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">  
            <div class="tooltip-demo well">
                <p class="muted" style="margin-bottom: 0;">
                    <i class="icon-warning-sign"></i>&nbsp;&nbsp;Ponga a 
                    <a href="#" data-rel="tooltip" data-original-title="Sólo las imágenes a las que le desee asignarles categoría">
                        ON
                    </a> 
                    las imágenes que desee asignarles una categoría, y seleccione la categoría deseada, sólo una categoría por grupo de imágenes,
                    y ponga a <a href="#" data-rel="tooltip" data-original-title="Sólo las imágenes a las que NO desee asignarles categoría">
                        OFF
                    </a> 
                    las imágenes que no desee asignarles categoría.
                </p>
            </div>

            <form method="POST">
                <div class="control-group">                    
                    <div class="controls">
                        <h3>Selecciona categoría</h3><br>
                        <select id="selectError" name="catgeroy" data-rel="chosen">
                            <?php if (isset($categories) && $categories !== 0) { ?>
                                <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                    <option><?= $categories[$i] ?></option>   
                                <?php } ?>
                            <?php } else { ?>
                                <option>No hay categorías</option>
                            <?php } ?>
                        </select>
                        <button class="btn btn-large btn-primary" id="comp_check" style="margin: -2% 20% 0 3%;">
                            Asignar categorías
                        </button>
                    </div>
                </div>
                <br>

                <?php
                if (isset($img_sin) && !empty($img_sin)) {
                    echo '<h4>Imágenes sin categoría</h4><br>';
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
                            <input data-no-uniform="true" name="nameCheckBox" value="<?= $name ?>" class="iphone-toggle check" checked type="checkbox" >
                        </li>
                        <?php
                    }
                    echo '</ul>';
                } else {
                    echo '<p style="color:red;text-align: center;">Muy bién! todas las imágenes se encuentran con categorías asociadas.</p>';
                }
                ?>
            </form>
        </div>    
    </div>           