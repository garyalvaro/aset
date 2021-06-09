<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
       
    }

    public function index()
     {
        $list_user = $this->db->select('*')->from('user')->order_by('id_user','desc')->get()->result(); 
        $this->load->view('user/list_user',['list_user'=>$list_user]);
    }

    public function edit_user($id_user) 
    {
 
        $data['user'] = $this->User_model->view_by($id_user);
        

        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
            $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'trim|min_length[6]|matches[password]');
            
            if($this->form_validation->run() == TRUE)
            {
                $id_user=$this->uri->segment(3);
                $username=$this->input->post('username');
                $email=$this->input->post('email');
                $nama=$this->input->post('nama');
                $nim=$this->input->post('nim');
                $password1 =$this->input->post('password');
                $password = sha1($password1);

                $where = array(
                    'id_user'=>$id_user
                );

                if($password1 == ""){
                    $data = array(
                        'username' => $username,
                        'nama' => $nama,
                        'email' => $email,
                        'nim' => $nim              
                    );
                }
                else{
                    $data = array(
                        'username' => $username,
                        'nama' => $nama,
                        'email' => $email,
                        'nim' => $nim,
                        'password' => $password               
                    );
                }

                $data_session = array(
					'id_user'=>$id_user,
					'email'=>$email,
					'nama'=>$nama,
					'username'=>$username
				);  
				$this->session->set_userdata($data_session);
                
                $this->User_model->edit($where,$data,'user');

                $this->session->set_flashdata('edit_sukses', 'edit_sukses');
                redirect('User/edit_user/'.$id_user);
            }
        }
        $this->load->view('user/user_edit',$data);
          
    }

   //  $this->form_validation->set_rules('konfirmasi password', 'Konfirmasi Password', '|min_length[5]|matches[password]');
       
       
   

    public function admin_profile_user($id_user) 
    {
        $row = $this->User_model->view_by($id_user);
        if ($row) {
            $data = array(
        'foto' => $row->foto,
        'username' => $row->username,
        'nama' => $row->nama,
        'nim' => $row->nim,
        'email' => $row->email,
        
        );
            $this->load->view('User/admin_user_profile',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function profile_user($id_user) 
    {
        $row = $this->User_model->view_by($id_user);
        if ($row) {
            $data = array(
        'foto' => $row->foto,
        'username' => $row->username,
        'nama' => $row->nama,
        'nim' => $row->nim,
        'email' => $row->email,
        
        );
            $this->load->view('User/user_profile',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function ubah_foto($id_user)
    {
        $this->load->view('user/user_edit',$data);
        $config['upload_path']       = './assets/images/user';
        $config['allowed_types']    = 'jpg|png';
        $config['file_name']            = date("Ymd_His")."-".$this->input->post('nama');
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
        $this->load->library('upload', $config);

        if($this->input->post('submit'))
        {
            $namafile = preg_replace('/\s+/', '_', $this->upload->data('file_name').".jpg");
            $data = array('foto' =>$namafile);
            
            $this->User_model->edit_foto($id_user, $data);

            if($this->session->userdata('id_user') == $id_user)
                $this->session->set_userdata($data);
            
            $this->session->set_flashdata('edit_sukses', 'edit_sukses');
            redirect('user/edit_user/'.$id_user);
        }

    }


    public function hapus_user($id_user)
    {
        if($this->session->userdata('level')!=1)
            redirect('');
        elseif($this->User_model->hapus($id_user)){
            redirect('user/index');
        }
        else{
            echo "Something Error";
        }
            
    }

    public function update_status()
    {
        if($this->session->userdata('level')!=1)
            redirect('');
        elseif(isset($_REQUEST['sval']))
        {
            $this->load->model('User_model','view');
            $up_status = $this->view->update_status();
    
            if($up_status>0)
            {
                $this->session->set_flashdata('msg','User status has been updated successfully!');
                $this->session->set_flashdata('msg_class','alert-success'); 
            }
            else{
            $this->session->set_flashdata('msg','User status has not been updated successfully!');
            $this->session->set_flashdata('msg_class','alert-danger');  
            }
            return redirect('user');
        }
    }

    public function update_status_byid($id_user, $actived)
    {
        if($this->session->userdata('level')!=1)
            redirect('');
        elseif($actived == 0)
            $this->User_model->update_status_byid($id_user, 1);
        else
            $this->User_model->update_status_byid($id_user, 0);
        redirect('User/edit_user/'.$id_user);
    }
}
?>
