
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pinjam_barang extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_data_pinjam_barang');
       
    }


    public function tampil_peminjam()
	{
		$data['pinjam_barang'] = $this->M_data_pinjam_barang->view();
		$this->load->view('pinjam_barang/tampil_pinjaman_barang',$data);
	}


    
    function pinjam_setujui($id_pinjamBarang)
	{
		// $data['pinjam_barang'] = $this->M_data_pinjam_barang->view_by($id_barang);
		// $this->load->view('pinjam_barang/tampil_pinjaman_barang',$data);
    	$data['data'] = $this->M_data_pinjam_barang->view_idPinjam($id_pinjamBarang);
    	$this->load->view('pinjam_barang/detailSetujui', $data);
		
		if($this->input->post('submit'))
		{
			$data = array(
				'qty' => $this->input->post('qty'),
				'tgl' => date('Y-m-d'),
				'id_user' => $this->session->userdata('id_user'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'tgl_pengembalian' => $this->input->post('tgl_pengembalian'),
				'alasan' => $this->input->post('alasan_pinjam'),
				'des' => $this->input->post('deskripsi_acc'),
				'action_datetime' => $this->input->post('action_datetime'),
				'id_barang' => $this->input->post('id_barang')
		);
			$this->M_data_pinjam_barang->setujui($id_pinjamBarang,$data);
			redirect('pinjam_barang/tampil_peminjam');
		}	
		
		

	}

	
	function pinjam_tolak($id_pinjamBarang)
	{// $data['pinjam_barang'] = $this->M_data_pinjam_barang->view_by($id_barang);
		// $this->load->view('pinjam_barang/tampil_pinjaman_barang',$data);
    	$data['data'] = $this->M_data_pinjam_barang->view_idPinjam($id_pinjamBarang);
    	$this->load->view('pinjam_barang/detailTolak', $data);
		if($this->input->post('submit'))
		{ if ($status_peminjaman == 0 ){
			$data = array(
				'qty' => $this->input->post('qty'),
				'tgl' => date('Y-m-d'),
				'id_user' => $this->session->userdata('id_user'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'tgl_pengembalian' => $this->input->post('tgl_pengembalian'),
				'alasan' => $this->input->post('alasan_pinjam'),
				'des' => $this->input->post('deskripsi_acc'),
				'action_datetime' => $this->input->post('action_datetime'),
				'id_barang' => $this->input->post('id_barang')
		);
			$this->M_data_pinjam_barang->tolak($id_pinjamBarang,$data);
			redirect('pinjam_barang/tampil_peminjam');
			}
		elseif($status_peminjaman == 1){
			echo "Peminjaman sudah disetujui ";
		} 
		}	
    }

	function pinjam_selesaikan($id_pinjamBarang)
	{// $data['pinjam_barang'] = $this->M_data_pinjam_barang->view_by($id_barang);
		// $this->load->view('pinjam_barang/tampil_pinjaman_barang',$data);
    	$data['data'] = $this->M_data_pinjam_barang->view_idPinjam($id_pinjamBarang);
    	$this->load->view('pinjam_barang/detailSelesaikan', $data);
		
		if($this->input->post('submit'))
		{
			$data = array(
				'qty' => $this->input->post('qty'),
				'tgl' => date('Y-m-d'),
				'id_user' => $this->session->userdata('id_user'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'tgl_pengembalian' => $this->input->post('tgl_pengembalian'),
				'alasan' => $this->input->post('alasan_pinjam'),
				'des' => $this->input->post('deskripsi_acc'),
				'action_datetime' => $this->input->post('action_datetime'),
				'id_barang' => $this->input->post('id_barang')
		);
			$this->M_data_pinjam_barang->selesaikan($id_pinjamBarang,$data);
			redirect('pinjam_barang/tampil_peminjam');
		}	
    }
	
	public function pinjam_user($id_barang)
	{

		//$t = $this->input->post(); ($t['ïd_barang']);
		$data['detail'] = $this->M_data->view_by($id_barang);
		if ($this->input->post('cek_stok')) {
			$id_barang = $this->uri->segment(3);
			$tgl_pinjam = $this->input->post('tgl_pinjam');
			$tgl_kembali = $this->input->post('tgl_pengembalian');
			$qty = $this->input->post('qty');
		
			$datas = array(
				'id_barang' => $id_barang,
				'tgl_pinjam' => $tgl_pinjam,
				'tgl_kembali' => $tgl_kembali,
				'qty' => $qty
			);

			$data['status']= $this->M_data_pinjam_barang->cek_stok($datas);
			$this->load->view('pinjam_barang/pinjam_barang1',$data);
		}
		elseif($this->input->post('submit'))
		{
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'id_barang' => $this->uri->segment(3),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'tgl_pengembalian' => $this->input->post('tgl_pengembalian'),
				'qty' => $this->input->post('qty'),
				'alasan_peminjaman' => $this->input->post('alasan_peminjaman')
			);
			
			$this->M_data_pinjam_barang->pinjam($id_barang, $data);
			$this->session->set_flashdata('pinjam_sukses','pinjam_sukses');
			redirect('barang/tampil_barang_users');
		}
		else{
			$this->load->view('pinjam_barang/pinjam_barang', $data);
		}
	}
	// public function detail($id_barang)
	// {
	// 	$this->load->model('M_data');
	// 	$detail = $this->M_data_pinjam_barang->detail_barang($id_barang);
	// 	$data['detail'] = $detail;
	// 	$this->load->view('pinjam_barang/pinjam_barang', $data);
	// }

	
}
?>
