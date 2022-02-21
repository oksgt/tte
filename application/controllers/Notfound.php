<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url', 'language', 'app_helper'));
    }

    function index(){
        $this->output->set_status_header('404');
        $this->load->view('view_404');
    }
}