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
		$this->session->set_userdata(['id_user' => 1]);

		$data = array(
			
			"nama_barang" => $this->input->post('input_namaBrg'),
			"foto" => $this->_uploadImage(),
			"deskripsi" => $this->input->post('input_deskripsiBrg'),
			"id_satuan" => $this->input->post('id_satuan')
		);

		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		

		
		$this->db->query("BEGIN;");
			$this->db->insert('barang',$data);
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', LAST_INSERT_ID(),'$id_user','3', '$tgl'); ");
		$this->db->query("COMMIT;");

	}

	public function barangRusak($id_barang)
	{
		$this->session->set_userdata(['id_user' => 1]);


		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		$id_transaksi = $this->input->post('id_transaksi');
		$deskripsi = $this->input->post('deskripsi');


		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','0', '$tgl');");
			$this->db->query("INSERT INTO barangrusak(id_transaksi,deskripsi) VALUES(LAST_INSERT_ID(), '$deskripsi');");
		$this->db->query("COMMIT;");
		
	}

	// public function pinjamStok($id_barang)
	// {
	// 	$this->session->set_userdata(['id_user' => 1]);
	// 	$qty = $this->input->post('qty');
	// 	$tgl = date('Y-m-d');
	// 	$id_user = $this->session->userdata('id_user');
	// 	$id_transaksi = $this->input->post('id_transaksi');

	// 	$this->db->query("BEGIN;");
	// 		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','1', '$tgl');");
	// 	$this->db->query("COMMIT;");
		
	// }

	// public function kembalikanStok($id_barang)
	// {
	// 	$this->session->set_userdata(['id_user' => 1]);
	// 	$qty = $this->input->post('qty');
	// 	$tgl = date('Y-m-d');
	// 	$id_user = $this->session->userdata('id_user');
	// 	$id_transaksi = $this->input->post('id_transaksi');

	// 	$this->db->query("BEGIN;");
	// 		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','2', '$tgl');");
	// 	$this->db->query("COMMIT;");
		
	// }

	public function hapusStok($id_barang)
	{
		$this->session->set_userdata(['id_user' => 1]);
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		$id_transaksi = $this->input->post('id_transaksi');

		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','4', '$tgl');");
		$this->db->query("COMMIT;");
		
	}

	public function tambahStok($id_barang)
	{
		$this->session->set_userdata(['id_user' => 1]);
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		$id_transaksi = $this->input->post('id_transaksi');

		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','3', '$tgl');");
		$this->db->query("COMMIT;");
		
	}

	public function edit_fotobarang_byid($id_barang, $data)
	{
		$foto_brg = $this->_uploadImage();
		$this->db->query("UPDATE barang SET foto='$foto_brg' WHERE id_barang=$id_barang");
		return TRUE;
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
	public function cek_stok($id_barang)
	{
		return $this->db->query("SELECT cek_stok_hariini($id_barang) AS stok")->row()->stok;
	}


}
?>