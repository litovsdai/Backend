<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Edit_images extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->load->model('gallery/gallery_m');
    }

    /*
     * ********************************************************************************
     * ********************  Botón del menú EDITAR IMÁGENES   *************************
     * ********************************************************************************
     */

    /*
     * Vista que carga la galería solo para EDITAR imágenes
     */

    public function index() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo las imágenes sin categoria asociada
            $data_all = $this->gallery_m->all_images_for_category('0');
            if ($data_all === '0') {
                $data['img_sin'] = 0;
            } else {
                $data['img_sin'] = $data_all;
            }
            // Recojo todas las categorias en un array 
            $data['categories'] = $this->gallery_m->all_category();
            // Para conservar los datos necesito guardarlo en otro array
            $data['all_category'] = $data['categories'];
            $data['cont'] = 0;
            // Recorro todas las categorias y sustraigo sus imagenes por categoria
            if ($data['categories'] !== 0) {
                foreach ($data['categories'] as $value) {
                    // Creo un array asociativo con los nombres de las categorias y con todas sus imagenes asociadas
                    $temp_array = $this->gallery_m->all_images_for_category($value);
                    if ($temp_array !== 0) {

                        $data['categ'][$data['cont']] = $temp_array;
                        $data['cont']++;
                    }
                }
            }
            // Muestro las vistas del apartado de usuarios
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_show_gallery');
            $this->load->view('galeria/gallery_v', $data);
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    /*
     * Método que gestiona con Ajax y Jquery, la eliminación de una imagen 
     */

    public function delete_image() {
        $data = $this->input->post('activitiesArray');

        if (count($data) > 0 && !empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $nombre = $this->gallery_m->get_name($data[$i]);
                $this->gallery_m->remove_picture($nombre);
                echo '<div class="alert alert-success">La imagen ' . $nombre . ' ha sido eliminada satisfactoriamente.</div>';
            }
        } else {
            echo '<div class="alert alert-error">No ha seleccionado ninguna imagen.</div>';
        }
    }

}

/* End of file b_usuario_c.php */
/* Location: ./application/controllers/b_gallery_c.php */