<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanAgendaModel extends CI_Model {

	public function getJson($TGL_MULAI,$TGL_SELESAI,$JENIS_KEGIATAN){
		$tglMulai = date("Ymd", strtotime($TGL_MULAI));
		$tglSelesai = date("Ymd", strtotime($TGL_SELESAI));
		$tgl = ($TGL_MULAI == '' || $TGL_SELESAI == '')?"":" and CONVERT(varchar(20), A.TGL_PEMESANAN, 112) between '$tglMulai' and '$tglSelesai' ";
		$jenis = ($JENIS_KEGIATAN == "")?"":" and A.ID_JENIS_KEGIATAN = '$JENIS_KEGIATAN' ";

		$data = $this->db->query("SELECT convert(varchar(20),A.TGL_PEMESANAN,120) TGL_PEMESANAN, B.JENIS_KEGIATAN, C.ASAL_KEGIATAN, D.nama_lengkap AS PEMESAN, A.KETERANGAN, A.JUMLAH, E.RUANG_RAPAT,convert(varchar(20),A.TGL_MULAI,120) TGL_MULAI,convert(varchar(20),A.TGL_SELESAI,120) TGL_SELESAI FROM TBL_AGENDA_RUANG_RAPAT A
		LEFT JOIN TBL_M_JENIS_KEGIATAN B ON A.ID_JENIS_KEGIATAN = B.ID_JENIS_KEGIATAN
		LEFT JOIN TBL_M_ASAL_KEGIATAN C ON A.ID_ASAL_KEGIATAN = C.ID_ASAL_KEGIATAN
		LEFT JOIN KARYAWAN D ON A.PEMESAN = D.nip
		LEFT JOIN TBL_M_RUANG_RAPAT E ON A.ID_RUANG_RAPAT = E.ID_RUANG_RAPAT
		WHERE 1 = 1 $tgl $jenis
		ORDER BY TGL_PEMESANAN DESC");
		return $data->result();
	}

	function getDataPejabat(){
		$query = $this->db->query("SELECT nama_lengkap as manajer, (select top 1 nama_lengkap from karyawan where bagian_id = '24') as assmen from KARYAWAN where bagian_id = '23'");
		return $query->row();
	}

}
