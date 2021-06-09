<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
    {
       parent::__construct();
       $this->load->model('Laporan_model');
    }

	public function index()
	{
		if($this->input->post('submit')){
			$data = [ 
				'tgl_mulai' => $this->input->post('tgl_mulai'),
				'tgl_selesai' => $this->input->post('tgl_selesai')
			];
			$data['laporan'] = $this->Laporan_model->cek_laporan($data);
            $data['record'] = $this->Laporan_model->hitung_record($data);
            $this->load->view('laporan/index', $data);
		}
        else{
            redirect('Pinjam_barang/tampil_peminjam');
        }
		
	}
}
