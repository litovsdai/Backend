<div>
    <ul class="breadcrumb">
        <li>
            <span class="divider">Menu /</span>
        </li>
        <li>
            <a href="#"> <?= lang('multi_edit_img_1') ?></a><span class="divider">/</span>
        </li>
    </ul>
</div>
<?php
if (isset($nom)) {
    echo '<p class="alert alert-success">' . lang('multi_edit_img_2', $nom) . '</p>';
}
?>