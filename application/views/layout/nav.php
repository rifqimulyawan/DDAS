<!-- Navigation-->
<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
  <h1 class="site-title"><a href="<?php echo base_url('user') ?>"><em class="fa fa-rocket"></em> DDAS.</a></h1>
                    
  <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
  <div class="nav nav-pills flex-column sidebar-nav">
    <div class="nav-item">
      <a class="nav-link" href="<?php echo base_url('user/dashboard') ?>"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a>
    </div>

    <?php if ($this->session->userdata('is_level') == 'Super_User'):?>
    <div id="accordion">
      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse">
            <em class="fa fa-wrench">&nbsp;</em> Administrative <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('prodi') ?>"><span class="fa fa-home"></span> Prodi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('fakultas') ?>"><span class="fa fa-building-o"></span> Fakultas</a>
          </li>
        </ul>
      </div>
      <?php endif ?>

    <div id="accordion">
      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse1">
            <em class="fa fa-book">&nbsp;</em> My Notebook <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse1" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('note/create') ?>">New Note <span class="fa fa-plus-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('note') ?>"><span class="fa fa-list"></span> List Note</a>
          </li>
        </ul>
      </div>

      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse2">
            <em class="fa fa-file-archive-o">&nbsp;</em> File <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse2" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('file/create') ?>">New File <span class="fa fa-plus-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('file') ?>"><span class="fa fa-list"></span> List File</a>
          </li>
        </ul>
      </div>

      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse3">
            <em class="fa fa-file-image-o">&nbsp;</em> Image <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse3" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('gambar/create') ?>">Add Image <span class="fa fa-plus-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('gambar') ?>"><span class="fa fa-list"></span> List Image</a>
          </li>
        </ul>
      </div>

      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse4">
            <em class="fa fa-file-audio-o">&nbsp;</em> Audio <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse4" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('audio/create') ?>">Add Audio <span class="fa fa-plus-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('audio') ?>"><span class="fa fa-list"></span> List Audio</a>
          </li>
        </ul>
      </div>

      <div class="parent nav-item">
        <div class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#collapse5">
            <em class="fa fa-file-video-o">&nbsp;</em> Video <span class="icon pull-right"><i class="fa fa-caret-down"></i></span>
          </a>
        </div>
        <ul class="children collapse text-center" id="collapse5" data-parent="#accordion">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('video/create') ?>">Add Video <span class="fa fa-plus-circle"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('video') ?>"><span class="fa fa-list"></span> List Video</a>
          </li>
        </ul>
      </div>

      <div class="nav-item">
      <a class="nav-link" href="<?php echo base_url('user/help') ?>"><em class="fa fa-question-circle">&nbsp;</em> Help</a>
    </div>

    </div>
  </div>
</nav>