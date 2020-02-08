<section class="content-header">
    <h1>Units
        <small>Satuan barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-users"></i></a></li>
        <li class="active">units</li>
    </ol>
</section>
<section class="content">
	<?php $this->load->view('messages'); ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data unit</h3>
			<div class="pull-right">
				<a href="<?=base_url('unit/add')?>" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php $no = 1; foreach($unit->result() as $s ){ ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$s->name?></td>
						<td class="text-center" width="160px">
							<a href="<?=base_url('unit/edit/'.$s->unit_id)?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
							<a href="<?=base_url('unit/del/'.$s->unit_id)?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>