<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['item_m','unit_m','supplier_m','stock_m']);
	}
	public function stock_in_data()
	{
		$data['stock'] = $this->stock_m->get_in();
		$this->template->load('template','transaction/stock_in/stock_in_data', $data);
	}
	public function stock_in_add()
	{
		$itemAll = $this->item_m->get();
		$supplier = $this->supplier_m->get();
		$query_item = $this->item_m->get($this->input->post('item_id'))->row();
		$data = array(
			'item' => $itemAll,
			'row' => $query_item,
			'supplier' => $supplier,
		);
		$this->template->load('template','transaction/stock_in/stock_in_form', $data);
	}
	public function stock_out_data()
	{
		$data['stock'] = $this->stock_m->get_out();
		$this->template->load('template', 'transaction/stock_out/stock_out_data', $data);
	}
	public function empty()
	{
		$data['productEmpty'] = $this->stock_m->getEmptyStock();
		$this->template->load('template','transaction/emptystock',$data);
	}
	public function stock_out_add()
	{
		$itemAll = $this->item_m->get();
		$supplier = $this->supplier_m->get();
		$query_item = $this->item_m->get($this->input->post('item_id'))->row();
		$data = array(
			'item' => $itemAll,
			'row' => $query_item,
			'supplier' => $supplier,
		);
		$this->template->load('template','transaction/stock_out/stock_out_form', $data);	
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['in_add'])) {
			$this->stock_m->in_add($post);
			$this->stock_m->tambah_stock();
		}//else if (isset($_POST['edit'])) {
		// 	$this->category_m->edit($post);
		// }
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('stock/in');
	}
	public function process_out()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['out_add'])) {
			$this->stock_m->out_add($post);
			$this->stock_m->kurang_stock();
		}//else if (isset($_POST['edit'])) {
		// 	$this->category_m->edit($post);
		// }
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
		redirect('stock/out');
	}
	public function getdataitem($id)
	{
		$query_item = $this->item_m->get($id)->row();
		echo json_encode($query_item);
	}

}

/* End of file Stock.php */
/* Location: ./application/controllers/Stock.php */