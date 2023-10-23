<section class="content-header"></section>
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?=$jumlahitem?></h3>
          <p>Items</p>
        </div>
        <div class="icon">
          <i class="fa fa-th"></i>
        </div>
        <a href="<?=base_url('item')?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?=$jumlahsupplier?></h3>
          <p>Suppliers</p>
        </div>
        <div class="icon">
          <i class="fa fa-truck"></i>
        </div>
        <a href="<?=base_url('supplier')?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>Rp. <?=number_format($profit, 2, ',', '.')?></h3>
          <p>Total Sales</p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="<?=base_url('transaction/history')?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?=$jumlahuser?></h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-plus"></i>
        </div>
        <a href="<?=base_url('user')?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</section>