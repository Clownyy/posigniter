<section class="content-header">
    <h1>Users
        <small>Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-users"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Users</h3>
			<div class="pull-right">
				<a href="<?=base_url('user/add')?>" class="btn btn-primary"><i class="fa fa-user-plus"></i> Create</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="tableAll">
				<thead>
					<th>#</th>
					<th>Username</th>
					<th>Name</th>
					<th>Addres</th>
					<th>Level</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php $no = 1; foreach($allusers->result() as $u ){ ?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$u->username?></td>
						<td><?=$u->name?></td>
						<td><?=$u->address?></td>
						<?php if($u->level == 1){ ?>
						<td><label class="label label-success">Admin</label></td>
						<?php }else{ ?>
						<td><label class="label label-warning">Kasir</label></td>
						<?php } ?>
						<td class="text-center" width="160px">
							<form action="<?=base_url('user/del')?>" method="post">
								<button type="button" data-toggle="modal" data-target="#editUser<?=$u->user_id?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Update</button>
								<input type="hidden" value="<?=$u->user_id?>" name="user_id">
								<button onclick="return confirm('Apakah Anda Yakin menghapus data ini?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</button>
							</form>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?php foreach($allusers->result() as $u) { ?>
<div class="modal fade" id="editUser<?=$u->user_id?>" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit User</h4>
			</div>
			<form action="<?=base_url('user/edit')?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label class="control-label">Nama</label>
							</div>
							<div class="col-md-9">
								<input type="hidden" value="<?=$u->user_id?>" name="user_id">
								<input type="text" class="form-control" value="<?=$u->name?>" name="name">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label class="control-label">Username</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" readonly value="<?=$u->username?>" name="username">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label class="control-label">Password</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="password">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label class="control-label">Address</label>
							</div>
							<div class="col-md-9">
								<textarea class="form-control" name="address"><?=$u->address?></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label class="control-label">Level</label>
							</div>
							<div class="col-md-9">
								<select class="form-control" name="level">
									<?php if ($u->level == 1): ?>
										<option value="1" selected>Admin</option>
										<option value="2">Kasir</option>
									<?php endif ?>
									<?php if ($u->level == 2): ?>
										<option value="1">Admin</option>
										<option value="2" selected>Kasir</option>
									<?php endif ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
		            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<?php } ?>