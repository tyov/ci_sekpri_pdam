<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class asalKegiatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('asalKegiatanmodel');
	}

	public function index()
	{
		
	}

	public function getAsalKegiatan()
	{
		$data=$this->asalKegiatanmodel->getJson();
		echo json_encode($data);
	}

/* End of file bagian.php */
/* Location: ./application/controllers/bagian.php */
?>