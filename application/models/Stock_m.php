<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {

	public function get_in($id = null)
    {
    	$this->db->select('t_stock.*,p_item.name as item_name, supplier.name as supplier_name, user.name as user_name, p_item.barcode as barcode_item');
    	$this->db->from('t_stock');
        $this->db->join('p_item','p_item.item_id = t_stock.item_id');
        $this->db->join('supplier','supplier.supplier_id = t_stock.supplier_id');
        $this->db->join('user','user.user_id = t_stock.user_id');
        $this->db->where('type','in');
    	if ($id != null) {
    		$this->db->where('stock_id', $id);
    	}
        $this->db->order_by('date', 'asc');
    	$query = $this->db->get();
    	return $query;
    }
    public function getEmptyStock()
    {
        $this->db->select('*');
        $this->db->where('stock', 0);
        return $this->db->get('p_item')->result();
    }
    public function get_out($id = null)
    {
        $this->db->select('t_stock.*,p_item.name as item_name, user.name as user_name, p_item.barcode as barcode_item');
        $this->db->from('t_stock');
        $this->db->join('p_item','p_item.item_id = t_stock.item_id');
        $this->db->join('user','user.user_id = t_stock.user_id');
        $this->db->where('type','out');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $this->db->order_by('date', 'asc');
        $query = $this->db->get();
        return $query;
    }
    public function in_add($post)
    {
    	$params = [
    		'item_id' => $this->input->post('item_id'),
    		'type' => 'in',
    		'detail' => $post['detail'],
    		'supplier_id' => $this->input->post('supplier_id'),
    		'qty' => $post['qty'],
    		'date' => $post['date'],
    		'user_id' => $this->input->post('user_id'),
    	];
    	$this->db->insert('t_stock', $params);
    }
    public function out_add($post)
    {
        $params = [
            'item_id' => $this->input->post('item_id'),
            'type' => 'out',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->input->post('user_id'),
        ];
        $this->db->insert('t_stock', $params);
    }
	function tambah_stock()
	{
		$item_id = $this->input->post('item_id');
		$stock = $this->db->select('stock')->from('p_item')->where('item_id', $item_id);
		$stockNow = $this->db->get()->row()->stock;
		$stockIn = $this->input->post('qty');
		$countStock = $stockNow + $stockIn;
      	$this->db->set('stock',$countStock);
      	$this->db->where('item_id',$this->input->post('item_id'));
      	return $this->db->update('p_item');
    }
    function kurang_stock()
    {
        $item_id = $this->input->post('item_id');
        $stock = $this->db->select('stock')->from('p_item')->where('item_id', $item_id);
        $stockNow = $this->db->get()->row()->stock;
        $stockIn = $this->input->post('qty');
        $countStock = $stockNow - $stockIn;
        $this->db->set('stock',$countStock);
        $this->db->where('item_id',$this->input->post('item_id'));
        return $this->db->update('p_item');
    }
}

/* End of file Stock_m.php */
/* Location: ./application/models/Stock_m.php */