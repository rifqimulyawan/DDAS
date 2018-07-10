<?php $this->load->view('layout/head') ?>

<body onload="welcome()">

  <div class="container-fluid" id="wrapper">
    <div class="row">
      
      <?php $this->load->view('layout/nav') ?>

      <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

        <?php $this->load->view('layout/header') ?>

        <section class="row">
          <div class="col-sm-12">
            <section class="row">
              <div class="col-md-12 col-lg-12">

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard') ?>"> Dashboard</a></li>
                    <li class="breadcrumb-item active"><?php echo $this->session->userdata('is_id') ?></li>
                </ol>
              </div>

              <div class="col-sm-12 col-lg-8">
                <div class="jumbotron">
                  <h1 class="mb-1">Hai, <?php echo $this->session->userdata('is_nama') ?></h1>
                  <p align="justify">Digital Document Archive System (DDAS) merupakan aplikasi yang dibuat untuk memudahkan kegiatan pengarsipan dokumen akademik mahasiswa. Silahkan pilih menu yang ada disebelah kiri untuk memulai mengarsipkan.</p>
                  <p align="justify">Khusus bagi anda yang baru mendaftar, silahkan lengkapi profil anda dengan mengklik tombol dibawah ini</p>
                  <p class="lead"><a class="btn btn-primary btn-lg mt-2" href="<?php echo base_url('user/profile') ?>" role="button">Perbarui Profile !</a></p>
                </div>
              </div>
                
              <div class="col-md-12 col-lg-4">
                <div class="card">
                  <div class="card-block">
                    <div id="calendar"></div>
                    <div class="divider"></div>
                    <center><h5 class="card-title"><span class="fa fa-calendar-o"></span> Calendar</h5></center>
                  </div>
                </div>
              </div>
            </section>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
