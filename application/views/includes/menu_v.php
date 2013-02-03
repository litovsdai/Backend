<div class="container-fluid">
    <div class="row-fluid">

        <!-- left menu starts -->
        <div class="span2 main-menu-span">
            <div class="well nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li class="nav-header hidden-tablet">Menu</li>
                    <li>
                        <a class="ajax-link" href="<?= base_url() ?>backend/escritorio/">
                            <i class="icon-home"></i>
                            <span class="hidden-tablet"> Escritorio</span>
                        </a>
                    </li>
                    <li class="nav-header hidden-tablet">Usuarios</li>
                    <?php if ($this->simple_sessions->get_value('super') === '1') { ?>
                        <li>
                            <a class="ajax-link" href="<?= base_url() ?>backend/usuarios/almacenar_nuevo">
                                <i class="icon-plus"></i>
                                <span class="hidden-tablet"> Nuevo usuario</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a class="ajax-link" href="<?= base_url() ?>backend/usuarios/nuevo_administrador">
                        <i class="icon-user"></i>
                        <span class="hidden-tablet"> Ver usuarios</span>
                    </a>
                </li>
                    <li class="nav-header hidden-tablet">Galería</li>
                    <li>
                        <a class="ajax-link" href="<?= base_url() ?>backend/multi_upload">
                            <i class="icon-camera"></i>
                            <span class="hidden-tablet"> Subir imágenes</span>
                        </a>
                    </li>
                    <li>
                        <a class="ajax-link" href="<?= base_url() ?>backend/edit_images">
                            <i class="icon-picture"></i>
                            <span class="hidden-tablet"> Editar imágenes</span>
                        </a>
                    </li>
                    <li>
                        <a class="ajax-link" href="<?= base_url() ?>backend/categorias">
                            <i class="icon-tags"></i>
                            <span class="hidden-tablet"> Categorías</span>
                        </a>
                    </li>
                </ul>
            </div><!--/.well -->
        </div><!--/span-->
        <!-- left menu ends -->

        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Atención!</h4>
            <p>Usted necesita <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> para que funcione el sitio.</p>
        </div>
        </noscript>

        <div id="content" class="span10">
            <!-- content starts -->
