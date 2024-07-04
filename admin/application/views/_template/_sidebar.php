    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('./../assets/adminlte/dist/img/usera.png" class="img-circle" alt="User Image');?>">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li <?=($this->uri->segment(1)=='kandidat') ? 'class="active"' : '' ?>>
          <a href="<?=base_url('kandidat');?>"><i class="fa fa-user-secret"></i> <span>Candidates</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?=$jmlkandidat;?></span>
            </span>
          </a>
        </li>
        <li <?=($this->uri->segment(1)=='voting') ? 'class="active"' : ''?>>
          <a href="<?=base_url('voting');?>"><i class="fa fa-caret-square-o-down"></i> <span>Voting</span></a>
      </li>
        <li <?=($this->uri->segment(1)=='pemilih') ? 'class="active"' : ''?>>
          <a href="<?=base_url('pemilih');?>"><i class="fa fa-users"></i> <span>Voter</span>
            <span class="pull-right-container">
              <span class="label label-success pull-right"><?=$jmlpemilih;?></span>
            </span>
          </a>
        </li>
        <li class="header">EXTRAS</li>
        <li <?=($this->uri->segment(1)=='pengaturan') ? 'class="active"' : ''?>>
          <a href="<?=base_url('pengaturan')?>"><i class="fa fa-cogs"></i> <span>Settings</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->