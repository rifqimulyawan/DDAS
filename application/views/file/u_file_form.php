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
                <li class="breadcrumb-item"><a href="<?php echo base_url('file') ?>">File Archive</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>

            <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>

            <?php echo form_open($action, array('enctype'=>'multipart/form-data')); ?>
            <div class="form-group">
                  <label for="varchar">Nama File : <?php echo form_error('nama_file') ?></label>
                  <input type="text" class="form-control" name="nama_file" id="nama_file" placeholder="Nama File" value="<?php echo $nama_file; ?>" />
              </div>
            <div class="form-group">
                  <label for="varchar">File <span style="color: red">(.pdf, docx, xlsx)</span> : <?php echo form_error('file') ?></label>
                  <input type="file" class="form-control" name="file" id="file" placeholder="File" value="<?php echo $file; ?>" />
              </div>
            <input type="hidden" name="id_file" value="<?php echo $id_file; ?>" /> 
              <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
            <button type="submit" class="btn btn-primary" onclick="return confirm('Anda Yakin?')"><?php echo $button ?></button>
            <a href="<?php echo site_url('file') ?>" class="btn btn-default">Cancel</a>
            <?php echo form_close(); ?>

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
