<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('berkasModel');
	}

	public function index()
	{
		$this->load->view('berkas');
	}
	
	public function getBerkas()
	{
		$data['rows']=$this->berkasModel->getJson('rows');
		$data['total']=$this->berkasModel->getJson('total');
		echo json_encode($data);
	}

	public function getBerkasSelesai()
	{
		$data['rows']=$this->berkasModel->getJsonSelesai('rows');
		$data['total']=$this->berkasModel->getJsonSelesai('total');
		echo json_encode($data);
	}

	public function newBerkas()
	{
		$result=$this->berkasModel->newData();
		echo json_encode($result);
	}

	public function deleteBerkas()
	{
		$ID_BERKAS=$this->input->post('ID_BERKAS');
		$result=$this->berkasModel->deleteData($ID_BERKAS);
		echo json_encode($result);
	}

	public function updateBerkas($ID_BERKAS)
	{
		$result=$this->berkasModel->updateData($ID_BERKAS);
		echo json_encode($result);
    }

    public function getNomorBerkas()
    {
    	$result=$this->berkasModel->getDataNomor();
		echo json_encode($result);
    }

    public function getTanggal()
    {
    	$result=$this->berkasModel->getDataTanggal();
		echo json_encode($result);
    }

	public function getBerkasDesc()
	{
		$data=$this->berkasModel->getID();
		echo json_encode($data);
	}    

}

/* End of file berkas.php */
/* Location: ./application/controllers/berkas.php */