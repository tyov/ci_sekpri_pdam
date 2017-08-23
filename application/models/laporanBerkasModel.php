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

	function getDataPejabat(){
		$query = $this->db->query("SELECT nama_lengkap as manajer, (select top 1 nama_lengkap from karyawan where bagian_id = '24') as assmen from KARYAWAN where bagian_id = '23'");
		return $query->row();
	}

	public function getJson2($periode)
	{
		$result = $this->db->query("select a.*,b.Total from (
	SELECT CONVERT(varchar(20), TGL_TERIMA, 105) as TGL_TERIMA, coalesce([Hubungan Pelanggan], '0') [Hubungan Pelanggan],coalesce([Jaringan Pipa Pelanggan], '0') [Jaringan Pipa Pelanggan],coalesce([Kehilangan Air], '0') [Kehilangan Air],coalesce([Keuangan], '0') [Keuangan],coalesce([Pengadaan], '0') [Pengadaan],coalesce([Pengawasan Pekerjaan], '0') [Pengawasan Pekerjaan],coalesce([Perawatan], '0') [Perawatan],coalesce([Perencanaan Teknik], '0') [Perencanaan Teknik],coalesce([Produksi], '0') [Produksi],coalesce([Pusat Penelitian dan Pengembangan], '0') [Pusat Penelitian dan Pengembangan],coalesce([Satuan Pengawasan Internal], '0') [Satuan Pengawasan Internal],coalesce([Sistem Informasi Manajemen], '0') [Sistem Informasi Manajemen],coalesce([Sumber Daya Manusia], '0') [Sumber Daya Manusia],coalesce([Umum], '0') [Umum] from 
	(	
		select CONVERT(varchar(10), a.TGL_TERIMA, 105) as TGL_TERIMA
			,sum(a.JUMLAH) as JUMLAH
			, d.nama_bagian
		FROM (
				SELECT TGL_TERIMA, BAGIAN, COUNT(ID_BERKAS) AS JUMLAH
				FROM TBL_BERKAS
				GROUP BY BAGIAN, TGL_TERIMA
			 ) a
		JOIN (
			select z.* from(
			select distinct nama_bagian, left(kode_jabatan,4) as kode 
			from bagian where nama_bagian is not null
			and left(kode_jabatan,4) not in('1.00','2.00','3.00','9.00','9.01','8.00','8.01','8.02','8.03','1.05','1.06')
			)z
		) d ON a.BAGIAN=d.kode
		WHERE CONVERT(varchar(6), a.TGL_TERIMA, 112) ='$periode'
		group by CONVERT(varchar(10), a.TGL_TERIMA, 105), d.nama_bagian
	)x
	pivot 
	(
		sum(JUMLAH)
		for nama_bagian in ([Hubungan Pelanggan],[Jaringan Pipa Pelanggan],[Kehilangan Air],[Keuangan],[Pengadaan],[Pengawasan Pekerjaan],[Perawatan],[Perencanaan Teknik],[Produksi],[Pusat Penelitian dan Pengembangan],[Satuan Pengawasan Internal],[Sistem Informasi Manajemen],[Sumber Daya Manusia],[Umum])
	) p 
) a
JOIN
(
	select TGL_TERIMA,sum([Hubungan Pelanggan]+[Jaringan Pipa Pelanggan]+[Kehilangan Air]+[Keuangan]+[Pengadaan]+[Pengawasan Pekerjaan]+[Perawatan]+[Perencanaan Teknik]+[Produksi]+[Pusat Penelitian dan Pengembangan]+[Satuan Pengawasan Internal]+[Sistem Informasi Manajemen]+[Sumber Daya Manusia]+[Umum]) Total from 
	(
		SELECT CONVERT(varchar(20), TGL_TERIMA, 105) as TGL_TERIMA, coalesce([Hubungan Pelanggan], '0') [Hubungan Pelanggan],coalesce([Jaringan Pipa Pelanggan], '0') [Jaringan Pipa Pelanggan],coalesce([Kehilangan Air], '0') [Kehilangan Air],coalesce([Keuangan], '0') [Keuangan],coalesce([Pengadaan], '0') [Pengadaan],coalesce([Pengawasan Pekerjaan], '0') [Pengawasan Pekerjaan],coalesce([Perawatan], '0') [Perawatan],coalesce([Perencanaan Teknik], '0') [Perencanaan Teknik],coalesce([Produksi], '0') [Produksi],coalesce([Pusat Penelitian dan Pengembangan], '0') [Pusat Penelitian dan Pengembangan],coalesce([Satuan Pengawasan Internal], '0') [Satuan Pengawasan Internal],coalesce([Sistem Informasi Manajemen], '0') [Sistem Informasi Manajemen],coalesce([Sumber Daya Manusia], '0') [Sumber Daya Manusia],coalesce([Umum], '0') [Umum] from 
		(	
			select CONVERT(varchar(10), a.TGL_TERIMA, 105) as TGL_TERIMA
				,sum(a.JUMLAH) as JUMLAH
				, d.nama_bagian
			FROM (
					SELECT TGL_TERIMA, BAGIAN, COUNT(ID_BERKAS) AS JUMLAH
					FROM TBL_BERKAS
					GROUP BY BAGIAN, TGL_TERIMA
				 ) a
			JOIN (
				select z.* from(
				select distinct nama_bagian, left(kode_jabatan,4) as kode 
				from bagian where nama_bagian is not null
				and left(kode_jabatan,4) not in('1.00','2.00','3.00','9.00','9.01','8.00','8.01','8.02','8.03','1.05','1.06')
				)z
			) d ON a.BAGIAN=d.kode
			WHERE CONVERT(varchar(6), a.TGL_TERIMA, 112) ='$periode'
			group by CONVERT(varchar(10), a.TGL_TERIMA, 105), d.nama_bagian
		)x
		pivot 
		(
			sum(JUMLAH)
			for nama_bagian in ([Hubungan Pelanggan],[Jaringan Pipa Pelanggan],[Kehilangan Air],[Keuangan],[Pengadaan],[Pengawasan Pekerjaan],[Perawatan],[Perencanaan Teknik],[Produksi],[Pusat Penelitian dan Pengembangan],[Satuan Pengawasan Internal],[Sistem Informasi Manajemen],[Sumber Daya Manusia],[Umum])
		) p 
	) a
	group by TGL_TERIMA
) b on a.TGL_TERIMA=b.TGL_TERIMA
")->result();
	    return $result;
	}
}

/* End of file laporanModel.php */
/* Location: ./application/models/laporanModel.php */