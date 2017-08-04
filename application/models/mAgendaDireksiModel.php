<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mAgendaDireksiModel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_DIREKSI';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;

        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

		if ($jenis=='total') {

        	$result = $this->db->query("select * from TBL_M_AGENDA_DIREKSI")->num_rows();
        	return $result;

        } elseif ($jenis=='rows') {

        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("a.*");
			$this->db->from("TBL_M_AGENDA_DIREKSI a");

        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}

        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}

	public function newData()
	{
		$DIREKSI = htmlspecialchars($_REQUEST['DIREKSI']);

		//$ID_RUANG_RAPAT = $this->db->query("select dbo.getNomorJenisEkspedisi() as baru")->row_array();

		$data = array(
		       // 'ID_RUANG_RAPAT' => $ID_RUANG_RAPAT['baru'], -- identity
		        'DIREKSI' => $DIREKSI
		);

		if ($this->db->insert('TBL_M_AGENDA_DIREKSI', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function updateData($ID_DIREKSI)
	{
		$DIREKSI = htmlspecialchars($_REQUEST['DIREKSI']);

		$data = array(
		        'DIREKSI' => $DIREKSI
		);

		$this->db->where('ID_DIREKSI', $ID_DIREKSI);

		if ($this->db->update('TBL_M_AGENDA_DIREKSI', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function deleteData($ID_DIREKSI)
	{
		$this->db->where('ID_DIREKSI', $ID_DIREKSI);

		if ($this->db->delete('TBL_M_AGENDA_DIREKSI')) {
			$result['error']=false;
		} else {
			$result['error']=true;
		}
		
		return $result;
	}

}