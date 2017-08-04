<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDireksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mDireksiModel');
	}

	public function index()
	{
		$this->load->view('mDireksi');
	}

	public function getDireksi()
	{
		$data['rows']=$this->mDireksiModel->getJson('rows');
		$data['total']=$this->mDireksiModel->getJson('total');
		echo json_encode($data);
	}

	public function newDireksi()
	{
		$result=$this->mDireksiModel->newData();
		echo json_encode($result);
	}

	public function deleteDireksi()
	{
		$ID_DIREKSI=$this->input->post('ID_DIREKSI');
		$result=$this->mDireksiModel->deleteData($ID_DIREKSI);
		echo json_encode($result);
	}

	public function updateDireksi($ID_DIREKSI)
	{
		$result=$this->mDireksiModel->updateData($ID_DIREKSI);
		echo json_encode($result);
    }

    public function getDireksiDesc()
	{
		$data=$this->mDireksiModel->getJson('rows');
		echo json_encode($data);
	}

}

/* End of file mDireksi.php */
/* Location: ./application/controllers/mDireksi.php */