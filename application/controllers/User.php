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
}
?>
