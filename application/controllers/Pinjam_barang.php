
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
	
	public function detail($id_pinjamBarang)
	{
		$data['detail'] = $this->M_data_pinjam_barang->view_by($id_pinjamBarang);
		$this->load->view('pinjam_barang/detail_pinjaman_admin',$data);
	}
	public function detail_pinjaman($id_pinjamBarang)
	{
		$data['detail'] = $this->M_data_pinjam_barang->view_by($id_pinjamBarang);
		$this->load->view('pinjam_barang/detail_pinjaman',$data);
	}

	public function acc($id_pinjamBarang)
	{
		if($this->input->post('terima')){
			$data = [ 
				'deskripsi_acc' => $this->input->post('deskripsi_acc'),
				'status_acc' => 'Peminjaman diterima' 
			];
			$this->M_data_pinjam_barang->terima($id_pinjamBarang, $data);
		}
		elseif ($this->input->post('tolak')) {
			$data = [ 
				'deskripsi_acc' => $this->input->post('deskripsi_acc'),
				'status_acc' => 'Peminjaman ditolak' 
			];
			$this->M_data_pinjam_barang->tolak($id_pinjamBarang, $data);
		}
		$data['detail'] = $this->M_data_pinjam_barang->view_by($id_pinjamBarang);
		$this->send_email($data);

		$this->session->set_flashdata('acc_berhasil', 'acc_berhasil');
		// $this->load->view('pinjam_barang/email',$data);
		redirect('Pinjam_barang/tampil_peminjam');
	}
	public function send_email($data)
    {
      // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'tubes.pi.semangat@gmail.com',  // Email gmail
            'smtp_pass'   => 'Tubes123',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('tubes.pi.semangat@gmail.com', 'Tubes PI');

        // Email penerima
        $this->email->to($data['detail']->email); // Ganti dengan email tujuan

        // Subject email
        $this->email->subject('Status Peminjaman Anda di Aset');

        // Isi email
        $body = $this->load->view('pinjam_barang/email',$data,TRUE);
        $this->email->message($body);
        
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }

    }

	public function selesaikan($id_pinjamBarang)
	{
		$this->M_data_pinjam_barang->selesai($id_pinjamBarang);
		$this->session->set_flashdata('selesai_berhasil', 'selesai_berhasil');
		redirect('Pinjam_barang/tampil_peminjam');
	}
	
	public function pinjam_user($id_barang)
	{
		$data['detail'] = $this->M_data->view_by($id_barang);
		$id_user = $this->session->userdata('id_user'); 

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
				'id_user' => $id_user,
				'id_barang' => $this->uri->segment(3),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'tgl_pengembalian' => $this->input->post('tgl_pengembalian'),
				'qty' => $this->input->post('qty'),
				'alasan_peminjaman' => $this->input->post('alasan_peminjaman')
			);
			$this->M_data_pinjam_barang->pinjam($id_barang, $data);
			$this->session->set_flashdata('pinjam_sukses','pinjam_sukses');
			redirect($this->user($id_user));
		}
		else
			$this->load->view('pinjam_barang/pinjam_barang', $data);
		
	}

	public function user($id_user)
	{
		$data['pinjaman'] = $this->M_data_pinjam_barang->view_by_user($id_user);
		$this->load->view('pinjam_barang/pinjaman_user', $data);
	}


	
}
?>
