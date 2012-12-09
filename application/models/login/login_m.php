<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_m extends CI_Model {

    public function accede($data) {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('mail', $data['email']);
        $this->db->where('password', $data['password']);
        // Inserción de la QUERY
        $query = $this->db->get();
        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }        
        return FALSE;
    }

}

/* End of file login_m.php */
    /* Location: ./application/models/login_m.php */