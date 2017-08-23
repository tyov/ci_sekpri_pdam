<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanDireksiModel extends CI_Model {

	public function getJson($TGL_ACARA,$TGL_KEMBALI,$ID_DIREKSI){
		$tglAcara= date("Ymd", strtotime($TGL_ACARA));
		$tglKembali = date("Ymd", strtotime($TGL_KEMBALI));
		$tgl = ($TGL_ACARA == '' || $TGL_KEMBALI == '')?"":" and CONVERT(varchar(20), A.TGL_ACARA, 112) between '$tglAcara' and '$tglKembali' ";
		$direksi = ($ID_DIREKSI == "")?"":" and A.ID_DIREKSI = '$ID_DIREKSI' ";

		$query = $this->db->query("select a.ID_AGENDA_DIREKSI,a.ID_DIREKSI,
				convert(varchar(20),TGL_ACARA,120) as TGL_ACARA,convert(varchar(20),a.TGL_KEMBALI,120) as TGL_KEMBALI,
				a.KEGIATAN,a.PENGUNDANG,a.KETERANGAN,a.LOKASI, 
				b.DIREKSI ID_DIREKSI_DESC from TBL_AGENDA_DIREKSI a
				left join TBL_M_DIREKSI b ON a.ID_DIREKSI=b.ID_DIREKSI
				where 1=1 $tgl $direksi");
		return $query->result();
	}

}
