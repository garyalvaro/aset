<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

public function view()
    {
        return $this->db->get('user')->result();
    }
 
    public function view_by($id_user)
    {
        $this->db->where('id_user',$id_user);
        return $this->db->get('user')->row();
    }

    public function edit($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function validation($mode)
    {
        $this->load->library('form_validation');
        if($mode == "edit")
        {

                    $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[30]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[30]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi_Password', 'min_length[5]|matches[password]');
            if($this->form_validation->run())
                return TRUE;
            else
                return FALSE;
        }


    }

        public function edit_foto($id_user, $data)
    {
        $foto_user = $this->_uploadImage();
        $this->db->query("UPDATE user SET foto='$foto_user' WHERE id_user=$id_user");
        return TRUE;
    }

    private function _uploadImage()
{
    $config['upload_path']          = '../assets/uploads/';
    $config['allowed_types']        = 'jpg|png';
    $config['file_name']            = date("Ymd_His")."-".$this->input->post('nama');
    $config['overwrite']            = true;
    $config['max_size']             = 2048; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('foto')) {
        return $this->upload->data("file_name");
    }
    
    print_r($this->upload->display_errors());
    // return "default.jpg";
}


   public function update_status()
    {
        $id_user = $_REQUEST['sid'];
        $saval = $_REQUEST['sval'];
        if($saval==1)
            $active = 0;
        else
            $active = 1;

        $data = array( 'active' => $active );
        $this->db->where('id_user',$id_user);
        return $this->db->update('user',$data);
    }

    public function update_status_byid($id_user, $active)
    {
        $data = array( 'active' => $active );
        $this->db->where('id_user',$id_user);
        return $this->db->update('user',$data);
    }
    
    public function hapus($id_user)
    {
        $this->db->query("BEGIN;");
            $this->db->query("DELETE FROM user WHERE id_user=$id_user");
        $this->db->query("COMMIT;");
        return TRUE;
    }
}