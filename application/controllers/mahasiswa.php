<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if (!empty($cek)) {
            $cari = $this->input->post('txt_cari');
            if (empty($cari)) {
                $where = ' ';
            } else {
                $where = " WHERE nim LIKE '%$cari%' OR nama_lengkap LIKE '%$cari%'";
            }

            $d['prg'] = $this->config->item('prg');
            $d['web_prg'] = $this->config->item('web_prg');

            $d['nama_program'] = $this->config->item('nama_program');
            $d['instansi'] = $this->config->item('instansi');
            $d['usaha'] = $this->config->item('usaha');
            $d['alamat_instansi'] = $this->config->item('alamat_instansi');


            $d['judul'] = "Mahasiswa";

            //paging
            $page = $this->uri->segment(3);
            $limit = $this->config->item('limit_data');
            if (!$page) :
                $offset = 0;
            else :
                $offset = $page;
            endif;

            $text = "SELECT * FROM mahasiswa $where ";
            $tot_hal = $this->app_model->manualQuery($text);

            $d['tot_hal'] = $tot_hal->num_rows();

            $config['base_url'] = site_url() . '/mahasiswa/index/';
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


            $text = "SELECT * FROM mahasiswa $where 
					ORDER BY nim ASC 
					LIMIT $limit OFFSET $offset";
            $d['data'] = $this->app_model->manualQuery($text);


            $d['content'] = $this->load->view('mahasiswa/view', $d, true);
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

            $d['judul'] = "Mahasiswa";

            $d['nim']             = '';
            $d['nama_lengkap']    = '';
            $d['tempat_lahir']    = '';
            $d['tanggal_lahir']    = '';
            $d['alamat']    = '';
            $d['jurusan']    = '';
            $d['no_hp']    = '';
            $d['email']    = '';


            $d['content'] = $this->load->view('mahasiswa/form', $d, true);
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

            $d['judul'] = "mahasiswa";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM mahasiswa WHERE kode_mahasiswa='$id'";
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['kode']        = $id;
                    $d['nama_supp']    = $db->nama_mahasiswa;
                    $d['alamat']    = $db->alamat;
                }
            } else {
                $d['kode']        = $id;
                $d['nama_supp']    = '';
                $d['alamat']    = '';
            }

            $d['content'] = $this->load->view('mahasiswa/form', $d, true);
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
            $this->app_model->manualQuery("DELETE FROM mahasiswa WHERE kode_mahasiswa='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/mahasiswa'>";
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan()
    {

        $cek = $this->session->userdata('logged_in');
        if (!empty($cek)) {


            $up['kode_mahasiswa'] = $this->input->post('kode');
            $up['kode_mahasiswa']    = $this->input->post('kode');
            $up['nama_mahasiswa']    = $this->input->post('nama_supp');
            $up['alamat']            = $this->input->post('alamat');

            $id['kode_mahasiswa'] = $this->input->post('kode');

            $data = $this->app_model->getSelectedData("mahasiswa", $id);
            if ($data->num_rows() > 0) {
                $this->app_model->updateData("mahasiswa", $up, $id);
                echo 'Update data Sukses';
            } else {
                $this->app_model->insertData("mahasiswa", $up);
                echo 'Simpan data Sukses';
            }
        } else {
            header('location:' . base_url());
        }
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */