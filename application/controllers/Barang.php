<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_data');
	}


	public function tampil_barang()
	{
		$data['barang'] = $this->M_data->view();
		$this->load->view('tampil',$data);
	}


	public function tambahBrg()
	{
		$data['sat'] = $this->M_data->show_satuan();
		$this->load->view('tambah_barang', $data);
		//File Upload Config
		$config['upload_path']       = '../assets/uploads/barang/';
		$config['allowed_types']    = 'jpg';
		$config['file_name']            = date("Ymd_His")."-".$this->input->post('nama_barang');
		$config['overwrite']			= true;
		$config['max_size']             = 2048; // 2MB
		$this->load->library('upload', $config);

		if($this->input->post('submit'))
		{
			$namafile = preg_replace('/\s+/', '_', $this->upload->data('file_name').".jpg");

			$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'foto' => "assets/uploads/barang/".$namafile,
					'deskripsi' => $this->input->post('deskripsi'),
					'id_satuan' => $this->input->post('id_satuan')
					
				);

			
//				echo $data['foto_brg']."<br>";
				$this->M_data->save($data);
				$this->session->set_flashdata('addBarang_success', 'addBarang_success');
				redirect('barang/tampil_barang');
			
				
				
		}
		
		


// $data['sat'] = $this->M_data->show_satuan();
// if($this->input->post('submit'))
// 		{
			
// 			$this->M_data->save();
// 				redirect('barang/tampil_barang');
// 		}
		
// 		$this->load->view('tambah_barang',$data);


	}

}
?>