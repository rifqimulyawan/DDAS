<header class="page-header row justify-center border-bottom">
  <div class="col-md-6 col-lg-8" >
    <h3 class="float-left text-center text-md-left"><b class="display-5 text-muted">Digital Documents Archive System</b></h3>
  </div>
  <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

    <img src="

    <?php if (empty($this->session->userdata('is_foto'))): ?>
    <?php echo base_url('assets');?>/dashboard/images/default.png ?>
    <?php else : ?>
    <?php echo base_url() . 'uploads/'.$foto_profil  ?>
    <?php endif ?>

    " alt="foto_profil" class="circle float-left profile-photo" width="50" height="50">

    <div class="username mt-1">
      <h4 class="mb-1"><?php echo $this->session->userdata('is_nama'); ?></h4>
      <h6 class="text-muted"><?php echo $this->session->userdata('is_level'); ?></h6>
    </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" href="<?php echo base_url('user/profile') ?>"><em class="fa fa-user-circle mr-1"></em> View Profile</a>
         <a class="dropdown-item" href="<?php echo base_url('user/edit_password') ?>"><em class="fa fa-sliders mr-1"></em> Change Password</a>
         <a class="dropdown-item" href="<?php echo base_url('logout') ?>"><em class="fa fa-power-off mr-1"></em> Logout</a></div>
  </div>
  <div class="clear"></div>
</header>