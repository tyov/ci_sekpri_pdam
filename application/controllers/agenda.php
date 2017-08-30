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
		echo $result;
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

    public function batalAgenda($ID_AGENDA_RUANG_RAPAT)
	{
		$result=$this->agendaModel->batalData($ID_AGENDA_RUANG_RAPAT);
		echo $result;
	}

	public function cetakAbsensi($jum,$id)
	{
		// $TGL_MULAI = @str_replace("~", "/", $TGL_MULAI);
		// $TGL_SELESAI = @str_replace("~", "/", $TGL_SELESAI);
		$this->load->library('mpdf/mPdf');
		$mpdf = new mPDF('c','Legal-P');
		$html = '
		<htmlpagefooter name="MyFooter1">
			<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic;">
				<tr>
					<td width="33%" align="center" style="font-weight: bold; font-style: italic;">PDAM Malang - DAFTAR HADIR, hal {PAGENO} dari {nbpg}</td>
				</tr>
			</table>
		</htmlpagefooter>
		<sethtmlpagefooter name="MyFooter1" value="on" />
		<div style="font-size:20px; font-weight:bold">PDAM KOTA MALANG</div>
		<div style="font-weight:bold;">Jl. Terusan Danau Sentani No.100 - Malang</div>
		<div style="font-size:25px; font-weight:bold; text-align:center">DAFTAR HADIR</div>
		<div style="font-weight:bold;">Rapat :</div>
		<div style="font-weight:bold;">Jenis Kegiatan :</div>
		<div style="font-weight:bold;">Asal Kegiatan :</div>
		<div style="font-weight:bold;">Tanggal :</div>
		<div style="font-weight:bold;">Tempat :</div>';
		$html .='
		<table width="100%" border="1" cellspacing="0" cellpadding="2">
		  <tr>
			<td width="5%" align="center" height="40px"><strong>NO</strong></td>
			<td width="35%" align="center"><strong>NAMA</strong></td>
			<td width="30%" align="center"><strong>BAGIAN/INSTANSI</strong></td>
			<td width="15%" align="center"><strong>NO HP</strong></td>
			<td width="15%" align="center"><strong>TTD</strong></td>

		  </tr>';
		$no=1;
		$n=1;

		for ($pg=22; $pg<$jum ; $pg=$pg+28) { 
		}

		// $data = $this->agendaModel->getAbsen($TGL_MULAI,$TGL_SELESAI,@$JENIS_KEGIATAN);
		//foreach($data as $row){
		for($x=1; $x<=$pg; $x++){
		$y = $n++;
		$nomor = ($y<=$jum)?$y:"";
		$html .='  
		  <tr>
			<td align="center" height="35px">'.$nomor.'</td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>';
		}
		$html .= '</table>';
		// $html .= '<div style="padding-top: 40px; left:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Mengetahui</div>';
		// $html .= '<div style="padding-top: 100px; left:0px; position:absolute; font-weight:bold; width:300px; text-align:center">'.$dataPejabat->manajer.'</div>';
		// $html .= '<div style="margin-top: 20px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Malang, '.date('d M Y').'</div>';
		// $html .= '<div style="padding-top: 40px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">Dibuat Oleh</div>';
		// $html .= '<div style="padding-top: 100px; right:0px; position:absolute; font-weight:bold; width:300px; text-align:center">'.$dataPejabat->assmen.'</div>';
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

}

/* End of file mAsalKegiatan.php */
/* Location: ./application/controllers/mAsalKegiatan.php */