<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('customer_m');
	}
	public function index()
	{
		$data['customer'] = $this->customer_m->get();
		$this->template->load('template','customer/customer_data', $data);
	}
	public function add()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
		$customer->name = null;
		$customer->gender = null;
		$customer->phone = null;
		$customer->address = null;
		$data = array(
			'page' => 'add',
			'row' => $customer,
		);
		$this->template->load('template','customer/customer_form', $data);
	}
    public function edit($id)
    {
    	$query = $this->customer_m->get($id);
    	if ($query->num_rows() > 0) {
    		$customer = $query->row();
    		$data = array(
    			'page' => 'edit',
    			'row' => $customer,
    		);
    		$this->template->load('template','customer/customer_form', $data);
    	}else{
    		echo "<script>alert('Data tidak ditemukan')</script>";
    		echo "<scripr>window.location='".base_url('customer')."'</script>";
    	}
    }
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$this->customer_m->add($post);
		}else if (isset($_POST['edit'])) {
			$this->customer_m->edit($post);
		}
		if ($this->db->affected_rows() > 0) {
			echo "<script>alert('Data berhasil disimpan')</script>";
		}
		echo "<script>window.location='".base_url('customer')."'</script>";
	}
	public function del($id)
	{
		$this->customer_m->del($id);
		if ($this->db->affected_rows() > 0) {
			echo "<script>alert('Data Berhasil Dihapus!')</script>";
		}
		echo "<script>window.location='".base_url('customer')."'</script>";
	}

}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */