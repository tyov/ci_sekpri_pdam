<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanBerkas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporanBerkasModel');
	}

	public function index()
	{
		
	}

	public function cetakLaporan()
	{
		$filename = time()."_order.pdf";

		$html = $this->load->view('laporanBerkas',$data,true);

		// unpaid_voucher is unpaid_voucher.php file in view directory and $data variable has infor mation that you want to render on view.

		$this->load->library('M_pdf');

		$this->m_pdf->pdf->WriteHTML($html);

		//download it D save F.

		$this->m_pdf->pdf->Output("./uploads/".$filename, "F");
	}

	public function getLaporan()
	{
		$data['rows']=$this->laporanBerkasModel->getJson();
		echo json_encode($data);
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */