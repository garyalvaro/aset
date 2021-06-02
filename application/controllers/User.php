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
        $list_user = $this->db->select('*')->from('user')->order_by('id_user','desc')->get()->result(); 
        $this->load->view('user/list_user',['list_user'=>$list_user]);
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
            
            if($this->User_model->edit_foto($id_user, $data))
                $this->session->set_flashdata('editFoto_success', 'editFoto_success');
            else
                $this->session->set_flashdata('editFoto_failed', 'editFoto_failed');
            redirect('user/index');
        }

    }


    public function hapus_user($id_user)
    {
        if($this->User_model->hapus($id_user)){
            $this->session->set_flashdata('deleteBarang_success', 'deleteBarang_success');
            redirect('user/index');
        }
        else{
            $this->session->set_flashdata('deleteBarang_failed', 'deleteBarang_failed');
            redirect('user/index/'.$id_user);
        }
            
    }

    public function update_status()
    {
        if(isset($_REQUEST['sval']))
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
}
?>
