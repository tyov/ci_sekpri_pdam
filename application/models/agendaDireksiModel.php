<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class agendaDireksiModel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_AGENDA_DIREKSI';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;
        //searching
        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$TGL_MULAI=isset($_POST['TGL_MULAI']) ? strval($_POST['TGL_MULAI']) : '';
		$TGL_SELESAI=isset($_POST['TGL_SELESAI']) ? strval($_POST['TGL_SELESAI']) : '';

        if ($jenis=='total') {
        	$result = $this->db->query("select * from TBL_AGENDA_DIREKSI")->num_rows();
        	return $result;
        } elseif ($jenis=='rows') {
        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("a.ID_AGENDA_DIREKSI,a.ID_DIREKSI,
				convert(varchar(20),TGL_ACARA,120) as TGL_ACARA,convert(varchar(20),a.TGL_KEMBALI,120) as TGL_KEMBALI,
				a.KEGIATAN,a.PENGUNDANG,a.KETERANGAN,a.LOKASI, 
				b.DIREKSI ID_DIREKSI_DESC");
			$this->db->from("TBL_AGENDA_DIREKSI a");
			$this->db->join("TBL_M_DIREKSI b", "a.ID_DIREKSI=b.ID_DIREKSI");
			if($TGL_MULAI<>'' && $searchKey==''){
				$this->db->where("CONVERT(varchar(20), TGL_ACARA, 101) between '$TGL_MULAI' and '$TGL_SELESAI'");
			}
        	if($searchKey<>''){
				$this->db->where($searchKey." like '%".$searchValue."%'");	
			}
        	$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        	return $hasil;
    	}
	}

	public function newData(){

		$ID_DIREKSI = htmlspecialchars($_REQUEST['ID_DIREKSI']);
		$TGL_ACARA = htmlspecialchars($_REQUEST['TGL_ACARA']);
		$TGL_KEMBALI = htmlspecialchars($_REQUEST['TGL_KEMBALI']);
		$KEGIATAN = htmlspecialchars($_REQUEST['KEGIATAN']);
		$PENGUNDANG = htmlspecialchars($_REQUEST['PENGUNDANG']);
		$KETERANGAN = htmlspecialchars($_REQUEST['KETERANGAN']);
		$LOKASI = htmlspecialchars($_REQUEST['LOKASI']);

		/*$TGL_PEMESANAN = $this->db->query("select getDate() as baru")->row_array();*/
		$ID_AGENDA_DIREKSI = $this->db->query("select dbo.getNomorDireksi() as baru")->row_array();
		 

		$data = array(
				'ID_AGENDA_DIREKSI'=>$ID_AGENDA_DIREKSI['baru'],
		        'ID_DIREKSI' => $ID_DIREKSI,
		        'TGL_ACARA' => $TGL_ACARA,
		        'TGL_KEMBALI' => $TGL_KEMBALI,
		        'KEGIATAN' => $KEGIATAN,
		        'PENGUNDANG' => $PENGUNDANG,
		        'KETERANGAN' => $KETERANGAN,
		        'LOKASI' => $LOKASI,
		);

		if ($this->db->insert('TBL_AGENDA_DIREKSI', $data)) {
			return "success";
		} else {
			return "insert failed";
		}
	}

	public function deleteData($ID_AGENDA_DIREKSI)
	{
		$this->db->where('ID_AGENDA_DIREKSI', $ID_AGENDA_DIREKSI);
		if ($this->db->delete('TBL_AGENDA_DIREKSI')) {
			return "success";
		} else {
			return "delete failed";
		}
	}

	public function updateData($ID_AGENDA_DIREKSI)
	{
		$ID_DIREKSI = htmlspecialchars($_REQUEST['ID_DIREKSI']);
		$TGL_ACARA = htmlspecialchars($_REQUEST['TGL_ACARA']);
		$TGL_KEMBALI = htmlspecialchars($_REQUEST['TGL_KEMBALI']);
		$KEGIATAN = htmlspecialchars($_REQUEST['KEGIATAN']);
		$PENGUNDANG = htmlspecialchars($_REQUEST['PENGUNDANG']);
		$KETERANGAN = htmlspecialchars($_REQUEST['KETERANGAN']);
		$LOKASI = htmlspecialchars($_REQUEST['LOKASI']);

		$data = array(
		        'ID_DIREKSI' => $ID_DIREKSI,
		        'TGL_ACARA' => $TGL_ACARA,
		        'TGL_KEMBALI' => $TGL_KEMBALI,
		        'KEGIATAN' => $KEGIATAN,
		        'PENGUNDANG' => $PENGUNDANG,
		        'KETERANGAN' => $KETERANGAN,
		        'LOKASI' => $LOKASI,
		);

		$this->db->where('ID_AGENDA_DIREKSI', $ID_AGENDA_DIREKSI);

		if ($this->db->update('TBL_AGENDA_DIREKSI', $data)) {
			return "success";
		} else {
			return "update failed";
		}
	}

		public function getDataDireksi()
	{
		$this->db->select('dbo.getNomorDireksi() as nomor');
		$hasil=$this->db->get()->row_array();
        return $hasil;
	}

	public function getDataTanggal()
	{
		$this->db->select('convert(varchar(20),getDate(),120) as tanggal');
		$hasil=$this->db->get()->row_array();
		return $hasil;
	}
}