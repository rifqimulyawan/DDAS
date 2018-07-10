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
                <li class="breadcrumb-item active">Form</li>
            </ol>

            <form action="<?php echo $action; ?>" method="post">
      <div class="form-group">
            <label for="varchar">Nama Prodi <?php echo form_error('nama_prodi') ?></label>
            <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" placeholder="Nama Prodi" value="<?php echo $nama_prodi; ?>" />
        </div>
      <div class="form-group">
            <label for="int">Pilih Fakultas <?php echo form_error('id_fakultas') ?></label>
            <?php echo cmb_dinamis('id_fakultas', 'fakultas', 'nama_fakultas', 'id_fakultas', $id_fakultas); ?>
        </div>
      <input type="hidden" name="id_prodi" value="<?php echo $id_prodi; ?>" /> 
      <button type="submit" class="btn btn-primary" onclick="return confirm('Anda Yakin?')"><?php echo $button ?></button>
      <a href="<?php echo site_url('prodi') ?>" class="btn btn-default">Cancel</a>
  </form>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
