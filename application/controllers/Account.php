<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
    {
       parent::__construct();
       $this->load->model('Account_model');
    }

	public function index()
	{
		$this->load->view('account/login.php');
	}

	public function login()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$password = sha1($password);
		$cek = $this->Account_model->login($username,$password,'user');
		if($cek!=NULL)
		{
			foreach ($cek as $key) {
				$id_user=$key->id_user;
				$email=$key->email;
				$nama=$key->nama;
				$active=$key->active;
				$level=$key->level;
				$foto=$key->foto;
			}
			if($active==1)
			{
				$data_session = array(
					'id_user'=>$id_user,
					'email'=>$email,
					'nama'=>$nama,
					'level'=>$level,
					'username'=>$username,
					'foto'=>$foto,
					'LoggedIN'=>TRUE
				);  
				$this->session->set_userdata($data_session);
				redirect('');
			}
			else{
				$this->session->set_flashdata('Nonaktif','Akun anda sudah dinonaktifkan');
				redirect('Account/index');
			}
		}
		else {
			// echo "Maaf username atau password Anda salah";
			$this->session->set_flashdata('Salah','Maaf Username atau Password Anda Salah'); // artinya Maaf Username atau Password Anda Salah di simpan ke 'Salah'
			redirect('Account/index');
		}
	}

	public function register()
	{	
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('konfirmasipassword', 'Konfirmasi Password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required|min_length[9]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('account/register');
			// redirect('Account/register');
		}
		else
		{		
			$username=$this->input->post('username');
			$email=$this->input->post('email');
			$nama=$this->input->post('nama');
			$nim=$this->input->post('nim');
			$image='user-icon.png';
			$password=$this->input->post('password');
			$password = sha1($password);

			$data=array(
				'username'=>$username,
				'email'=>$email,
				'nama'=>$nama,
				'nim'=>$nim,
				'password'=>$password,
				'foto'=>$image,
				'active'=>1
			);
			$this->Account_model->register('user',$data);

			// Untuk mendapatkan data ke session 
			$cek = $this->Account_model->login($username,$password,'user');
			foreach ($cek as $key) {
				$id_user=$key->id_user;
				$email=$key->email;
				$nama=$key->nama;
				$active=$key->active;
				$level=$key->level;
				$foto=$key->foto;
			}
			$data_session = array(
				'id_user'=>$id_user,
				'email'=>$email,
				'nama'=>$nama,
				'level'=>$level,
				'username'=>$username,
				'foto'=>$foto,
				'LoggedIN'=>TRUE
			);  
			$this->session->set_userdata($data_session);

			redirect('');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("Account");
	}	
}

?>