<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login/login_m');
        $this->load->model('usuarios/usuarios_m');
    }

    public function index() {
        // Vistas del login
        $this->load->view('includes/head_v');
        $this->load->view('login/login_v');
        $this->load->view('login/login_footer_v');
    }

    public function login() {
        // Validación de los campos del login
        $this->form_validation->set_rules('email', 'correo electrónico', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'contraseña', 'required|trim');
        // Traducción de los mensajes de error
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El %s, no tiene un formato válido');
        // Si el formulario no es exitoso, muestro de nuevo el login
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('includes/head_v');
            $this->load->view('login/login_v');
            $this->load->view('login/login_footer_v');
        } else {// Si el formulario es exitoso 
            //almaceno las variables POST, para buscar enviarlas al modelo y que contraste los datos con los de la DB
            $data = array(
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password'))
            );
            // Si los datos coinciden con los de la base de datos, inicio la sesión
            if ($this->login_m->accede($data) != FALSE) {
                // Devuelve id a partir del password y el correo electrónico
                $id_temp = $this->usuarios_m->dame_id($data);
                // Devuleve los datos del usuario logueado
                $datos_one = $this->usuarios_m->get_one_user($id_temp);
                // Los almaceno en un array para crear los datos de session
                $data = array(
                    'id' => $datos_one['id'],
                    'nombre' => $datos_one['nombre'],
                    'email' => $datos_one['email'],
                    'avatar' => $datos_one['avatar'],
                    'fecha_creacion' => $datos_one['fecha_creacion'],
                    'super' => $this->usuarios_m->super($data),
                    'status' => TRUE
                );
                // Creo la session
                $this->simple_sessions->add_sess($data);
                // Redirijo al usuario al BACKEND
                redirect('backend/backend_c');
            } else {// Si los datos no existen en la DB, formulario de LOGIN de nuevo
                $this->load->view('includes/head_v');
                $this->load->view('login/login_error_v');
                $this->load->view('login/login_footer_v');
            }
        }
    }

}

/* End of file login_c.php */
/* Location: ./application/controllers/login_c.php */