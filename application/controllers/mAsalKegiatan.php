<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAsalKegiatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mAsalKegiatanModel');
	}

	public function index()
	{
		$this->load->view('mAsalKegiatan');
	}

	public function getAsalKegiatan()
	{
		$data['rows']=$this->mAsalKegiatanModel->getJson('rows');
		$data['total']=$this->mAsalKegiatanModel->getJson('total');
		echo json_encode($data);
	}

	public function newAsalKegiatan()
	{
		$result=$this->mAsalKegiatanModel->newData();
		echo json_encode($result);
	}

	public function deleteAsalKegiatan()
	{
		$ID_ASAL_KEGIATAN=$this->input->post('ID_ASAL_KEGIATAN');
		$result=$this->mAsalKegiatanModel->deleteData($ID_ASAL_KEGIATAN);
		echo json_encode($result);
	}

	public function updateAsalKegiatan($ID_ASAL_KEGIATAN)
	{
		$result=$this->mAsalKegiatanModel->updateData($ID_ASAL_KEGIATAN);
		echo json_encode($result);
    }

    	public function getAsalKegiatanDesc()
	{
		$data=$this->mAsalKegiatanModel->getAllAsalKegiatan();
		echo json_encode($data);
	}

}

/* End of file mAsalKegiatan.php */
/* Location: ./application/controllers/mAsalKegiatan.php */