<section class="content-header">
    <h1>Stok
        <small>Kosong</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""></a></li>
        <li class="active">Empty Stock</li>
    </ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<tr>
						<th>NO</th>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga Jual</th>
						<th>Foto</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($productEmpty as $p): ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$p->barcode?></td>
							<td><?=$p->name?></td>
							<td><?=$p->price?></td>
							<td><?php if($p->image != null){ ?><img style="width:50px;" src="<?=base_url('assets/uploads/product/').$p->image?>"><?php } ?></td>
							<td><label class="label label-danger">KOSONG</label></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</section>