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
<?php if (isset($err_old)) echo '<div class="alert alert-error">La <b>contraseña vieja</b> no coincide.</div>'; ?>
<?php if (isset($err_username)) echo '<div class="alert alert-error">El nombre de usuario <b>' . $err_username . '</b>, ya existe en la base de datos<br>Pruebe con otro nombre.</div>'; ?>
<?php if (isset($err_email)) echo '<div class="alert alert-error">El correo electronico <b>' . $err_email . '</b>, ya existe en la base de datos.</div>'; ?>
<?php if (isset($err_db)) echo '<div class="alert alert-error">Error en la base de datos, rogamos póngase en contacto con el administrador.</div>'; ?>
<?php
if (isset($success))
    echo '<div class="alert alert-success">Datos almacenados satisfactoriamente.</div>'; ?>