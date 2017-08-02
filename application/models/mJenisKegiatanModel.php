<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MJenisKegiatanModel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_JENIS_KEGIATAN';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;

        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

		if ($jenis=='total') {

        	$result = $this->db->query("select * from TBL_M_JENIS_KEGIATAN")->num_rows();
        	return $result;

        } elseif ($jenis=='rows') {

        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("a.*");
			$this->db->from("TBL_M_JENIS_KEGIATAN a");

        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}

        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}

	public function newData()
	{
		$JENIS_KEGIATAN = htmlspecialchars($_REQUEST['JENIS_KEGIATAN']);

		//$ID_JENIS_KEGIATAN = $this->db->query("select dbo.getNomorJenisEkspedisi() as baru")->row_array();

		$data = array(
		       // 'ID_JENIS_KEGIATAN' => $ID_JENIS_KEGIATAN['baru'], -- identity
		        'JENIS_KEGIATAN' => $JENIS_KEGIATAN
		);

		if ($this->db->insert('TBL_M_JENIS_KEGIATAN', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function updateData($ID_JENIS_KEGIATAN)
	{
		$JENIS_KEGIATAN = htmlspecialchars($_REQUEST['JENIS_KEGIATAN']);

		$data = array(
		        'JENIS_KEGIATAN' => $JENIS_KEGIATAN
		);

		$this->db->where('ID_JENIS_KEGIATAN', $ID_JENIS_KEGIATAN);

		if ($this->db->update('TBL_M_JENIS_KEGIATAN', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function deleteData($ID_JENIS_KEGIATAN)
	{
		$this->db->where('ID_JENIS_KEGIATAN', $ID_JENIS_KEGIATAN);

		if ($this->db->delete('TBL_M_JENIS_KEGIATAN')) {
			$result['error']=false;
		} else {
			$result['error']=true;
		}
		
		return $result;
	}

}

/* End of file mJenisKegiatanModel.php */
/* Location: ./application/models/mJenisKegiatanModel.php */