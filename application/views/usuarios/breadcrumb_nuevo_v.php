<div>
    <ul class="breadcrumb">
        <li>
            <span class="divider">Menu /</span>
        </li>
        <li>
            <a href="#"><?= lang('multi_menuIzq_nuevo') ?></a><span class="divider">/</span>
        </li>
    </ul>
</div>

<?php
if (isset($msg)) {
    echo '<p class="alert alert-success">' . lang('multi_usu_bread_1', $msg) . '</p>';
}
?>