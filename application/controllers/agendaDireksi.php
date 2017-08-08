<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class agendaDireksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('agendaDireksiModel');
	}

	public function getAgendaDireksi()
	{
		$data['rows']=$this->agendaDireksiModel->getJson('rows');
		$data['total']=$this->agendaDireksiModel->getJson('total');
		echo json_encode($data);
	}

	public function index()
	{
		$this->load->view('agendaDireksi');
	}

	public function newAgendaDireksi()
	{
		// print_r($_POST);exit;
		$result=$this->agendaDireksiModel->newData();
		echo json_encode($result);
	}

	public function deleteAgendaDireksi()
	{
		$ID_AGENDA_DIREKSI=$this->input->post('ID_AGENDA_DIREKSI');
		$result=$this->agendaDireksiModel->deleteData($ID_AGENDA_DIREKSI);
		echo json_encode($result);
	}

	public function updateAgendaDireksi($ID_AGENDA_DIREKSI)
	{
		$result=$this->agendaDireksiModel->updateData($ID_AGENDA_DIREKSI);
		echo json_encode($result);
    }

    public function getNomorDireksi()
    {
    	$result=$this->agendaDireksiModel->getDataDireksi();
		echo json_encode($result);
    }

    public function getTanggal()
    {
    	$result=$this->agendaDireksiModel->getDataTanggal();
		echo json_encode($result);
    }

}