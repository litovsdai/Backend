<?php
if (isset($nombre) && isset($email) && isset($fecha_creacion) && isset($avatar)) {
    ?>
    <div class="box span4">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-eye-open"></i> Ver usuario</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <ul class="dashboard-list">
                <li>

                    <img class="dashboard-avatar" title="<?= $nombre ?>" alt="<?= $nombre ?>" src="<?=$avatar?>">

                    <strong>Nombre:</strong> <a href="#"> <?= $nombre ?></a><br>
                    <strong>Correo:</strong> <?= $email ?><br>
                    <strong>Desde:</strong> <?= $fecha_creacion ?><br>                                  
                </li>
            </ul>
        </div>
    </div><!--/span-->

    </div>
    <?php
}
?>