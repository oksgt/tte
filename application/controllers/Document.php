<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url', 'language', 'app_helper', 'string', 'file'));

		$this->load->model(array('Document_model'));
		if ($this->session->userdata('status') !== 'loggedin') {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->template->load('Template', 'document');
	}

	function download($id)
	{
		$this->load->helper('download');
		$doc = $this->Document_model->get_by(['id' => $id])->row_array();
		$filename = $doc['signed_file_name'];
		force_download('assets/upload/' . $filename, null);
	}

	public function test()
	{
		// echo uniqid();
	}

	public function ajax_list()
	{
		$list = $this->Document_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $r->original_file_name;
			$row[] = formatTglIndo_datetime($r->upload_time);
			$row[] = ($r->signed_file_name !== null) ? '<a role="button" class="btn btn-primary btn-xs" href="' . base_url('document/download/' . $r->id) . '">Download</a> ' . $r->signed_file_name : '<a type="button" class="btn btn-warning btn-xs" href="' . base_url('document/prepareSign/' . $r->id) . '">Sign Now</a> ';
			$row[] = ($r->signed_file_name !== null) ? formatTglIndo_datetime($r->signed_at) : "";
			$row[] = $r->name;
			$row[] = '<button onclick="hapus_doc(' . $r->id . ')" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Document_model->count_all(),
			"recordsFiltered" => $this->Document_model->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	function prepareSign($id)
	{
		$this->session->set_userdata(['doc_id' => $id]);
		redirect('document/sign');
	}

	public function sign()
	{
		if ($this->session->userdata('doc_id') !== null) {
			$doc = $this->Document_model->get_qry($this->session->userdata('doc_id'))->row_array();
			$data['doc'] = $doc;
			$data['token'] = uniqid();
			$this->template->load('Template', 'draw', $data);
		} else {
			redirect('welcome');
		}


		// $plain_text = base_url();
		// $ciphertext = $this->encryption->encrypt($plain_text);

		// // Outputs: This is a plain-text message!
		// echo "chipertext " . $ciphertext . "<br>"; 
		// echo $this->encryption->decrypt($ciphertext);
	}


	function upload()
	{
		$file_name = $this->Document_model->_uploadFile();
		// var_dump($file_name); 
		if ($file_name['status']) {
			$object = [
				'id_user'	=> $this->session->userdata('id'),
				'original_file_name'	=> $file_name['original_image'],
				'original_file_ext'		=> $file_name['original_ext'],
				'upload_time'			=> date('Y-m-d H:i:s'),
				'is_del'				=> 0
			];

			$inserted = $this->Document_model->save($object);
			if ($inserted > 0) {
				$result = array('status' => true);
				$this->session->set_userdata(['doc_id' => $inserted]);
				// echo json_encode($this->session->userdata());
				redirect('document/sign');
			} else {
				$result = array('status' => false);
			}
		}
	}

	function upload_signed()
	{
		$file_name = $this->Document_model->_uploadFileServer();
		if ($file_name['status']) {
			$object = [
				'signed_file_name'	=> $file_name['original_image'],
				'signed_file_ext'	=> $file_name['original_ext'],
				'signed_at'			=> date('Y-m-d H:i:s'),
				'token'				=> $_POST['token']
			];

			$inserted = $this->Document_model->update($object, ['id' => $_POST['fileId']]);
			if ($inserted > 0) {
				$result = array('status' => true);
				$this->session->set_userdata(['doc_id' => null]);
				echo json_encode($result);
				// $this->session->set_userdata(['doc_id' => $inserted]);
				// redirect(base_url());
			} else {
				$result = array('status' => false);
				// redirect(base_url());
			}
		} else {
			// redirect(base_url());
		}
	}

	public function delete($id)
	{
		$data = $this->Document_model->get_by(['id' => $id])->row_array();
			// echo file_exists('assets/upload/' . $data['original_file_name']);
			// die;
		if (!empty($data)) {

			if($data['original_file_name'] !== ""){
				if(file_exists('assets/upload/' . $data['original_file_name']) == true){
					unlink('assets/upload/' . $data['original_file_name']);
				}
			}

			if( $data['signed_file_name'] !== null){
				if(file_exists('assets/upload/' . $data['signed_file_name']) == true){
					unlink('assets/upload/' . $data['signed_file_name']);
				}
			}

			$affected_row = $this->Document_model->delete($id);
			$result = array('status' => TRUE, "message" => "Hapus Data Berhasil", "detail_data" => null, "error" => "Delete");
			echo json_encode($result);
			
		} else {
			
		}

		
	}
}
