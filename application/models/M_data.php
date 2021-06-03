
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


	public function validation($mode)
	{
		$this->load->library('form_validation');
		if($mode == "save")
		{
			$this->form_validation->set_rules('input_namaBrg','nama_barang','required');

			$this->form_validation->set_rules('input_deskripsiBrg','deskripsi','required');

			$this->form_validation->set_rules('qty','qty','required|numeric|max_length[11]');

			$this->form_validation->set_rules('id_satuan','id_satuan','required');


			if($this->form_validation->run())
				return TRUE;
			else
				return FALSE;
		}
	}

	public function validationEdit($mode)
	{
		$this->load->library('form_validation');
		if($mode == "edit")
			$this->form_validation->set_rules('input_namaBrg','nama_barang','required');

			$this->form_validation->set_rules('input_deskripsiBrg','deskripsi','required');

			$this->form_validation->set_rules('id_satuan','id_satuan','required|numeric|max_length[11]');


			if($this->form_validation->run() != FALSE)
				return TRUE;
			else
				return FALSE;

	}


public function cek_file($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['foto']['name']);
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('cek_file', 'Silahkan pilih hanya file pdf/gif/jpg/png.');
                return false;
            }
        }else{
            $this->form_validation->set_message('cek_file', 'Silakan pilih file untuk diupload.');
            return false;
        }
    }

	public function show_satuan()
	{
		$query=$this->db->get('satuan')->result();
		return $query;
	}

	public function show_action()
	{
		$query=$this->db->get('action')->result();
		return $query;
	}

private function _uploadImage()
{
    $config['upload_path']          = '..assets/images/barang/';
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
		// $action = $this->input->post('id_action');

		
		$this->db->query("BEGIN;");
			$this->db->insert('barang',$data);
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', LAST_INSERT_ID(),'$id_user','1', '$tgl'); ");
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
		// $action = $this->input->post('id_action');

		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','4', '$tgl');");
			$this->db->query("INSERT INTO barangrusak(id_transaksi,deskripsi) VALUES(LAST_INSERT_ID(), '$deskripsi');");
		$this->db->query("COMMIT;");
		
	}


	public function hapusStok($id_barang)
	{
		$this->session->set_userdata(['id_user' => 1]);
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		$id_transaksi = $this->input->post('id_transaksi');
		// $action = $this->input->post('id_action');

		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','5', '$tgl');");
		$this->db->query("COMMIT;");
		
	}

	public function tambahStok($id_barang)
	{
		$this->session->set_userdata(['id_user' => 1]);
		$qty = $this->input->post('qty');
		$tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id_user');
		$id_transaksi = $this->input->post('id_transaksi');
		// $action = $this->input->post('id_action');

		$this->db->query("BEGIN;");
			$this->db->query("INSERT INTO log_transaksi(qty, id_barang, id_user, action, action_datetime) VALUES('$qty', '$id_barang','$id_user','1', '$tgl');");
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

