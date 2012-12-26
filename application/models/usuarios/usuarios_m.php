<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_m extends CI_Model {

    public function existe_nombre($data) {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('nombre', $data['nombre']);
        // Inserción de la QUERY
        $query = $this->db->get();
        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function total_members() {
        return $this->db->count_all('administradores');
    }

    public function existe_nombre_menos1($data) {
        // ConsultaSELECT * FROM administradores where nombre !='Lito' AND nombre='manu'
        $query = $this->db->query("
            SELECT * FROM administradores
            where nombre !='" . $this->simple_sessions->get_value('nombre') . "' AND nombre='" . $data['nombre'] . "'");

        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function existe_mail_menos1($data) {
        // ConsultaSELECT * FROM administradores where nombre !='Lito' AND nombre='manu'
        $query = $this->db->query("
            SELECT * FROM administradores
            where mail !='" . $this->simple_sessions->get_value('email') . "' AND mail='" . $data['email'] . "'");

        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function dame_id($datos) {
        // Consulta
        $query = $this->db->query("
            SELECT id FROM administradores
            where mail='" . $datos['email'] . "' AND password='" . $datos['password'] . "'");

        // Si hay coincidencia retrornará TRUE, si no FALSE
        foreach ($query->result_array() as $row) {
            return $row['id'];
        }
        return -1;
    }

    public function super($datos) {
        $a = "SELECT * FROM administradores
            where mail='" . $datos['email'] . "' AND password='" . $datos['password'] . "' AND super_user=1";
        // Consulta
        $query = $this->db->query("
            SELECT * FROM administradores
            where mail='" . $datos['email'] . "' AND password='" . $datos['password'] . "' AND super_user=1");

        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() == 1) {
            return 1;
        }
        return 0;
    }

    public function existe_email($data) {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('mail', $data['email']);
        // Inserción de la QUERY
        $query = $this->db->get();
        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function existe_old($data) {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('id', $this->simple_sessions->get_value('id'));
        $this->db->where('password', md5($data['oldpassword']));
        // Inserción de la QUERY
        $query = $this->db->get();
        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function update_usuario($data) {
        $query = $this->db->query("
            UPDATE administradores
            SET nombre='" . $data['nombre'] . "', mail='" . $data['email'] . "', password='" . md5($data['password']) . "' WHERE id = " . $this->simple_sessions->get_value('id') . "");

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function insert_usuario($data) {
        $fecha = date('Y-m-d');
        $data = array(
            'nombre' => $data['nombre'],
            'mail' => $data['email'],
            'password' => md5($data['password']),
            'fecha_creacion' => $fecha
        );
        $this->db->insert('administradores', $data);
        return $this->db->affected_rows();
    }

    public function get_last_week() {
        $query = $this->db->query(
                'SELECT * FROM administradores
                    WHERE extract(month from current_date)=extract(month from fecha_creacion) AND
                    extract(year from current_date)=extract(year from fecha_creacion)');
        return $query->num_rows();
    }
    
    

    public function get_num_pro_members() {
        $query = $this->db->query(
                'SELECT * FROM administradores
                    WHERE super_user=1');
        return $query->num_rows();
    }

    public function get_usuarios() {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('super_user', 0);
        // Inserción de la QUERY
        $query = $this->db->get();
        if ($this->db->affected_rows() > 0) {
            $array_usarios = array();

            foreach ($query->result_array() as $row) {
                $temporal = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'mail' => $row['mail'],
                    'fecha_creacion' => $row['fecha_creacion']);
                array_push($array_usarios, $temporal);
            }
            return $array_usarios;
        }
        return FALSE;
    }

    function delete_admin($id) {
        $this->db->delete('administradores', array('id' => $id));
    }

    function set_avatar($dat) {
        $datos = array('avatar' => $dat['avatar']);
        $this->db->where('id', $dat['id']);
        $this->db->update('administradores', $datos);
    }

    function get_one_user($id) {
        // Consulta
        $this->db->from('administradores');
        $this->db->where('id', $id);
        // Inserción de la QUERY
        $query = $this->db->get();
        if ($this->db->affected_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $one_user = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'email' => $row['mail'],
                    'avatar' => $row['avatar'],
                    'fecha_creacion' => $row['fecha_creacion']);
            }
            return $one_user;
        }
        return FALSE;
    }

}

/* End of file usuarios_m.php */
    /* Location: ./application/models/usuarios_m.php */