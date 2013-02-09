<div class="container-fluid">
    <div class="row-fluid">
        <!-- left menu starts -->
        <div class="span2 main-menu-span">
            <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li class="nav-header hidden-tablet">Menu</li>
                    <li>
                        <a class="ajax-link" href="<?= site_url('backend/escritorio') ?>">
                            <i class="icon-home"></i>
                            <span class="hidden-tablet"> <?=lang('multi_escritorio_breadcrumb')?></span>
                        </a>
                    </li>
                    <li class="nav-header hidden-tablet"><?=lang('multi_menuIzq_usuarios')?></li>
                    <?php if ($this->simple_sessions->get_value('super') === '1') { ?>
                        <li>
                            <a class="ajax-link" href="<?= site_url('backend/usuarios/almacenar_nuevo') ?>">
                                <i class="icon-plus"></i>
                                <span class="hidden-tablet"> <?=lang('multi_menuIzq_nuevo')?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="ajax-link" href="<?= site_url('backend/usuarios') ?>">
                        <i class="icon-user"></i>
                        <span class="hidden-tablet"> <?=lang('multi_menuIzq_ver')?></span>
                    </a>
                </li>
                    <li class="nav-header hidden-tablet"><?=lang('multi_menuIzq_galeria')?></li>
                    <li>
                        <a class="ajax-link" href="<?= site_url('backend/multi_upload') ?>">
                            <i class="icon-camera"></i>
                            <span class="hidden-tablet"> <?=lang('multi_menuIzq_subir')?></span>
                        </a>
                    </li>
                    <li>
                        <a class="ajax-link" href="<?= site_url('backend/edit_images') ?>">
                            <i class="icon-picture"></i>
                            <span class="hidden-tablet"> <?=lang('multi_menuIzq_edit')?></span>
                        </a>
                    </li>
                    <li>
                        <a class="ajax-link" href="<?= site_url('backend/categorias') ?>">
                            <i class="icon-tags"></i>
                            <span class="hidden-tablet"> <?=lang('multi_menuIzq_categ')?></span>
                        </a>
                    </li>
                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <!-- left menu ends -->

        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Warning!</h4>
            <p>Required <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> for website.</p>
        </div>
        </noscript>

        <div id="content" class="span10">
            <!-- content starts -->
