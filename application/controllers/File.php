<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('status') != "login") {
			echo "<script>alert('Maaf anda harus login terlebih dahulu untuk mengakses halaman admin!');</script>";
			echo "<script>location='../login?pesan=belum_login';</script>";
		} else {
			$this->load->helper('url');
			$this->load->helper('download');
			$this->load->model('m_login');
			$this->load->model('m_data');
			$this->load->library('pagination');
		}		
	}

//DEPARTEMEN

	/* AWAL VIEW FILE SK*/
	function sk_tampil($kat_admin,$kategori){
		$this->load->database();
		
		if (!empty($this->input->get('paginasi'))) {
			$a = $this->input->get('paginasi');
			$_SESSION['paginasi'] = $a;
			if ($a != "semua") {
				$paginasi = $a;
			} else {
				$paginasi = $this->m_data->get_file('dokumen_sk',$kat_admin,$kategori)->num_rows();
			}
		} else {
			if (empty($_SESSION['paginasi'])) {
				$paginasi = 50;
			} else {
				$paginasi = $_SESSION['paginasi'];
			}
		}	

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/sk_tampil/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file('dokumen_sk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = $paginasi;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.
        $where = array(
        	'iddepartemen' => $kat_admin,
        	'kategori'     => $kategori
        ); 

        $data['data']       = $this->m_data->get_file_list('dokumen_sk',$where,$config["per_page"], $data['page']);           
 
        $data['pagination'] = $this->pagination->create_links();


		$data['kategori']    = $kategori;
		$data['kat_admin']   = $kat_admin;

		$data['sk']          = $this->m_data->get_file('dokumen_sk',$kat_admin,$kategori)->result();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/sk/v_sk',$data);
	}
	/* AWAL VIEW FILE SK*/

	/* AWAL VIEW FILE FILTER SK*/
	function filter($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		$cari     = $this->input->get('cari');
		$kolom    = $this->input->get('kolom');

		if ($kolom == "semua") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/filter/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari('dokumen_sk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

	        $data['data']       = $this->m_data->get_file_list_cari('dokumen_sk', $kat_admin, $kategori, $cari, $config["per_page"], $data['page']);          
	 
	        $data['pagination'] = $this->pagination->create_links();


			$data['kategori']    = $kategori;
			$data['kat_admin']   = $kat_admin;

			$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/sk/v_sk',$data);

		} else if ($kolom == "judul"){
				//konfigurasi pagination
	        $config['base_url']    = base_url().'file/filter/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari_b_judul('dokumen_sk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

	        $data['data']       = $this->m_data->get_file_list_cari_b_judul('dokumen_sk', $kat_admin, $kategori, $cari, $config["per_page"], $data['page']);          
	 
	        $data['pagination'] = $this->pagination->create_links();


			$data['kategori']    = $kategori;
			$data['kat_admin']   = $kat_admin;

			$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/sk/v_sk',$data);
		} else if ($kolom == "tahun"){
				//konfigurasi pagination
	        $config['base_url']    = base_url().'file/filter/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari_b_tahun('dokumen_sk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

	        $data['data']       = $this->m_data->get_file_list_cari_b_tahun('dokumen_sk', $kat_admin, $kategori, $cari, $config["per_page"], $data['page']);          
	 
	        $data['pagination'] = $this->pagination->create_links();


			$data['kategori']    = $kategori;
			$data['kat_admin']   = $kat_admin;

			$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/sk/v_sk',$data);
		}	

		
	}
	/* AWAL VIEW FILE FILTER SK*/

	/*AWAL HAPUSFILE SK*/
	function sk_hapus($kat_admin,$id,$kategori){
		$result = $this->m_data->ambil_file('dokumen_sk',$kat_admin,$kategori,$id)->result();
  		$file   = "upload/sk/".$result[0]->nama_sk;
		
		if(file_exists($file)){
		    unlink($file);
		} else {
			echo "<script>alert('Gagal menghapus file, file tidak tersedia di databse');</script>";
			echo "<script>location='../../../sk_tampil/".$kat_admin."/".$kategori."';</script>";
		} 

		if(file_exists($file)){
    		echo "<script>alert('Gagal menghapus file, file tidak bisa dihapus dari direktori');</script>";
			echo "<script>location='../../../sk_tampil/".$kat_admin."/".$kategori."';</script>";
  		} else {
			$data  = $this->m_data->hapus_file('dokumen_sk',$kat_admin,$kategori,$id);
			if ($data) {
				echo "<script>alert('File berhasil dihapus');</script>";
				echo "<script>location='../../../sk_tampil/".$kat_admin."/".$kategori."';</script>";
			} else {
				echo "<script>alert('Gagal menghapus file');</script>";
				echo "<script>location='../../../sk_tampil/".$kat_admin."/".$kategori."';</script>";
			}
		}
	}
	/*AKHIR HAPUS FILE SK*/

	/*URUT TAHUN FILE SK DEPARTEMEN*/
	function sk_urut_tahun($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin'] = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/sk_urut_tahun/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_tahun('dokumen_sk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 10;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_tahun('dokumen_sk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/sk/v_sk',$data);
	}

	/*URUT NO SKFILE SK DEPARTEMEN*/
	function sk_urut_nosk($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin'] = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/sk_urut_nosk/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_nosk('dokumen_sk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_nosk('dokumen_sk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/sk/v_sk',$data);
	}

	/*URUT JUDUL FILE SK DEPARTEMEN*/
	function sk_urut_judul($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin'] = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/sk_urut_judul/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_judul('dokumen_sk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_judul('dokumen_sk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/sk/v_sk',$data);
	}

	/*URUT JUDUL FILE SK DEPARTEMEN*/
	function sk_urut_nama_file($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin'] = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/sk_urut_nama_file/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_nama_file('dokumen_sk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_nama_file('dokumen_sk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/sk/v_sk',$data);
	}


	/*AWAL DOWNLOAD FILE SK*/
	function sk_download($kat_admin,$id,$kategori){
		$this->load->database();
		$data['id']        = $id;
		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		$data['file']      = $this->m_data->download_file('dokumen_sk',$kat_admin,$kategori,$id)->result();
		force_download('upload/sk/'.$data['file'][0]->nama_sk,NULL);
	}
	/*AKHIR DOWNLOAD FILE SK*/

	/*AWAL UPLOAD FILE SK*/
	function upload_sk_file(){
        // definisi folder upload
        define("UPLOAD_DIR", "./upload/sk/");

        if (!empty($_FILES["sk"])) {
        	$ekstesi_boleh = array('pdf','doc','docx');

			$sk     = $_FILES["sk"];
			$ext    = pathinfo($_FILES["sk"]["name"], PATHINFO_EXTENSION);
			$size   = $_FILES["sk"]["size"];
			$tgl    = date("Y-m-d");

			$iddep     = $this->input->post('kat_dep');
			$nosk      = $this->input->post('no_sk');
			$jdl       = $this->input->post('judul');
			$kategori  = $this->input->post('kategori');
			$tahun     = $this->input->post('tahun');

			$no_sk     = htmlspecialchars($nosk);
			$judul     = htmlspecialchars($jdl);

			if (in_array(strtolower($ext), $ekstesi_boleh)) {
				if ($sk["error"] !== UPLOAD_ERR_OK) {
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../sk_tampil/".$iddep."/".$kategori."';</script>";
					exit;
				}

				// filename yang aman
				$name = $sk["name"];

				// mencegah overwrite filename
				$i = 0;
				$parts = pathinfo($name);
				while (file_exists(UPLOAD_DIR . $name)) {
					$i++;
					$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
				}

				// upload file
				$success = move_uploaded_file($sk["tmp_name"],
				UPLOAD_DIR . $name);
				if (!$success) { 
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../sk_tampil/".$iddep."/".$kategori."';</script>";
					exit;
				} else {
					$data_file = array (
						'no_sk'       => $no_sk,
						'judul'       => $judul,
						'nama_sk'     => $name,
						'ukuran_file' => $size,
						'ekstensi'    => $ext,
						'kategori'    => $kategori,
						'iddepartemen'=> $iddep,
						'date'        => $tahun
					);

					$insert = $this->m_data->save('dokumen_sk',$data_file);
					if($insert){
						echo "<script>alert('Berhasil upload file');</script>";
						echo "<script>location='../sk_tampil/".$iddep."/".$kategori."';</script>";
					}else{
						echo "<script>alert('Gagal upload file3');</script>";
						echo "<script>location='../sk_tampil/".$iddep."/".$kategori."';</script>";
						exit;
					}
				}

				// set permisi file
				chmod(UPLOAD_DIR . $name, 0644);
			} else {
				echo "<script>alert('Gagal upload file, ekstensi file yang diijinkan hanya .pdf, .doc, dan .docx');</script>";
				echo "<script>location='../sk_tampil/".$iddep."/".$kategori."';</script>";
			}
        }
	}
	/*AKHIR UPLOAD FILE SK*/



	/* AWAL VIEW FILE NSK*/
	function nsk_tampil($kat_admin,$kategori){
		$this->load->database();

		if (!empty($this->input->get('paginasi'))) {
			$a = $this->input->get('paginasi');
			$_SESSION['paginasi'] = $a;
			if ($a != "semua") {
				$paginasi = $a;
			} else {
				$paginasi = $this->m_data->get_file('dokumen_nsk',$kat_admin,$kategori)->num_rows();
			}
		} else {
			if (empty($_SESSION['paginasi'])) {
				$paginasi = 50;
			} else {
				$paginasi = $_SESSION['paginasi'];
			}
		}	

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/nsk_tampil/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file('dokumen_nsk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = $paginasi;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.
        $where = array(
        	'iddepartemen' => $kat_admin,
        	'kategori'     => $kategori
        ); 

        $data['data']       = $this->m_data->get_file_list('dokumen_nsk',$where,$config["per_page"], $data['page']);           
        $data['pagination'] = $this->pagination->create_links();


		$data['kategori']     = $kategori;
		$data['kat_admin']    = $kat_admin;
		$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/non_sk/v_nsk',$data);
	}
	/* AWAL VIEW FILE NSK*/

	/* AWAL VIEW FILE FILTER SK*/
	function filter_nsk($kat_admin,$kategori){
		$this->load->database();
		$cari              = $this->input->get('cari');
		$kolom             = $this->input->get('kolom');

		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		if ($kolom == "semua") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/nsk_tampil/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari('dokumen_nsk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page']        = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
	        $data['data']        = $this->m_data->get_file_list_cari('dokumen_nsk',$kat_admin,$kategori,$cari,$config["per_page"], $data['page']);           
	        $data['pagination']  = $this->pagination->create_links();


			$data['kategori']     = $kategori;
			$data['kat_admin']    = $kat_admin;
			$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/non_sk/v_nsk',$data);
		} else if ($kolom == "judul") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/nsk_tampil/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari_b_judul('dokumen_nsk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page']        = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
	        $data['data']        = $this->m_data->get_file_list_cari_b_judul('dokumen_nsk',$kat_admin,$kategori,$cari,$config["per_page"], $data['page']);           
	        $data['pagination']  = $this->pagination->create_links();


			$data['kategori']     = $kategori;
			$data['kat_admin']    = $kat_admin;
			$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/non_sk/v_nsk',$data);
		} else if ($kolom == "tahun") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/nsk_tampil/'.$kat_admin.'/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->get_file_cari_b_tahun('dokumen_nsk',$kat_admin,$kategori,$cari)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 5;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page']        = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0; 
	        $data['data']        = $this->m_data->get_file_list_cari_b_tahun('dokumen_nsk',$kat_admin,$kategori,$cari,$config["per_page"], $data['page']);           
	        $data['pagination']  = $this->pagination->create_links();


			$data['kategori']     = $kategori;
			$data['kat_admin']    = $kat_admin;
			$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/non_sk/v_nsk',$data);
		}
			
	}
	/* AWAL VIEW FILE FILTER SK*/

	/*AWAL HASIL FILE NSK*/
	public function nsk_hasil($kat_admin,$id,$kategori){
		$this->load->database();
		$data['kat_admin'] = $kat_admin;
		$data['kategori']  = $kategori;
		$data['id']        = $id;
		$nama  = $this->m_data->get_file_id('dokumen_nsk',$kategori,$id)->result();
		
		redirect(base_url()."upload/non_sk/". $nama[0]->nama_nsk);
	}
	/*AKHIR HASIL FILE NSK*/

	/*AWAL HAPUSFILE NSK*/
	function nsk_hapus($kat_admin,$id,$kategori){
		$result = $this->m_data->ambil_file('dokumen_nsk',$kat_admin,$kategori,$id)->result();
  		$file   = "upload/non_sk/".$result[0]->nama_nsk;
		
		if(file_exists($file)){
		    unlink($file);
		} else {
			echo "<script>alert('Gagal menghapus file, file tidak tersedia di databse');</script>";
			echo "<script>location='../../../nsk_tampil/".$kat_admin."/".$kategori."';</script>";
		} 

		if(file_exists($file)){
    		echo "<script>alert('Gagal menghapus file, file tidak bisa dihapus dari direktori');</script>";
			echo "<script>location='../../../nsk_tampil/".$kat_admin."/".$kategori."';</script>";
  		} else {
			$data  = $this->m_data->hapus_file('dokumen_nsk',$kat_admin,$kategori,$id);
			if ($data) {
				echo "<script>alert('File berhasil dihapus');</script>";
				echo "<script>location='../../../nsk_tampil/".$kat_admin."/".$kategori."';</script>";
			} else {
				echo "<script>alert('Gagal menghapus file');</script>";
				echo "<script>location='../../../nsk_tampil/".$kat_admin."/".$kategori."';</script>";
			}
		}
	}
	/*AKHIR HAPUS FILE NSK*/

	/*AWAL DOWNLOAD FILE NSK*/
	function nsk_download($kat_admin,$id,$kategori){
		$this->load->database();
		$data['id']        = $id;
		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		$data['file']      = $this->m_data->download_file('dokumen_nsk',$kat_admin,$kategori,$id)->result();
		force_download('upload/non_sk/'.$data['file'][0]->nama_nsk,NULL);
	}
	/*AKHIR DOWNLOAD FILE NSK*/

	/*URUT TAHUN FILE NSK DEPARTEMEN*/
	function nsk_urut_tahun($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin'] = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/nsk_urut_tahun/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_tahun('dokumen_nsk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_tahun('dokumen_nsk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_nsk']  = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/non_sk/v_nsk',$data);
	}

	/*URUT NO NSK FILE NSK DEPARTEMEN*/
	function nsk_urut_judul($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin']     = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/nsk_urut_judul/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_judul('dokumen_nsk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_judul('dokumen_nsk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_nsk']  = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/non_sk/v_nsk',$data);
	}

	/*URUT NAMA NSK FILE NSK DEPARTEMEN*/
	function nsk_urut_nama_file($kat_admin,$kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$data['kat_admin']     = $kat_admin;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/nsk_urut_judul/'.$kat_admin.'/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_nama_file_nsk('dokumen_nsk',$kat_admin,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 5;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_list_urut_nama_file_nsk('dokumen_nsk', $kat_admin, $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_nsk']  = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/non_sk/v_nsk',$data);
	}

	/*AWAL UPLOAD FILE NSK*/
	function upload_nsk_file(){
        // definisi folder upload
        define("UPLOAD_DIR", "./upload/non_sk/");

        if (!empty($_FILES["nsk"])) {
        	$ekstesi_boleh = array('pdf','doc','docx', 'txt', 'jpg', 'jpeg', 'png', 'bmp', 'csv', 'ico', 'psd', 'mp3', 'wav', 'mpg', 'mpeg', 'avi', 'flv', 'gif', 'log', 'rar', 'zip', 'cdr', 'mp4', '3gp', 'xls', 'xlsx', 'mid', 'wav', 'swf', 'tar', 'ppt', 'pptx', 'sql', 'db', 'epub', 'mobi', 'acsm', 'pst', 'xlsm', 'mpp', 'ppsx', 'mdb', 'opf', 'crtx', 'docm', 'one', 'ost', 'dotm', 'iaf', 'lit', 'mbd', 'prc', 'snp', 'ceb', 'potx');

			$nsk    = $_FILES["nsk"];
			$ext    = pathinfo($_FILES["nsk"]["name"], PATHINFO_EXTENSION);
			$size   = $_FILES["nsk"]["size"];
			$tgl    = date("Y-m-d");

			$iddep     = $this->input->post('kat_dep');
			$jdl       = $this->input->post('judul');
			$kategori  = $this->input->post('kategori');
			$tahun     = $this->input->post('tahun');

			$judul     = htmlspecialchars($jdl);
			if (in_array(strtolower($ext), $ekstesi_boleh)) {
				if ($nsk["error"] !== UPLOAD_ERR_OK) {
					echo "<script>alert('Gagal upload file');</script>";
					echo "<script>location='../nsk_tampil/".$iddep."/".$kategori."';</script>";
					exit;
				}
				// filename yang aman
				$name = $nsk["name"];

				// mencegah overwrite filename
				$i = 0;
				$parts = pathinfo($name);
				while (file_exists(UPLOAD_DIR . $name)) {
					$i++;
					$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
				}

				// upload file
				$success = move_uploaded_file($nsk["tmp_name"],
				UPLOAD_DIR . $name);
				if (!$success) { 
					echo "<script>alert('Gagal upload file');</script>";
					echo "<script>location='../nsk_tampil/".$iddep."/".$kategori."';</script>";
					exit;
				} else {
					$data_file = array (
						'judul'       => $judul,
						'nama_nsk'    => $name,
						'ukuran_file' => $size,
						'ekstensi'    => $ext,
						'kategori'    => $kategori,
						'iddepartemen'=> $iddep,
						'date'        => $tahun
					);

					$insert = $this->m_data->save('dokumen_nsk',$data_file);
					if($insert){
						echo "<script>alert('Berhasil upload file');</script>";
						echo "<script>location='../nsk_tampil/".$iddep."/".$kategori."';</script>";
					}else{
						echo "<script>alert('Gagal upload file');</script>";
						echo "<script>location='../nsk_tampil/".$iddep."/".$kategori."';</script>";
						exit;
					}
				}

				// set permisi file
				chmod(UPLOAD_DIR . $name, 0644);
			} else {
				echo "<script>alert('Gagal upload file, ekstensi file tidak diijinkan, silangkan convert file terlebih dahulu ke .rar atau .zip');</script>";
				echo "<script>location='../nsk_tampil/".$iddep."/".$kategori."';</script>";
			}
        }
	}
	/*AKHIR UPLOAD FILE NSK*/

	/*AWAL HASIL FILE SK*/
	public function hasil($kat_admin,$id,$kategori){
		$this->load->database();
		$data['kat_admin']= $kat_admin;
		$data['kategori'] = $kategori;
		$data['id']       = $id;
		$nama  = $this->m_data->get_file_id('dokumen_sk',$kategori,$id)->result();

		redirect(base_url()."upload/sk/". $nama[0]->nama_sk);
		
		//$this->load->view('admin/sk/hasil',$data);
	}
	/*AKHIR HASIL FILE SK*/



//UP2TI
	/* AWAL VIEW FILE SK*/
	function f_sk_tampil($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/f_sk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/sk/vf_sk',$data);
	}
	/* AKHIR VIEW FILE SK*/

	/* AWAL VIEW FILE NSK*/
	function f_nsk_tampil($kategori){
		$this->load->database();
		$data['kategori']       = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/f_nsk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/non_sk/vf_nsk',$data);
	}
	/* AWAL VIEW FILE NSK*/

	/* AWAL CARI FILE NSK*/
	function cari_f_nsk($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		$cari                  = $this->input->get('cari');

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/f_nsk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->cari_f_nsk('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_cari_f_list('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/non_sk/vf_nsk',$data);
	}
	/* AKHIR CARI FILE NSK*/

	/* AWAL CARI FILE SK*/
	function cari_f_sk($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$cari                  = $this->input->get('cari');

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/f_sk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->cari_f_sk('dokumen_sk','departemen',$cari,$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_cari_f_list('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/sk/vf_sk',$data);
	}
	/* AKHIR CARI FILE SK*/




//FAKULTAS
	function fkl_sk_tampil($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		
		if (!empty($this->input->get('paginasi'))) {
			$b = $this->input->get('paginasi');
			$_SESSION['paginasi'] = $b;
			if ($b != "semua") {
				$paginasi = $b;
			} else {
				$paginasi = $this->m_data->get_file_f('dokumen_sk','departemen',$kategori)->num_rows();
			}
		} else {
			if (empty($_SESSION['paginasi'])) {
				$paginasi = 50;
			} else {
				$paginasi = $_SESSION['paginasi'];
			}
		}

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = $paginasi;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_sk_urut_judul($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_urut_nosk/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_urut_judul('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_urut_judul('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_sk_urut_nama_file($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_urut_nosk/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_urut_nama_file('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_urut_nama_file('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_sk_urut_unit($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_urut_nosk/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_urut_unit('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_urut_unit('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_sk_urut_tahun($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_urut_tahun/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_tahun('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_tahun('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_sk_urut_nosk($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_sk_urut_nosk/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_nosk('dokumen_sk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_nosk('dokumen_sk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/sk/vf_sk',$data);
	}

	function fkl_cari_f_sk($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;
		$cari                  = $this->input->get('cari');

		$cari     = $this->input->get('cari');
		$kolom    = $this->input->get('kolom');

		if ($kolom == "semua") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_sk('dokumen_sk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/sk/vf_sk',$data);

		} else if ($kolom == "judul") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_sk_judul('dokumen_sk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_judul('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/sk/vf_sk',$data);

		} else if ($kolom == "nama_file") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_sk_nama_file('dokumen_sk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_nama_file('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/sk/vf_sk',$data);

		} else if ($kolom == "unit") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_sk_unit('dokumen_sk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_unit('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/sk/vf_sk',$data);

		} else {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_sk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_sk_tahun('dokumen_sk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_tahun('dokumen_sk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/sk/vf_sk',$data);
		}

			
	}

	function fkl_nsk_tampil($kategori){
		$this->load->database();
		$data['kategori']       = $kategori;

		if (!empty($this->input->get('paginasi'))) {
			$b = $this->input->get('paginasi');
			$_SESSION['paginasi'] = $b;
			if ($b != "semua") {
				$paginasi = $b;
			} else {
				$paginasi = $this->m_data->get_file_f('dokumen_nsk','departemen',$kategori)->num_rows();
			}
		} else {
			if (empty($_SESSION['paginasi'])) {
				$paginasi = 50;
			} else {
				$paginasi = $_SESSION['paginasi'];
			}
		}

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = $paginasi;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
	}

	function fkl_cari_f_nsk($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		$cari                  = $this->input->get('cari');
		$kolom    = $this->input->get('kolom');

		if ($kolom == "semua") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_nsk('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);

		} else if ($kolom == "judul") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_nsk_judul('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_judul('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);

		} else if ($kolom == "nama_file") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_nsk_nama_file('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_fnsk_list_nama_file('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);

		} else if ($kolom == "unit") {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_nsk_unit('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_unit('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);

		} else {
			//konfigurasi pagination
	        $config['base_url']    = base_url().'file/fkl_nsk_tampil/'.$kategori.'/'; //site url
	        $config['total_rows']  = $this->m_data->cari_f_nsk_tahun('dokumen_nsk','departemen',$cari,$kategori)->num_rows();
	        $config['per_page']    = 50;  //show record per halaman
	        $config["uri_segment"] = 4;  // uri parameter
	        $choice                = $config["total_rows"] / $config["per_page"];
	        $config["num_links"]   = floor($choice);
	 
	        // Membuat Style pagination untuk BootStrap v4
	        $config['first_link']       = 'First';
	        $config['last_link']        = 'Last';
	        $config['next_link']        = 'Next';
	        $config['prev_link']        = 'Prev';
	        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	        $config['full_tag_close']   = '</ul></nav></div>';
	        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	        $config['num_tag_close']    = '</span></li>';
	        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['prev_tagl_close']  = '</span>Next</li>';
	        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	        $config['first_tagl_close'] = '</span></li>';
	        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	        $config['last_tagl_close']  = '</span></li>';
	 
	        $this->pagination->initialize($config);
	        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	 
	        //panggil function get_file_list yang ada pada mmodel.

	        $data['data']          = $this->m_data->get_file_cari_f_list_tahun('dokumen_nsk', 'departemen', $kategori, $cari, $config["per_page"], $data['page']);           
	        $data['pagination']    = $this->pagination->create_links();
			$data['kategori_f_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();
			$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

			$this->load->view('admin/vf_header');
			$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
		}
	}

	/*AWAL HAPUSFILE SK*/
	function fkl_sk_hapus($kat_admin,$id,$kategori){
		$result = $this->m_data->ambil_file('dokumen_sk',$kat_admin,$kategori,$id)->result();
  		$file   = "upload/sk/".$result[0]->nama_sk;
		
		if(file_exists($file)){
		    unlink($file);
		} else {
			echo "<script>alert('Gagal menghapus file, file tidak tersedia di databse');</script>";
			echo "<script>location='../../../fkl_sk_tampil/".$kategori."';</script>";
		} 

		if(file_exists($file)){
    		echo "<script>alert('Gagal menghapus file, file tidak bisa dihapus dari direktori');</script>";
			echo "<script>location='../../../fkl_sk_tampil/".$kategori."';</script>";
  		} else {
			$data  = $this->m_data->hapus_file('dokumen_sk',$kat_admin,$kategori,$id);
			if ($data) {
				echo "<script>alert('File berhasil dihapus');</script>";
				echo "<script>location='../../../fkl_sk_tampil/".$kategori."';</script>";
			} else {
				echo "<script>alert('Gagal menghapus file');</script>";
				echo "<script>location='../../../fkl_sk_tampil/".$kategori."';</script>";
			}
		}
	}
	/*AKHIR HAPUS FILE SK*/

	public function fkl_sk_hasil($id,$kategori){
		$this->load->database();
		$data['kategori'] = $kategori;
		$data['id']       = $id;
		$nama = $this->m_data->get_file_id('dokumen_sk',$kategori,$id)->result();
		
		redirect(base_url()."upload/sk/". $nama[0]->nama_sk);
	}

	/*AWAL DOWNLOAD FILE SK*/
	function fkl_sk_download($kat_admin,$id,$kategori){
		$this->load->database();
		$data['id']        = $id;
		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		$data['file']      = $this->m_data->download_file('dokumen_sk',$kat_admin,$kategori,$id)->result();
		force_download('upload/sk/'.$data['file'][0]->nama_sk,NULL);
	}
	/*AKHIR DOWNLOAD FILE SK*/

	/*AWAL HASIL FILE NSK*/
	public function fkl_nsk_hasil($id,$kategori){
		$this->load->database();
		$data['kategori']  = $kategori;
		$data['id']        = $id;
		$nama  = $this->m_data->get_file_id('dokumen_nsk',$kategori,$id)->result();
		
		redirect(base_url()."upload/non_sk/". $nama[0]->nama_nsk);
	}
	/*AKHIR HASIL FILE NSK*/

	/*AWAL HAPUSFILE NSK*/
	function fkl_nsk_hapus($kat_admin,$id,$kategori){
		$result = $this->m_data->ambil_file('dokumen_nsk',$kat_admin,$kategori,$id)->result();
  		$file   = "upload/non_sk/".$result[0]->nama_nsk;
		
		if(file_exists($file)){
		    unlink($file);
		} else {
			echo "<script>alert('Gagal menghapus file, file tidak tersedia di databse');</script>";
			echo "<script>location='../../../fkl_nsk_tampil/".$kategori."';</script>";
		} 

		if(file_exists($file)){
    		echo "<script>alert('Gagal menghapus file, file tidak bisa dihapus dari direktori');</script>";
			echo "<script>location='../../../fkl_nsk_tampil/".$kategori."';</script>";
  		} else {
			$data  = $this->m_data->hapus_file('dokumen_nsk',$kat_admin,$kategori,$id);
			if ($data) {
				echo "<script>alert('File berhasil dihapus');</script>";
				echo "<script>location='../../../fkl_nsk_tampil/".$kategori."';</script>";
			} else {
				echo "<script>alert('Gagal menghapus file');</script>";
				echo "<script>location='../../../fkl_nsk_tampil/".$kategori."';</script>";
			}
		}
	}
	/*AKHIR HAPUS FILE NSK*/

	/*AWAL DOWNLOAD FILE NSK*/
	function fkl_nsk_download($kat_admin,$id,$kategori){
		$this->load->database();
		$data['id']        = $id;
		$data['kategori']  = $kategori;
		$data['kat_admin'] = $kat_admin;

		$data['file']      = $this->m_data->download_file('dokumen_nsk',$kat_admin,$kategori,$id)->result();
		force_download('upload/non_sk/'.$data['file'][0]->nama_nsk,NULL);
	}
	/*AKHIR DOWNLOAD FILE NSK*/

	function fkl_nsk_urut_tahun($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_nsk_urut_tahun/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_tahun('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_tahun('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk']= $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
	}

	function fkl_nsk_urut_judul($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_nsk_urut_judul/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_judul_fnsk('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_urut_judul('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk']= $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
	}

	function fkl_nsk_urut_nama_file($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_nsk_urut_judul/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_urut_nama_file_fnsk('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_fnsk_list_urut_nama_file('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk']= $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
	}

	function fkl_nsk_urut_unit($kategori){
		$this->load->database();
		$data['kategori']      = $kategori;

		//konfigurasi pagination
        $config['base_url']    = base_url().'file/fkl_nsk_urut_judul/'.$kategori.'/'; //site url
        $config['total_rows']  = $this->m_data->get_file_f_urut_unit('dokumen_nsk','departemen',$kategori)->num_rows();
        $config['per_page']    = 50;  //show record per halaman
        $config["uri_segment"] = 4;  // uri parameter
        $choice                = $config["total_rows"] / $config["per_page"];
        $config["num_links"]   = floor($choice);
 
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        //panggil function get_file_list yang ada pada mmodel.

        $data['data']          = $this->m_data->get_file_f_list_urut_unit('dokumen_nsk', 'departemen', $kategori, $config["per_page"], $data['page']);           
        $data['pagination']    = $this->pagination->create_links();
		$data['kategori_f_nsk']= $this->m_data->get_kategori('kategori_sk')->result();
		$data['departemen']    = $this->m_data->get_departemen('departemen')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/fakultas/non_sk/vf_nsk',$data);
	}

	/*AWAL UPLOAD FILE SK*/
	function upload_f_sk_file(){
        // definisi folder upload
        define("UPLOAD_DIR", "./upload/sk/");

        if (!empty($_FILES["sk"])) {
        	$ekstesi_boleh = array('pdf','doc','docx');

			$sk     = $_FILES["sk"];
			$ext    = pathinfo($_FILES["sk"]["name"], PATHINFO_EXTENSION);
			$size   = $_FILES["sk"]["size"];
			$tgl    = date("Y-m-d");

			$iddep     = $this->input->post('departemen');
			$nosk      = $this->input->post('no_sk');
			$jdl       = $this->input->post('judul');
			$kategori  = $this->input->post('kategori');
			$tahun     = $this->input->post('tahun');

			$no_sk     = htmlspecialchars($nosk);
			$judul     = htmlspecialchars($jdl);

			if (in_array(strtolower($ext), $ekstesi_boleh)) {
				if ($sk["error"] !== UPLOAD_ERR_OK) {
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../fkl_sk_tampil/".$kategori."';</script>";
					exit;
				}

				// filename yang aman
				$name = $sk["name"];

				// mencegah overwrite filename
				$i = 0;
				$parts = pathinfo($name);
				while (file_exists(UPLOAD_DIR . $name)) {
					$i++;
					$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
				}

				// upload file
				$success = move_uploaded_file($sk["tmp_name"],
				UPLOAD_DIR . $name);
				if (!$success) { 
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../fkl_sk_tampil/".$kategori."';</script>";
					exit;
				} else {
					$data_file = array (
						'no_sk'       => $no_sk,
						'judul'       => $judul,
						'nama_sk'     => $name,
						'ukuran_file' => $size,
						'ekstensi'    => $ext,
						'kategori'    => $kategori,
						'iddepartemen'=> $iddep,
						'date'        => $tahun
					);

					$insert = $this->m_data->save('dokumen_sk',$data_file);
					if($insert){
						echo "<script>alert('Berhasil upload file');</script>";
						echo "<script>location='../fkl_sk_tampil/".$kategori."';</script>";
					}else{
						echo "<script>alert('Gagal upload file3');</script>";
						echo "<script>location='../fkl_sk_tampil/".$kategori."';</script>";
						exit;
					}
				}

				// set permisi file
				chmod(UPLOAD_DIR . $name, 0644);
			} else {
				echo "<script>alert('Gagal upload file, ekstensi file yang diijinkan hanya .pdf, .docx, .doc');</script>";
				echo "<script>location='../fkl_sk_tampil/".$kategori."';</script>";
			}
        }
	}
	/*AKHIR UPLOAD FILE SK*/

	/*AWAL UPLOAD FILE NSK*/
	function upload_f_nsk_file(){
        // definisi folder upload
        define("UPLOAD_DIR", "./upload/non_sk/");

        if (!empty($_FILES["nsk"])) {
        	$ekstesi_boleh = array('pdf','doc','docx', 'txt', 'jpg', 'jpeg', 'png', 'bmp', 'csv', 'ico', 'psd', 'mp3', 'wav', 'mpg', 'mpeg', 'avi', 'flv', 'gif', 'log', 'rar', 'zip', 'cdr', 'mp4', '3gp', 'xls', 'xlsx', 'mid', 'wav', 'swf', 'tar', 'ppt', 'pptx', 'sql', 'db', 'epub', 'mobi', 'acsm', 'pst', 'xlsm', 'mpp', 'ppsx', 'mdb', 'opf', 'crtx', 'docm', 'one', 'ost', 'dotm', 'iaf', 'lit', 'mbd', 'prc', 'snp', 'ceb', 'potx');

			$sk     = $_FILES["nsk"];
			$ext    = pathinfo($_FILES["nsk"]["name"], PATHINFO_EXTENSION);
			$size   = $_FILES["nsk"]["size"];
			$tgl    = date("Y-m-d");

			$iddep     = $this->input->post('departemen');
			$jdl       = $this->input->post('judul');
			$kategori  = $this->input->post('kategori');
			$tahun     = $this->input->post('tahun');

			$judul     = htmlspecialchars($jdl);
			if (in_array(strtolower($ext), $ekstesi_boleh)) {
				if ($sk["error"] !== UPLOAD_ERR_OK) {
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../fkl_nsk_tampil/".$kategori."';</script>";
					exit;
				}

				// filename yang aman
				$name = $sk["name"];

				// mencegah overwrite filename
				$i = 0;
				$parts = pathinfo($name);
				while (file_exists(UPLOAD_DIR . $name)) {
					$i++;
					$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
				}

				// upload file
				$success = move_uploaded_file($sk["tmp_name"],
				UPLOAD_DIR . $name);
				if (!$success) { 
					echo "<script>alert('Gagal upload file3');</script>";
					echo "<script>location='../fkl_nsk_tampil/".$kategori."';</script>";
					exit;
				} else {
					$data_file = array (
						'judul'       => $judul,
						'nama_nsk'    => $name,
						'ukuran_file' => $size,
						'ekstensi'    => $ext,
						'kategori'    => $kategori,
						'iddepartemen'=> $iddep,
						'date'        => $tahun
					);

					$insert = $this->m_data->save('dokumen_nsk',$data_file);
					if($insert){
						echo "<script>alert('Berhasil upload file');</script>";
						echo "<script>location='../fkl_nsk_tampil/".$kategori."';</script>";
					}else{
						echo "<script>alert('Gagal upload file3');</script>";
						echo "<script>location='../fkl_nsk_tampil/".$kategori."';</script>";
						exit;
					}
				}

				// set permisi file
				chmod(UPLOAD_DIR . $name, 0644);
			} else {
				echo "<script>alert('Gagal upload file, ekstensi file tidak diijinkan, silangkan convert file terlebih dahulu ke .rar atau .zip');</script>";
				echo "<script>location='../fkl_nsk_tampil/".$kategori."';</script>";
			}
        }
	}
	/*AKHIR UPLOAD FILE NSK*/

}