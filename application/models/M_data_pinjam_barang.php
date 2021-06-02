<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_data_pinjam_barang extends CI_Model

{
    public function view()
    {
        return $this->db->get('pinjam_barang')->result();
    }


	public function view_by($id_barang)
	{
		$this->db->where('id_barang',$id_barang);
		return $this->db->get('barang')->row();
	}


	public function view_idPinjam($id_pinjamBarang)
	{
		$this->db->where('id_pinjamBarang',$id_pinjamBarang);
		return $this->db->get('pinjam_barang')->row();
	}

	public function setujui($id_pinjamBarang, $data)
	{
		$this->session->set_userdata(['id_user' => 1]);

		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		// $id_transaksi = $this->input->post('id_transaksi');
		// $deskripsi = $this->input->post('deskripsi');
		// $tgl_pinjam = $this->input->post('tgl_pinjam');
		// $tgl_pengembalian = $this->input->post('tgl_pengembalian');
		// $alasan = $this->input->post('alasan_pinjam');
		// $des = $this->input->post('deskripsi_acc');
		$action_datetime = $this->input->post('action_datetime');
		$id_barang = $this->input->post('id_barang');

		$this->db->query("BEGIN;");
		$this->db->query("UPDATE pinjam_barang SET status_peminjaman='1' WHERE id_pinjamBarang=$id_pinjamBarang;");
		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','2', '$tgl');");
			
		$this->db->query("COMMIT;");
	}

	public function tolak($id_pinjamBarang, $data)
	{
		$this->session->set_userdata(['id_user' => 1]);

		$status_peminjaman == $this->input->post('status_peminjaman');
		if ($status_peminjaman != 1) {
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		// $id_transaksi = $this->input->post('id_transaksi');
		// $deskripsi = $this->input->post('deskripsi');
		// $tgl_pinjam = $this->input->post('tgl_pinjam');
		// $tgl_pengembalian = $this->input->post('tgl_pengembalian');
		// $alasan = $this->input->post('alasan_pinjam');
		// $des = $this->input->post('deskripsi_acc');
		$action_datetime = $this->input->post('action_datetime');
		$id_barang = $this->input->post('id_barang');

		$this->db->query("BEGIN;");
		$this->db->query("DELETE FROM pinjam_barang WHERE id_pinjamBarang=$id_pinjamBarang");
		$this->db->query("COMMIT;");
		return TRUE;
		}
		else { redirect('pinjam_barang/tampil_peminjam');}
	}

	public function selesaikan($id_pinjamBarang, $data)
	{
		$this->session->set_userdata(['id_user' => 1]);

		$status_peminjaman == $this->input->post('status_peminjaman');
		if ($status_peminjaman != 1) {
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		// $id_transaksi = $this->input->post('id_transaksi');
		// $deskripsi = $this->input->post('deskripsi');
		// $tgl_pinjam = $this->input->post('tgl_pinjam');
		// $tgl_pengembalian = $this->input->post('tgl_pengembalian');
		// $alasan = $this->input->post('alasan_pinjam');
		// $des = $this->input->post('deskripsi_acc');
		$action_datetime = $this->input->post('action_datetime');
		$id_barang = $this->input->post('id_barang');

		$this->db->query("BEGIN;");
		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','3', '$tgl');");
		$this->db->query("DELETE FROM pinjam_barang WHERE id_pinjamBarang=$id_pinjamBarang");

		$this->db->query("COMMIT;");
		return TRUE;
	}
		else { redirect('pinjam_barang/tampil_peminjam');}
	}

	public function pinjam($id_barang,$data)
	{
		$this->session->set_userdata(['id_user' => 1]);

		// $id_barang = $this->input->post('id_barang');
		$id_user = $this->input->post('id_user');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_pengembalian = $this->input->post('tgl_pengembalian');
		$qty = $this->input->post('qty');
		$alasan_pinjam = $this->input->post('alasan_pinjam');
		$tgl = date('Y-m-d');
		
		$id_user = $this->session->userdata('id_user');
		
		
		$this->db->query("BEGIN;");
		$this->db->query("INSERT INTO pinjam_barang(id_barang, id_user, tgl_pinjam, tgl_pengembalian, qty, status_peminjaman, alasan_pinjam, deskripsi_acc, action_datetime) VALUES('$id_barang', '$id_user', '$tgl_pinjam', '$tgl_pengembalian', '$qty', '0', '$alasan_pinjam', '-', '$tgl'); ");
		$this->db->query("COMMIT;");

	}


	public function show_barang()
	{
		$query=$this->db->get('barang')->result();
		return $query;
	}

	public function detail_barang($id_barang = NULL)
	{
		$query = $this->db->get_where('barang', array('id_barang' => $id_barang)) -> row();
		return $query;
	}



}


?>