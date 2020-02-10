<section class="content-header">
    <h1>Items
        <small>Data Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-users"></i></a></li>
        <li class="active">Items</li>
    </ol>
</section>
<section class="content">
	<?php $this->load->view('messages'); ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Product Items</h3>
			<div class="pull-right">
				<a href="<?=base_url('item/add')?>" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create Product Item</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<th>#</th>
					<th>Product Code</th>
					<th>QRCode</th>
					<th>Name</th>
					<th>Category</th>
					<th>Unit</th>
					<th>Buy Price</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Image</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php $no = 1; foreach($item->result() as $s ){ ?>
						<?php
							$qrCode = new Endroid\QrCode\QrCode($s->barcode.'|'.$s->name.'|'.$s->category_name);
							$qrCode->writeFile('assets/uploads/qr-code/item-'.md5($s->name).'.png');
						 ?>
					<tr>
						<td><?=$no++?></td>
						<td>
							<?=$s->barcode?>
						</td>
						<td>
							<img style="width: 70px" src="<?=base_url('assets/uploads/qr-code/item-'.md5($s->name).'.png')?>">
						</td>
						<td><?=$s->name?></td>
						<td><?=$s->category_name?></td>
						<td><?=$s->unit_name?></td>
						<td align="right">Rp <?=number_format($s->buy_price, 2, ',', '.')?></td>
						<td align="right">Rp <?=number_format($s->price, 2, ',', '.')?></td>
						<td><?=$s->stock?></td>
						<td><?php if($s->image != null){ ?><img style="width:50px;" src="<?=base_url('assets/uploads/product/').$s->image?>"><?php } ?></td>
						<td class="text-center" width="160px">
							<a href="<?=base_url('item/edit/'.$s->item_id)?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
							<a href="<?=base_url('item/del/'.$s->item_id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>