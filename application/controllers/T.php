<?php
defined('BASEPATH') or exit('No direct script access allowed');

class T extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url', 'language', 'app_helper', 'string'));

		$this->load->model(array('Document_model'));
	}

	public function index(){
		redirect('http://www.perumdamts.com/', 'refresh');
	}

    function v($token=""){
		if($token == ""){
			redirect('Notfound');
		} else {
			$doc = $this->Document_model->get_by(['token' => $token, 'is_del' => 0])->row_array();
            
			if(!empty($doc)){
				$data['doc'] = $doc;
				$this->load->view('doc_valid', $data);
			} else {
				redirect('Notfound');
			}
		}
	}

}