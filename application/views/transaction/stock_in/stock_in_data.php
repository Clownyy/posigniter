<section class="content-header">
    <h1>Stock In
        <small>Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-users"></i></a></li>
        <li>Transaction</li>
        <li class="active">Stock In</li>
    </ol>
</section>
<section class="content">
	<?php $this->load->view('messages'); ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Product Items</h3>
			<div class="pull-right">
				<a href="<?=base_url('stock/in/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Barang Masuk</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<th>#</th>
					<th>Date</th>
					<th>Kode Produk</th>
					<th>Name</th>
					<th>Supplier</th>
					<th>Quantity</th>
					<th>Detail</th>
					<th>User</th>
				</thead>
				<tbody>
					<?php $no = 1; foreach($stock->result() as $s ){ ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$s->date?></td>
						<td>
							<?=$s->barcode_item?>
						</td>
						<td><?=$s->item_name?></td>
						<td><?=$s->supplier_name?></td>
						<td align="right"><?=$s->qty?></td>
						<td><?=$s->detail?></td>
						<td><?=$s->user_name?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>