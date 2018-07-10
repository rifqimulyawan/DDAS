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
                <li class="breadcrumb-item active">Form</li>
            </ol>

            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>

            <?php echo form_open($action, array('enctype'=>'multipart/form-data')); ?>
                <div class="form-group">
                    <label for="varchar">Nama Gambar : <?php echo form_error('nama_gambar') ?></label>
                    <input type="text" class="form-control" name="nama_gambar" id="nama_gambar" placeholder="Nama Gambar" value="<?php echo $nama_gambar; ?>" required />
                </div>
                <div class="form-group">
                    <label for="varchar">Gambar <span style="color: red">(.jpg, .jpeg, .png)</span> : <?php echo form_error('gambar') ?></label>
                    <input type="file" class="form-control" name="gambar" id="gambar" placeholder="Gambar" value="<?php echo $gambar; ?>" />
                </div>
                <input type="hidden" name="id_gambar" value="<?php echo $id_gambar; ?>" />
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                <button type="submit" class="btn btn-primary" onclick="return confirm('Anda Yakin?')"><?php echo $button ?></button>
                <a href="<?php echo site_url('gambar') ?>" class="btn btn-default">Cancel</a>
            <?php echo form_close(); ?>
            
            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
