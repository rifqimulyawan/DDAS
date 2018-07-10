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
                    <li class="breadcrumb-item active">Profile</li>
                  </ol>

                  <?php if($this->session->flashdata('pesan') == TRUE): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('pesan'); ?>
                    </div>
                  <?php endif; ?>
                  
                  <div class="container">

                    <div class="table-responsive mb-3">
                      <center>
                        <h3 class="mb-3">My Profile</h3>
                      </center>
                      <table class="table text-center" height="50%">
                        <tr>
                          <td>NIM</td><td align="left">:</td><td><?php echo $nim; ?></td>
                        </tr>
                        <tr>
                          <td>Nama Lengkap</td><td align="left">:</td><td><?php echo $nama; ?></td>
                        </tr>
                        <tr>
                          <td>Email</td><td align="left">:</td><td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                          <td>Profiles Photo</td><td align="left">:</td><td><a data-toggle="modal" data-target="#img-display"><img class="img-thumbnail" width="100" height="100" src="<?php echo base_url() . 'uploads/'.$foto_profil  ?>"/></a></td>
                        </tr>
                        <tr>
                          <td>Program Studi</td><td align="left">:</td><td><?php echo $nama_prodi; ?></td>
                        </tr>
                        <tr>
                          <td>Level?</td><td align="left">:</td><td><code><?php echo $level; ?></code></td>
                        </tr>
                      </table>
                    </div>

                      <div class="modal fade" id="img-display" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Profile's Photo</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <img class="img-thumbnail" src="<?php echo base_url() . 'uploads/'.$foto_profil  ?>"/>
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-sm-12">
                        <center>
                          <a class=" btn btn-secondary col-md-2" href="<?php echo base_url('user') ?>">Kembali</a>&nbsp;
                          <a class=" btn btn-primary col-md-2" href="<?php echo base_url('user/edit_profile') ?>">Perbarui ?</a>
                        </center>
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
