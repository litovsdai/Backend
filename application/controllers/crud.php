<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load language file
        $this->lang->load('multi');
        $this->load->scaffolding('administradores');
    }

    public function index() {
        
    }

}

//
