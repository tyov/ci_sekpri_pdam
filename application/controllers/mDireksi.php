<?php
defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
class mDireksi extends CI_Controller {
=======
class MDireksi extends CI_Controller {
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mDireksiModel');
	}

	public function index()
	{
		$this->load->view('mDireksi');
	}

<<<<<<< HEAD
	public function getMDireksi()
=======
	public function getDireksi()
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e
	{
		$data['rows']=$this->mDireksiModel->getJson('rows');
		$data['total']=$this->mDireksiModel->getJson('total');
		echo json_encode($data);
	}

<<<<<<< HEAD
	public function newMDireksi()
=======
	public function newDireksi()
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e
	{
		$result=$this->mDireksiModel->newData();
		echo json_encode($result);
	}

<<<<<<< HEAD
	public function deleteMDireksi()
	{
		$ID_DIREKSI=$this->input->post('ID_DIREKSI');
		$result=$this->MDireksiModel->deleteData($ID_DIREKSI);
		echo json_encode($result);
	}

	public function updateMDireksi($ID_DIREKSI)
=======
	public function deleteDireksi()
	{
		$ID_DIREKSI=$this->input->post('ID_DIREKSI');
		$result=$this->mDireksiModel->deleteData($ID_DIREKSI);
		echo json_encode($result);
	}

	public function updateDireksi($ID_DIREKSI)
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e
	{
		$result=$this->mDireksiModel->updateData($ID_DIREKSI);
		echo json_encode($result);
    }

<<<<<<< HEAD
    public function getMDireksiDesc()
=======
    public function getDireksiDesc()
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e
	{
		$data=$this->mDireksiModel->getJson('rows');
		echo json_encode($data);
	}

<<<<<<< HEAD
}
=======
}

/* End of file mDireksi.php */
/* Location: ./application/controllers/mDireksi.php */
>>>>>>> 15e631e957c38df17a42c24d024a0ae0111a671e
