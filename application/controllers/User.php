<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('user_m');
	}
	public function index()
	{
		$data['allusers'] = $this->user_m->get();

		$this->template->load('template', 'user/user_data', $data);
	}
	public function myprofile()
	{
		$this->template->load('template','user/myprofile');
	}
	public function updateProfile()
	{
		if ($this->input->post('password') == NULL) {
			$params = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'), 
			);
			$this->db->where('user_id', $this->session->userdata('userid'));
			$this->db->update('user', $params);
			$this->session->set_userdata($params);
		}else{
			$params = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'), 
				'password' => $this->input->post('password')
			);
			$this->db->where('user_id', $this->session->userdata('userid'));
			$this->db->update('user', $params);
			$this->session->set_userdata($params);
		}
		if ($this->db->affected_rows()>0) {
			$this->session->set_flashdata('success', 'Sukses!');
		}
		redirect('user/myprofile');
	}
	public function add()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]',
			array('matches'=>'%s tidak sesuai dengan password')
		);
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_message('required','%s masih kosong, silahkan isi!');
		$this->form_validation->set_message('min_length','{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique','{field} sudah digunakan');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('template', 'user/user_form_add');	
		} else {
			$post = $this->input->post(null, TRUE);
			$this->user_m->add($post);
			if ($this->db->affected_rows() > 0) {
				echo "<script>alert('Data Berhasil Disimpan')</script>";
			}
			echo "<script>window.location='".base_url('user')."'</script>";
		}

	}
	public function edit()
	{
		$user_id = $this->input->post('user_id');
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$address = $this->input->post('address');
		$level = $this->input->post('level');

		if (!empty($this->input->post('password'))) {
			$data = array(
				'name' => $name,
				'username' => $username,
				'password' => $password,
				'address' => $address,
				'level' => $level,
			);
		}else{
			$data = array(
				'name' => $name,
				'username' => $username,
				'address' => $address,
				'level' => $level,
			);
		}
		$where = array(
			'user_id' => $user_id,
		);
		$this->user_m->edit_data($where,$data,'user');
		redirect(base_url('user'));
	}
	public function del()
	{
		$id = $this->input->post('user_id');
		$this->user_m->del($id);

		if ($this->db->affected_rows() > 0) {
			echo  "<script>alert('Data Berhasil Dihapus!')</script>";
		}
		echo "<script>window.location='".base_url('user')."'</script>";
	}
	public function informasiToko($id)
	{
		$data['info'] = $this->user_m->getInfoToko($id);
		$this->template->load('template', 'user/info_toko', $data);
	}
	public function editInfoToko($id)
	{
		$config['upload_path'] = './assets/uploads/info_toko/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 2048;
		$config['file_name'] = 'info-'.date('ymd').'-'.substr(rand(),0,10);
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('foto')) {
			$data = array(
				'nama_toko' => $this->input->post('nama_toko'),
				'notelp' => $this->input->post('notelp'),
				'kode_pos' => $this->input->post('kode_pos'),
				'deskripsi' => $this->input->post('deskripsi'),
				'alamat' => $this->input->post('alamat'),
				'foto' => $this->upload->data('file_name'), 
			);
			$where = array(
				'id' => $id,
			);
			$this->user_m->edit_data($where,$data,'info');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Berhasil mengubah data Informasi Toko');
			}
			redirect('user/informasiToko/1');
		}else if(!$this->upload->do_upload('foto')){
			$data = array(
				'nama_toko' => $this->input->post('nama_toko'),
				'notelp' => $this->input->post('notelp'),
				'kode_pos' => $this->input->post('kode_pos'),
				'deskripsi' => $this->input->post('deskripsi'),
				'alamat' => $this->input->post('alamat'),
			);
			$where = array(
				'id' => $id,
			);
			$this->user_m->edit_data($where,$data,'info');
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Berhasil mengubah data Informasi Toko');
			}
			redirect('user/informasiToko/1');
		}
	}
}
