<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ekspedisi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ekspedisiModel');
	}
	public function index()
	{
		$this->load->view('ekspedisi');
	}
	
	public function getEkspedisi()
	{
		$data['rows']=$this->ekspedisiModel->getJson('rows');
		$data['total']=$this->ekspedisiModel->getJson('total');
		echo json_encode($data);
	}
	public function newEkspedisi()
	{
		$result=$this->ekspedisiModel->newData();
		echo json_encode($result);
	}
	public function deleteEkspedisi()
	{
		$ID_EKSPEDISI=$this->input->post('ID_EKSPEDISI');
		$result=$this->ekspedisiModel->deleteData($ID_EKSPEDISI);
		echo json_encode($result);
	}
	public function updateEkspedisi($ID_EKSPEDISI)
	{
		$result=$this->ekspedisiModel->updateData($ID_EKSPEDISI);
		echo json_encode($result);
    }
    public function getNomorEkspedisi()
    {
    	$result=$this->ekspedisiModel->getNomorEkspedisi();
		echo json_encode($result);
    }
}
