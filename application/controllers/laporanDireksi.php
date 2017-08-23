<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanDireksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporanDireksiModel');
	}

	public function index()
	{
		
	}

	public function cetakLaporan($TGL_ACARA="",$TGL_KEMBALI="",$ID_DIREKSI="")
	{
		$TGL_ACARA = str_replace("~", "/", $TGL_ACARA);
		$TGL_KEMBALI = str_replace("~", "/", $TGL_KEMBALI);
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">PDAM Malang - Laporan Semua Kegiatan DIREKSI, Page {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Laporan Semua Kegiatan DIREKSI</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="10%" align="center"><strong>Tgl Acara</strong></td>
			<td width="16%" align="center"><strong>Tgl Kembali</strong></td>
			<td width="10%" align="center"><strong>Kegiatan</strong></td>
			<td width="10%" align="center"><strong>Pengundang</strong></td>
			<td width="15%" align="center"><strong>Keterangan</strong></td>
			<td width="10%" align="center"><strong>Lokasi</strong></td>
			<td width="10%" align="center"><strong>Dihadiri oleh</strong></td>
		  </tr>';
		$no=1;
		$data = $this->laporanDireksiModel->getJson($TGL_ACARA,$TGL_KEMBALI,@$ID_DIREKSI);
		foreach($data as $row){
		//for($x=1; $x<=10; $x++){
		$html .='  
		  <tr>
			<td>'.$row->TGL_ACARA.'</td>
			<td>'.$row->TGL_KEMBALI.'</td>
			<td>'.$row->KEGIATAN.'</td>
			<td>'.$row->PENGUNDANG.'</td>
			<td>'.$row->KETERANGAN.'</td>
			<td>'.$row->LOKASI.'</td>
			<td>'.$row->ID_DIREKSI_DESC.'</td>

		</tr>';
		}
		$html .= '</table>';
		$html .= '<div style="margin-top: 20px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Malang, '.date('d M Y').'</div>';
		$html .= '<div style="padding-top: 100px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Manager Kuangan</div>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function getLaporan()
	{
		$TGL_ACARA=@$this->input->post('TGL_ACARA');
		$TGL_KEMBALI=@$this->input->post('TGL_KEMBALI');
		$ID_DIREKSI=@$this->input->post('ID_DIREKSI');

		$data['rows']=$this->laporanDireksiModel->getJson($TGL_ACARA,$TGL_KEMBALI,$ID_DIREKSI);
		echo json_encode($data);

	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */