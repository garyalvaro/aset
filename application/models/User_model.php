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

    public function edit($id_user,$data)
    {
        $data = array(
            "username" => $this->input->post('username'),
            "nama" => $this->input->post('nama'),
            "email" => $this->input->post('email')
        );

        $this->db->where('id_user',$id_user);
        $this->db->update('user',$data);
    }

   
    public function hapus($id_user)
    {
        $this->db->where('id_user',$id_user);
        $this->db->delete('id_user');
    }

}