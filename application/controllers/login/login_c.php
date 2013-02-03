<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_c extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load language file

        $this->load->model('login/login_m');
        $this->load->model('usuarios/usuarios_m');
    }

    public function index() {
        // Vistas del login
        $this->load->view('includes/head_v');
        $this->load->view('login/login_v');
        $this->load->view('login/login_footer_v');
    }

    /*
     *  Controlador que se encarga de activar las cuentas
     */

    public function activacion($clave, $id) {
        // Recojo toda la información del usuario
        $datos = $this->usuarios_m->get_one_user($id);
        //echo $datos['clave_temp'].'<br>'.$clave;
        if ($datos['clave_temp'] === $clave) {
            // Cambio el campo de activación de la base datos por activado = SI
            $this->usuarios_m->active_user($id);
            // Mensaje que envio a la vista en caso de activarse satisfactoriamente
            $data['active'] = 'Bienvenido, tu cuenta ha sido activada<br />Con los datos adjuntos en el email podrás acceder a la aplicación.';
        }
        // Vistas del login
        $this->load->view('includes/head_v');
        if (isset($data)) {// Si existe la variable $data     
            $this->load->view('login/login_v', $data);
        } else {// Si no existe $data
            $this->load->view('login/login_v');
        }
        $this->load->view('login/login_footer_v');
    }

    /*
     *  Controlador que gestiona el acceso a la aplicación
     */

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
            // Recojo el ID del usuario a partir de los datos recogios en el formulario
            $id = $this->usuarios_m->dame_id($data);
            // A partir del ID recojo, todos los datos del Usuario, aunque sólo me hace falta el campo ACTIVO
            $datos = $this->usuarios_m->get_one_user($id);
            // Me quedo con el campo ACTIVO
            $activo = $datos['activo'];
            // Si los datos coinciden con los de la base de datos, procedo a comprobar si la cuenta está activada
            if ($this->login_m->accede($data) != FALSE) {
                // Si el usuario a activado su CUENTA, accederà
                if ($activo === 'si') {
                    // Los almaceno en un array para crear los datos de session
                    $data = array(
                        'id' => $datos['id'],
                        'nombre' => $datos['nombre'],
                        'email' => $datos['email'],
                        'avatar' => $datos['avatar'],
                        'fecha_creacion' => $datos['fecha_creacion'],
                        'super' => $datos['super_user'],
                        'status' => TRUE
                    );
                    // Creo la session
                    $this->simple_sessions->add_sess($data);
                    // Redirijo al usuario al BACKEND
                    redirect('backend/escritorio');
                } else {// Si no tiene activada la cuenta
                    $data['no_active'] = 'No puedes acceder a la aplicación ya que tu cuenta no está activada.';
                    // Cargo vistas
                    $this->load->view('includes/head_v');
                    $this->load->view('login/login_error_v', $data);
                    $this->load->view('login/login_footer_v');
                }
            } else {// Si los datos no existen en la DB, formulario de LOGIN de nuevo
                // Cargo Vistas
                $this->load->view('includes/head_v');
                $this->load->view('login/login_error_v');
                $this->load->view('login/login_footer_v');
            }
        }
    }

}

/* End of file login_c.php */
/* Location: ./application/controllers/login_c.php */