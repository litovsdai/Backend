
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_avatar extends CI_Controller {

    function __construct() {
        parent::__construct();
        // load language file
        $this->lang->load('multi');
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
            if(isset($_FILES)){
                $_FILES['userfile']['name']=$this->simple_sessions->get_value('id').$_FILES['userfile']['name'];
            }
            // Ejecuto la accion e subir
            $this->upload->initialize($config);
            
            // Recojo los datos que genera la subida de imagen, ya sea error o mensaje OK
            if (!$this->upload->do_upload()) {
                // Recojo los datos de suceso ERROR
                $data = array('error' => $this->upload->display_errors());
            } else {
                foreach ($this->upload->data() as $key => $value) {
                    if($key === 'file_ext'){
                        $extension = $value;
                    }
                    if ($key === 'orig_name') {
                        $name = $value;
                    }
                }
                
                $data = array(
                    'id' => $this->simple_sessions->get_value('id'),
                    'nom_img' => $name,
                    'avatar' => base_url().'img/avatares/'.$name
                );
                // Inserto datos en DB
                $this->usuarios_m->set_avatar($data);
                $data['msj_exit'] = '<b>Avatar cambiado</b>, con nombre <b>'.$name.'</b>.';
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



    