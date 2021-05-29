<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
       
    }

    public function index()
    {
        $data['user'] = $this->User_model->view();
        $this->load->view('User/list_user',$data);
    }

    public function edit_user($id_user)
    {
       
        $data['user'] = $this->User_model->view_by($id_user);
        $this->load->view('user/user_edit',$data);

        if($this->input->post('submit'))
        {
            
            $data = array(
                    'username' => $this->input->post('username'),
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email')
                    );

                    $this->User_model->edit($id_user,$data);
                    redirect('user/index');    
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

    public function hapus_user($id_user)
    {
        $this->User_model->hapus($id_user);

        redirect('user');
    }

}
?>
