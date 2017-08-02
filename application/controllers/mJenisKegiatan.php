<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MJenisKegiatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mJenisKegiatanModel');
	}

	public function index()
	{
		$this->load->view('mJenisKegiatan');
	}

	public function getJenisKegiatan()
	{
		$data['rows']=$this->mJenisKegiatanModel->getJson('rows');
		$data['total']=$this->mJenisKegiatanModel->getJson('total');
		echo json_encode($data);
	}

	public function newJenisKegiatan()
	{
		$result=$this->mJenisKegiatanModel->newData();
		echo json_encode($result);
	}

	public function deleteJenisKegiatan()
	{
		$ID_JENIS_KEGIATAN=$this->input->post('ID_JENIS_KEGIATAN');
		$result=$this->mJenisKegiatanModel->deleteData($ID_JENIS_KEGIATAN);
		echo json_encode($result);
	}

	public function updateJenisKegiatan($ID_JENIS_KEGIATAN)
	{
		$result=$this->mJenisKegiatanModel->updateData($ID_JENIS_KEGIATAN);
		echo json_encode($result);
    }

}

/* End of file mJenisKegiatan.php */
/* Location: ./application/controllers/mJenisKegiatan.php */