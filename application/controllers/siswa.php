<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller
{

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$cari = $this->input->post('txt_cari');
			$gudang = $this->input->post('gudang');

			if (empty($cari) && empty($gudang)) {
				$where = ' ';
				$kata = $this->session->userdata('cari');
			} else {
				if (!empty($cari)) {
					$sess_data['cari'] = $this->input->post("txt_cari");
					$this->session->set_userdata($sess_data);
					$cari = $this->session->userdata('cari');
					$where = " WHERE nim LIKE '%$cari%' OR nim LIKE '%$cari%'";
				} else {
					$sess_data['siswa'] = $this->input->post("siswa");
					$this->session->set_userdata($sess_data);
					$siswa = $this->session->userdata('siswa');
					$where = " WHERE id_gudang='$siswa'";
					$d['siswa'] = $siswa;
				}
			}

			$d['prg'] = $this->config->item('prg');
			$d['web_prg'] = $this->config->item('web_prg');

			$d['nama_program'] = $this->config->item('nama_program');
			$d['instansi'] = $this->config->item('instansi');
			$d['usaha'] = $this->config->item('usaha');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');


			$d['judul'] = "Data Siswa";

			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT * FROM siswa $where ";
			$tot_hal = $this->app_model->manualQuery($text);

			$d['tot_hal'] = $tot_hal->num_rows();

			$config['base_url'] = site_url() . '/siswa/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] = $this->pagination->create_links();
			$d['hal'] = $offset;


			$text = "SELECT * FROM siswa $where 
					ORDER BY nim ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			$text = "SELECT * FROM jurusan";
			$d["tb_jurusan"] = $this->app_model->manualQuery($text);

			// $d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('siswa/view', $d, true);
			$this->load->view('home', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$d['prg'] = $this->config->item('prg');
			$d['web_prg'] = $this->config->item('web_prg');

			$d['nama_program'] = $this->config->item('nama_program');
			$d['instansi'] = $this->config->item('instansi');
			$d['usaha'] = $this->config->item('usaha');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');

			$d['judul'] = "Data Siswa";
			// $kode	= $this->app_model->MaxKodeBarang();

			$d['nim']	= '';
			$d['nama']	= '';
			$d['alamat']	= '';
			$d['jurusan']	= '';
			$d['ttl']	= '';

			$text = "SELECT * FROM jurusan";
			$d["tb_jurusan"] = $this->app_model->manualQuery($text);

			// $d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('siswa/form', $d, true);
			$this->load->view('home', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {

			$d['prg'] = $this->config->item('prg');
			$d['web_prg'] = $this->config->item('web_prg');

			$d['nama_program'] = $this->config->item('nama_program');
			$d['instansi'] = $this->config->item('instansi');
			$d['usaha'] = $this->config->item('usaha');
			$d['alamat_instansi'] = $this->config->item('alamat_instansi');

			$d['judul'] = "Data Siswa";

			$id = $this->uri->segment(3);
			$text = "SELECT * FROM siswa WHERE nim='$id'";
			$data = $this->app_model->manualQuery($text);
			if ($data->num_rows() > 0) {
				foreach ($data->result() as $db) {
					$d['nim']		= $id;
					$d['nama']	= $db->nama;
					$d['alamat']	= $db->alamat;
					$d['jurusan']	= $db->kode_jurusan;
					$d['ttl']	= $db->ttl;
				}
			} else {
				$d['nim']		= $id;
				$d['nama']	= '';
				$d['alamat']	= '';
				$d['jurusan']	= '';
				$d['ttl']	= '';
			}
			$text = "SELECT * FROM jurusan";
			$d["tb_jurusan"] = $this->app_model->manualQuery($text);
			// $d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('siswa/form', $d, true);
			$this->load->view('home', $d);
		} else {
			header('location:' . base_url());
		}
	}

	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM siswa WHERE nim='$id'");
			echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/siswa'>";
		} else {
			header('location:' . base_url());
		}
	}

	public function simpan()
	{

		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {

			$up['nim'] = $this->input->post('nim');
			$up['nama'] = $this->input->post('nama');
			$up['alamat'] = $this->input->post('alamat');
			$up['kode_jurusan'] = $this->input->post('jurusan');
			$up['ttl'] = $this->input->post('ttl');

			$id['nim'] = $this->input->post('nim');

			// $text = "SELECT * FROM jurusan";
			// $d['tb_jurusan'] = $this->app_model->manualQuery($text);

			$data = $this->app_model->getSelectedData("siswa", $id);
			if ($data->num_rows() > 0) {
				$this->app_model->updateData("siswa", $up, $id);
				echo 'Update data Sukses';
			} else {
				$this->app_model->insertData("siswa", $up);
				echo 'Simpan data Sukses';
			}
		} else {
			header('location:' . base_url());
		}
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */