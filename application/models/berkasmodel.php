<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BerkasModel extends CI_Model {

	public function getJson($jenis)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'ID_BERKAS';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        $this->limit = $rows;
        $this->offset = $offset;

        $searchKey=isset($_POST['searchKey']) ? strval($_POST['searchKey']) : '';
		$searchValue=isset($_POST['searchValue']) ? strval($_POST['searchValue']) : '';

		if ($jenis=='total') {

        	$result = $this->db->query("select * from TBL_BERKAS")->num_rows();
        	return $result;

        } elseif ($jenis=='rows') {

        	$this->db->limit($rows,$offset);
        	$this->db->order_by($sort,$order);
			$this->db->select("a.ID_BERKAS, a.TGL_TERIMA, convert(varchar(20),a.TGL_TERIMA,120) as TGL_TERIMA_DESC, a.PENERIMA, a.PENGIRIM, a.BAGIAN, a.PERIHAL, a.TGL_AMBIL, convert(varchar(20),a.TGL_AMBIL,120) as TGL_AMBIL_DESC, a.PENGAMBIL, c.nama_lengkap PENERIMA_DESC, d.nama_lengkap PENGIRIM_DESC, e.nama_lengkap PENGAMBIL_DESC, b.nama_bagian BAGIAN_DESC");
			$this->db->from("TBL_BERKAS a");
			$this->db->join("(SELECT left(kode_jabatan,4) as KODE, nama_bagian FROM BAGIAN group by left(kode_jabatan,4), nama_bagian) b", "a.BAGIAN = b.KODE");
			$this->db->join("KARYAWAN c", "a.PENERIMA=c.nip");
			$this->db->join("KARYAWAN d", "a.PENGIRIM=d.nip");
			$this->db->join("KARYAWAN e", "a.PENGAMBIL=e.nip");

        if($searchKey<>''){
			$this->db->where($searchKey." like '%".$searchValue."%'");
		}

        $hasil=$this->db->get ('',$this->limit, $this->offset)->result_array();
        return $hasil;
    	}
	}

	public function newData()
	{
		$PENERIMA = htmlspecialchars($_REQUEST['PENERIMA']);
		$PENGIRIM = htmlspecialchars($_REQUEST['PENGIRIM']);
		$BAGIAN = htmlspecialchars($_REQUEST['BAGIAN']);
		$PERIHAL = htmlspecialchars($_REQUEST['PERIHAL']);
		$TGL_AMBIL = htmlspecialchars($_REQUEST['TGL_AMBIL']);
		$PENGAMBIL = htmlspecialchars($_REQUEST['PENGAMBIL']);

		$TGL_TERIMA = $this->db->query("select getDate() as baru")->row_array();
		$ID_BERKAS = $this->db->query("select dbo.getNomorDokumen() as baru")->row_array();

		$data = array(
		       	'ID_BERKAS' => $ID_BERKAS['baru'],
		       	'TGL_TERIMA' => $TGL_TERIMA['baru'],
		        'PENERIMA' => $PENERIMA,
		        'PENGIRIM' => $PENGIRIM,
		        'BAGIAN' => $BAGIAN,
		        'PERIHAL' => $PERIHAL,
		        'TGL_AMBIL' => $TGL_AMBIL,
		        'PENGAMBIL' => $PENGAMBIL
		);

		if ($this->db->insert('TBL_BERKAS', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function updateData($ID_BERKAS)
	{
		$PENERIMA = htmlspecialchars($_REQUEST['PENERIMA']);
		$PENGIRIM = htmlspecialchars($_REQUEST['PENGIRIM']);
		$BAGIAN = htmlspecialchars($_REQUEST['BAGIAN']);
		$PERIHAL = htmlspecialchars($_REQUEST['PERIHAL']);
		$TGL_AMBIL = htmlspecialchars($_REQUEST['TGL_AMBIL']);
		$PENGAMBIL = htmlspecialchars($_REQUEST['PENGAMBIL']);

		$data = array(
		        'PENERIMA' => $PENERIMA,
		        'PENGIRIM' => $PENGIRIM,
		        'BAGIAN' => $BAGIAN,
		        'PERIHAL' => $PERIHAL,
		        'TGL_AMBIL' => $TGL_AMBIL,
		        'PENGAMBIL' => $PENGAMBIL
		);

		$this->db->where('ID_BERKAS', $ID_BERKAS);

		if ($this->db->update('TBL_BERKAS', $data)) {
			return "SUCCESS";
		} else {
			return "FAILED";
		}
	}

	public function deleteData($ID_BERKAS)
	{
		$this->db->where('ID_BERKAS', $ID_BERKAS);

		if ($this->db->delete('TBL_BERKAS')) {
			$result['error']=false;
		} else {
			$result['error']=true;
		}
		
		return $result;
	}

	public function getDataNomor()
	{
		$this->db->select('dbo.getNomorDokumen() as nomor');
		$this->db->select('convert(varchar(20),getDate(),120) as tanggal');
		$hasil=$this->db->get()->row_array();
        return $hasil;
	}

	public function getID()
	{
		$this->db->select("a.ID_BERKAS");
		$this->db->from("TBL_BERKAS a");
		$hasil=$this->db->get()->result_array();
        return $hasil;
	}

}

/* End of file berkasModel.php */
/* Location: ./application/models/berkasModel.php */