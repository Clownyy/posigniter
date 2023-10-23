<section class="content-header">
	<h1>Transaksi
		<small>Transaction</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""></a></li>
		<li>Transaction</li>
		<li class="active">Sales</li>
	</ol>
</section>
<section class="content">
	<?php $this->load->view('messages') ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-5 text-left">
							<h5><b>Kasir :</b> <?=$this->session->userdata('name')?></h5>
						</div>
						<div class="col-md-5 text-right">
							<h5><b>Tanggal :</b> <?=date('d M Y')?></h5>
						</div>
						<div class="col-md-1"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-striped" id="tableAll">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Total Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; foreach($carts->result() as $c){ ?>
									<tr>
										<td><?=$no++?></td>
										<td>
											<?php 
											$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
											echo '<img src="data:image/png;base64,'.base64_encode($generator->getBarcode($c->barcode, $generator::TYPE_CODE_128)).'">';
											?><br>
											<?=$c->barcode?>
										</td>
										<td><?=$c->item_name?></td>
										<td>Rp. <?=number_format($c->price, 2, ',', '.')?></td>
										<td><?=$c->jumlah?></td>
										<td>Rp. <?=number_format($c->sub_total, 2, ',', '.')?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr>
							<div class="text-right">
								<small>Total</small>
								<p style="font-size: 40pt">Rp. <?=number_format($totalCarts, 2, ',', '.')?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="text-left">
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCheckout"><i class="fa fa-credit-card"> </i> Pembayaran</button>
						<a href="<?=base_url('transaction')?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog" arial-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog confirm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
			</div>
			<form method="post" action="<?=base_url('transaction/pembayaran')?>">
				<input type="hidden" name="total" value="<?=$totalCarts?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Bayar</label>
						<input type="text" class="form-control" name="bayar" placeholder="Jumlah Uang Tunai">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>