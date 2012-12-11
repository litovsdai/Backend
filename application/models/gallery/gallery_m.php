<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_m extends CI_Model {

    public function add_images($data) {
        if (!$this->existe_img($data['name'])) {
            $fecha = date('Y-m-d');
            $data = array(
                'name' => $data['name'],
                'ruta' => $data['ruta1'],
                'ruta_thumb' => $data['ruta2'],
                'fecha_creacion' => $fecha
            );
            $this->db->insert('imagenes', $data);
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function remove_picture($name) {
        @unlink('./img/gallery/' . '800X600/' . $name);
        @unlink('./img/gallery/' . '145X100/' . $name);
        $this->db->delete('imagenes', array('name' => $name));
    }

    public function get_last_pic() {
        $query = $this->db->query(
                'SELECT * FROM imagenes
                    WHERE extract(month from current_date)=extract(month from fecha_creacion) AND
                    extract(year from current_date)=extract(year from fecha_creacion)');
        return $query->num_rows();
    }

    public function total_pictures() {
        return $this->db->count_all('imagenes');
    }

    public function existe_img($name) {
        // Consulta
        $this->db->from('imagenes');
        $this->db->where('name', $name);
        // Inserción de la QUERY
        $query = $this->db->get();
        // Si hay coincidencia retrornará TRUE, si no FALSE
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    public function all_images() {
        // Consulta
        $this->db->from('imagenes');
        // Inserción de la QUERY
        $query = $this->db->get();
        if ($this->db->affected_rows() > 0) {
            $array_images = array();

            foreach ($query->result_array() as $row) {
                $temporal = array(
                    'name' => $row['name'],
                    'ruta' => $row['ruta'],
                    'ruta_thumb' => $row['ruta_thumb'],
                    'fecha_creacion' => $row['fecha_creacion'],
                    'padre' => $row['padre']);
                array_push($array_images, $temporal);
            }
            return $array_images;
        } else {
            return 0;
        }
    }

    public function all_category() {
        // Consulta
        $query = $this->db->query("SELECT DISTINCT padre FROM imagenes WHERE padre != '0'");

        if ($this->db->affected_rows() > 0) {
            $array_images = array();
            foreach ($query->result_array() as $row) {
                $temporal = $row['padre'];
                array_push($array_images, $temporal);
            }
            return $array_images;
        } else {
            return 0;
        }
    }
    
    public function all_categories() {
        // Consulta
        $this->db->from('categorias');
        // Inserción de la QUERY
        $query = $this->db->get();
        if ($this->db->affected_rows() > 0) {
            $array_images = array();
            foreach ($query->result_array() as $row) {
                $temporal = $row['name'];
                array_push($array_images, $temporal);
            }
            return $array_images;
        } else {
            return 0;
        }
    }

    public function all_images_for_category($padre) {
        // Consulta
        $this->db->from('imagenes');
        $this->db->where('padre', $padre);
        // Inserción de la QUERY
        $query = $this->db->get();
        if ($this->db->affected_rows() > 0) {
            $array_images = array();

            foreach ($query->result_array() as $row) {
                $temporal = array(
                    'name' => $row['name'],
                    'ruta' => $row['ruta'],
                    'ruta_thumb' => $row['ruta_thumb'],
                    'fecha_creacion' => $row['fecha_creacion'],
                    'padre' => $row['padre']);
                array_push($array_images, $temporal);
            }
            return $array_images;
        } else {
            return 0;
        }
    }

}

/* End of file login_m.php */
    /* Location: ./application/models/gallery_m.php */