<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendamodel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_AGENDA_RUANG_RAPAT';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;
        //searching
        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

        if ($jenis=='total') {
        	$result = $this->db->query("select * from TBL_AGENDA_RUANG_RAPAT")->num_rows();
        	return $result;
        } elseif ($jenis=='rows') {
        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("a.ID_AGENDA_RUANG_RAPAT,a.ID_JENIS_KEGIATAN,a.PEMESAN,a.ID_ASAL_KEGIATAN,a.ID_RUANG_RAPAT,
				convert(varchar(20),TGL_PEMESANAN,120) as TGL_PEMESANAN,
				a.KETERANGAN,a.JUMLAH,
				convert(varchar(20),a.TGL_MULAI,120) as TGL_MULAI,
				convert(varchar(20),a.TGL_SELESAI,120) as TGL_SELESAI, 
				b.RUANG_RAPAT ID_RUANG_RAPAT_DESC, c.nama_lengkap PEMESAN_DESC, d.JENIS_KEGIATAN ID_JENIS_KEGIATAN_DESC, e.ASAL_KEGIATAN ID_ASAL_KEGIATAN_DESC");
			$this->db->from("TBL_AGENDA_RUANG_RAPAT a");
			$this->db->join("TBL_M_RUANG_RAPAT b", "a.ID_RUANG_RAPAT=b.ID_RUANG_RAPAT");
			$this->db->join("KARYAWAN c", "a.PEMESAN=c.nip");
			$this->db->join("TBL_M_JENIS_KEGIATAN d", "a.ID_JENIS_KEGIATAN=d.ID_JENIS_KEGIATAN");
			$this->db->join("TBL_M_ASAL_KEGIATAN e", "a.ID_ASAL_KEGIATAN=e.ID_ASAL_KEGIATAN");
        	if($searchKey<>''){
				$this->db->where($searchKey." like '%".$searchValue."%'");	
			}
        	$hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        	return $hasil;
    	}
	}

	public function newData(){

		$ID_JENIS_KEGIATAN = htmlspecialchars($_REQUEST['ID_JENIS_KEGIATAN']);
		$PEMESAN = htmlspecialchars($_REQUEST['PEMESAN']);
		$TGL_PEMESANAN = date('Y-m-d H:i:s');
		$ID_ASAL_KEGIATAN = htmlspecialchars($_REQUEST['ID_ASAL_KEGIATAN']);
		$TGL_MULAI = htmlspecialchars($_REQUEST['TGL_MULAI']);
		$TGL_SELESAI = htmlspecialchars($_REQUEST['TGL_SELESAI']);
		$ID_RUANG_RAPAT = htmlspecialchars($_REQUEST['ID_RUANG_RAPAT']);
		$KETERANGAN = htmlspecialchars($_REQUEST['KETERANGAN']);
		$JUMLAH = htmlspecialchars($_REQUEST['JUMLAH']);

		$TGL_MULAI_NEW = date("Y-m-d H:i:s", strtotime($TGL_MULAI));
		$TGL_SELESAI_NEW = date("Y-m-d H:i:s", strtotime($TGL_SELESAI));

		$TGL_PEMESANAN = $this->db->query("select getDate() as baru")->row_array();
		$id_agenda_rapat = $this->db->query("select dbo.getNomorRapat() as baru")->row_array();
		$ket_ruang_rapat=$this->db->query("select keterangan 
											from TBL_M_RUANG_RAPAT where ID_RUANG_RAPAT='".$ID_RUANG_RAPAT."'")->row_array();
		 
		$CEK = $this->db->query("select count(*) AS JUMLAH from TBL_AGENDA_RUANG_RAPAT 
WHERE ID_RUANG_RAPAT in(".$ket_ruang_rapat['keterangan'].") AND (('$TGL_MULAI_NEW' >= TGL_MULAI AND '$TGL_MULAI_NEW' <= TGL_SELESAI) OR ('$TGL_SELESAI_NEW' >= TGL_MULAI AND '$TGL_SELESAI_NEW' <= TGL_SELESAI))
");
		if ($CEK->row()->JUMLAH == "0") {
			$data = array(
					'ID_AGENDA_RUANG_RAPAT'=>$id_agenda_rapat['baru'],
			        'ID_JENIS_KEGIATAN' => $ID_JENIS_KEGIATAN,
			        'PEMESAN' => $PEMESAN,
			        'TGL_PEMESANAN' => $TGL_PEMESANAN['baru'],
			        'ID_ASAL_KEGIATAN' => $ID_ASAL_KEGIATAN,
			        'TGL_MULAI' => $TGL_MULAI,
			        'TGL_SELESAI' => $TGL_SELESAI,
			        'ID_RUANG_RAPAT' => $ID_RUANG_RAPAT,
			        'KETERANGAN' => $KETERANGAN,
			        'JUMLAH' => $JUMLAH,
			        
			);

			if ($this->db->insert('TBL_AGENDA_RUANG_RAPAT', $data)) {
				return "sukses";
			} else {
				return "gagal";
			}
		} else {
			return "penuh";
		}
	}

	public function deleteData($ID_AGENDA_RUANG_RAPAT)
	{
		$this->db->where('ID_AGENDA_RUANG_RAPAT', $ID_AGENDA_RUANG_RAPAT);
		if ($this->db->delete('TBL_AGENDA_RUANG_RAPAT')) {
			return "success";
		} else {
			return "delete failed";
		}
	}

	public function updateData($ID_AGENDA_RUANG_RAPAT)
	{
		$ID_JENIS_KEGIATAN = htmlspecialchars($_REQUEST['ID_JENIS_KEGIATAN']);
		$PEMESAN = htmlspecialchars($_REQUEST['PEMESAN']);
		$ID_ASAL_KEGIATAN = htmlspecialchars($_REQUEST['ID_ASAL_KEGIATAN']);
		$TGL_MULAI = htmlspecialchars($_REQUEST['TGL_MULAI']);
		$TGL_SELESAI = htmlspecialchars($_REQUEST['TGL_SELESAI']);
		$ID_RUANG_RAPAT = htmlspecialchars($_REQUEST['ID_RUANG_RAPAT']);
		$KETERANGAN = htmlspecialchars($_REQUEST['KETERANGAN']);
		$JUMLAH = htmlspecialchars($_REQUEST['JUMLAH']);

		$data = array(
		        'ID_JENIS_KEGIATAN' => $ID_JENIS_KEGIATAN,
		        'PEMESAN' => $PEMESAN,
		        'ID_ASAL_KEGIATAN' => $ID_ASAL_KEGIATAN,
		        'TGL_MULAI' => $TGL_MULAI,
		        'TGL_SELESAI' => $TGL_SELESAI,
		        'ID_RUANG_RAPAT' => $ID_RUANG_RAPAT,
		        'KETERANGAN' => $KETERANGAN,
		        'JUMLAH' => $JUMLAH,
		        
		);

		$this->db->where('ID_AGENDA_RUANG_RAPAT', $ID_AGENDA_RUANG_RAPAT);

		if ($this->db->update('TBL_AGENDA_RUANG_RAPAT', $data)) {
			return "success";
		} else {
			return "update failed";
		}
	}

		public function getDataRapat()
	{
		$this->db->select('dbo.getNomorRapat() as nomor');
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