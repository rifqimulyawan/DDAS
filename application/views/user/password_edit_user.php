<?php $this->load->view('layout/head') ?>

<body>

  <div class="container-fluid" id="wrapper">
    <div class="row">
      
      <?php $this->load->view('layout/nav') ?>

      <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

        <?php $this->load->view('layout/header') ?>

        <section class="row">
          <div class="col-sm-12">
            <!-- paste what you wanted to display here -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Change_Password</li>
            </ol>

            <div class="row">
              <div class="col-md-12 container mb-5">
                <center>
                  <h3 class="mb-3 mt-3">Ubah Password</h3>
                </center>

                <?php if($this->session->flashdata('pesan') == TRUE): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('pesan'); ?>
                    </div>
                  <?php endif; ?>

                <?php echo form_open("user/edit_password_proses", array('enctype'=>'multipart/form-data')); ?>

                  <div class="form-group">
                    <label for="password">Password Lama :</label>
                    <input class="form-control" id="password" type="password" name="password" aria-describedby="emailHelp" placeholder="Masukkan Password Lama">
                    <?php echo form_error('password', '<div class="text-danger"><small>', '</small></div>');?>
                  </div>
                  
                  <div class="form-group">
                    <label for="password">Password Baru :</label>
                    <input class="form-control" id="password" type="password" name="password_baru" aria-describedby="emailHelp" placeholder="Masukkan Password Baru Anda">
                    <?php echo form_error('password', '<div class="text-danger"><small>', '</small></div>');?>
                  </div>
                  <input type="checkbox" onclick="myFunction()">&nbsp; Lihat Password ?

                  <div class="form-group ">
                    <span>&nbsp;</span>
                  </div>

                  <div class="form-group col-sm-12">
                    <center>
                      <a class=" btn btn-secondary col-md-2" href="<?php echo base_url('user/profile') ?>">Kembali</a>&nbsp;
                      <button type="submit" name="submit" value="Simpan" class="btn btn-primary col-md-2">Perbarui</button>
                    </center>
                  </div>

                <?php echo form_close(); ?>

              </div>              
            </div>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
