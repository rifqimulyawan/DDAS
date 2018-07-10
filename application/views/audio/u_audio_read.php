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
                <li class="breadcrumb-item"><a href="<?php echo base_url('audio') ?>">Audio Archive</a></li>
                <li class="breadcrumb-item active">View</li>
            </ol>

            <table class="table table-striped">
            <tr><td>Nama Audio</td><td>:&nbsp;<?php echo $nama_audio; ?></td></tr>
            <tr><td>Audio</td>
              <td>:&nbsp; 

              <audio controls>
                <source src="<?php echo base_url() . 'uploads/'.$audio  ?>" type="audio/ogg">
                <source src="<?php echo base_url() . 'uploads/'.$audio  ?>" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>
                
              </td>
            </tr>

            <tr><td>Added</td><td>:&nbsp;<?php echo $added; ?></td></tr>
            <tr><td>Updated</td><td>:&nbsp;<?php echo $updated; ?></td></tr>
            <tr><td>Id User</td><td>:&nbsp;<?php echo $id_user; ?></td></tr>
            <tr><td></td><td><a href="<?php echo site_url('audio') ?>" class="btn btn-default">Cancel</a></td></tr>
            </table>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
