<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function cek_laporan($data)
    {
        $tgl_mulai = $data['tgl_mulai'];
        $tgl_selesai = $data['tgl_selesai'];
		$query = $this->db->query("SELECT nama, nama_barang, DATEDIFF(tgl_pengembalian, tgl_pinjam)+1 AS durasi, qty, action_datetime
            FROM pinjam_barang
            JOIN user ON pinjam_barang.id_user = user.id_user
            JOIN barang ON pinjam_barang.id_barang = barang.id_barang
            WHERE (tgl_pinjam BETWEEN '$tgl_mulai' AND '$tgl_selesai') 
            AND status_peminjaman=3
           	ORDER BY tgl_pinjam;
        ");
        return $query->result();
    }

    public function hitung_record($data)
    {
        $tgl_mulai = $data['tgl_mulai'];
        $tgl_selesai = $data['tgl_selesai'];
		$query = $this->db->query("SELECT COUNT(*) AS record
            FROM pinjam_barang
            JOIN user ON pinjam_barang.id_user = user.id_user
            JOIN barang ON pinjam_barang.id_barang = barang.id_barang
            WHERE (tgl_pinjam BETWEEN '$tgl_mulai' AND '$tgl_selesai') 
            AND status_peminjaman=3
           	ORDER BY tgl_pinjam;
        ");
        return $query->row()->record;
    }
}

?>