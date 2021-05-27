<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_data extends CI_Model
{
	public function view()
	{
		return $this->db->get('barang')->result();
	}

	public function view_by($id_barang)
	{
		$this->db->where('id_barang',$id_barang);
		return $this->db->get('barang')->row();
	}


public function show_satuan()
	{
		$query=$this->db->get('satuan')->result();
		return $query;
	}

private function _uploadImage()
{
    $config['upload_path']          = '../assets/uploads/barang/';
    $config['allowed_types']        = 'jpg|png';
    $config['file_name']            = date("Ymd_His")."-".$this->input->post('nama_barang');
    $config['overwrite']			= true;
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


	public function save($data)
	{
		$data = array(
			
			"nama_barang" => $this->input->post('input_namaBrg'),
			"foto" => $this->_uploadImage(),
			"deskripsi" => $this->input->post('input_deskripsiBrg'),
			"id_satuan" => $this->input->post('id_satuan')
		);
		$this->db->insert('barang',$data);
		

		// $nama_barang = $data['nama_barang'];
		// $foto_brg = $data['foto'];
		// $deskripsi = $data['deskripsi'];
		// $id_satuan = $data['id_satuan'];
		// $this->db->query("BEGIN;");
		// 	$this->db->query("INSERT INTO barang(nama_barang, foto, deskripsi, id_satuan) VALUES('$nama_barang', '$foto_brg', '$deskripsi', '$id_satuan');");
		// $this->db->query("COMMIT;");
	
	}

	
	public function edit($id_barang,$data)
	{
		$data = array(
			"nama_barang" => $this->input->post('input_namaBrg'),
			"deskripsi" => $this->input->post('input_deskripsiBrg'),
			"id_satuan" => $this->input->post('id_satuan')
		);

		$this->db->where('id_barang',$id_barang);
		$this->db->update('barang',$data);
	}

	public function hapusBarang($id_barang)
	{
		$this->db->query("BEGIN;");
			$this->db->query("DELETE FROM barang WHERE id_barang=$id_barang");
		$this->db->query("COMMIT;");
		return TRUE;
	}

	public function barangRusak($data)
	{

		$data = array(
			
			"id_transaksi" => $this->input->post('id_transaksi'),
			"deskripsi" => $this->input->post('input_deskripsiBrg')
		);
		$this->db->insert('barangRusak',$data);
	}
}
?>