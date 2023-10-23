<?php 
$this->db->select('carts.*, p_item.barcode as barcode_item, p_item.name as item_name, p_item.price as harga_satuan');
$this->db->from('carts');
$this->db->join('p_item', 'p_item.item_id = carts.item_id');
$this->db->where('kode_unik', $invoice->kode_unik);
$query = $this->db->get();
 ?>
 <?php $info = $this->db->get('info')->row(); ?>
<section class="content">
	<div class="box">
		<div class="box-body">
			<center>
				<img src="<?=base_url('assets/uploads/info_toko/'.$info->foto)?>" style="width: 100px;">
				<h3><?=$info->nama_toko?></h3>
				<h5><?=$info->alamat?>, <?=$info->kode_pos?>, <?=$info->notelp?></h5>
			</center>
			<br><br>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped text-center table-bordered" style="width:100%">
						<thead>
							<tr>
								<th width="10">No</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total Harga</th>
								<th>Nama Kasir</th>
								<th>Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($query->result() as $query) {?>
								<tr>
									<td><?= $no++ ?></td>
									<td>
										<?php 
										$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
										echo '<img src="data:image/png;base64,'.base64_encode($generator->getBarcode($query->barcode_item, $generator::TYPE_CODE_128)).'">';
										?><br>
										<?=$query->barcode_item?>
									</td>
									<td><?=$query->item_name?></td>
									<td>Rp. <?=number_format($query->harga_satuan, 2, ',', '.')?></td>
									<td><?=$invoice->jumlah_item?></td>
									<td>Rp. <?=number_format($query->sub_total, 2, ',', '.')?></td>
									<td><?=$invoice->cashier?></td>
									<td><?=$invoice->tanggal?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<hr>
					<div class="row">
						<div class="col-md-4 text-center">
							<small style="color: grey">Total</small>
							<p style="font-weight: bold; font-size: 20px">Rp. <?=number_format($invoice->total, 2, ',', '.')?></p>
						</div>
						<div class="col-md-4 text-center">
							<small style="color: grey">Bayar</small>
							<p style="font-weight: bold; font-size: 20px">Rp. <?=number_format($invoice->bayar, 2, ',', '.')?></p>
						</div>
						<div class="col-md-4 text-center">
							<small style="color: grey">Kembalian</small>
							<p style="font-weight: bold; font-size: 20px">Rp. <?=number_format($invoice->kembalian, 2, ',', '.')?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer"><button class="btn btn-primary btn-sm" onclick="window.print()"><i class="fa fa-download"></i> Download Invoice</button></div>
	</div>
</section>