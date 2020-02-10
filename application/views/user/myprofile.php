<section class="content-header">
    <h1>Profile
        <small><?=$this->session->userdata('name');?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-home"></i></a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
	<?php $this->load->view('messages'); ?>
	<div class="box">
		<div class="box-header text-center" style="font-size: 18pt">
			Profile <?=$this->session->userdata('name');?>
		</div>
		<form action="<?=base_url('user/updateProfile')?>" method="post">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Username</label>
							<input type="text" class="form-control" name="username" value="<?=$this->session->userdata('username');?>">
						</div>
						<div class="form-group">
							<label class="control-label">Nama</label>
							<input type="text" class="form-control" name="name" value="<?=$this->session->userdata('name');?>">
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="text" class="form-control" name="password" value="">
						</div>
						<div class="form-group">
							<label class="control-label">Level</label>
							<?php if($this->session->userdata('level') == 1){ ?>
								<input type="text" class="form-control" name="level" value="Admin" readonly>
							<?php }else{ ?>
								<input type="text" class="form-control" name="level" value="Kasir" readonly>
							<?php } ?>
						</div>
						<div class="form-group">
							<label class="control-label">Deskripsi</label>
							<textarea rows="3" id="ckeditor" class="form-control" name="address"><?=$this->session->userdata('address');?></textarea>
						</div>
				</div>
			</div>
			<div class="box-footer text-right">
				<button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
			</div>
		</form>
	</div>
</section>