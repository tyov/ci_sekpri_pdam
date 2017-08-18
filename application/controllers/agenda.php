<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class agenda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('agendaModel');
	}

	public function index()
	{
		$this->load->view('agenda');
	}

	public function getAgenda()
	{
		$data['rows']=$this->agendaModel->getJson('rows');
		$data['total']=$this->agendaModel->getJson('total');
		echo json_encode($data);
	}

	public function newAgenda()
	{
		// print_r($_POST);exit;
		$result=$this->agendaModel->newData();
		echo $result;
	}

	public function deleteAgenda()
	{
		$ID_AGENDA_RUANG_RAPAT=$this->input->post('ID_AGENDA_RUANG_RAPAT');
		$result=$this->agendaModel->deleteData($ID_AGENDA_RUANG_RAPAT);
		echo json_encode($result);
	}

	public function updateAgenda($ID_AGENDA_RUANG_RAPAT)
	{
		$result=$this->agendaModel->updateData($ID_AGENDA_RUANG_RAPAT);
		echo json_encode($result);
    }

        public function getNomorRapat()
    {
    	$result=$this->agendaModel->getDataRapat();
		echo json_encode($result);
    }

    public function getTanggal()
    {
    	$result=$this->agendaModel->getDataTanggal();
		echo json_encode($result);
    }

}

/* End of file mAsalKegiatan.php */
/* Location: ./application/controllers/mAsalKegiatan.php */