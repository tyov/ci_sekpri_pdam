<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mDireksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mDireksiModel');
	}

	public function index()
	{
		$this->load->view('mDireksi');
	}

	public function getMDireksi()

	{
		$data['rows']=$this->mDireksiModel->getJson('rows');
		$data['total']=$this->mDireksiModel->getJson('total');
		echo json_encode($data);
	}

	public function newMDireksi()

	{
		$result=$this->mDireksiModel->newData();
		echo json_encode($result);
	}

	public function deleteMDireksi()
	{
		$ID_DIREKSI=$this->input->post('ID_DIREKSI');
		$result=$this->mDireksiModel->deleteData($ID_DIREKSI);
		echo json_encode($result);
	}

	public function updateMDireksi($ID_DIREKSI)

	{
		$result=$this->mDireksiModel->updateData($ID_DIREKSI);
		echo json_encode($result);
    }

    public function getMDireksiDesc()

	{
		$data=$this->mDireksiModel->getJson('rows');
		echo json_encode($data);
	}

}