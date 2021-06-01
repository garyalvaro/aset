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
				$active=$key->active;
				$level=$key->level;
			}
			if($active==1)
			{
				$data_session = array(
					'id_user'=>$id_user,
					'email'=>$email,
					'level'=>$level,
					'username'=>$username,
					'LoggedIN'=>TRUE
				);  
				$this->session->set_userdata($data_session);
				redirect('Account/dashboard');
			}
			else
				echo "Akun anda sudah dinonaktifkan";
		}
		else {
			// echo "Maaf username atau password Anda salah";
			$this->session->set_flashdata('Salah','Maaf Username atau Password Anda Salah'); // artinya Maaf Username atau Password Anda Salah di simpan ke 'Salah'
			redirect('Account/index');
		}
	}

	public function dashboard()
	{
		$this->load->view('account/dashboard.php');
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
			$config['upload_path'] = './assets/images/user';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048000'; // max size in KB
			$config['max_width'] = '20000'; //max resolution width
			$config['max_height'] = '20000';  //max resolution height
			// load CI libarary called upload
			$this->load->library('upload', $config);
			// body of if clause will be executed when image uploading is failed
			if(!$this->upload->do_upload()){
				$errors = array('error' => $this->upload->display_errors());
				// This image is uploaded by deafult if the selected image in not uploaded
				$image = 'user-icon.png';
				//redirect('Account/dashboard');
			}
			// body of else clause will be executed when image uploading is succeeded
			else{
				$data = array('upload_data' => $this->upload->data());
				$image = $_FILES['userfile']['name'];  //name must be userfile

			}
			$this->session->set_flashdata('success','Image stored');
		
			$username=$this->input->post('username');
			$email=$this->input->post('email');
			$nama=$this->input->post('nama');
			$nim=$this->input->post('nim');
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
			redirect('Account/dashboard');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("Account");
	}	
}

?>