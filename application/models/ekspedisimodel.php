<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EkspedisiModel extends CI_Model {
	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'TGL_EKSPEDISI_DESC';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;
        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';
		$TGL_MULAI=isset($_POST['TGL_MULAI']) ? strval($_POST['TGL_MULAI']) : '';
		$TGL_SELESAI=isset($_POST['TGL_SELESAI']) ? strval($_POST['TGL_SELESAI']) : '';
		if ($jenis=='total') {
        	$result = $this->db->query("select * from EKSPEDISI")->num_rows();
        	return $result;
        } elseif ($jenis=='rows') {
        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
        	$this->db->select('a.ID_EKSPEDISI, a.ID_BERKAS, a.ID_JENIS_EKSPEDISI, a.ID_STATUS, convert(varchar(20),a.TGL_EKSPEDISI,120) as TGL_EKSPEDISI_DESC, convert(varchar(20),a.TGL_SELESAI,120) as TGL_SELESAI_DESC, b.JENIS_EKSPEDISI as ID_JENIS_EKSPEDISI_DESC, c.STATUS as ID_STATUS_DESC');
        	$this->db->from('EKSPEDISI a');
        	$this->db->join("TBL_M_JENIS_EKSPEDISI b", "a.ID_JENIS_EKSPEDISI=b.ID_JENIS_EKSPEDISI");
        	$this->db->join("TBL_M_STATUS c", "a.ID_STATUS=c.ID_STATUS");
        if($TGL_MULAI<>'' && $searchKey==''){
				$this->db->where("CONVERT(varchar(20), a.TGL_EKSPEDISI, 101) between '$TGL_MULAI' and '$TGL_SELESAI'");
			}

        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}
        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}
	public function newData()
	{
		$ID_BERKAS = htmlspecialchars($_REQUEST['ID_BERKAS_EKS']);
		$ID_JENIS_EKSPEDISI = htmlspecialchars($_REQUEST['ID_JENIS_EKSPEDISI']);
		$ID_STATUS = htmlspecialchars($_REQUEST['ID_STATUS']);
		$TGL_EKSPEDISI = htmlspecialchars($_REQUEST['TGL_EKSPEDISI']);
		
		$ID_EKSPEDISI = $this->db->query("select dbo.getNomorEkspedisi() as baru")->row_array();		

		if ($_REQUEST['TGL_SELESAI']==null||$_REQUEST['TGL_SELESAI']==' ') {
			$TGL_SELESAI = NULL;
		} else {
			$TGL_SELESAI = htmlspecialchars($_REQUEST['TGL_SELESAI']);
		}

		$data = array(
		        'ID_EKSPEDISI' => $ID_EKSPEDISI['baru'],
		        'ID_BERKAS' => $ID_BERKAS,
		        'ID_JENIS_EKSPEDISI' => $ID_JENIS_EKSPEDISI,
		        'ID_STATUS' => $ID_STATUS,
		        'TGL_EKSPEDISI' => $TGL_EKSPEDISI,
		        'TGL_SELESAI' => $TGL_SELESAI
		);
		if ($this->db->insert('EKSPEDISI', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}
	public function updateData($ID_EKSPEDISI)
	{
		$ID_BERKAS = htmlspecialchars($_REQUEST['ID_BERKAS_EKS']);
		$ID_JENIS_EKSPEDISI = htmlspecialchars($_REQUEST['ID_JENIS_EKSPEDISI']);
		$ID_STATUS = htmlspecialchars($_REQUEST['ID_STATUS']);
		$TGL_SELESAI = htmlspecialchars($_REQUEST['TGL_SELESAI']);
		$data = array(
		        'ID_BERKAS' => $ID_BERKAS,
		        'ID_JENIS_EKSPEDISI' => $ID_JENIS_EKSPEDISI,
		        'ID_STATUS' => $ID_STATUS,
		        'TGL_SELESAI' => $TGL_SELESAI
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

	public function getNomorEkspedisi()
	{
		$this->db->select('dbo.getNomorEkspedisi() as nomor');
		$this->db->select('convert(varchar(20),getDate(),120) as tanggal');
		$hasil=$this->db->get()->row_array();
        return $hasil;
	}
	
}
/* End of file ekspedisiModel.php */
/* Location: ./application/models/ekspedisiModel.php */