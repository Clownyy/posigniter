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
	<?php $this->view('messages') ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title"><?=ucfirst($page)?> items</h3>
			<div class="pull-right">
				<a href="<?=base_url('item')?>" class="btn btn-warning"><i class="fa fa-undo"></i> Back</a>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form action="<?=base_url('item/process')?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Barcode *</label>
							<input type="hidden" name="item_id" value="<?=$row->item_id?>">
							<input type="text" class="form-control" value="<?=$row->barcode?>" name="barcode" required>
						</div>
						<div class="form-group">
							<label for="product_name">Product Name *</label>
							<input type="text" id="product_name" class="form-control" value="<?=$row->name?>" name="product_name" required>
						</div>
						<div class="form-group">
							<label>Category *</label>
							<select name="category" class="form-control" required>
								<option value="">- Pilih -</option>
								<?php foreach($category->result() as $key => $data){ ?>
									<option value="<?=$data->category_id?>"<?=$data->category_id == $row->category_id ? "selected" : null?>><?=$data->name?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Unit *</label>
							<?php echo form_dropdown('unit', $unit, $selectedunit,
							['class' => 'form-control', 'required' => 'required']) ?>
							</select>
						</div>
						<div class="form-group">
							<label>Price *</label>
							<input type="number" class="form-control" value="<?=$row->buy_price?>" name="buy_price" required>
						</div>
						<div class="form-group">
							<label>Image</label>
							<?php if ($page == 'edit') {
								if ($row->image != null) {?>
									<div style="margin-bottom: 5px">
										<img src="<?=base_url('assets/uploads/product/'.$row->image)?>" style="width: 80%;">
									</div>
								<?php
								}
							} ?>
							<input type="file" class="form-control" name="image">
							<small>(Biarkan kosong jika tidak <?=$page == 'edit' ? 'diganti' : 'ada'?>)</small>
						</div>
						<div class="form-group">
							<button type="submit" name="<?=$page?>" class="btn btn-success">
								<i class="fa fa-paper-plane"></i> Save
							</button>
							<button type="Reset" class="btn">Reset</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>