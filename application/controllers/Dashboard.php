<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('supplier_m');
		$this->load->model('user_m');
		// $this->load->model('customer_m');
		$this->load->model('transaction_m');
		$this->load->model('item_m');
	}
	public function index()
	{
		$data['jumlahsupplier'] = $this->supplier_m->jumlahsupplier();
		$data['jumlahuser'] = $this->user_m->jumlahuser();
		// $data['jumlahcustomer'] = $this->customer_m->jumlahcustomer();
		$data['profit'] = $this->transaction_m->profit();
		$data['jumlahitem'] = $this->item_m->jumlahitem();
		$this->template->load('template', 'dashboard', $data);
	}
}
