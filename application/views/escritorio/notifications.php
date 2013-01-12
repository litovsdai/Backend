
<div class="sortable row-fluid">
    <a data-rel="tooltip" title="<?= $last_month ?> nuevos miembros este último mes." class="well span4 top-block" href="<?= site_url('backend/b_usuario_c/nuevo_administrador') ?>">
        <span class="icon32 icon-red icon-user"></span>
        <div>Miembros totales</div>
        <div><?= $totales ?></div>
        <?php if ($last_month > 0) { ?>
            <span class="notification red"><?= $last_month ?></span>
        <?php } ?>
    </a>

    <a data-rel="tooltip" title="<?= $total_pro ?> miembros pro." class="well span4 top-block" href="#">
        <span class="icon32 icon-color icon-star-on"></span>
        <div>Miembros pro</div>
        <div><?= $total_pro ?></div>
    </a>
    <a data-rel="tooltip" title="<?= $total_pictures ?> imágenes nuevas de este mes" class="well span4 top-block" href="<?= base_url() ?>backend/b_gallery_c">
        <span class="icon32 icon-color icon-image"></span>
        <div>Imágenes</div>
        <div><?= $total_pictures ?></div>
        <?php if ($last_month_pic > 0) { ?>
            <span class="notification yellow"><?= $last_month_pic ?></span>
        <?php } ?>
    </a>
</div>