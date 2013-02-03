
<div class="row-fluid sortable">

    <div class="box span8">

        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Miembros</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de registro</th>   
                        <th>Estado</th>                     
                        <th>Acciones</th>
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
                                        case 'fecha_creacion':
                                            echo '<td class="center">' . $valor . '</td>';
                                            break;
                                        case 'activo':
                                            if($valor==='si'){
                                                echo '<td class="center">
                                                            <span class="label label-success">Activo</span>
                                                            </td>';
                                            }else{
                                                echo '<td class="center">
                                                            <span class="label label-warning">Pendiente</span>
                                                            </td>';
                                            }
                                            break;
                                    }
                                }
                                ?>
                                <td class = "center">
                                    <a class="btn btn-info" href="<?= base_url(); ?>backend/usuarios/ver/<?= $id_user ?>">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        Ver                                            
                                    </a>
                                    <?php
                                    if ($this->simple_sessions->get_value('super') === '1') {
                                        ?>
                                        <a class = "btn btn-danger" href = "<?= base_url(); ?>backend/usuarios/delete_user/<?= $id_user ?>/<?= $name ?>">
                                            <i class = "icon-trash icon-white"></i>
                                            Eliminar
                                        </a>
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