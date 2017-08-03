<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawanModel');
	}

	public function index()
	{
		
	}

	public function getKaryawan()
	{
		$data=$this->karyawanModel->getJson();
		echo json_encode($data);
	}

}

/* End of file bagian.php */
/* Location: ./application/controllers/bagian.php */
?>