<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backend_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios/usuarios_m');
        $this->load->model('gallery/gallery_m');
    }

    public function index() {
        // Si está iniciada la SESION, mostrara las vistas del BACKEND
        if ($this->simple_sessions->get_value('status')) {
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
            $this->load->view('escritorio/breadcrumb_escritorio_v');
            $this->load->view('escritorio/notifications', $data);
            //$this->load->view('escritorio/prueba');
            $this->load->view('includes/footer_v');
        } else {// Si no está activada la SESION será imposible acceder al BACKEND, se redirig al LOGIN
            redirect('');
        }
    }

}

/* End of file backend_c.php */
    /* Location: ./application/controllers/backend_c.php */

    