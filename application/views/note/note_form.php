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
                <li class="breadcrumb-item"><a href="<?php echo base_url('user/dashboard') ?>">Note Archive</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>

            <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                  <label for="note">Note : <?php echo form_error('note') ?></label>
                  <textarea class="ckeditor" rows="3" name="note" id="ckeditor" placeholder="Note"><?php echo $note; ?></textarea>
              </div>
            <div class="form-group">
                  <label for="date">Date : <?php echo form_error('date') ?></label>
                  <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?php echo $date; ?>" />
              </div>

            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
            <input type="hidden" name="id_note" value="<?php echo $id_note; ?>" /> 
            <button type="submit" class="btn btn-primary" onclick="return confirm('Anda Yakin?')"><?php echo $button ?></button>
            <a href="<?php echo site_url('note') ?>" class="btn btn-default">Cancel</a>
            </form>            

            <?php $this->load->view('layout/footer') ?>
            
          </div>
        </section>
      </main>
    </div>
  </div>

  <?php $this->load->view('layout/js') ?>

</body>
