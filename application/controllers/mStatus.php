<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MStatus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mStatusModel');
	}

	public function index()
	{
		$this->load->view('mStatus');
	}

	public function getStatus()
	{
		$data['rows']=$this->mStatusModel->getJson('rows');
		$data['total']=$this->mStatusModel->getJson('total');
		echo json_encode($data);
	}

	public function newStatus()
	{
		$result=$this->mStatusModel->newData();
		echo json_encode($result);
	}

	public function deleteStatus()
	{
		$ID_STATUS=$this->input->post('ID_STATUS');
		$result=$this->mStatusModel->deleteData($ID_STATUS);
		echo json_encode($result);
	}

	public function updateStatus($ID_STATUS)
	{
		$result=$this->mStatusModel->updateData($ID_STATUS);
		echo json_encode($result);
    }

}

/* End of file mStatus.php */
/* Location: ./application/controllers/mStatus.php */