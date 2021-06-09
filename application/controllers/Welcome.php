<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		// $this->load->view('layout/blank');
		if($this->session->userdata('level')==0)
			redirect('Barang/tampil_barang_users');
		else
			redirect('Pinjam_barang/tampil_peminjam');
	}

	public function AboutUs()
	{
		$this->load->view('layout/aboutus');
	}
}
