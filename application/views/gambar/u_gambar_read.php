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
                <li class="breadcrumb-item"><a href="<?php echo base_url('gambar') ?>">Image Archive</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>

            <table class="table table-striped">
                <tr><td>Nama Gambar</td><td>:&nbsp;<?php echo $nama_gambar; ?></td></tr>
                <tr><td>Gambar</td><td>:&nbsp;<a data-toggle="modal" data-target="#img-display"><img src="<?php echo base_url() . 'uploads/'.$gambar  ?>" class="img-thumbnail" width="100" height="100"></a></td></tr>
                <tr><td>Added</td><td>:&nbsp;<?php echo $added; ?></td></tr>
                <tr><td>Updated</td><td>:&nbsp;<?php echo $updated; ?></td></tr>
                <tr><td>Uploaded By</td><td>:&nbsp;<?php echo $nama ?></td></tr>
                <tr><td></td><td><a href="<?php echo site_url('gambar') ?>" class="btn btn-default">Back</a></td></tr>
            </table>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <div class="modal fade" id="img-display" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <img class="img-thumbnail" src="<?php echo base_url() . 'uploads/'.$gambar  ?>"/>
      </div>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
