<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Multi_upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('image_lib');
        $this->load->model('gallery/gallery_m');
    }

    /*
     * ********************************************************************************
     * ********************  Botón del menú SUBIR IMÁGENES   **************************
     * ********************************************************************************
     */

    /*
     * Vista que carga cuando el Pulsas en subir imágenes
     */

    public function index($start = 0) {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // Recojo las imágenes sin categoria asociada
            $datos['img_sin'] = $this->img_sin();
            // Si esta contiene alguna imagen
            if ($datos['img_sin'] !== 0) {
                // Cargo la configuracion de la paginacion
                $config = $this->pagination($datos['img_sin']);
                // Creo el array donde por porciones enviare las imágens que correspondan
                $data['img_sin'] = array();
                // Recorro el array y recojo la porcion elegida en la confguracion
                for ($i = $start; $i < $start + $config['per_page']; $i++) {
                    // Alamceno en data la porcion de datos
                    $data['img_sin'][] = $datos['img_sin'][$i];
                    // Si se ha llegado al final del array me salgo con "break"
                    if ($i == count($datos['img_sin']) - 1) {
                        break;
                    }
                }
                $this->pagination->initialize($config);
            } else {
                $data['cero'] = '<br>Muy bién, no hay imágenes sin categoría.';
            }
            // Envio los links correspondientes a las vistas
            $data['paginacion'] = $this->pagination->create_links();

            // Cargo vistas
            if (!$this->input->post('ajax')) {
                $this->load->view('includes/head_v');
                $this->load->view('includes/header_v');
                $this->load->view('includes/menu_v');
                $this->load->view('galeria/breadcrumb_gallery');
                $this->load->view('galeria/multi_upload_v', $data);
                $this->load->view('galeria/img_sin_v', $data);
                $this->load->view('includes/footer_v');
            } else if ($this->input->post('ajax')) {
                $this->load->view('galeria/img_sin_v_ajax', $data);
            } else {
                redirect('');
            }
        } else {
            redirect('');
        }
    }

    /*
     * Método que gestiona la subida imágenes, y genera la respuesta a dicha acción
     */

    public function multi_upload_start($start = 0) {
        // Si está iniciada la SESION, mostrara las vistas de la galeria
        if ($this->simple_sessions->get_value('status')) {
            // configuración para el Upload de imágenes
            $config['upload_path'] = "./img/gallery/"; // la ruta desde la raíz de CI
            $config['overwrite'] = TRUE;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['max_size'] = '10000'; // 10 Mb
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';
            $config['remove_spaces'] = TRUE;
            // Procedo a subir las imágenes
            $this->upload->initialize($config);
            // Compruebo si la subida de esta imagen ha sido satisfactoria
            if ($this->upload->do_multi_upload("files")) {
                $datos = array();
                // Recorro los resultados satisfactorios uno a uno
                foreach ($this->upload->get_multi_upload_data() as $values) {
                    foreach ($values as $key => $value) {
                        // Recojo el campo NOMBRE
                        if ($key === 'file_name') {
                            // Añado a un array con los nombres para mostrarlos en la vista
                            array_push($datos, $value);
                            // Genero la redimension 800X600
                            $redimension_800X600 = $this->redimensiona($value, '800', '600');
                            if ($redimension_800X600) {// SUCCESS 800X600
                                // Genero la redimension 145X100
                                $redimension_145X100 = $this->redimensiona($value, '145', '100');
                                if ($redimension_145X100) {// SUCCESS 145X100
                                    // Recojo los datos a incluir en la Database
                                    $data = array(
                                        'name' => $value,
                                        'ruta1' => site_url('img/gallery') . '/800X600/' . $value,
                                        'ruta2' => site_url('img/gallery') . '/145X100/' . $value
                                    );
                                    // Envio los datos
                                    $this->gallery_m->add_images($data);
                                    // Elimino la imagen grande, ya que ocupa mucho
                                    @unlink('./img/gallery/' . $value);
                                } else {// ERROR 145X100
                                    echo 'En la redimensión 145X100 de la imagen ' . $value . '<br>';
                                    print_r($redimension_145X100);
                                }
                            } else {// ERROR 800X600
                                echo 'En la redimensión 800X600  de la imagen ' . $value . '<br>';
                                print_r($redimension_800X600);
                            }
                        }
                        $data ['datos'] = $datos;
                        /* DEVUELVE
                          file_name: 2011-12-31_22.15_.39_.jpg
                          file_type: image/jpeg
                          file_path: /var/www/Backend/img/gallery/
                          full_path: /var/www/Backend/img/gallery/2011-12-31_22.15_.39_.jpg
                          raw_name: 2011-12-31_22.15_.39_
                          orig_name: 2011-12-31_22.15_.39_.jpg
                          client_name: 2011-12-31 22.15_.39_.jpg
                          file_ext: .jpg
                          file_size: 2683.42
                          is_image: 1
                          image_width: 3264
                          image_height: 2448
                          image_type: jpeg
                          image_size_str: width="3264" height="2448"
                         */
                    }
                }
            } else {
                /*
                 * Aunque ocurra algún error, puede haber imágenes que se hallan subido bien
                 */
                $datos = array();
                // Recorro los resultados satisfactorios uno a uno
                foreach ($this->upload->get_multi_upload_data() as $values) {
                    foreach ($values as $key => $value) {
                        // Recojo el campo NOMBRE
                        if ($key === 'file_name') {
                            // Añado a un array los nombres para mostrarlos
                            array_push($datos, $value);
                            // Genero la redimension 800X600
                            $redimension_800X600 = $this->redimensiona($value, '800', '600');
                            if ($redimension_800X600) {// SUCCESS 800X600
                                // Genero la redimension 145X100
                                $redimension_145X100 = $this->redimensiona($value, '145', '100');
                                if ($redimension_145X100) {// SUCCESS 145X100
                                    // Recojo los datos a incluir en la Database
                                    $data = array(
                                        'name' => $value,
                                        'ruta1' => site_url('img/gallery') . '/800X600/' . $value,
                                        'ruta2' => site_url('img/gallery') . '/145X100/' . $value
                                    );
                                    // Envio los datos
                                    $this->gallery_m->add_images($data);
                                    // Elimino la imagen grande, ya que ocupa mucho
                                    @unlink('./img/gallery/' . $value);
                                } else {// ERROR 145X100
                                    echo 'En la redimension 145X100 de la imagen ' . $value . '<br>';
                                    print_r($redimension_145X100);
                                }
                            } else {// ERROR 800X600
                                echo 'En la redimension 800X600  de la imagen ' . $value . '<br>';
                                print_r($redimension_800X600);
                            }
                        }
                    }
                }
                $data ['datos'] = $datos;
                // Errors
                $data['error_images'] = $this->upload->display_errors();
            }
        }
        /**
         * PAGINACIÓN + RECOGIDA IMÁGENES SIN CATEGORIA
         */
        // Recojo las imágenes sin categoria asociada, en caso de no haber imágenes devuelve 0
        $datos['img_sin'] = $this->img_sin();
        // Si esta contiene alguna imagen
        if ($datos['img_sin'] !== 0) {
            // Cargo la configuracion de la paginacion
            $config = $this->pagination($datos['img_sin']);
            // Creo el array donde por porciones enviare las imágenes que correspondan
            $data['img_sin'] = array();
            // Recorro el array y recojo la porcion elegida en la confguracion
            for ($i = $start; $i < $start + $config['per_page']; $i++) {
                // Almaceno en data la porcion de datos
                $data['img_sin'][] = $datos['img_sin'][$i];
                // Si se ha llegado al final del array me salgo con "break"
                if ($i == count($datos['img_sin']) - 1) {
                    break;
                }
            }
            $this->pagination->initialize($config);
        } else {
            $data['cero'] = '<br>Muy bién, no hay imágenes sin categoría.';
        }
        // Envio los links correspondientes a las vistas
        $data['paginacion'] = $this->pagination->create_links();

        // Cargo vistas
        if (!$this->input->post('ajax')) {
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('galeria/breadcrumb_gallery');
            $this->load->view('galeria/multi_upload_v', $data);
            $this->load->view('galeria/img_sin_v', $data);
            $this->load->view('includes/footer_v');
        } else if ($this->input->post('ajax')) {
            $this->load->view('galeria/img_sin_v_ajax', $data);
        } else {
            redirect('');
        }
    }

    /*
     * ********************************************************************************
     *  METODOS Y FUNCIONES INTERNAS Y PRIVADAS SOLO UTILIZADAS EN ESTE CONTROLADOR  *
     * ********************************************************************************
     */

    function redimensiona($name, $width, $heigth) {
        // Datos para el config
        $config = array(
            'image_library' => 'gd2',
            'source_image' => './img/gallery/' . $name,
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
            return $this->image_lib->display_errors();
        }
        return TRUE;
    }

    function img_sin() {
        // Recojo las imágenes sin categoria asociada
        if ($this->gallery_m->all_images_for_category('0') === 0) {
            return 0;
        } else {
            $img_sin = $this->gallery_m->all_images_for_category('0');
            return $img_sin;
        }
    }

    function pagination($array) {
        $config['base_url'] = base_url() . 'backend/multi_upload';
        $config['total_rows'] = count($array);
        $config['per_page'] = '3';
        $config['uri_segment'] = '4';
        // El texto que le gustaría que se muestre en el "primer" enlace de la izquierda.
        $config['first_link'] = '';
        // El texto que le gustaría que se muestre en el "último" enlace de la derecha.
        $config['last_link'] = '';
        // El texto que le gustaría que se muestre en el enlace de página "siguiente".
        $config['next_link'] = '&rarr;';
        // El texto que le gustaría que se muestre en el enlace de página "anterior".
        $config['prev_link'] = '&larr;';
        return $config;
    }

}

/* End of file b_usuario_c.php */
/* Location: ./application/controllers/b_gallery_c.php */