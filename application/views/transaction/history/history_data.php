<section class="content-header">
	<h1>History Transaction
		<small>Riwayat Transaksi</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""></a></li>
		<li>Transaction</li>
		<li class="active">History Transaction</li>
	</ol>
</section>
<section class="content">
	<?php $this->load->view('messages'); ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Riwayat Transaksi</h3>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<tr>
						<th>NO</th>
						<th>Barcode Transaksi</th>
						<th width="120">Total Harga</th>
						<th width="150">Metode Pembayaran</th>
						<th>Nama Kasir</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($history->result() as $h) {?>
					<tr>
						<td><?=$no++?></td>
						<td>
							<?php 
							$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
							echo '<img src="data:image/png;base64,'.base64_encode($generator->getBarcode($h->kode_unik, $generator::TYPE_CODE_128)).'">';
							?>
						</td>	
						<td align="right">Rp. <?=number_format($h->total, 2, ',', '.')?></td>
						<td><center><span class="label label-success"><?=$h->metode_pembayaran?></span></center></td>
						<td><?=$h->name?></td>
						<td><a href="<?=base_url('transaction/invoice/'.$h->kode_unik)?>" class="btn btn-success"><i class="fa fa-eye"></i> Detail Transaksi</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>