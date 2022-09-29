<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller
{

	public function CariNoSJ()
	{
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kodebeli) as no FROM h_beli";
		$data = $this->app_model->manualQuery($text);
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $t) {
				$no = $t->no;
				$tmp = ((int) substr($no, 5, 5)) + 1;
				$hasil = 'BL' . sprintf("%05s", $tmp);
			}
		} else {
			$hasil = 'BL' . '00001';
		}
		return $hasil;
	}

	public function InfoBarang()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$kode = $this->input->post('kode');
			if ($this->session->userdata('level') == 'User') {
				$gudang = $this->session->userdata('gudang');
				$text = "SELECT * FROM barang WHERE kode_barang='$kode' AND id_gudang='$gudang'";
			} else {
				$text = "SELECT * FROM barang WHERE kode_barang='$kode'";
			}
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if ($row > 0) {
				foreach ($tabel->result() as $t) {
					$data['nama_barang'] = $t->nama_barang;
					$data['satuan'] = $t->satuan;
					$data['harga_beli'] = $t->harga_beli;
					$data['harga_jual'] = $t->harga_jual;
					$data['stok_awal'] = $t->stok_awal;
					echo json_encode($data);
				}
			} else {
				$data['nama_barang'] = '';
				$data['satuan'] = '';
				$data['harga_beli'] = '';
				$data['harga_jual'] = '';
				$data['stok_awal'] = '';
				echo json_encode($data);
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function InfoSupplier()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM supplier WHERE kode_supplier='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if ($row > 0) {
				foreach ($tabel->result() as $t) {
					$data['nama_supplier'] = $t->nama_supplier;
					$data['alamat'] = $t->alamat;
					echo json_encode($data);
				}
			} else {
				$data['nama_supplier'] = '';
				$data['alamat'] = '';
				echo json_encode($data);
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function InfoMahasiswa()
	{
		$nim = $_GET['nim'];
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$kode = $this->input->post('nim');
			$text = "SELECT * FROM mahasiswa WHERE nim='$nim'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if ($row > 0) {
				foreach ($tabel->result() as $t) {
					$data['nama_lengkap'] = $t->nama_lengkap;
					$data['tempat_lahir'] = $t->tempat_lahir;
					$data['tanggal_lahir'] = $t->tanggal_lahir;
					$data['alamat'] = $t->alamat;
					$data['jurusan'] = $t->jurusan;
					$data['no_hp'] = $t->no_hp;
					$data['email'] = $t->email;

					echo json_encode($data);
				}
			} else {
				$data['nama_lengkap'] = '';
				$data['tempat_lahir'] = '';
				$data['tanggal_lahir'] = '';
				$data['alamat'] = '';
				$data['jurusan'] = '';
				$data['no_hp'] = '';
				$data['email'] = '';

				echo json_encode($data);
			}
		} else {
			header('location:' . base_url());
		}
	}

	public function DataBarang()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$cari = $this->input->post('cari');
			if ($this->session->userdata('level') == 'User') {
				$gudang = $this->session->userdata('gudang');
				if (empty($cari)) {
					$text = "SELECT * FROM barang WHERE id_gudang='$gudang'";
				} else {
					$text = "SELECT * FROM barang WHERE id_gudang='$gudang' AND (kode_barang LIKE '%$cari%' OR nama_barang LIKE '%$cari%')";
				}
			} else {
				if (empty($cari)) {
					$text = "SELECT * FROM barang";
				} else {
					$text = "SELECT * FROM barang WHERE kode_barang LIKE '%$cari%' OR nama_barang LIKE '%$cari%'";
				}
			}
			$d['data'] = $this->app_model->manualQuery($text);

			$this->load->view('data_barang', $d);
		} else {
			header('location:' . base_url());
		}
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */