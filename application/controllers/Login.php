<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('v_header');
		$this->load->view('v_login');
		$this->load->view('v_footer');
	}

	function login_aksi(){
		$usr = $this->input->post('username');
		$psw = md5($this->input->post('password'));

		$username = strip_tags($usr);
		$password = strip_tags($psw);

		$where    = array(
			'username'    => $username,
			'password'    => $password
		);
		$cek   = $this->m_login->cek_login("akun",$where)->num_rows();
		$data  = $this->m_login->cek_login("akun",$where)->result();
		if($cek > 0){
			if($data[0]->level == "admin"){
				$data_session = array(
					'id'          => $data[0]->id,
					'nama'        => $data[0]->nama,
					'username'    => $username,
					'status'      => "login",
					'level'       => $data[0]->level,
					'kategori'    => $data[0]->kategori
				);

				$this->session->set_userdata($data_session);
				redirect(base_url("admin/up2ti"));
			} else if($data[0]->level == "admin_fakultas"){
				$data_session = array(
					'id'          => $data[0]->id,
					'nama'        => $data[0]->nama,
					'username'    => $username,
					'status'      => "login",
					'level'       => $data[0]->level,
					'kategori'    => $data[0]->kategori
				);

				$this->session->set_userdata($data_session);
				redirect(base_url("admin/fakultas"));
			} else {
				$data_session = array(
					'id'          => $data[0]->id,
					'nama'        => $data[0]->nama,
					'username'    => $username,
					'status'      => "login",
					'level'       => $data[0]->level,
					'kategori'    => $data[0]->kategori
				);

				$this->session->set_userdata($data_session);
				redirect(base_url("admin/departemen"));
			}

		} else{
			echo "<script>alert('Username dan Password anda salah');</script>";
			echo "<script>location='".base_url('login/index')."';</script>";
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}