<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MJenisEkspedisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mJenisEkspedisiModel');
	}

	public function index()
	{
		$this->load->view('mJenisEkspedisi');
	}

	public function getJenisEkspedisi()
	{
		$data['rows']=$this->mJenisEkspedisiModel->getJson('rows');
		$data['total']=$this->mJenisEkspedisiModel->getJson('total');
		echo json_encode($data);
	}

	public function newJenisEkspedisi()
	{
		$result=$this->mJenisEkspedisiModel->newData();
		echo json_encode($result);
	}

	public function deleteJenisEkspedisi()
	{
		$ID_JENIS_EKSPEDISI=$this->input->post('ID_JENIS_EKSPEDISI');
		$result=$this->mJenisEkspedisiModel->deleteData($ID_JENIS_EKSPEDISI);
		echo json_encode($result);
	}

	public function updateJenisEkspedisi($ID_JENIS_EKSPEDISI)
	{
		$result=$this->mJenisEkspedisiModel->updateData($ID_JENIS_EKSPEDISI);
		echo json_encode($result);
    }

}

/* End of file mJenisEkspedisi.php */
/* Location: ./application/controllers/mJenisEkspedisi.php */