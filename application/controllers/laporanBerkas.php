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

	public function cetakLaporan($bulan,$tahun)
	{
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">eOffice PDAM Malang - Laporan Berkas Masuk ke SEKPRI, BULAN {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Laporan Berkas Masuk ke SEKPRI</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="10%" align="center"><strong>Tanggal Terima</strong></td>
			<td width="5.625%" align="center"><strong>Keu.</strong></td>
			<td width="5.625%" align="center"><strong>Hub.</strong></td>
			<td width="5.625%" align="center"><strong>Pengd.</strong></td>
			<td width="5.625%" align="center"><strong>Jpp</strong></td>
			<td width="5.625%" align="center"><strong>Litb.</strong></td>
			<td width="5.625%" align="center"><strong>Perwt.</strong></td>
			<td width="5.625%" align="center"><strong>Nrw</strong></td>
			<td width="5.625%" align="center"><strong>Prcn</strong></td>
			<td width="5.625%" align="center"><strong>Sim</strong></td>
			<td width="5.625%" align="center"><strong>Wasker</strong></td>
			<td width="5.625%" align="center"><strong>Prod</strong></td>
			<td width="5.625%" align="center"><strong>Spi</strong></td>
			<td width="5.625%" align="center"><strong>Sdm</strong></td>
			<td width="5.625%" align="center"><strong>Umum</strong></td>
			<td width="5.625%" align="center"><strong>Total</strong></td>
		  </tr>';
		$no=1;
		$data = $this->laporanBerkasModel->getJson('rows',$bulan,$tahun);
		foreach($data as $row){
		//for($x=1; $x<=10; $x++){
		$html .='  
		  <tr>
			<td align="center">'.$row->TGL_TERIMA.'</td>
			<td align="center">'.$row->Keuangan.'</td>
			<td align="center">'.$row->{'Hubungan Pelanggan'}.'</td>
			<td align="center">'.$row->Pengadaan.'</td>
			<td align="center">'.$row->{'Jaringan Pipa Pelanggan'}.'</td>
			<td align="center">'.$row->{'Pusat Penelitian dan Pengemban'}.'</td>
			<td align="center">'.$row->Perawatan.'</td>
			<td align="center">'.$row->{'Kehilangan Air'}.'</td>
			<td align="center">'.$row->{'Perencanaan Teknik'}.'</td>
			<td align="center">'.$row->{'Sistem Informasi Manajemen'}.'</td>
			<td align="center">'.$row->{'Pengawasan Pekerjaan'}.'</td>
			<td align="center">'.$row->Produksi.'</td>
			<td align="center">'.$row->{'Satuan Pengawasan Internal'}.'</td>
			<td align="center">'.$row->{'Sumber Daya Manusia'}.'</td>
			<td align="center">'.$row->Umum.'</td>
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
		$data['rows']=$this->laporanBerkasModel->getJson('rows');
		$data['total']=$this->laporanBerkasModel->getJson('total');
		echo json_encode($data);
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */