<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang extends CI_Controller {
	
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Gudang";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM gudang";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/gudang/index/';
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
			

			$text = "SELECT * FROM gudang
					ORDER BY id_gudang ASC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('gudang/view', $d, true);		
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

			$d['judul']="Gudang";
			
			$d['id']		='';
			$d['gudang']	='';

			
			$d['content'] = $this->load->view('gudang/form', $d, true);		
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
			
			$d['judul'] = "Gudang";
			
			$id = $this->uri->segment(3);
			$text = "SELECT * FROM gudang WHERE id_gudang='$id'";
			$data = $this->app_model->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['id']		=$id;
					$d['gudang']	=$db->gudang;
				}
			}else{
					$d['id']		=$id;
					$d['gudang']	='';
			}
									
			$d['content'] = $this->load->view('gudang/form', $d, true);		
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
			$this->app_model->manualQuery("DELETE FROM gudang WHERE id_gudang='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/gudang'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				
				$up['id_gudang']		= $this->input->post('id');
				$up['gudang']	= $this->input->post('gudang');
				
				$id['id_gudang']=$this->input->post('id');
				
				$data = $this->app_model->getSelectedData("gudang",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("gudang",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("gudang",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */