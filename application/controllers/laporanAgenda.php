<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanAgenda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporanAgendaModel');
	}

	public function index()
	{
		
	}

	public function cetakLaporan()
	{
		$filename = time()."_order.pdf";

		$html = $this->load->view('LaporanAgenda',$data,true);

		// unpaid_voucher is unpaid_voucher.php file in view directory and $data variable has infor mation that you want to render on view.

		$this->load->library('M_pdf');

		$this->m_pdf->pdf->WriteHTML($html);

		//download it D save F.

		$this->m_pdf->pdf->Output("./uploads/".$filename, "F");
	}

	public function getLaporan()
	{
		$data['rows']=$this->laporanAgendaModel->getJson();
		echo json_encode($data);
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */