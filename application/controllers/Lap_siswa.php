 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Lap_siswa extends CI_Controller
	{


		public function index()
		{
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {

				$d['prg'] = $this->config->item('prg');
				$d['web_prg'] = $this->config->item('web_prg');

				$d['nama_program'] = $this->config->item('nama_program');
				$d['instansi'] = $this->config->item('instansi');
				$d['usaha'] = $this->config->item('usaha');
				$d['alamat_instansi'] = $this->config->item('alamat_instansi');


				$d['judul'] = "Laporan Siswa";

				$text = "SELECT * FROM jurusan ";
				$d['tb_jurusan'] = $this->app_model->manualQuery($text);

				$d['content'] = $this->load->view('lap_siswa/form', $d, true);
				$this->load->view('home', $d);
			} else {
				header('location:' . base_url());
			}
		}

		public function lihat()
		{
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {

				//$tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
				//$tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
				$nim = $this->input->post('nim');
				$jurusan = $this->input->post('jurusan');

				//$where = " WHERE nim = '$nim' OR kode_jurusan = '$jurusan'";

				if (empty($nim)) {
					if ($jurusan != 'semua') {
						$text = "SELECT * FROM siswa
							WHERE kode_jurusan = '$jurusan'
							ORDER BY nim ASC";
					} else {
						$text = "SELECT * FROM siswa
							ORDER BY nim ASC";
					}
				} else {
					$text = "SELECT * FROM siswa
					WHERE nim = '$nim' AND kode_jurusan = '$jurusan'
					ORDER BY nim ASC ";
				}



				$d['data'] = $this->app_model->manualQuery($text);
				$text = "SELECT * FROM jurusan ";
				$d['tb_jurusan'] = $this->app_model->manualQuery($text);
				$this->load->view('lap_siswa/view', $d);
			} else {
				header('location:' . base_url());
			}
		}

		public function cetak()
		{
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {

				$d['prg'] = $this->config->item('prg');
				$d['web_prg'] = $this->config->item('web_prg');

				$d['nama_program'] = $this->config->item('nama_program');
				$d['instansi'] = $this->config->item('instansi');
				$d['usaha'] = $this->config->item('usaha');
				$d['alamat_instansi'] = $this->config->item('alamat_instansi');
				$d['judul'] = "Laporan Pembelian Barang";

				$nim = $this->uri->segment(4);
				$jurusan = $this->uri->segment(3);
				// $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
				// $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));

				if (empty($nim)) {
					if ($jurusan != 'semua') {
						$text = "SELECT * FROM siswa
							WHERE kode_jurusan = '$jurusan'
							ORDER BY nim ASC";
					} else {
						$text = "SELECT * FROM siswa
							ORDER BY nim ASC";
					}
				} else {
					$text = "SELECT * FROM siswa
					WHERE nim = '$nim' AND kode_jurusan = '$jurusan'
					ORDER BY nim ASC ";
				}

				$d['data'] = $this->app_model->manualQuery($text);

				$this->load->view('lap_siswa/cetak', $d);
			} else {
				header('location:' . base_url());
			}
		}
		public function cetak_excel()
		{
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {

				$d['prg'] = $this->config->item('prg');
				$d['web_prg'] = $this->config->item('web_prg');

				$d['nama_program'] = $this->config->item('nama_program');
				$d['instansi'] = $this->config->item('instansi');
				$d['usaha'] = $this->config->item('usaha');
				$d['alamat_instansi'] = $this->config->item('alamat_instansi');
				$d['judul'] = "Laporan Pembelian Barang";


				$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
				$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
				// $kode_jurusan = "1"; //$this->uri->segment(5);
				$nim = $this->uri->segment(6);
				$kode_jurusan = $this->uri->segment(6);

				$where = " WHERE a.tglbeli BETWEEN '$tgl1' AND '$tgl2'";
				// $d['filter'] = 'Tanggal ' . $this->app_model->tgl_indo($tgl1) . ' s.d ' . $this->app_model->tgl_indo($tgl2);

				// if (empty($kode_barang)) {
				// 	if ($gudang != 'semua') {
				// 		$where .= " AND c.id_gudang='$gudang'";
				// 		//$d['filter'] .= ' Lokasi '.$this->app_model->Nama_Gudang($gudang);
				// 	}
				// } else {
				// 	$where .= " AND b.kode_barang='$kode_barang'";
				// 	$d['filter'] .= ' Kode Barang ' . $kode_barang;
				// }
				$text = "SELECT * FROM siswa
					ORDER BY nim ASC ";
				$d['data'] = $this->app_model->manualQuery($text);

				$this->load->view('lap_siswa/cetak_excel', $d);
			} else {
				header('location:' . base_url());
			}
		}
	}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */