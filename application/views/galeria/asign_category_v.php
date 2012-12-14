
<div class="row-fluid sortable">
    <div class="box span8">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> Asignar categorías</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content"> 

            <p class="muted" style="margin-bottom: 0;">
            <div class="alert alert-block ">
                <button class="close" data-dismiss="alert" type="button">
                    ×
                </button>                
                <h4 class="alert-heading">
                    <i class="icon-exclamation-sign"></i>&nbsp;Atención!
                </h4>
                <p>
                    Ponga a 
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
                <div class="resp_cat">
                </div>
                <div class="control-group">                    
                    <div class="controls">
                        <h3>Selecciona categoría</h3><br>
                        <select class="selectError" name="catgeroy" data-rel="chosen">
                            <?php if (isset($categories) && $categories !== 0) { ?>
                                <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                    <option><?= $categories[$i] ?></option>   
                                <?php } ?>
                            <?php } else { ?>
                                <option>No hay categorías</option>
                            <?php } ?>
                        </select>                       
                        <a class="btn btn-small btn-primary comp_check" style="margin: -3% 2% 0 3%;">
                            Asignar categorías
                        </a>
                        <a href="<?= base_url() ?>backend/b_gallery_c/category" style="margin: -3% 2% 0 0;" class="btn btn-small">
                            <i class="icon-refresh"></i>&nbsp;Actualizar cambios
                        </a>  
                        <img class="resp_asig" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="margin: -3% 2% 0 3%;display:none;">
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
                    ?>
<!--                    <div class="control-group">                    
                        <div class="controls">
                            <h3>Selecciona categoría</h3><br>
                            <select class="selectError" name="catgeroy" data-rel="chosen">
                                <?php if (isset($categories) && $categories !== 0) { ?>
                                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                        <option><?= $categories[$i] ?></option>   
                                    <?php } ?>
                                <?php } else { ?>
                                    <option>No hay categorías</option>
                                <?php } ?>
                            </select>                       
                            <a class="btn btn-small btn-primary comp_check" style="margin: -3% 2% 0 3%;">
                                Asignar categorías
                            </a>
                            <a href="<?= base_url() ?>backend/b_gallery_c/category" style="margin: -3% 2% 0 0;" class="btn btn-small">
                                <i class="icon-refresh"></i>&nbsp;Actualizar cambios
                            </a>  
                            <img class="resp_asig" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="margin: -3% 2% 0 3%;display:none;">
                        </div>
                    </div>
                    <div class="resp_cat">
                    </div>-->
                    <?php
                } else {
                    echo '<p style="color:red;text-align: center;">Muy bién! todas las imágenes se encuentran con categorías asociadas.</p>';
                }
                ?>
            </form>
        </div>    
    </div>           