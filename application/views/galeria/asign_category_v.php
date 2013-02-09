
<div class="row-fluid sortable">
    <div class="box span8">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-th-list"></i> <?= lang('multi_asign_cat_img_1') ?></h2>
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
                    <i class="icon-exclamation-sign"></i>&nbsp;<?= lang('multi_asign_cat_img_2') ?>
                    <a href="#" data-rel="tooltip" data-original-title="<?= lang('multi_asign_cat_img_3_tooltip') ?>">
                        ON
                    </a> 
                    <?= lang('multi_asign_cat_img_4') ?> <a href="#" data-rel="tooltip" data-original-title="<?= lang('multi_asign_cat_img_5_tooltip') ?>.">
                        OFF
                    </a> 
                    <?=lang('multi_asign_cat_img_6')?>
                </p>
            </div>
            <form method="POST">
                <div class="control-group">                    
                    <div  class="controls">
                        <h3><?=lang('multi_asign_cat_img_7')?></h3><br>
                        <span id="refresh_list">
                            <select id="list_cat" class="selectError" name="catgeroy" data-rel="chosen">
                                <?php if (isset($categories) && $categories != 0) { ?>
                                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                                        <option><?= $categories[$i] ?></option>   
                                    <?php } ?>
                                <?php } else { ?>
                                    <option></option>
                                <?php } ?>
                            </select>    
                        </span>
                        <a class="btn btn-small btn-primary comp_check" style="margin: -1% 2% 0 3%;">
                            <?=lang('multi_asign_cat_img_1')?>
                        </a>
                        <img class="resp_asig" src="<?= base_url() ?>img/ajax-loaders/load-indicator.gif" style="margin: -1% 2% 0 3%;display:none;">

                    </div>
                    <br>
                    <div class="resp_cat">
                    </div>
                </div> 
                <?php if (isset($img_sin) && !empty($img_sin)) { ?>
                    <h4 id="tile"><?=lang('multi_asign_cat_img_8')?></h4><br><br>
                    <div id="containerdiv">
                        <ul class="thumbnails gallery" id="refresh">
                            <?php
                            foreach ($img_sin as $array) {
                                foreach ($array as $key => $valor) {
                                    //echo $key . ' ' . $valor . '<br>';
                                    if ($key === 'id') {
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
                                <li class="thumbnail" id="<?= $id ?>" style="display: block;">
                                    <a class="visor" style="margin-bottom: 5px;background:url(<?= $ruta_thumb ?>)" title="<?= $padre . ' / ' . $name ?>" href="<?= $ruta ?>">
                                        <img class="grayscale" src="<?= $ruta_thumb ?>" alt="<?= $name ?>">
                                    </a>
                                    <input data-no-uniform="true" name="nameCheckBox" value="<?= $id ?>" class="iphone-toggle check" checked type="checkbox" >
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <?php
                } else {
                    echo '<p style="color:tomato;text-align: center;">'.lang('multi_asign_cat_img_9').'</p>';
                }
                ?>
            </form>
        </div>    
    </div>           