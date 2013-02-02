
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_avatar extends CI_Controller {

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

}

/* End of file upload.php */
    /* Location: ./application/controllers/upload.php */



    