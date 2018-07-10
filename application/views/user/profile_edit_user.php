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
                      <li class="breadcrumb-item active">Perbarui</li>
                    </ol>

                    <div class="row">

                      <div class="col-md-12 container">
                        <center>
                          <h3 class="mb-3 mt-3">Perbarui Profil</h3>
                        </center>
                        <?php echo form_open("user/edit_proses", array('enctype'=>'multipart/form-data')); ?>

                        <div class="form-group">
                          <label for="nim">Nim :</label>
                          <input class="form-control" type="text" name="nim" required placeholder="Masukkan NIM" value="<?php echo $nim ?>">
                          <?php echo form_error('nim', '<div class="text-danger"><small>', '</small></div>');?>
                        </div>

                        <div class="form-group">
                          <label for="nama">Nama Lengkap :</label>
                          <input class="form-control" id="exampleInputEmail1" type="text" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap" value="<?php echo $nama ?>">
                          <?php echo form_error('nama', '<div class="text-danger"><small>', '</small></div>');?>
                        </div>

                        <div class="form-group">
                          <label for="email">Email :</label>
                          <input class="form-control" id="exampleInputEmail1" type="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan Email" value="<?php echo $email ?>">
                          <?php echo form_error('email', '<div class="text-danger"><small>', '</small></div>');?>
                        </div>

                        <div class="form-group">
                          <label for="text">Program Studi :</label>
                          <?php echo cmb_dinamis('id_prodi', 'prodi', 'nama_prodi', 'id_prodi', $id_prodi); ?>
                          <?php echo form_error('Password', '<div class="text-danger"><small>', '</small></div>');?>
                        </div>

                        <div class="form-group ">
                          <label for="input_gambar">Foto Profil : <?php echo $foto_profil ?></label>
                          <input class="form-control" type="file" name="input_gambar" value="<?php echo $foto_profil ?>">

                          <?php echo form_error('input_gambar', '<div class="text-danger"><small>', '</small></div>');?>
                        </div>

                        <div class="form-group ">
                          <span>&nbsp;</span>
                        </div>

                        <div class="form-group col-sm-12 mt-3">
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
