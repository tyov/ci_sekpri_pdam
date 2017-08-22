<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanAgendaModel extends CI_Model {

	public function getJson($bulan,$tahun){
		$data = $this->db->query("SELECT convert(varchar(20),A.TGL_PEMESANAN,120) TGL_PEMESANAN, B.JENIS_KEGIATAN, C.ASAL_KEGIATAN, D.nama_lengkap AS PEMESAN, A.KETERANGAN, A.JUMLAH, E.RUANG_RAPAT,convert(varchar(20),A.TGL_MULAI,120) TGL_MULAI,convert(varchar(20),A.TGL_SELESAI,120) TGL_SELESAI FROM TBL_AGENDA_RUANG_RAPAT A
		LEFT JOIN TBL_M_JENIS_KEGIATAN B ON A.ID_JENIS_KEGIATAN = B.ID_JENIS_KEGIATAN
		LEFT JOIN TBL_M_ASAL_KEGIATAN C ON A.ID_ASAL_KEGIATAN = C.ID_ASAL_KEGIATAN
		LEFT JOIN KARYAWAN D ON A.PEMESAN = D.nip
		LEFT JOIN TBL_M_RUANG_RAPAT E ON A.ID_RUANG_RAPAT = E.ID_RUANG_RAPAT
		WHERE CONVERT(varchar(20), TGL_PEMESANAN, 105) like '__-$bulan-$tahun'
		ORDER BY TGL_PEMESANAN DESC");
		return $data->result();
	}

}
