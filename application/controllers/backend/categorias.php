<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->load->model('gallery/gallery_m');
    }

    /*
     * ********************************************************************************
     * ***********************  Botón del menú CATEGORÍAS   ***************************
     * ********************************************************************************
     */

    /*
     * Vista de nuevas categorías y eliminar categorías
     */

    public function index() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo las imágenes sin categoria asociada
            $data_all = $this->gallery_m->all_images_for_category('0');
            if ($data_all === '0') {
                $data['sin'] = 0;
            } else {
                $data['img_sin'] = $data_all;
            }
            // Recojo todas las categorias en un array 
            $data['categories'] = $this->gallery_m->all_categories();
            // Cargo vistas
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_category_v');
            $this->load->view('galeria/asign_category_v', $data);
            $this->load->view('galeria/create_new_category_v');
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    /*
     *  Método llamado por Jquery y Ajax, que crea una nueva categoría
     */

    public function new_category() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            $name = $this->input->post('name');
            if (!empty($name)) {
                $data = array('name' => $this->input->post('name'));
                $result = $this->gallery_m->set_category($data);

                if ($result) {
                    echo '<div class="alert alert-success">Categoría <b>' . $name . '</b> almacenada satisfactoriamente.</div>';
                } else if (!$result) {
                    echo '<div class="alert alert-error">La categoría <b>' . $name . '</b> ya existe en la base de datos.</div>';
                } else {
                    echo '<div class="alert alert-error"><b>Error</b> al insertar los datos en la base de datos.</div>';
                }
            } else {
                echo '<div class="alert alert-error">Debe rellenar el campo <b>"Nombre"</b>.</div>';
            }
        } else {
            redirect('');
        }
    }

    /*
     *  Método llamado por Jquery y Ajax que asigna categorías a las imágenes seleccionadas
     */

    public function asign_category() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            $data = $this->input->post('activitiesArray');
            $msg = '';
            if (count($data) > 1 && $data[0] !== 'No hay categorías' && !empty($data[0])) {
                for ($i = 1; $i < count($data); $i++) {
                    $result = $this->gallery_m->asign_categ($data[$i], $data[0]);
                    if ($result !== TRUE) {
                        $errores[] = 'Error al asignar categoría a la imagen <b>' . $result . '</b>.';
                    } else {
                        $success[] = 'Imagen ' . $this->gallery_m->get_name($data[$i]) . '.';
                    }
                }
                if (isset($errores) && count($errores) > 0) {
                    $err = '';
                    $err += '<div class="alert alert-error"><ul>';
                    for ($j = 0; $j < count($errores); $j++) {
                        $err += '<li>' . $errores[$j] . '</li>';
                    }
                    $err+='</ul></div>';
                    if ($err !== 0) {
                        echo $err;
                    }
                } else {
                    $msg .= '<div class="alert alert-success">Las siguientes imagen/es han sido asignada/s a la categoría <b>' . $data[0] . '</b> satisfactoriamente.<ul>';
                    for ($i = 0; $i < count($success); $i++) {
                        $msg .= '<li><b>' . $success[$i] . '</b></li>';
                    }
                    $msg.= '</ul></div>';
                    echo $msg;
                }
            } else if ($data[0] === '') {
                echo '<div class="alert alert-error">No ha <b>seleccionado</b> ninguna categoría.</div>';
            } else {
                echo '<div class="alert alert-error">Debe <b>seleccionar</b> alguna imagen.</div>';
            }
        } else {
            redirect('');
        }
    }

    /*
     * Controlador que refresca la lista de ASIGNACIÓN después de agregar una nueva categoría, con Ajax
     */

    public function refresh_list() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo todas las categorias en un array 
            $msg = '';
            $categories = $this->gallery_m->all_categories();

            $msg.= '<select class="selectError" name="catgeroy" data-rel="chosen">';
            if (isset($categories) && $categories !== 0) {
                for ($i = 0; $i < count($categories); $i++) {
                    $msg.= '<option>' . $categories[$i] . '</option>';
                }
            } else {
                $msg.= ' <option>No hay categorías</option>';
            }
            $msg .= '</select>';
            $msg .=$this->load->view('includes/all_dom', "", TRUE);

            echo $msg;
        } else {
            redirect('');
        }
    }

    /*
     * Controlador que refresca el contenido del listado de categorias a ELIMINAR
     */

    public function refresh_delete() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo todas las categorias en un array 
            $msg = '';
            $categories = $this->gallery_m->all_categories();
            $msg.='<select id="sel" class="selectError1" name="delete_cats[]" multiple="multiple" data-rel="chosen">';
            if (isset($categories) && $categories !== 0) {
                for ($i = 0; $i < count($categories); $i++) {
                    $msg .='<option value="' . $categories[$i] . '">' . $categories[$i] . '</option>';
                }
            } else {
                $msg .='<option>No hay categorías</option>';
            }
            $msg .='</select>';
            $msg .=$this->load->view('includes/all_dom', "", TRUE);
            echo $msg;
        } else {
            redirect('');
        }
    }

    /*
     * Controlador que elimina categoría + imágenes que contenga 
     */

    public function delete_category() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            $data = $this->input->post('activitiesArray');
            /*
             *  Recojo los nombres de las imágenes que tengan como padre el
             *  nombre de la categoria a eliminar.. para eliminarlas
             */
            $nombres_delete = array();
            if (count($data) > 0 && !empty($data)) {
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i] !== 'No hay categorías') {
                        $nombres_delete[$i] = $this->gallery_m->list_img_for_cat($data[$i]);
                        $this->gallery_m->remove_cat($data[$i]);
                    }
                }
                foreach ($nombres_delete as $val) {
                    if (count($val) > 0 && !empty($val)) {
                        foreach ($val as $datos) {
                            foreach ($datos as $key => $value) {
                                if ($key === 'name') {
                                    $this->gallery_m->remove_picture($value);
                                }
                                if ($key === 'ruta') {
                                    @unlink($value);
                                }
                                if ($key === 'ruta_thumb') {
                                    @unlink($value);
                                }
                            }
                        }
                    }
                }
                $resp = '<div class="alert alert-success">';
                for ($i = 0; $i < count($data); $i++) {
                    $resp .= 'Categoría <b>' . $data[$i] . '</b> eliminada satisfactoriamente.<br>';
                }
                $resp .= '</div>';
                echo $resp;
            } else {
                echo '<div class="alert alert-error">No ha seleccionado ninguna categoría.</div>';
            }
        } else {
            redirect('');
        }
    }

}

/* End of file b_usuario_c.php */
/* Location: ./application/controllers/b_gallery_c.php */