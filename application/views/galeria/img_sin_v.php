<div class="box span7">
    <div class="box-header well" data-original-title>
        <h2><i class="icon-inbox"></i> Imágenes sin categoría</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">        
        <i class="icon-share-alt"></i>
        <?= anchor('backend/b_gallery_c', 'Asignar categorías a estas imágenes.', array('title' => 'Asignales categorías a la imágenes')) ?>
        <br>
        <?php if (isset($img_sin) && !empty($img_sin)) { ?>
            <?php
            foreach ($img_sin as $array) {
                foreach ($array as $item => $valor) {
                    switch ($item) {
                        case 'name':
                            $name = $valor;
                            break;
                        case 'ruta':
                            $ruta = $valor;
                            break;
                        case 'ruta_thumb':
                            $ruta_thumb = $valor;
                            break;
                        case 'fecha_creacion':
                            $fecha_creacion = $valor;
                            break;
                        case 'padre':
                            $padre = $valor;
                            if ($padre == 0) {
                                $padre = 'Sin categoría';
                            }
                            break;
                    }
                    ?>
                <?php } ?>

                <div id="data">
                    <div class="box-content">
                        <ul class="dashboard-list">
                            <li>
                                <img class="dashboard-avatar" title="<?= $name ?>" alt="<?= $name ?>" src="<?= $ruta_thumb ?>">
                                <strong>Nombre:</strong> <a href="#"> <?= $name ?></a><br>
                                <strong>Fecha de subida:</strong> <a href="#"> <?= $fecha_creacion ?></a><br>
                                <strong>Categoria:</strong> <a href="#"> <?= $padre ?></a><br>
                            </li>
                        </ul>
                </div>
                </data>
                
            <?php } ?>
        <?php } ?>
        <?php if (isset($cero)) { ?>
            <?php echo $cero; ?>
        <?php } ?>
        <div id="ajax_paging">
            <?php echo $paginacion; ?>
        </div>
    </div>
</div><!--/span-->

</div>