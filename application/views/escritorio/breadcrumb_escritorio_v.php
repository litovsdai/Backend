<div>
    <ul class="breadcrumb">
        <li>
            <span class="divider">Menu /</span>
        </li>
        <li>
            <a href="#"><?= lang('multi_escritorio_breadcrumb') ?></a><span class="divider">/</span>
        </li>
    </ul>
</div>
<div class="alert-error" style="border-radius: 5px;margin-bottom: 10px;">
    <?= validation_errors() ?>
</div>
<?php
if (isset($error))
    echo '<div class="alert alert-error">' . $error . '</div>';
?>
<?php if (isset($msj_exit)) { ?>

    <div class="alert alert-success">
        <h4>¡<?= lang('multi_escritorio_avatar_success1') ?>!</h4>
        <p><?= lang('multi_escritorio_avatar_success2') ?> <?= $msj_exit ?></p>
    </div>
    <br>
<?php } ?>
<?php if (isset($err_old)) echo '<div class="alert alert-error">' . lang('multi_escritorio_err_1') . '.</div>'; ?>
<?php if (isset($err_username)) echo '<div class="alert alert-error">' . lang('multi_escritorio_err_2', $err_username) . ' </div>'; ?>
<?php if (isset($err_email)) echo '<div class="alert alert-error">' . lang('multi_escritorio_err_3', $err_email) . '</div>'; ?>
<?php if (isset($err_db)) echo '<div class="alert alert-error">' . lang('multi_escritorio_err_4') . '</div>'; ?>
<?php
if (isset($success)) echo '<div class="alert alert-success">' . lang('multi_escritorio_succ_5') . '</div>'; ?>