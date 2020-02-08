<section class="content-header">
    <h1>Supplier
        <small>Pemasok</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-users"></i></a></li>
        <li class="active">Supplier</li>
    </ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Supplier</h3>
			<div class="pull-right">
				<a href="<?=base_url('supplier/add')?>" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Description</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php $no = 1; foreach($supplier->result() as $s ){ ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$s->name?></td>
						<td><?=$s->phone?></td>
						<td><?=$s->address?></td>
						<td><?=$s->description?></td>
						<td class="text-center" width="160px">
							<a href="<?=base_url('supplier/edit/'.$s->supplier_id)?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
							<a href="<?=base_url('supplier/del/'.$s->supplier_id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
