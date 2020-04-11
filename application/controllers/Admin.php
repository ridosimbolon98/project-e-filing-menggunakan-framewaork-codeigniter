<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('status') != "login") {
			echo "<script>alert('Maaf anda harus login terlebih dahulu untuk mengakses halaman admin!');</script>";
			echo "<script>location='../login?pesan=belum_login';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_data');
			$this->load->model('m_login');
		}		
	}

	/*UBAH PASSWORD AKUN*/
	function ubah_password(){
		$this->load->view('admin/v_ubah_password');
		$this->load->view('v_footer');
	}

	function kembali(){
		echo "<script>history.go(-2)</script>";
	}

	function ubah_password_aksi(){
		$pl       = $this->input->post('pass_lama');
		$pb       = $this->input->post('pass_baru');
		$kpb      = $this->input->post('konf_pass_baru');
		$id       = $this->input->post('id');
		$kategori = $this->input->post('kategori');
		$level    = $this->input->post('level');

		$pass_lama      = strip_tags($pl);
		$pass_baru      = strip_tags($pb);
		$konf_pass_baru = strip_tags($kpb);

		$where    = array(
			'password'    => md5($pass_lama),
			'id'          => $id,
			'kategori'    => $kategori,
			'level'       => $level
		);
		$cek = $this->m_login->cek_pass("akun",$where)->num_rows();
		if($cek > 0){
			if($pass_baru == $konf_pass_baru){
				$id        = $this->session->userdata("id");
				$kategori  = $this->session->userdata("kategori");
				$level     = $this->session->userdata("level");
				$pl        = md5($pass_lama);
				$password  = md5($pass_baru);

				$update = $this->m_login->ubah_pass("akun",$id, $kategori, $level, $password, $pl);
				if($update){
					echo "<script>alert('Password berhasil diubah, silahkan login ulang');</script>";
					echo "<script>location='".base_url('login')."';</script>";
				} else{
					//kondisi jika proses query gagal
					echo "<script>alert('Maaf, gagal mengubah password!');</script>";
					echo "<script>location='".base_url('admin/ubah_password')."';</script>";
				}
			} else {
				//kondisi jika password baru beda dengan konfirmasi password
				echo "<script>alert('Maaf, password baru anda tidak sama dengan ulangi password! !');</script>";
				echo "<script>location='".base_url('admin/ubah_password')."';</script>";
			}
		} else {
			echo "<script>alert('Maaf, password lama anda tidak ada di database!');</script>";
			echo "<script>location='".base_url('admin/ubah_password')."';</script>";
		}
	}
	/*AKHIR UBAH PASSWORD AKUN*/


	/*AWAL KONTROL VIEW UNTUK UP2TI*/
	function up2ti(){
		$this->load->database();

		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		
		$data['kategori']   = $this->m_data->get_kategori('kategori_sk')->num_rows();
		$data['kategori_r'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['akun']       = $this->m_data->get_akun('akun','departemen')->num_rows();
		$data['akun_r']     = $this->m_data->get_data_dep('akun','departemen')->result();

		$data['kat_sk']     = $this->m_data->get_kat_sk('dokumen_sk','kategori_sk')->result();

		$data['file_sk']    = $this->m_data->get_file_sk('dokumen_sk')->num_rows();
		$data['file_sk1']   = $this->m_data->get_file_sk_dep('dokumen_sk',1)->num_rows();
		$data['file_sk2']   = $this->m_data->get_file_sk_dep('dokumen_sk',2)->num_rows();
		$data['file_sk3']   = $this->m_data->get_file_sk_dep('dokumen_sk',3)->num_rows();
		$data['file_sk4']   = $this->m_data->get_file_sk_dep('dokumen_sk',4)->num_rows();
		$data['file_sk5']   = $this->m_data->get_file_sk_dep('dokumen_sk',5)->num_rows();
		$data['file_sk6']   = $this->m_data->get_file_sk_dep('dokumen_sk',6)->num_rows();

		$data['file_nsk']   = $this->m_data->get_file_nsk('dokumen_nsk')->num_rows();
		$data['file_nsk1']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',1)->num_rows();
		$data['file_nsk2']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',2)->num_rows();
		$data['file_nsk3']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',3)->num_rows();
		$data['file_nsk4']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',4)->num_rows();
		$data['file_nsk5']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',5)->num_rows();
		$data['file_nsk6']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',6)->num_rows();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/vf_dashboard',$data);
	}

	function f_sk(){
		$this->load->database();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/vf_sk',$data);
	}

	function f_non_sk(){
		$this->load->database();
		$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/vf_non_sk',$data);
	}

	function daftar_akun(){
		$this->load->database();
		$data['akun']     = $this->m_data->get_akun('akun','departemen')->result();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/vf_akun',$data);
	}

	function cari_akun(){
		$this->load->database();
		$cari                  = $this->input->get('cari');
		$data['akun']          = $this->m_data->cari_akun('akun','departemen',$cari)->result();
		$data['kategori_f_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/vf_akun',$data);
	}

	function kategori_file(){
		$this->load->database();
		$data['kategori_file'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/vf_kategori',$data);
	}

	function cari_kategori(){
		$this->load->database();
		$cari                  = $this->input->get('cari');
		$data['kategori_file'] = $this->m_data->cari_kategori('kategori_sk',$cari)->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/up2ti/vf_kategori',$data);
	}

	function tambah_akun(){
		$nm   = $this->input->post('nama');
		$usr  = $this->input->post('username');
		$psw  = $this->input->post('password');
		$lvl  = $this->input->post('level');
		$ktg  = $this->input->post('kategori');

		$nama     = strip_tags($nm);
		$username = strip_tags($usr);
		$password = strip_tags($psw);
		$level    = strip_tags($lvl);
		$kategori = strip_tags($ktg);

		$data     = array(
			'nama'	   => $nama,
			'username' => $username,
			'password' => md5($password),
			'level'    => $level,
			'kategori' => $kategori
		); 

		$insert = $this->m_login->tambah_akun('akun',$data);
		if ($insert) {
			echo "<script>alert('Akun berhasil ditambahkan');</script>";
			echo "<script>location='daftar_akun';</script>";
		} else {
			echo "<script>alert('Gagal meambahkan akun');</script>";
			echo "<script>location='up2ti';</script>";
		}	
	}

	function tambah_kategori_file(){
		$ktg      = $this->input->post('kategori');
		$kategori = strip_tags($ktg);

		$data     = array(
			'nama_kategori' => $kategori
		); 

		$insert = $this->m_login->tambah_akun('kategori_sk',$data);
		if ($insert) {
			echo "<script>alert('Kategori berhasil ditambahkan');</script>";
			echo "<script>location='kategori_file';</script>";
		} else {
			echo "<script>alert('Gagal menambahkan kategori file');</script>";
			echo "<script>location='up2ti';</script>";
		}	
	}

	function ubah_akun(){
		$id   = $this->input->post('id');
		$nm   = $this->input->post('nama');
		$usr  = $this->input->post('username');
		$lvl  = $this->input->post('level');
		$ktg  = $this->input->post('kategori');

		$nama     = strip_tags($nm);
		$username = strip_tags($usr);
		$password = strip_tags($psw);
		$level    = strip_tags($lvl);
		$kategori = strip_tags($ktg);

		$update = $this->m_login->ubah_akun('akun',$nama,$username,$level,$kategori,$id);
		if ($update) {
			echo "<script>alert('Akun berhasil diubah');</script>";
			echo "<script>location='../daftar_akun';</script>";
		} else {
			echo "<script>alert('Gagal mengubah akun');</script>";
			echo "<script>location='../up2ti';</script>";
		}	
	}

	function hapus_akun($id){
		$hapus  = $this->m_login->hapus_akun('akun',$id);

		if ($hapus) {
			echo "<script>alert('Akun berhasil dihapus');</script>";
			echo "<script>location='../daftar_akun';</script>";
		} else {
			echo "<script>alert('Gagal menghapus akun');</script>";
			echo "<script>location='../up2ti';</script>";
		}
	}

	function ubah_kategori_file(){
		$id       = $this->input->post('id');
		$ktg      = $this->input->post('kategori');
		$ktg_jlh  = strlen($ktg);
		$kategori = strip_tags($ktg);

		if ($ktg_jlh >= 100) {
			echo "<script>alert('Gagal mengubah kategori, maksimal karakter 100');</script>";
			echo "<script>location='../kategori_file';</script>";
		} else {
			$update = $this->m_data->ubah_kategori_file('kategori_sk',$kategori,$id);
			if ($update) {
				echo "<script>alert('Kategori berhasil diubah');</script>";
				echo "<script>location='../kategori_file';</script>";
			} else {
				echo "<script>alert('Gagal mengubah kategori');</script>";
				echo "<script>location='../kategori_file';</script>";
			}	
		}	
	}

	function hapus_kategori_file($id){
		$hapus  = $this->m_data->hapus_kategori_file('kategori_sk',$id);

		if ($hapus) {
			echo "<script>alert('Kategori file berhasil dihapus');</script>";
			echo "<script>location='../kategori_file';</script>";
		} else {
			echo "<script>alert('Gagal menghapus kategori file');</script>";
			echo "<script>location='../kategori_file';</script>";
		}
	}
	/*AKHIR KONTROL VIEW UNTUK UP2TI*/



	/*AWAL KONTROL VIEW UNTUK DEPARTEMEN*/
	function departemen(){
		$this->load->database();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();
		$this->load->view('admin/vd_header');
		$this->load->view('admin/v_departemen',$data);
		$this->load->view('admin/v_footer');
	}

	function sk(){
		$this->load->database();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/v_sk',$data);
	}

	function non_sk(){
		$this->load->database();
		$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/vf_header');
		$this->load->view('admin/v_non_sk',$data);
	}
	/*AKHIR KONTROL VIEW UNTUK DEPARTEMEN*/





	/*AWAL KONTROL VIEW UNTUK FAKULTAS*/
	function fakultas(){
		$this->load->database();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$data['kategori']   = $this->m_data->get_kategori('kategori_sk')->num_rows();
		$data['kategori_r'] = $this->m_data->get_kategori('kategori_sk')->result();
		$data['akun']       = $this->m_data->get_akun('akun','departemen')->num_rows();
		$data['akun_r']     = $this->m_data->get_data_dep('akun','departemen')->result();

		$data['kat_sk']     = $this->m_data->get_kat_sk('dokumen_sk','kategori_sk')->result();

		$data['file_sk']    = $this->m_data->get_file_sk('dokumen_sk')->num_rows();
		$data['file_sk1']   = $this->m_data->get_file_sk_dep('dokumen_sk',1)->num_rows();
		$data['file_sk2']   = $this->m_data->get_file_sk_dep('dokumen_sk',2)->num_rows();
		$data['file_sk3']   = $this->m_data->get_file_sk_dep('dokumen_sk',3)->num_rows();
		$data['file_sk4']   = $this->m_data->get_file_sk_dep('dokumen_sk',4)->num_rows();
		$data['file_sk5']   = $this->m_data->get_file_sk_dep('dokumen_sk',5)->num_rows();
		$data['file_sk6']   = $this->m_data->get_file_sk_dep('dokumen_sk',6)->num_rows();

		$data['file_nsk']   = $this->m_data->get_file_nsk('dokumen_nsk')->num_rows();
		$data['file_nsk1']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',1)->num_rows();
		$data['file_nsk2']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',2)->num_rows();
		$data['file_nsk3']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',3)->num_rows();
		$data['file_nsk4']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',4)->num_rows();
		$data['file_nsk5']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',5)->num_rows();
		$data['file_nsk6']  = $this->m_data->get_file_nsk_dep('dokumen_nsk',6)->num_rows();

		$this->load->view('admin/v_f_header');
		$this->load->view('admin/v_f_dashboard',$data);
	}

	function fkl_sk(){
		$this->load->database();
		$data['kategori_sk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/v_f_header');
		$this->load->view('admin/v_f_sk',$data);
	}

	function fkl_non_sk(){
		$this->load->database();
		$data['kategori_nsk'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/v_f_header');
		$this->load->view('admin/v_f_non_sk',$data);
	}

	function fkl_kategori_file(){
		$this->load->database();
		$data['kategori_file'] = $this->m_data->get_kategori('kategori_sk')->result();

		$this->load->view('admin/v_f_header');
		$this->load->view('admin/fakultas/vf_kategori',$data);
	}

	function fkl_cari_kategori(){
		$this->load->database();
		$cari                  = $this->input->get('cari');
		$data['kategori_file'] = $this->m_data->cari_kategori('kategori_sk',$cari)->result();

		$this->load->view('admin/v_f_header');
		$this->load->view('admin/fakultas/vf_kategori',$data);
	}

	function fkl_ubah_kategori_file(){
		$id       = $this->input->post('id');
		$ktg      = $this->input->post('kategori');
		$ktg_jlh  = strlen($ktg);
		$kategori = strip_tags($ktg);

		if ($ktg_jlh >= 100) {
			echo "<script>alert('Gagal mengubah kategori');</script>";
			echo "<script>location='../fkl_kategori_file';</script>";
		} else {
			$update = $this->m_data->ubah_kategori_file('kategori_sk',$kategori,$id);
			if ($update) {
				echo "<script>alert('Kategori berhasil diubah');</script>";
				echo "<script>location='../fkl_kategori_file';</script>";
			} else {
				echo "<script>alert('Gagal mengubah kategori');</script>";
				echo "<script>location='../fkl_kategori_file';</script>";
			}
		}		
	}

	function fkl_hapus_kategori_file($id){
		$hapus  = $this->m_data->hapus_kategori_file('kategori_sk',$id);

		if ($hapus) {
			echo "<script>alert('Kategori file berhasil dihapus');</script>";
			echo "<script>location='../fkl_kategori_file';</script>";
		} else {
			echo "<script>alert('Gagal menghapus kategori file');</script>";
			echo "<script>location='../fkl_kategori_file';</script>";
		}
	}

	function fkl_tambah_kategori_file(){
		$ktg      = $this->input->post('kategori');
		$kategori = strip_tags($ktg);

		$data     = array(
			'nama_kategori' => $kategori
		); 

		$insert = $this->m_login->tambah_akun('kategori_sk',$data);
		if ($insert) {
			echo "<script>alert('Kategori berhasil ditambahkan');</script>";
			echo "<script>location='fkl_kategori_file';</script>";
		} else {
			echo "<script>alert('Gagal menambahkan kategori file');</script>";
			echo "<script>location='fkl_kategori_file';</script>";
		}	
	}
	/*AKHIR KONTROL VIEW UNTUK FAKULTAS*/

}