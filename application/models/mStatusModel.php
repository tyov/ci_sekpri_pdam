<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MStatusModel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_STATUS';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;

        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

		if ($jenis=='total') {

        	$result = $this->db->query("select * from TBL_M_STATUS")->num_rows();
        	return $result;

        } elseif ($jenis=='rows') {

        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("ID_STATUS, STATUS");
			$this->db->from("TBL_M_STATUS");

        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}

        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}

	public function newData()
	{
		$STATUS = htmlspecialchars($_REQUEST['STATUS']);

		//$ID_STATUS = $this->db->query("select dbo.getNomorJenisEkspedisi() as baru")->row_array();

		$data = array(
		       // 'ID_STATUS' => $ID_STATUS['baru'], -- identity
		        'STATUS' => $STATUS
		);

		if ($this->db->insert('TBL_M_STATUS', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function updateData($ID_STATUS)
	{
		$STATUS = htmlspecialchars($_REQUEST['STATUS']);

		$data = array(
		        'STATUS' => $STATUS
		);

		$this->db->where('ID_STATUS', $ID_STATUS);

		if ($this->db->update('TBL_M_STATUS', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function deleteData($ID_STATUS)
	{
		$this->db->where('ID_STATUS', $ID_STATUS);

		if ($this->db->delete('TBL_M_STATUS')) {
			$result['error']=false;
		} else {
			$result['error']=true;
		}
		
		return $result;
	}

}

/* End of file mStatus.php */
/* Location: ./application/models/mStatus.php */