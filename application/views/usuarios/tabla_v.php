
<div class="row-fluid sortable">

    <div class="box span11">

        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <?= lang('multi_usu_tab_1') ?></h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th><?= lang('multi_usu_tab_2') ?></th>
                        <th><?= lang('multi_usu_tab_3') ?></th>
                        <th><?= lang('multi_usu_tab_4') ?></th>
                        <th><?= lang('multi_usu_tab_5') ?></th>   
                        <th><?= lang('multi_usu_tab_6') ?></th>     
                        <th> <span class="label label-important"><?= lang('multi_usu_tab_7') ?></span></th>
                    </tr>
                </thead>   
                <tbody>   
                    <?php
                    if (isset($array) && !empty($array)) {
                        foreach ($array as $aux1) {
                            ?>
                            <tr>
                                <?php
                                foreach ($aux1 as $aux2 => $valor) {

                                    switch ($aux2) {
                                        case 'id':
                                            $id_user = $valor;
                                            break;
                                        case 'nombre':
                                            echo '<td>' . $valor . '</td>';
                                            $name = $valor;
                                            break;
                                        case 'mail':
                                            echo '<td class="center">' . $valor . '</td>';
                                            break;
                                        case 'avatar':
                                            echo '<td class="center"><img class="" width="42" heigth="28" src="' . $valor . '" alt="img"></td>';
                                            break;
                                        case 'fecha_creacion':
                                            echo '<td class="center">' . $valor . '</td>';
                                            break;
                                        case 'super_user':
                                            $super = $valor;
                                            break;
                                        case 'activo':
                                            if ($super == 0) {
                                                if ($valor === 'si') {
                                                    echo '<td class="center">
                                                            <span class="label label-success">'.lang('multi_usu_tab_8').'</span>
                                                            </td>';
                                                } else {
                                                    echo '<td class="center">
                                                            <span class="label label-warning">'.lang('multi_usu_tab_9').'</span>
                                                            </td>';
                                                }
                                            } else {
                                                echo '<td class="center">
                                                            <span class="label btn-primary">'.lang('multi_usu_tab_10').'</span>
                                                            </td>';
                                            }
                                            break;
                                    }
                                }
                                ?>
                                <td style="text-align: center;" class = "center">

                                    <?php
                                    if ($this->simple_sessions->get_value('super') === '1') {
                                        if ($super == 0) {
                                            ?>
                                            <a class = "btn btn-danger" href = "<?= site_url('backend/usuarios/delete_user'); ?>/<?= $id_user ?>/<?= $name ?>">
                                                <i class = "icon-trash icon-white"></i>                                              
                                            </a>
                                        <?php } ?>
                                    <?php } ?>

                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>            
        </div>
    </div><!--/span-->