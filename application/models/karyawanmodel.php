<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KaryawanModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getJson()
	{
		$hasil = $this->db->query("select distinct nip, nama_lengkap from karyawan where nama_lengkap is not null order by nama_lengkap")->result_array();
        return $hasil;
	}
}

/* End of file karyawanmodel.php */
/* Location: ./application/models/karyawanmodel.php */