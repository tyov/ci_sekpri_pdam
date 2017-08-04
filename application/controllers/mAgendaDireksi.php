<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mAgendaDireksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mAgendaDireksiModel');
	}

	public function index()
	{
		$this->load->view('mAgendaDireksi');
	}

	public function getmAgendaDireksi()
	{
		$data['rows']=$this->mAgendaDireksiModel->getJson('rows');
		$data['total']=$this->mAgendaDireksiModel->getJson('total');
		echo json_encode($data);
	}

	public function newmAgendaDireksi()
	{
		$result=$this->mAgendaDireksiModel->newData();
		echo json_encode($result);
	}

	public function deletemAgendaDireksi()
	{
		$ID_DIREKSI=$this->input->post('ID_DIREKSI');
		$result=$this->mAgendaDireksiModel->deleteData($ID_DIREKSI);
		echo json_encode($result);
	}

	public function updateRuangRapat($ID_DIREKSI)
	{
		$result=$this->mAgendaDireksiModel->updateData($ID_DIREKSI);
		echo json_encode($result);
    }

    public function getmAgendaDireksiDesc()
	{
		$data=$this->mAgendaDireksiModel->getJson('rows');
		echo json_encode($data);
	}

}
