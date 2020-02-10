<section class="content-header">
    <h1>Informasi
        <small>Toko</small>
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
			Informasi Toko
		</div>
		<form action="<?=base_url('user/editInfoToko/1')?>" method="post" enctype="multipart/form-data">
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<img style="width: 250px" id="blah1" src="<?=base_url('assets/uploads/info_toko/'.$info->foto)?>">
						<input type="file" onchange="readURL1(this)" class="form-control" name="foto">
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Nama Toko</label>
							<input type="text" class="form-control" name="nama_toko" value="<?=$info->nama_toko?>">
						</div>
						<div class="form-group">
							<label class="control-label">Nomor Telepon Toko</label>
							<input type="text" class="form-control" name="notelp" value="<?=$info->notelp?>">
						</div>
						<div class="form-group">
							<label class="control-label">Kode Pos</label>
							<input type="text" class="form-control" name="kode_pos" value="<?=$info->kode_pos?>">
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label class="control-label">Deskripsi</label>
							<textarea rows="3" id="ckeditor" class="form-control" name="deskripsi"><?=$info->deskripsi?></textarea>
						</div>
						<div class="form-group">
							<label class="control-label">Alamat</label>
							<textarea rows="3" id="ckeditor" class="form-control" name="alamat"><?=$info->alamat?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer text-right">
				<button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
			</div>
		</form>
	</div>
</section>