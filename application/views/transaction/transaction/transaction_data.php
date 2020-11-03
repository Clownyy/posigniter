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
	<?php $this->load->view('messages'); ?>
	<div class="row">
		<div class="col-md-4">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Pilih Produk</h3>
				</div>
				<div class="box-body">
					<form action="<?=base_url('transaction/cartStore')?>" method="post">
						<div class="form-group">
							<label>Nama Produk</label>
							<input type="hidden" name="user_id" value="<?=$this->session->userdata('userid')?>">
							<select class="form-control" id="product" name="item_id">
								<option value="">--</option>
								<?php foreach($product->result() as $p){?>
								<option value="<?=$p->item_id?>"><?=$p->name?></option>
								<?php }?>
							</select>
						</div>
						<div class="panel panel-default">
							<div class="panel-body">
								<table>
									<tr>
										<td width="100">Stok tersisa</td>
										<td><b>: </b></td>
										<td><b id="stok"></b></td>
									</tr>
									<tr>
										<td width="100">Harga</td>
										<td>:</td>
										<td>
											<input type="hidden" class="form-control" id="price" name="harga">
											<b id="prices"></b>
										</td>
									</tr>
									<tr>
										<td colspan="3"><i>Sudah termasuk PPN</i></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<input type="number" name="qty" class="form-control">
							</div>
							<div class="col-md-4">
								<button class="btn btn-primary">Tambah</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Keranjang</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NO.</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th colspan="2">Total Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($carts->result() as $c){ ?>
							<tr>
								<input type="hidden" name="qty" value="<?=$c->jumlah?>">
								<input type="hidden" name="item_id" value="<?=$c->item_id?>">
								<td><?=$no++?></td>
								<td>
									<?php 
									$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
									echo '<img src="data:image/png;base64,'.base64_encode($generator->getBarcode($c->barcode, $generator::TYPE_CODE_128)).'">';
									?><br>
									<?=$c->barcode?>
								</td>
								<td><?=$c->item_name?></td>
								<td><?=$c->jumlah?></td>
								<td>Rp. <?=number_format($c->sub_total, 2, ',', '.')?></td>
								<td><center><a href="<?=base_url('transaction/deleteCarts/'.$c->id)?>" data-toggle="tooltip" data-placement="bottom" title="On Development" class="btn btn-danger" disabled><i class="fa fa-trash"></i></a></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<hr>
					<div class="text-right">
						<p class="h5">Total Harga : <b>Rp. <?=number_format($totalCarts, 2, ',', '.')?></b></p>
					</div>
				</div>
				<div class="box-footer text-right">
					<?php if ($totalCarts != 0) { ?>
						<a href="<?= base_url('transaction/checkout') ?>" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
	$('#product').change(function(){
		var selected =  $(this).val()
		$.ajax({
			url : "<?=base_url('stock/getdataitem/"+selected+"')?>",
			type: "GET",
			success: function(data){
				var dataProduct = JSON.parse(data)
				$('#stok').html(dataProduct.stock)
				$('#prices').html(dataProduct.price)
				$('#price').val(dataProduct.price)
			}
		})
	})
</script>