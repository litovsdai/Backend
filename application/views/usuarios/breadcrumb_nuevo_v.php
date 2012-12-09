<div>
    <ul class="breadcrumb">
        <li>
            <span class="divider">Menu /</span>
        </li>
        <li>
            <a href="#">Nuevo usuario</a><span class="divider">/</span>
        </li>
    </ul>
</div>

<?php
if (isset($msg)) {
    echo '<p class="alert alert-success">El usuario ' . $msg . ', se ha eliminado satisfactoriamente.</p>';
}
?>