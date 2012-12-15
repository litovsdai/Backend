
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
            <br>
            <p class="muted" style="margin-bottom: 0;">
            <div id="delete" class="alert alert-block">
                <button class="close" data-dismiss="alert" type="button">
                    ×
                </button>  
                <p>
                    <i class="icon-exclamation-sign"></i>&nbsp;Atención! Ponga a 
                    <a href="#" data-rel="tooltip" data-original-title="Sólo las imágenes a las que le desee asignarles categoría">
                        ON
                    </a> 
                    las imágenes que desee asignarles una categoría, de lo contario póngalas a <a href="#" data-rel="tooltip" data-original-title="Las que no desee asignarles categoría.">
                        OFF
                    </a> 
                    para no asignarles categoría.
                </p>
            </div>
            <form method="POST">
                <div class="control-group">                    
                    <div  class="controls">
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
                        <img class="resp_asig" src="<?= base_url() ?>img/ajax-loaders/loader2.gif" style="margin: -3% 2% 0 3%;display:none;">

                    </div>
                    <div class="resp_cat">
                    </div>
                </div> 
                <?php if (isset($img_sin) && !empty($img_sin)) { ?>
                    <h4>Imágenes sin categoría</h4><br><br>
                    <ul class="thumbnails gallery" id="refresh">
                        <?php
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
                        <?php }
                        ?>
                    </ul>
                    <?php
                } else {
                    echo '<p style="color:red;text-align: center;">Muy bién! todas las imágenes se encuentran con categorías asociadas.</p>';
                }
                ?>
            </form>
        </div>    
    </div>           