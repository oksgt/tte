<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper(array('url', 'language', 'app_helper'));
        $this->load->model(array('Document_model'));
        if ($this->session->userdata('status') !== 'loggedin') {
            redirect(base_url("login"));
        }
    }

	public function index()
	{
		$this->template->load('Template', 'dashboard');

		// $plain_text = base_url();
		// $ciphertext = $this->encryption->encrypt($plain_text);

		// // Outputs: This is a plain-text message!
		// echo "chipertext " . $ciphertext . "<br>"; 
		// echo $this->encryption->decrypt($ciphertext);
	}

	function dekrip(){
		echo $this->encryption->decrypt('edda9f13c799396080789e985d8e4ccf32b9d8cd4ac4cda0205b75d982a567bd397a6ed6b4e4251d5195444a32655060604b7f0cb11c6189984c73bde285d8eeQYje9aoEbVBagjF4XnoYiqpREIR9NeinpHkHZY85Z8NoLF8kGhe515eu2J+HUt5g');
	}

	function upload(){
		$file_name = $this->Document_model->_uploadFile();
		// var_dump($file_name);
		$this->template->load('Template', 'draw');
        // if ($file_name['status']) {

		// }
	}
}
