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
		$config['upload_path']       = 'assets/uploads';
		$config['allowed_types']    = 'jpg|png';
		$config['file_name']            = date("Ymd_His")."-".$this->input->post('nama_barang');
		$config['overwrite']			= true;
		$config['max_size']             = 2048; // 2MB
		$this->load->library('upload', $config);

		if($this->input->post('submit'))
		{
			$namafile = preg_replace('/\s+/', '_', $this->upload->data('file_name').".jpg");

			$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'foto' => "assets/uploads/".$namafile,
					'deskripsi' => $this->input->post('deskripsi'),
					'id_satuan' => $this->input->post('id_satuan')
					
				);

			
				echo $data['foto']."<br>";
				$this->M_data->save($data);
				$this->session->set_flashdata('addBarang_success', 'addBarang_success');
				redirect('barang/tampil_barang');
			
				
				
		}

	}


	public function editFoto($id_barang)
	{
		$this->load->view('ubah',$data);
		$config['upload_path']       = './assets/uploads';
		$config['allowed_types']    = 'jpg|png';
		$config['file_name']            = date("Ymd_His")."-".$this->input->post('nama_barang');
		$config['overwrite']			= true;
		$config['max_size']             = 2048; // 2MB
		$this->load->library('upload', $config);

		if($this->input->post('submit'))
		{
		$namafile = preg_replace('/\s+/', '_', $this->upload->data('file_name').".jpg");
			$data = array('foto' =>$namafile);
			
			if($this->M_data->edit_fotobarang_byid($id_barang, $data))
				$this->session->set_flashdata('editFotoBarang_success', 'editFotoBarang_success');
			else
				$this->session->set_flashdata('editFotoBarang_failed', 'editFotoBarang_failed');
			redirect('barang/tampil_barang');
		}

	}

	public function editBarang($id_barang)
	{
		$data['sat'] = $this->M_data->show_satuan();
		$data['barang'] = $this->M_data->view_by($id_barang);
		$this->load->view('ubah',$data);

		if($this->input->post('submit'))
		{
			

			$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'deskripsi' => $this->input->post('deskripsi'),
					'id_satuan' => $this->input->post('id_satuan')
					
				);
					$this->M_data->edit($id_barang,$data);
					redirect('barang/tampil_barang');
				
		}
		
		
	}


	public function hapus($id_barang)
	{
		if($this->M_data->hapusBarang($id_barang)){
			$this->
			$this->session->set_flashdata('deleteBarang_success', 'deleteBarang_success');
			redirect('barang/tampil_barang');
		}
		else{
			$this->session->set_flashdata('deleteBarang_failed', 'deleteBarang_failed');
			redirect('Barang/editBarang/'.$id_barang);
		}
			
	}

}
?>