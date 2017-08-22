<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanBerkasModel extends CI_Model {

	public function getJson($jenis,$bulan,$tahun)
	{

		if ($jenis=='total') {

	        $result = $this->db->query("LAPORANBERKAS '$tahun','$bulan'")->num_rows();
	        return $result;

	    } elseif ($jenis=='rows') {	

			$result = $this->db->query("LAPORANBERKAS '$tahun','$bulan'")->result();
	        return $result;
	    }
	}
}

/* End of file laporanModel.php */
/* Location: ./application/models/laporanModel.php */