<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_stok extends CI_Model
{
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