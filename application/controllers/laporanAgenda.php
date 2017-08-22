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

	public function cetakLaporan($TGL_MULAI,$TGL_SELESAI,$JENIS_KEGIATAN)
	{
		$TGL_MULAI = str_replace("~", "/", $TGL_MULAI);
		$TGL_SELESAI = str_replace("~", "/", $TGL_SELESAI);
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">eOffice PDAM Malang - Laporan Semua Kegiatan SEKPRI, BULAN {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Laporan Semua Kegiatan SEKPRI</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="10%" align="center"><strong>Tgl Pesan</strong></td>
			<td width="16%" align="center"><strong>Jenis Kegiatan</strong></td>
			<td width="10%" align="center"><strong>Asal Kegiatan</strong></td>
			<td width="10%" align="center"><strong>Pemesan</strong></td>
			<td width="15%" align="center"><strong>Keterangan</strong></td>
			<td width="8%" align="center"><strong>Jumlah</strong></td>
			<td width="10%" align="center"><strong>Ruangan</strong></td>
			<td width="10%" align="center"><strong>Tgl Mulai</strong></td>
			<td width="10%" align="center"><strong>Tgl Selesai</strong></td>
		  </tr>';
		$no=1;
		$data = $this->laporanAgendaModel->getJson($TGL_MULAI,$TGL_SELESAI,$JENIS_KEGIATAN);
		foreach($data as $row){
		//for($x=1; $x<=10; $x++){
		$html .='  
		  <tr>
			<td>'.$row->TGL_PEMESANAN.'</td>
			<td>'.$row->JENIS_KEGIATAN.'</td>
			<td>'.$row->ASAL_KEGIATAN.'</td>
			<td>'.$row->PEMESAN.'</td>
			<td>'.$row->KETERANGAN.'</td>
			<td>'.$row->JUMLAH.'</td>
			<td>'.$row->RUANG_RAPAT.'</td>
			<td>'.$row->TGL_MULAI.'</td>
			<td>'.$row->TGL_SELESAI.'</td>
		</tr>';
		}
		$html .= '</table>';
		$html .= '<br><b>Jumlah Surat : '.($no-1).'</b></br>';
		$html .= '<div style="margin-top: 20px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Malang, '.date('d M Y').'</div>';
		$html .= '<div style="padding-top: 100px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Manager Kuangan</div>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function getLaporan($bulan="",$tahun="")
	{
		$TGL_SELESAI=@$this->input->post('TGL_SELESAI');
		$TGL_MULAI=@$this->input->post('TGL_MULAI');
		$JENIS_KEGIATAN=@$this->input->post('JENIS_KEGIATAN');

		$data['rows']=$this->laporanAgendaModel->getJson($TGL_MULAI,$TGL_SELESAI,$JENIS_KEGIATAN);
		echo json_encode($data);

	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */