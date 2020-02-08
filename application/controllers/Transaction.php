<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['transaction_m','item_m','stock_m']);
		$this->load->library('pdf');
	}

	public function index()
	{
		$data['product'] = $this->item_m->get();
		$data['carts'] = $this->transaction_m->getCarts();
		$data['totalCarts'] = $this->transaction_m->jumlahCarts();
		$this->template->load('template', 'transaction/transaction/transaction_data', $data);
	}
	public function invoice($kode_unik)
	{
		$data['invoice'] = $this->transaction_m->getInvoice($kode_unik);
		$this->template->load('template','transaction/history/invoice',$data);
		// json_encode($data);
		// $this->pdf->loadHtml($html);
		// $this->pdf->setPaper('A4','landscape');
		// $this->pdf->render();
		// $this->pdf->stream('invoice_'.$kode_unik.'.pdf', array("Attachment"=>0));
	}
	public function history()
	{
		$data['history'] = $this->transaction_m->getHistory();
		$this->template->load('template', 'transaction/history/history_data', $data);
	}
	public function pembayaran()
	{
		$total = $this->input->post('total');
		$user_id = $this->session->userdata('userid');
		$bayar = $this->input->post('bayar');

		if ($bayar < $total) {
			echo "<script>
				alert('Uang yang dibayarkan tidak cukup');
				window.location='".site_url('transaction/checkout')."';
				</script>";
		}
		else
		{
			$kembalian = $bayar - $total;
			$metode_pembayaran = 'CASH';

			$kode_unik = rand(111111, 999999);
			$kode_unik2 = rand(111111,999999);
			$finalkodeunik = $kode_unik.$kode_unik2;

			$params = array(
				'total' => $total, 
				'user_id' => $user_id,
				'bayar' => $bayar,
				'kembalian' => $kembalian,
				'metode_pembayaran' => $metode_pembayaran,
				'kode_unik' => $finalkodeunik,
			);
			$this->transaction_m->inputTransaction($params, 'checkout');
			$this->transaction_m->updateCarts($finalkodeunik);
			$this->transaction_m->updateStatus();

			redirect('transaction/invoice/'.$finalkodeunik);
		}

	}
	public function checkout()
	{
		$data['product'] = $this->item_m->get();
		$data['carts'] = $this->transaction_m->getCarts();
		$data['totalCarts'] = $this->transaction_m->jumlahCarts();
		$this->template->load('template', 'transaction/checkout/checkout', $data);
	}
	public function cartStore()
	{
		$stok = $this->item_m->get()->row()->stock;
		$harga = $this->input->post('harga');
		$item_id = $this->input->post('item_id');
		$jumlah = $this->input->post('qty');
		$status = 1;
		$kode_unik = rand(111111, 999999);
		$kode_unik2 = rand(111111, 999999);
		$user_id = $this->input->post('user_id');

		if ($jumlah > $stok) {
			echo "<script>
				alert('Stok barang yang anda inginkan tidak cukup');
				window.location='".site_url('transaction')."';
				</script>";
		}
		else
		{
			$params = array(
				'item_id' => $item_id,
				'jumlah' => $jumlah,
				'sub_total' => $harga * $jumlah,
				'status' => $status,
				'kode_unik' => $kode_unik.$kode_unik2,
				'user_id' => $user_id
			);
		$this->transaction_m->inputTransaction($params, 'carts');
		$this->stock_m->kurang_stock();
		redirect('transaction');
		}
	}

}

/* End of file Transaction.php */
/* Location: ./application/controllers/Transaction.php */