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

	public function cetakLaporan2($bulan,$tahun)
	{
		$dataPejabat = $this->laporanBerkasModel->getDataPejabat();
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

	public function getLaporan($eksp,$periode)
	{
		$data['rows']			= $this->laporanBerkasModel->getJson2($eksp,$periode);
		$keuangan=0;
		$hubunganPelanggan=0;
		$pengadaan=0;
		$jaringanPipaPelanggan=0;
		$pusatPenelitianDanPengembangan=0;
		$perawatan=0;
		$kehilanganAir=0;
		$perencanaanTeknik=0;
		$sistemInformasiManajemen=0;
		$pengawasanPekerjaan=0;
		$produksi=0;
		$satuanPengawasanInternal=0;
		$sumberDayaManusia=0;
		$umum=0;
		$grandTotal=0;

		foreach($data['rows'] as $row){
			$keuangan+=$row->Keuangan;
			$hubunganPelanggan+=$row->{'Hubungan Pelanggan'};
			$pengadaan+=$row->Pengadaan;
			$jaringanPipaPelanggan+=$row->{'Jaringan Pipa Pelanggan'};
			$pusatPenelitianDanPengembangan+=$row->{'Pusat Penelitian dan Pengemban'};
			$perawatan+=$row->Perawatan;
			$kehilanganAir+=$row->{'Kehilangan Air'};
			$perencanaanTeknik+=$row->{'Perencanaan Teknik'};
			$sistemInformasiManajemen+=$row->{'Sistem Informasi Manajemen'};
			$pengawasanPekerjaan+=$row->{'Pengawasan Pekerjaan'};
			$produksi+=$row->Produksi;
			$satuanPengawasanInternal+=$row->{'Satuan Pengawasan Internal'};
			$sumberDayaManusia+=$row->{'Sumber Daya Manusia'};
			$umum+=$row->Umum;
			$grandTotal+=$row->Total;
		}

		$footer['TGL_TERIMA'] 	= 'Total';
		$footer['Keuangan'] 	= $keuangan;
		$footer['Hubungan Pelanggan'] 	= $hubunganPelanggan;
		$footer['Pengadaan'] 	= $pengadaan;
		$footer['Jaringan Pipa Pelanggan'] 	= $jaringanPipaPelanggan;
		$footer['Pusat Penelitian dan Pengemban'] 	= $pusatPenelitianDanPengembangan;
		$footer['Perawatan'] 	= $perawatan;
		$footer['Kehilangan Air'] 	= $kehilanganAir;
		$footer['Perencanaan Teknik'] 	= $perencanaanTeknik;
		$footer['Sistem Informasi Manajemen'] 	= $sistemInformasiManajemen;
		$footer['Pengawasan Pekerjaan'] 	= $pengawasanPekerjaan;
		$footer['Produksi'] 	= $produksi;
		$footer['Satuan Pengawasan Internal'] 	= $satuanPengawasanInternal;
		$footer['Sumber Daya Manusia'] 	= $sumberDayaManusia;
		$footer['Umum'] 	= $umum;
		$footer['Total'] 	= $grandTotal;

		$data['footer'][] 		= $footer;

		echo json_encode($data);
	}

	public function cetakLaporan($eksp,$periode)
	{
		$tahun = substr($periode,0,-2);
		$number = substr($periode,4,2);
		$dataPejabat = $this->laporanBerkasModel->getDataPejabat();

		if ($number=='01') {
			$bulan='Januari';
		} elseif ($number=='02') {
			$bulan='Februari';
		} elseif ($number=='03') {
			$bulan='Maret';
		} elseif ($number=='04') {
			$bulan='April';
		} elseif ($number=='05') {
			$bulan='Mei';
		} elseif ($number=='06') {
			$bulan='Juni';
		} elseif ($number=='07') {
			$bulan='Juli';
		} elseif ($number=='08') {
			$bulan='Agustus';
		} elseif ($number=='09') {
			$bulan='September';
		} elseif ($number=='10') {
			$bulan='Oktober';
		} elseif ($number=='11') {
			$bulan='November';
		} else {
			$bulan='Desember';
		}

		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-L');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">PDAM Kota Malang - Laporan Berkas Masuk ke SEKPRI, Bulan '.$bulan.' Tahun '.$tahun.'</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Laporan Berkas Masuk ke SEKPRI</div>
		<div style="font-size:20px; font-weight:bold; text-align:center">Bulan '.$bulan.' Tahun '.$tahun.'</div>';
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
		$data = $this->laporanBerkasModel->getJson2($eksp,$periode);
		$keuangan=0;
		$hubunganPelanggan=0;
		$pengadaan=0;
		$jaringanPipaPelanggan=0;
		$pusatPenelitianDanPengembangan=0;
		$perawatan=0;
		$kehilanganAir=0;
		$perencanaanTeknik=0;
		$sistemInformasiManajemen=0;
		$pengawasanPekerjaan=0;
		$produksi=0;
		$satuanPengawasanInternal=0;
		$sumberDayaManusia=0;
		$umum=0;
		$grandTotal=0;
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
			<td align="center"><strong>'.$row->Total.'</strong></td>
		</tr>';
		$keuangan+=$row->Keuangan;
		$hubunganPelanggan+=$row->{'Hubungan Pelanggan'};
		$pengadaan+=$row->Pengadaan;
		$jaringanPipaPelanggan+=$row->{'Jaringan Pipa Pelanggan'};
		$pusatPenelitianDanPengembangan+=$row->{'Pusat Penelitian dan Pengemban'};
		$perawatan+=$row->Perawatan;
		$kehilanganAir+=$row->{'Kehilangan Air'};
		$perencanaanTeknik+=$row->{'Perencanaan Teknik'};
		$sistemInformasiManajemen+=$row->{'Sistem Informasi Manajemen'};
		$pengawasanPekerjaan+=$row->{'Pengawasan Pekerjaan'};
		$produksi+=$row->Produksi;
		$satuanPengawasanInternal+=$row->{'Satuan Pengawasan Internal'};
		$sumberDayaManusia+=$row->{'Sumber Daya Manusia'};
		$umum+=$row->Umum;
		$grandTotal+=$row->Total;
		}
		$html .= '<tr>
			<td align="center"><strong>TOTAL</strong></td>
			<td align="center"><strong>'.$keuangan.'</strong></td>
			<td align="center"><strong>'.$hubunganPelanggan.'</strong></td>
			<td align="center"><strong>'.$pengadaan.'</strong></td>
			<td align="center"><strong>'.$jaringanPipaPelanggan.'</strong></td>
			<td align="center"><strong>'.$pusatPenelitianDanPengembangan.'</strong></td>
			<td align="center"><strong>'.$perawatan.'</strong></td>
			<td align="center"><strong>'.$kehilanganAir.'</strong></td>
			<td align="center"><strong>'.$perencanaanTeknik.'</strong></td>
			<td align="center"><strong>'.$sistemInformasiManajemen.'</strong></td>
			<td align="center"><strong>'.$pengawasanPekerjaan.'</strong></td>
			<td align="center"><strong>'.$produksi.'</strong></td>
			<td align="center"><strong>'.$satuanPengawasanInternal.'</strong></td>
			<td align="center"><strong>'.$sumberDayaManusia.'</strong></td>
			<td align="center"><strong>'.$umum.'</strong></td>
			<td align="center"><strong>'.$grandTotal.'</strong></td>
		</tr>';
		$html .= '</table>';
		$html .= '<div style="padding-top: 40px; left:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Mengetahui</div>';
		$html .= '<div style="padding-top: 100px; left:0px; position:absolute; font-weight:bold; width:300px; text-align:center">'.$dataPejabat->manajer.'</div>';
		$html .= '<div style="margin-top: 20px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Malang, '.date('d M Y').'</div>';
		$html .= '<div style="padding-top: 40px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Dibuat Oleh</div>';
		$html .= '<div style="padding-top: 100px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">'.$dataPejabat->assmen.'</div>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */