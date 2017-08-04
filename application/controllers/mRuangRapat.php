<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRuangRapat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mRuangRapatModel');
	}

	public function index()
	{
		$this->load->view('mRuangRapat');
	}

	public function getRuangRapat()
	{
		$data['rows']=$this->mRuangRapatModel->getJson('rows');
		$data['total']=$this->mRuangRapatModel->getJson('total');
		echo json_encode($data);
	}

	public function newRuangRapat()
	{
		$result=$this->mRuangRapatModel->newData();
		echo json_encode($result);
	}

	public function deleteRuangRapat()
	{
		$ID_RUANG_RAPAT=$this->input->post('ID_RUANG_RAPAT');
		$result=$this->mRuangRapatModel->deleteData($ID_RUANG_RAPAT);
		echo json_encode($result);
	}

	public function updateRuangRapat($ID_RUANG_RAPAT)
	{
		$result=$this->mRuangRapatModel->updateData($ID_RUANG_RAPAT);
		echo json_encode($result);
    }

    public function getRuangRapatDesc()
	{
		$data=$this->mRuangRapatModel->getJson('rows');
		echo json_encode($data);
	}

}

/* End of file mRuangRapat.php */
/* Location: ./application/controllers/mRuangRapat.php */