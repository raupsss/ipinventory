 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_beli extends CI_Controller {
	
	
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

			
			$d['judul']="Laporan Pembelian Barang";
			
			$text = "SELECT * FROM gudang ";
			$d['l_gudang'] = $this->app_model->manualQuery($text);
			
			$d['content'] = $this->load->view('lap_beli/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function lihat()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
	
			$tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
			$tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
			$gudang = "1";//$this->input->post('gudang');
			$kode_barang = $this->input->post('kode_barang');
			
			$where = " WHERE a.tglbeli BETWEEN '$tgl1' AND '$tgl2'";
			if(empty($kode_barang)){
				if($gudang!='semua'){
					$where .= " AND c.id_gudang='$gudang'";	
				}
			}else{
				$where .= " AND b.kode_barang='$kode_barang'";	
			}
			
			$text = "SELECT a.kodebeli,a.tglbeli,a.kode_supplier,
					b.kode_barang,b.jmlbeli,b.hargabeli,
					c.nama_barang,c.satuan,
					d.nama_supplier
					FROM h_beli as a
					JOIN d_beli as b
					JOIN barang as c
					JOIN supplier as d
					ON a.kodebeli=b.kodebeli AND b.kode_barang=c.kode_barang AND a.kode_supplier=d.kode_supplier
					$where 
					ORDER BY a.kodebeli ASC ";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_beli/view',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			$d['judul']="Laporan Pembelian Barang";
			
			
			$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
			$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
			$gudang = "1";//$this->uri->segment(5);
			$kode_barang = $this->uri->segment(6);
			
			$where = " WHERE a.tglbeli BETWEEN '$tgl1' AND '$tgl2'";
			$d['filter'] = 'Tanggal '.$this->app_model->tgl_indo($tgl1).' s.d '.$this->app_model->tgl_indo($tgl2);
				
			if(empty($kode_barang)){		
				if($gudang!='semua'){
					$where .= " AND c.id_gudang='$gudang'";	
					//$d['filter'] .= ' Lokasi '.$this->app_model->Nama_Gudang($gudang);
				}
			}else{
				$where .= " AND b.kode_barang='$kode_barang'";	
				$d['filter'] .= ' Kode Barang '.$kode_barang;
			}
			$text = "SELECT a.kodebeli,a.tglbeli,a.kode_supplier,
					b.kode_barang,b.jmlbeli,b.hargabeli,
					c.nama_barang,c.satuan,
					d.nama_supplier
					FROM h_beli as a
					JOIN d_beli as b
					JOIN barang as c
					JOIN supplier as d
					ON a.kodebeli=b.kodebeli AND b.kode_barang=c.kode_barang AND a.kode_supplier=d.kode_supplier
					$where 
					ORDER BY a.kodebeli ASC ";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_beli/cetak',$d);
		}else{
			header('location:'.base_url());
		}
	}

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */