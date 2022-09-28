<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			$gudang = $this->input->post('gudang');
			
			if(empty($cari) && empty($gudang)){
				$where = ' ';
				$kata = $this->session->userdata('cari');
			}else{
				if(!empty($cari)){
					$sess_data['cari'] = $this->input->post("txt_cari");
					$this->session->set_userdata($sess_data);
					$cari = $this->session->userdata('cari');
					$where = " WHERE idabsen LIKE '%$cari%' OR nim LIKE '%$cari%'";
				}else{
					$sess_data['gudang'] = $this->input->post("gudang");
					$this->session->set_userdata($sess_data);
					$gudang = $this->session->userdata('gudang');
					$where = " WHERE id_gudang='$gudang'";
					$d['gudang'] = $gudang;
				}
				
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Data Barang";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM absensi $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/absensi/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;
			

			$text = "SELECT * FROM absensi $where 
					ORDER BY idabsen ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('absensi/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Data Barang";
			$kode	= $this->app_model->MaxKodeBarang();
			
			$d['kode_brg']	=$kode;
			$d['nama_brg']	='';
			$d['satuan']	='';
			$d['hrg_beli']	='';
			$d['hrg_jual']	='';
			$d['stok_awal']	='';
			$d['gudang']	='';	
			
			$d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('absensi/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['judul'] = "Data Barang";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM absensi WHERE idabsen='$id'";
			$data = $this->app_model->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['kode_brg']		=$id;
					$d['nama_brg']	=$db->nama_barang;
					$d['satuan']	=$db->satuan;
					$d['hrg_beli']	=$db->harga_beli;
					$d['hrg_jual']	=$db->harga_jual;
					$d['stok_awal']	=$db->stok_awal;
					$d['gudang']	=$db->id_gudang;
				}
			}else{
					$d['kode_brg']		=$id;
					$d['nama_brg']	='';
					$d['satuan']	='';
					$d['hrg_beli']	='';
					$d['hrg_jual']	='';
					$d['stok_awal']	='';
					$d['gudang']	='';
			}
			$d['l_gudang'] = $this->app_model->getAllData("gudang");			
			$d['content'] = $this->load->view('absensi/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM absensi WHERE id_absensi='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/barang'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$up['kode_barang']=$this->input->post('kode_brg');
				$up['nama_barang']=$this->input->post('nama_brg');
				$up['satuan']=$this->input->post('satuan');
				$up['harga_beli']="0";//$this->input->post('hrg_beli');
				$up['harga_jual']="0";//$this->input->post('hrg_jual');
				$up['stok_awal']=$this->input->post('stok_awal');
				$up['id_gudang']="1";//$this->input->post('gudang');
				
				$id['kode_barang']=$this->input->post('kode_brg');
				
				$data = $this->app_model->getSelectedData("absensi",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("absensi",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("absensi",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */