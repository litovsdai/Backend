<div>
    <ul class="breadcrumb">
        <li>
            <span class="divider">Menu /</span>
        </li>
        <li>
            <a href="#">Escritorio</a><span class="divider">/</span>
        </li>
    </ul>
</div>

<?= validation_errors('<div class="alert alert-error">', '</div>') ?>  

<?php if (isset($nombre_error1)) echo '<br><span class="alert alert-error">El nombre ya existe en la base de datos</span><br><br><br>'; ?>
<?php if (isset($email_error1)) echo '<span class="alert alert-error">El email ya existe en la base de datos</span><br><br><br>'; ?>
<?php if (isset($form_ok)) echo '<span class="alert alert-success">Los datos de usuario se han actualizado satisfactoriamente</span><br><br><br>'; ?>
<?php if (isset($error_db)) echo '<span class="alert alert-error">Error al actualizar los datos</span><br><br><br>'; ?>
<?php if (isset($old)) echo '<span class="alert alert-error">El password antiguo no coincide, por lo tanto los cambios no se han realizado.</span><br><br><br>'; ?>


<?php
if (isset($error))
    echo '<div class="alert alert-error">' . $error . '</div>';
?>
<?php if (isset($err)) echo $err; ?>
<?php if (isset($msj_exit)) { ?>
    <h3>¡La imagen se transfirió correctamente!</h3>
    <div class="alert alert-success"><?= $msj_exit ?></div><br>
<?php } ?>
<?php if (isset($upload_data)) { ?>
    <ul>
        <?php foreach ($upload_data as $item => $value): ?>
            <li><?php echo $item; ?>: <?php echo $value; ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
<?php } ?>
