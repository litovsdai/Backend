
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuarios/usuarios_m');
        $this->load->model('gallery/gallery_m');
    }

    function do_upload() {
        // Si está iniciada la SESION, mostrara las vistas del BACKEND
        if ($this->simple_sessions->get_value('status')) {
            $config['upload_path'] = './img/avatares/';
            $config['overwrite'] = TRUE;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['max_size'] = '2048';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            // Cambio el nombre de la imagen
            $pos = strripos($_FILES['userfile']['name'], '.');
            $format = substr($_FILES['userfile']['name'], $pos, strlen($_FILES['userfile']['name']));
            $name = $this->simple_sessions->get_value('id') . $format;
            $_FILES['userfile']['name'] = $name;
            // Ejecuto la accion e subir
            $this->upload->initialize($config);

            // Recojo los datos que genera la subida de imagen, ya sea error o mensaje OK
            if (!$this->upload->do_upload()) {
                // Recojo los datos de suceso ERROR
                $data = array('error' => $this->upload->display_errors());
            } else {
                // Recojo los datos de suceso OK
                $data = array('upload_data' => $this->upload->data());
                // Manipulo lo datos recibidos, para crearle un nombre y ruta
                $data['upload_data']['client_name'] = $name;
                $route = base_url() . 'img/avatares/' . $name;
                $dat = array(
                    'id' => $this->simple_sessions->get_value('id'),
                    'nom_img' => $name,
                    'avatar' => $route
                );
                // Inserto datos en DB
                $this->usuarios_m->set_avatar($dat);
                // Elimino los mensajes de error, si quiero verlos comento esto
                unset($data['upload_data']);
                $data['msj_exit'] = 'La imagen se ha sustituido con éxito.';
            }

            // Cargo las vistas de incio del BACKEND
            // Miembros totales
            $data['totales'] = $this->usuarios_m->total_members();
            // Añadidos el ultimo mes
            $data['last_month'] = $this->usuarios_m->get_last_week();
            // Superusuarios
            $data['total_pro'] = $this->usuarios_m->get_num_pro_members();
            // Total imágenes
            $data['total_pictures'] = $this->gallery_m->total_pictures();
            // Imágenes añadidas el último mes
            $data['last_month_pic'] = $this->gallery_m->get_last_pic();
            // Cargo las vistas de incio del BACKEND
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('escritorio/breadcrumb_escritorio_v', $data);
            $this->load->view('escritorio/notifications', $data);
            //$this->load->view('escritorio/prueba');
            $this->load->view('includes/footer_v');
        } else {
            redirect('');
        }
    }

    /*
     * Pruebas para subida múltiple de Imágenes
     */

    public function upload() {
        # Configuracion de la libreria
        # 'img_path' esta en /applications/config/pixmat.php
        $config['upload_path'] = './img/gallery/';
        $config['allowed_types'] = 'jpg|gif|png|jpeg';
        $config['encrypt_name'] = 'TRUE';
        $config['max_size'] = '71680';
        $config['max_width'] = '8000';
        $config['max_height'] = '8000';

        $this->load->library('upload', $config);

        # Uploading
        if (!$this->upload->do_upload('Filedata')) {
            # Error
            $errors = $this->upload->display_errors();

            # nombre de la imagen, evitando errores
            $image_name = NULL;
        } else {
            # Nombre de la foto
            $imageData = $this->upload->data();
            $image_name = $imageData['file_name'];
            $image_ext = $imageData['file_ext'];

            # Achicamos la foto
            if (!$this->resizePhoto($image_name)) {
                $errors = "La imagen no pudo redimensionarse correctamente";
            } else {
                # Agregamos a la base de datos
                $data = array(
                    'title' => 'Foto sin titulo',
                    'image' => $image_name,
                    'active' => 0
                );

                # ID recien creado, verificamos
                //$id = $this->photos_model->create($data);
//                if (!$id) {
//                    $errors = "La imagen no pudo ingresarse a la DB";
//                }
            }
        }

        // Error?
        if (isset($errors)) {
            # Borramos la foto (si existe)
            $id = isset($id) ? $id : NULL;
            $this->deletePhoto($id, $image_name);

            echo $errors;
        }
    }

    private function resizePhoto($name) {
        # Load library
        $this->load->library('image_lib');

        // Achicamos a 1024x768
        $config['image_library'] = 'gd2';
        $config['source_image'] = './img/gallery/' . $name;
        $config['new_image'] = './img/gallery/' . '1024x768/' . $name;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 1024;
        $config['height'] = 768;

        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            $error = TRUE;
        }

        /*

          // Le ponemos watermark, tenemos que utilizar otra configuracion, puesto que vamos a trabajar
          // con el thumbnail y vamos a ponerle watermark
          $config2['image_library']       = 'gd2';
          $config2['source_image']        = $this->config->item('upload_path') . '1024x768/' . $name;
          $config2['wm_type']         = 'overlay';
          $config2['wm_overlay_path']     = $this->config->item('watermark');
          $config2['wm_vrt_alignment']        = 'middle';
          $config2['wm_hor_alignment']    = 'center';

          # Watermark
          $this->image_lib->initialize($config2);
          if ( ! $this->image_lib->watermark()){
          $error = TRUE;
          }

         */

        // Achicamos a 800x600
        $config['source_image'] = './img/gallery/' . '1024x768/' . $name;
        $config['new_image'] = './img/gallery/' . '800x600/' . $name;
        $config['width'] = 800;
        $config['height'] = 600;

        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            $error = TRUE;
        }

        // Achicamos a 400x300
        $config['source_image'] = './img/gallery/' . '1024x768/' . $name;
        $config['new_image'] = './img/gallery/' . '400x300/' . $name;
        $config['width'] = 400;
        $config['height'] = 300;

        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            $error = TRUE;
        }

        # Error ?
        if (isset($error) and $error === TRUE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function deletePhoto($id, $image) {
        # Delete from the DB
//        if ($id !== NULL) {
//            $this->photos_model->delete($id);
//        }

        if ($image !== NULL) {
            # Borramos todas las imagenes (si existen). Evitamos warnings con el @ adelante
            @unlink('./img/gallery/' . $image);
            @unlink('./img/gallery/' . '1024x768/' . $image);
            @unlink('./img/gallery/' . '800x600/' . $image);
            @unlink('./img/gallery/' . '400x300/' . $image);
        }
    }

}

/* End of file upload.php */
    /* Location: ./application/controllers/upload.php */



    