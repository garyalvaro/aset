<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stok extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_stok');
	}
	public function index(){
		$this->load->view('stok/index');
	}
	public function cek_stok(){
		$id_barang = $this->input->post('id_barang');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$qty = $this->input->post('qty');
		
		$data = array(
			'id_barang' => $id_barang,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'qty' => $qty
		);

		$page['status']= $this->M_stok->cek_stok($data);
		$this->load->view('stok/index2',$page,$data);
	}
}
?>