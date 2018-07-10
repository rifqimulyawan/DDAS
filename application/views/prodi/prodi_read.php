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
                <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard') ?>">Prodi</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>

            <table class="table table-striped">
                <tr><td>Nama Prodi</td><td>:&nbsp;<?php echo $nama_prodi; ?></td></tr>
                <tr><td>Id Fakultas</td><td>:&nbsp;<?php echo $id_fakultas; ?></td></tr>
                <tr><td></td><td><a href="<?php echo site_url('prodi') ?>" class="btn btn-default">Cancel</a></td></tr>
            </table>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
