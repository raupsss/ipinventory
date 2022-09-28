<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_barang extends CI_Controller {

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

			
			$d['judul']="Stok Barang";
			
			$d['l_gudang'] = $this->app_model->getAllData("gudang");
			$d['content'] = $this->load->view('lap_barang/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function lihat()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['tgl_1'] = $this->input->post('tgl_1');
			$d['tgl_2'] = $this->input->post('tgl_2');
			$gudang = "1";//$this->input->post('gudang');
			$kode_barang = $this->input->post('kode_barang');
			
			if(empty($kode_barang)){		
				if($gudang=='semua'){
					$where = " ";
				}else{
					$where = " WHERE id_gudang='$gudang'";
				}
			}else{
				$where = " WHERE kode_barang='$kode_barang'";
			}
			$text = "SELECT * FROM barang $where 
					ORDER BY kode_barang ASC ";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_barang/view',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			/*
			$pilih = $this->uri->segment(3);
			$kode = $this->uri->segment(4);
			$gudang = $this->uri->segment(5);
			$nama_gudang = $this->app_model->Nama_Gudang($gudang);
			*/
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['tgl_1'] = $this->uri->segment(3);
			$d['tgl_2'] = $this->uri->segment(4);
			$gudang = "1";//$this->uri->segment(5);
			$kode_barang = $this->uri->segment(6);
			
			$nama_gudang = $this->app_model->Nama_Gudang($gudang);	
			$d['filter'] = "Tanggal ".$this->uri->segment(3)." s.d Tanggal ".$this->uri->segment(4);
			
			if(empty($kode_barang)){
				if($gudang=='semua'){
					$where = " ";
				}else{
					$where = " WHERE id_gudang='$gudang'";
				}
			}else{
				$where = " WHERE kode_barang='$kode_barang'";
			}
			
			$d['judul']="Stok Barang";
			
			$text = "SELECT * FROM barang $where 
					ORDER BY kode_barang ASC ";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_barang/cetak',$d);
		}else{
			header('location:'.base_url());
		}
	}

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */