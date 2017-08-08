<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EkspedisiModel extends CI_Model {
	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_EKSPEDISI';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;
        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		if ($jenis=='total') {
        	$result = $this->db->query("select * from EKSPEDISI")->num_rows();
        	return $result;
        } elseif ($jenis=='rows') {
        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
        	$this->db->select('a.ID_EKSPEDISI, a.ID_BERKAS, a.ID_JENIS_EKSPEDISI, a.ID_STATUS, a.TGL_EKSPEDISI, convert(varchar(20),a.TGL_EKSPEDISI,120) as TGL_EKSPEDISI_DESC, b.JENIS_EKSPEDISI as ID_JENIS_EKSPEDISI_DESC, c.STATUS as ID_STATUS_DESC');
        	$this->db->from('EKSPEDISI a');
        	$this->db->join("TBL_M_JENIS_EKSPEDISI b", "a.ID_JENIS_EKSPEDISI=b.ID_JENIS_EKSPEDISI");
        	$this->db->join("TBL_M_STATUS c", "a.ID_STATUS=c.ID_STATUS");
			// $this->db->select("a.ID_EKSPEDISI, a.TGL_TERIMA, convert(varchar(20),a.TGL_TERIMA,120) as TGL_TERIMA_DESC, a.PENERIMA, a.PENGIRIM, a.BAGIAN, a.PERIHAL, a.TGL_AMBIL, convert(varchar(20),a.TGL_AMBIL,120) as TGL_AMBIL_DESC, a.PENGAMBIL, c.nama_lengkap PENERIMA_DESC, d.nama_lengkap PENGIRIM_DESC, e.nama_lengkap PENGAMBIL_DESC, b.nama_bagian BAGIAN_DESC");
			// $this->db->from("EKSPEDISI a");
			// $this->db->join("(SELECT left(kode_jabatan,4) as KODE, nama_bagian FROM BAGIAN group by left(kode_jabatan,4), nama_bagian) b", "a.BAGIAN = b.KODE");
			// $this->db->join("KARYAWAN c", "a.PENERIMA=c.nip");
			// $this->db->join("KARYAWAN d", "a.PENGIRIM=d.nip");
			// $this->db->join("KARYAWAN e", "a.PENGAMBIL=e.nip");
        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}
        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}
	public function newData()
	{
		$ID_BERKAS = htmlspecialchars($_REQUEST['ID_BERKAS']);
		$ID_JENIS_EKSPEDISI = htmlspecialchars($_REQUEST['ID_JENIS_EKSPEDISI']);
		$ID_STATUS = htmlspecialchars($_REQUEST['ID_STATUS']);
		$TGL_EKSPEDISI = htmlspecialchars($_REQUEST['TGL_EKSPEDISI']);
		$data = array(
		        'ID_BERKAS' => $ID_BERKAS,
		        'ID_JENIS_EKSPEDISI' => $ID_JENIS_EKSPEDISI,
		        'ID_STATUS' => $ID_STATUS,
		        'TGL_EKSPEDISI' => $TGL_EKSPEDISI
		);
		if ($this->db->insert('EKSPEDISI', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}
	public function updateData($ID_EKSPEDISI)
	{
		$ID_BERKAS = htmlspecialchars($_REQUEST['ID_BERKAS']);
		$ID_JENIS_EKSPEDISI = htmlspecialchars($_REQUEST['ID_JENIS_EKSPEDISI']);
		$ID_STATUS = htmlspecialchars($_REQUEST['ID_STATUS']);
		$TGL_EKSPEDISI = htmlspecialchars($_REQUEST['TGL_EKSPEDISI']);
		$data = array(
		        'ID_BERKAS' => $ID_BERKAS,
		        'ID_JENIS_EKSPEDISI' => $ID_JENIS_EKSPEDISI,
		        'ID_STATUS' => $ID_STATUS,
		        'TGL_EKSPEDISI' => $TGL_EKSPEDISI
		);
		$this->db->where('ID_EKSPEDISI', $ID_EKSPEDISI);
		if ($this->db->update('EKSPEDISI', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}
	public function deleteData($ID_EKSPEDISI)
	{
		$this->db->where('ID_EKSPEDISI', $ID_EKSPEDISI);
		if ($this->db->delete('EKSPEDISI')) {
			$result['error']=false;
		} else {
			$result['error']=true;
		}
		
		return $result;
	}
	
}
/* End of file ekspedisiModel.php */
/* Location: ./application/models/ekspedisiModel.php */