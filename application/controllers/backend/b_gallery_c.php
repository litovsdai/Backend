<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class B_gallery_c extends CI_Controller {

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

    public function multi_upload($start = 0) {
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
                        /*
                         * 800 X 600
                         */
                        $size_width_1 = '800';
                        $size_heigth_1 = '600';
                        if ($this->redimensiona($name, $size_width_1, $size_heigth_1)) {// Si es satisfactorio
                            /*
                             * Thumb 145 X  100
                             */
                            $size_width_2 = '145';
                            $size_heigth_2 = '100';
                            if ($this->redimensiona($name, $size_width_2, $size_heigth_2)) {// Si es satisfactorio
                                // Recojo el nombre de la imagen
                                $data['ok'][$i] = $name;
                                // Almaceno los datos para Mysql
                                $data['name'] = $name;
                                $data['ruta1'] = base_url() . 'img/gallery/' . $size_width_1 . 'X' . $size_heigth_1 . '/' . $name;
                                $data['ruta2'] = base_url() . 'img/gallery/' . $size_width_2 . 'X' . $size_heigth_2 . '/' . $name;
                                // Si la insercion es satisfactoria sigo adelante, si no ya existia a img
                                $this->gallery_m->add_images($data);
                                // Elimino la imagen subida a que no vale y pesa demasiado para lo que quiero hacer con ella
                                @unlink('./img/gallery/' . $name);
                                // Recojo los success
                                $data['success'][$i] = array('upload_data' => $this->upload->data());
                            } else {
                                $data['err_145X100'][$i] = 'Error en transformación 145X100 en imagen ' . $name;
                            }
                        } else {
                            $data['err_800X600'][$i] = 'Error en transformación 800X600 en imagen ' . $name;
                        }
                    }
                }
            }
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

    /*
     * ********************************************************************************
     * ***********************  Botón del menú CATEGORÍAS   ***************************
     * ********************************************************************************
     */

    /*
     * Vista de nuevas categorías y eliminar categorías
     */

    public function category() {
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
    }

    /*
     *  Método llamado por Jquery y Ajax, que crea una nueva categoría
     */

    public function new_category() {
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
    }

    /*
     *  Método llamado por Jquery y Ajax que asigna categorías a las imágenes seleccionadas
     */

    public function asign_category() {
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
    }

    /*
     * Controlador que refresca la lista de ASIGNACIÓN después de agregar una nueva categoría, con Ajax
     */

    public function refresh_list() {
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
    }

    /*
     * Controlador que refresca el contenido del listado de categorias a ELIMINAR
     */

    public function refresh_delete() {
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
    }

    /*
     * Controlador que elimina categoría + imágenes que contenga 
     */

    public function delete_category() {
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
            echo $this->image_lib->display_errors();
            // Por si a caso elimino los directorios creados
            @unlink('./img/gallery/' . $name);
            @unlink('./img/gallery/' . $width . 'X' . $heigth . '/' . $name);
            return FALSE;
        }
        return TRUE;
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

    function img_sin() {
        // Recojo las imágenes sin categoria asociada
        if ($this->gallery_m->all_images_for_category('0') === 0) {
            $cero = '<strong>Muy bién!</strong> No hay imágenes sin categoría.';
            return 0;
        } else {
            $img_sin = $this->gallery_m->all_images_for_category('0');
            return $img_sin;
        }
    }

    function pagination($array) {
        $config['base_url'] = base_url() . 'backend/b_gallery_c/multi_upload';
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