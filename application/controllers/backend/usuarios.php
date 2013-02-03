<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load language file
        $this->lang->load('multi');
        $this->load->model('usuarios/usuarios_m');
        $this->load->model('gallery/gallery_m');
        $this->load->library('email','','correo');
    }

    public function index() {
        // Si está iniciada la SESION, mostrara las vistas del BACKEND
        if ($this->simple_sessions->get_value('status')) {
            // Recojo los datos de todos los usuarios para la tabla
            if ($this->usuarios_m->get_usuarios() != FALSE) {
                // Si hay mas de 1 usuario 
                $data['array'] = $this->usuarios_m->get_usuarios();
            }
            // Muestro las vistas del apartado de usuarios
            $this->load->view('includes/head_v');
            $this->load->view('includes/header_v');
            $this->load->view('includes/menu_v');
            $this->load->view('usuarios/breadcrumb_usuario_v');
            if ($this->usuarios_m->get_usuarios() != FALSE) {
                $this->load->view('usuarios/tabla_v', $data);
            } else {
                $this->load->view('usuarios/tabla_v');
            }
            $this->load->view('includes/footer_v');
        } else {// Si no está activada la SESION será imposible acceder al BACKEND, se redirige al LOGIN
            redirect('');
        }
    }

    public function almacenar_nuevo() {
        if ($this->simple_sessions->get_value('status')) {
            // Correccion de errores en formulario
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[45]');
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|trim|max_length[80]');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Repita contraseña', 'required|trim|');
             // Si el formulario no es exitoso, vuelvo a mostrar las vistas junto a sus errores
            if (!$this->form_validation->run()) {
                // Recojo los datos de todos los usuarios para la tabla
                if ($this->usuarios_m->get_usuarios() != FALSE) {
                    // Si hay mas de 1 usuario 
                    $data['array'] = $this->usuarios_m->get_usuarios();
                }
                // Muestro las vistas del apartado de usuarios
                $this->load->view('includes/head_v');
                $this->load->view('includes/header_v');
                $this->load->view('includes/menu_v');
                $this->load->view('usuarios/breadcrumb_nuevo_v');
                $this->load->view('usuarios/form_v');
                $this->load->view('includes/footer_v');
            } else {// Si fue existo compruebo que no exista ni el nombre del usuario, ni el correo 
                // Recojo datos del formulario
                $data = array(
                    'nombre'     => $this->input->post('nombre'),
                    'email'      => $this->input->post('email'),
                    'password'   => $this->input->post('password'),
                    'repassword' => $this->input->post('repassword')
                );
                // Recojo los datos de todos los usuarios para la tabla
                if ($this->usuarios_m->get_usuarios() != FALSE) {
                    // Si hay mas de 1 usuario 
                    $data['array'] = $this->usuarios_m->get_usuarios();
                }
                // Compruebo si existe el nombre de usuario, ya que no se puede duplicar en la DB
                if ($this->usuarios_m->existe_nombre($data)) {
                    $data['nombre_error'] = $this->input->post('nombre');
                }
                // Lo mismo con el email
                if ($this->usuarios_m->existe_email($data)) {
                    $data['email_error'] = $this->input->post('email');
                }
                // Si no existe ninguno de las dos variables, alamaceno los datos en la DB
                if (!isset($data['nombre_error']) && !isset($data['email_error'])) {
                    // Genero clave aleatoria de activación para adjuntarla en la url del email y en la BBDD
                    $data['clave'] = $this->generar_txtAct(20,FALSE);
                    //Almaceno los datos en la DB y si esto funciona bien..
                    if ($this->usuarios_m->insert_usuario($data) > 0) {
                        // Array para recoger el ID
                        $dame = array('email'=>$this->input->post('email'),'password'=>md5($this->input->post('password')));
                        // Extraigo el id de usuario para enviarlo por la url
                        $id = $this->usuarios_m->dame_id($dame);
                        // Creo la variable para mensaje de exito
                        $data['form_ok'] = $this->input->post('nombre');                        
                        // Envio correo al usuario recien creado
                        $this->correo->from('info@casualweb.org', 'Casual Web');
                        $this->correo->to($this->input->post('email'));
                        $this->correo->subject('Hola '.$this->input->post('nombre').':');
                        $this->correo->message('
                            <p>Te envío este email para que actives tu cuenta con xxxxxxx, pulsa en el siguiente link para activarla:</p><br />
                            <a style="color:purple;font-size:18px;" href="'.base_url().'login/login_c/activacion/'.$data['clave'].'/'.$id.'">Activación de cuenta.</a></p>
                            <p style="color:red;">Tus datos personales son los siguientes:</p>
                            <p style="color:tomato;">Nombre: <b>'.$this->input->post('nombre').'</b></p>
                            <p style="color:tomato;">Email: <b>'.$this->input->post('email').'</b></p>
                            <p style="color:tomato;">Contraseña: <b>'.$this->input->post('password').'</b></p>
                            <p style="color:green;"><b>Puedes editar los datos personales una vez activada tu cuenta dentro de la aplicación.</b></p>
                            ');
                        // Si este fue enviado satisfactoriamente
                        if($this->correo->send()) {
                            $data['mail_ok']='El correo de activación se envió satisfactoriamente';
                            // Si no se envió satisfactoriamente
                        } else {
                            //show_error($this->correo->print_debugger());
                            $data['mail_err']='Ha ocurrido un <b>error</b> inesperado al enviar el correo de activación.<br>
                            <b>Elimina el usuario</b> y vuélvelo a registrar, en caso de otro error como este, ponte en contacto con el administrador.';
                        }
                    } else {// Si no se almacena ---> ERROR
                        //Error al insertar datos en la base de datos
                        $data['error_db'] = '';
                    }
                }

                // Muestro las vistas del apartado de usuarios
                $this->load->view('includes/head_v');
                $this->load->view('includes/header_v');
                $this->load->view('includes/menu_v');
                $this->load->view('usuarios/breadcrumb_nuevo_v', $data);
                $this->load->view('usuarios/form_v', $data);
                $this->load->view('includes/footer_v');
            }
        } else {
            redirect('');
        }
    }

    public function edit() {
        if ($this->simple_sessions->get_value('status')) {
            // Correccion de errores en formulario
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[45]');
            $this->form_validation->set_rules('email', 'Correo electrónico', 'required|valid_email|trim|max_length[80]');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|matches[repassword]');
            $this->form_validation->set_rules('repassword', 'Repita contraseña', 'required|trim|');
            // Traducción de los mensajes de error
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $this->form_validation->set_message('max_length', 'El campo %s, no puede tener más de %s caracteres');
            $this->form_validation->set_message('valid_email', 'El %s, no tiene un formato válido');
            $this->form_validation->set_message('matches', 'Los campos %s y %s no coinciden');

            // Si el formulario no es exitoso, vuelvo a mostrar las vistas junto a sus errores
            if (!$this->form_validation->run()) {
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
            } else {// Si fue existo compruebo que no exista ni el nombre del usuario, ni el correo 
                // Recojo datos del formulario
                $data = array(
                    'nombre'      => $this->input->post('nombre'),
                    'email'       => $this->input->post('email'),
                    'password'    => $this->input->post('password'),
                    'repassword'  => $this->input->post('repassword'),
                    'oldpassword' => $this->input->post('oldpassword')
                );
                // Compruebo que coincida el viejo password
                if (!$this->usuarios_m->existe_old($data)) {
                    $data['err_old'] = '';
                }
                // Compruebo si existe el nombre de usuario, ya que no se puede duplicar en la DB
                if ($this->usuarios_m->existe_nombre_menos1($data)) {
                    $data['err_username'] = $this->input->post('nombre');
                }
                // Lo mismo con el email
                if ($this->usuarios_m->existe_mail_menos1($data)) {
                    $data['err_email'] = $this->input->post('email');
                }
                // Si no existe ninguno de las dos variables, alamaceno los datos en la DB
                if (!isset($data['err_old']) && !isset($data['err_username']) && !isset($data['err_email'])) {
                    //Almaceno los datos en la DB y si esto funciona bien..
                    if ($this->usuarios_m->update_usuario($data)) {
                        // Creo la variable para mensaje de exito
                        $data['success'] = '';
                    } else {// Si no se almacena ---> ERROR
                        //Error al insertar datos en la base de datos
                        $data['err_db'] = '';
                    }
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
            }
        } else {
            redirect('');
        }
    }

    public function delete_user($id, $name) {
        // Si está iniciada la SESION, mostrara las vistas
        if ($this->simple_sessions->get_value('status')) {
            // Compruebo que el id no sea 1
            if (!empty($id) && $id !== 1) {
                // Elimino al usuario
                $this->usuarios_m->delete_admin($id);

                // Recojo los datos de todos los usuarios para la tabla
                if ($this->usuarios_m->get_usuarios() != FALSE) {
                    // Si hay mas de 1 usuario 
                    $data['array'] = $this->usuarios_m->get_usuarios();
                }
                $data['msg'] = $name;
                // Muestro las vistas del apartado de usuarios
                $this->load->view('includes/head_v');
                $this->load->view('includes/header_v');
                $this->load->view('includes/menu_v');
                $this->load->view('usuarios/breadcrumb_nuevo_v', $data);
                $this->load->view('usuarios/tabla_v', $data);
                $this->load->view('usuarios/profile_v', $data);
                $this->load->view('includes/footer_v');
            } else {
                redirect('');
            }
        } else {
            redirect('');
        }
    }

    public function ver($id) {
        // Si está iniciada la SESION, mostrara las vistas del BACKEND
        if ($this->simple_sessions->get_value('status')) {
            if (!empty($id) && $id != 1) {
                // Recojo los datos de todos los usuarios para la tabla
                if ($this->usuarios_m->get_usuarios() != FALSE) {
                    // Si hay mas de 1 usuario 
                    $data['array'] = $this->usuarios_m->get_usuarios();
                }
                $data['one_user']       = $this->usuarios_m->get_one_user($id);
                $data['nombre']         = $data['one_user']['nombre'];
                $data['email']          = $data['one_user']['email'];
                $data['fecha_creacion'] = $data['one_user']['fecha_creacion'];
                $data['avatar']         = $data['one_user']['avatar'];
                // Muestro las vistas del apartado de usuarios
                $this->load->view('includes/head_v');
                $this->load->view('includes/header_v');
                $this->load->view('includes/menu_v');
                $this->load->view('usuarios/breadcrumb_usuario_v');
                $this->load->view('usuarios/tabla_v', $data);
                $this->load->view('usuarios/profile_v', $data);
                $this->load->view('includes/footer_v');
            } else {// Si no está activada la SESION será imposible acceder al BACKEND, se redirige al LOGIN
                redirect('');
            }
        } else {// Si no está activada la SESION será imposible acceder al BACKEND, se redirige al LOGIN
            redirect('');
        }
    }

    function cerrar_sesion() {
        $this->simple_sessions->destroy_sess();
        redirect(site_url());
    }



    function generar_txtAct($longitud,$especiales){
        // Array con los valores a escoger
        $semilla   = array();
        $semilla[] = array('a','e','i','o','u');
        $semilla[] = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z');
        $semilla[] = array('0','1','2','3','4','5','6','7','8','9');
        $semilla[] = array('A','E','I','O','U');
        $semilla[] = array('B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z');
        $semilla[] = array('0','1','2','3','4','5','6','7','8','9');
         
        // si puede contener caracteres especiales, aumentamos el array $semilla
        if ($especiales) { 
            $semilla[] = array('+','-','*');
         }
         $clave='';
        // creamos la clave con la longitud indicada
        for ($bucle=0; $bucle < $longitud; $bucle++){
            // seleccionamos un subarray al azar
            $valor = mt_rand(0, count($semilla)-1);
            // selecccionamos una posición al azar dentro del subarray
            $posicion = mt_rand(0,count($semilla[$valor])-1);
            // cogemos el carácter y lo agregamos a la clave
            $clave .= $semilla[$valor][$posicion];
        }
        // devolvemos la clave
        return $clave;
    }


}

/* End of file b_usuario_c.php */
    /* Location: ./application/controllers/b_usuario_c.php */




    