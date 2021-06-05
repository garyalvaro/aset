<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_data_pinjam_barang extends CI_Model

{
    public function view()
    {
        // return $this->db->get('pinjam_barang')->result();
		$query = $this->db->query("SELECT id_pinjamBarang, nama, nama_barang, tgl_pinjam, tgl_pengembalian, qty, status_peminjaman, alasan_pinjam, deskripsi_acc, action_datetime
            FROM pinjam_barang
            JOIN user ON pinjam_barang.id_user = user.id_user
            JOIN barang ON pinjam_barang.id_barang = barang.id_barang;
        ");
        return $query->result();	
    }

	public function view_by($id_pinjamBarang)
	{
		// $this->db->where('id_barang',$id_barang);
		// return $this->db->get('barang')->row();
		$query = $this->db->query("SELECT id_pinjamBarang, nama, user.foto as foto_user, nama_barang, barang.foto as foto_barang, satuan, tgl_pinjam, tgl_pengembalian, qty, status_peminjaman, alasan_pinjam, deskripsi_acc, action_datetime
            FROM pinjam_barang
            JOIN user ON pinjam_barang.id_user = user.id_user
            JOIN barang ON pinjam_barang.id_barang = barang.id_barang
			JOIN satuan ON barang.id_satuan = satuan.id_satuan
			WHERE id_pinjamBarang = $id_pinjamBarang ;
        ");
        return $query->row();	
	}

	public function view_by_user($id_user)
	{
		$query = $this->db->query("SELECT user.id_user, nama, user.foto as foto_user, nama_barang, barang.foto as foto_barang, satuan, tgl_pinjam, tgl_pengembalian, qty, status_peminjaman, alasan_pinjam, deskripsi_acc, action_datetime
            FROM pinjam_barang
            JOIN user ON pinjam_barang.id_user = user.id_user
            JOIN barang ON pinjam_barang.id_barang = barang.id_barang
			JOIN satuan ON barang.id_satuan = satuan.id_satuan
			WHERE user.id_user = $id_user 
			ORDER BY action_datetime DESC;
        ");
        return $query->result();	
	}


	// Status Peminjaman :
	// 0 = belum diacc 
	// 1 = pinjaman diterima
	// 2 = pinjaman ditolak
	// 3 = pinjaman sudah selesai

	public function terima($id_pinjamBarang, $data)
	{
		$pilih =  $this->db->query("SELECT qty, id_barang, id_user FROM pinjam_barang WHERE id_pinjamBarang = $id_pinjamBarang ;")->row();
		$qty = $pilih->qty;
		$id_barang = $pilih->id_barang;
		$id_user = $pilih->id_user;
		$tgl = date('Y-m-d H:i:s');
		$deskripsi_acc = $data['deskripsi_acc'];

		$this->db->query("BEGIN;");
		$this->db->query("UPDATE pinjam_barang SET status_peminjaman='1',deskripsi_acc='$deskripsi_acc' WHERE id_pinjamBarang=$id_pinjamBarang;");
		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','2', '$tgl');");
		$this->db->query("COMMIT;");

		return TRUE;
	}

	public function tolak($id_pinjamBarang, $data)
	{
		$deskripsi_acc = $data['deskripsi_acc'];
		$this->db->query("UPDATE pinjam_barang SET status_peminjaman='2',deskripsi_acc='$deskripsi_acc' WHERE id_pinjamBarang=$id_pinjamBarang;");
		return TRUE;
	}

	public function selesai($id_pinjamBarang)
	{
		$pilih =  $this->db->query("SELECT qty, id_barang, id_user FROM pinjam_barang WHERE id_pinjamBarang = $id_pinjamBarang ;")->row();
		$qty = $pilih->qty;
		$id_barang = $pilih->id_barang;
		$id_user = $pilih->id_user;
		$tgl = date('Y-m-d H:i:s');

		$this->db->query("BEGIN;");
		$this->db->query("UPDATE pinjam_barang SET status_peminjaman='3' WHERE id_pinjamBarang=$id_pinjamBarang;");
		$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','3', '$tgl');");
		$this->db->query("COMMIT;");

		return TRUE;
	}

	public function pinjam($id_barang,$data)
	{
		$id_user = $this->input->post('id_user');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_pengembalian = $this->input->post('tgl_pengembalian');
		$qty = $this->input->post('qty');
		$alasan_pinjam = $this->input->post('alasan_pinjam');
		$tgl = date('Y-m-d H:i:s');
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

	public function cek_stok($data)
	{
		$id_barang = $data['id_barang'];
		$tgl_pinjam = $data['tgl_pinjam'];
		$tgl_kembali = $data['tgl_kembali'];
		$qty = $data['qty'];
		return $this->db->query("SELECT cek_availability($id_barang, '$tgl_pinjam', '$tgl_kembali', $qty) AS stok")->row();
	}


}


?>
