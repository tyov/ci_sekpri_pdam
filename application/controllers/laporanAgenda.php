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
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">eOffice PDAM Malang - Laporan Persuratan, Halaman {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">LAPORAN PERSURATAN</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="5%" align="center"><strong>No</strong></td>
			<td width="16%" align="center"><strong>No Surat</strong></td>
			<td width="8%" align="center"><strong>Tanggal</strong></td>
			<td width="8%" align="center"><strong>Tipe Surat</strong></td>
			<td width="9%" align="center"><strong>Jenis Surat</strong></td>
			<td width="10%" align="center"><strong>Bagian</strong></td>
			<td width="13%" align="center"><strong>Tujuan</strong></td>
			<td width="31%" align="center"><strong>Perihal</strong></td>
		  </tr>';
		$no= 1;
		$data = $this->laporanAgendaModel->getJson();
		foreach($data as $row){
		//for($x=1; $x<=10; $x++){
		$html .='  
		  <tr>
			<td align="center">'.$no++.'</td>
			<td>'.$row->TGL_PEMESANAN.'</td>
			<td>'.$row->JENIS_KEGIATAN.'</td>
			<td>'.$row->ASAL_KEGIATAN.'</td>
			<td>'.$row->PEMESANAN.'</td>
			<td>'.$row->KETERANGAN.'</td>
			<td>Tes 1</td>
			<td>Tes 1</td>
		</tr>';
		}
		$html .= '</table>';
		$html .= '<br><b>Jumlah Surat : '.($no-1).'</b></br>';
		$html .= '<div style="margin-top: 20px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Malang, '.date('d M Y').'</div>';
		$html .= '<div style="padding-top: 100px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Manager Kuangan</div>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function getLaporan()
	{
		$data['rows']=$this->laporanAgendaModel->getJson();
		echo json_encode($data);
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */