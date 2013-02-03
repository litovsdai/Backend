
<div class="sortable row-fluid">
    <a data-rel="tooltip" title="<?= $last_month ?> <?= lang('multi_escritorio_notif_tooltip1') ?>" class="well span4 top-block" href="<?= site_url('backend/usuarios') ?>">
        <span class="icon32 icon-red icon-user"></span>
        <div><?= lang('multi_escritorio_notif_text1'); ?></div>
        <div><?= $totales ?></div>
        <?php if ($last_month > 0) { ?>
            <span class="notification red"><?= $last_month ?></span>
        <?php } ?>
    </a>

    <a data-rel="tooltip" title="<?= $total_pro ?> <?= lang('multi_escritorio_notif_tooltip2') ?>" class="well span4 top-block" href="#">
        <span class="icon32 icon-color icon-star-on"></span>
        <div><?= lang('multi_escritorio_notif_text2') ?></div>
        <div><?= $total_pro ?></div>
    </a>
    <a data-rel="tooltip" title="<?= $last_month_pic ?> <?= lang('multi_escritorio_notif_tooltip3') ?>" class="well span4 top-block" href="<?= site_url('backend/edit_images') ?>">
        <span class="icon32 icon-color icon-image"></span>
        <div><?= lang('multi_escritorio_notif_text3') ?></div>
        <div><?= $total_pictures ?></div>
        <?php if ($last_month_pic > 0) { ?>
            <span class="notification yellow"><?= $last_month_pic ?></span>
        <?php } ?>
    </a>
</div>