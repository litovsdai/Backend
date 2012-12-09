<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class B_gallery_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('gallery/gallery_m');
    }

    /*
     * Vista que carga la galeria solo para visualizar
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
     * Vista que carga cuando el menu se subida de imagenes
     */

    public function multi_upload() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo las imágenes sin categoria asociada
            if ($this->gallery_m->all_images_for_category('0') === 0) {
                $data['cero'] = '<strong>Muy bién!</strong> No hay imágenes sin categoría.';
            } else {
                $data['img_sin'] = $this->gallery_m->all_images_for_category('0');
            }

            // Cargo vistas
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_gallery');
            $this->load->view('galeria/multi_upload_v', $data);
            $this->load->view('galeria/img_sin_v', $data);
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    /*
     * Vista que carga el resultado de cuando lo pulsas a subir
     */

    public function multi_upload_start() {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            # Load library
            $this->load->library('image_lib');
            # Recorro todos los FILES que se hallan seleccionado
            for ($i = 1; $i <= count($_FILES); $i++) {
                $campo_temp = 'userfile' . $i;
                // Si no esta vacio el campo
                if (isset($_FILES[$campo_temp]['name']) && !empty($_FILES[$campo_temp]['name'])) {
                    // Elimino todos los posibles puntos i espacios que contenga el nombee  de laimagen
                    $name = $this->elimina_puntos_espacios($_FILES[$campo_temp]['name']);
                    // configuración para el Upload de imágenes
                    $config['upload_path'] = "./img/gallery/"; // la ruta desde la raíz de CI
                    $config['overwrite'] = TRUE;
                    $config['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config['file_name'] = $name;
                    $config['max_size'] = '10000'; // 10 Mb
                    $config['max_width'] = '5000';
                    $config['max_height'] = '5000';
                    $config['remove_spaces'] = TRUE;
                    // Procedo a subir las imágenes
                    $this->upload->initialize($config);
                    // Compruebo si la subida de esta imagen NO ha sido satisfactoria
                    if (!$this->upload->do_upload($campo_temp)) {
                        // Recojo los errores
                        $data['error'][$i] = array('error' => $this->upload->display_errors());
                        $data['error'][$i]['error'] = $name . $data['error'][$i]['error'];
                    } else {// En caso contrario
                        // Recojo los success
                        $data['success'][$i] = array('upload_data' => $this->upload->data());
                        /* Redimensiono la imagen
                         * 800 X 600
                         */
                        if ($this->redimensiona($name, '800', '600')) {// Si es satisfactorio
                            /*
                             * Thumb 145 X  100
                             */
                            if ($this->redimensiona($name, '145', '100')) {// Si es satisfactorio
                                // Recojo el nombre de la imagen
                                $data['ok'][$i] = $name;
                                // Almaceno los datos para Mysql
                                $data['name'] = $name;
                                $data['ruta1'] = base_url() . 'img/gallery/800X600/' . $name;
                                $data['ruta2'] = base_url() . 'img/gallery/145X100/' . $name;
                                // Si la insercion es satisfactoria sigo adelante, si no ya existia a img
                                $this->gallery_m->add_images($data);

                                // Elimino la imagen subida a que no vale y pesa demasiado para lo que quiero hacer con ella
                                @unlink('./img/gallery/' . $name);
                            } else {
                                $data['err_145X100'][$i] = $name;
                            }
                        } else {
                            $data['err_800X600'][$i] = $name;
                        }
                    }
                }
            }

            // Recojo las imágenes sin categoria asociada
            if ($this->gallery_m->all_images_for_category('0') === 0) {
                $data['cero'] = '<strong>Muy bién!</strong> No hay imágenes sin categoría.';
            } else {
                $data['img_sin'] = $this->gallery_m->all_images_for_category('0');
            }
            // Cargo vistas
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_gallery');
            $this->load->view('galeria/multi_upload_v', $data);
            $this->load->view('galeria/img_sin_v', $data);
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    /*
     * Resultado cuando eliminas una imagen
     */

    public function delete_image($name) {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            $this->gallery_m->remove_picture($name);
            // Recojo las imágenes sin categoria asociada
            if ($this->gallery_m->all_images_for_category('0') === 0) {
                $data['cero'] = '<strong>No hay imágenes.</strong>';
            } else {
                $data['img_sin'] = $this->gallery_m->all_images();
            }
            // Dato para el Mensaje
            $data['nom'] = $name;
            // Muestro las vistas del apartado de usuarios
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_show_gallery', $data);
            $this->load->view('galeria/gallery_v', $data);
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    function redimensiona($name, $width, $heigth) {
        // Datos para el config
        $config = array(
            'image_library' => 'gd2',
            'source_image' => './img/gallery/' . $name,
            //'maintain_ratio' => 'TRUE',
            'width' => $width,
            'height' => $heigth,
            'new_image' => './img/gallery/' . $width . 'X' . $heigth . '/' . $name
        );
        // Cargo la libreria que se encargará de redimensionar imágenes
        $this->image_lib->initialize($config);
        // Si NO es satisfactorio
        if (!$this->image_lib->resize()) {
            // Por si a caso elimino los directorios creados
            @unlink('./img/gallery/' . $name);
            @unlink('./img/gallery/' . $width . 'X' . $heigth . '/' . $name);
            return FALSE;
        }
        return TRUE;
    }

    function img_x_cat() {
        // Recojo las imágenes sin categoria asociada
        if ($this->gallery_m->all_images_for_category('0') === 0) {
            $data['cero'] = '<strong>No hay imágenes.</strong>';
        } else {
            $data['img_sin'] = $this->gallery_m->all_images_for_category('0');
        }

        // Recojo todas las categorias en un array 
        $data['categories'] = $this->gallery_m->all_category();
        // Creo un array asociativo con los nombres de las categorias y con todas sus imagenes asociadas
        foreach ($data['categories'] as $value) {
            echo $value;
        }
    }

    function elimina_puntos_espacios($nombre_temp) {
        $name_origin = $nombre_temp;
        // Sustituyo los espacios por "_"
        $name_complet = str_replace(' ', '_', $name_origin);
        // Extraigo la posicion del el ultimo "." de la String
        $pos_extension = strripos($name_complet, '.');
        // Extraigo la posicion del el ultimo "." de la String                 
        $extension = substr($name_complet, $pos_extension, strlen($name_complet));
        // Extraigo nombe actual
        $nombe_actual = substr($name_complet, 0, $pos_extension);
        // Quito los puntos por "_"
        $nombre_sin_puntos = str_replace('.', '_', $nombe_actual);
        // Concateno el nuevo nombre
        $nombre_final = $nombre_sin_puntos . $extension;
        // Asigno el nuevo nombre
        return $nombre_final;
    }

}

/* End of file b_usuario_c.php */
    /* Location: ./application/controllers/b_gallery_c.php */






    