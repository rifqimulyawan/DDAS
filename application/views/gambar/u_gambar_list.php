<?php $this->load->view('layout/head') ?>

<body>

  <div class="container-fluid" id="wrapper">
    <div class="row">
      
      <?php $this->load->view('layout/nav') ?>

      <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

        <?php $this->load->view('layout/header') ?>

        <section class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('gambar') ?>">Image Archive</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            <!-- paste what you wanted to display here -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 mb-2">
                <?php echo anchor(site_url('gambar/create'),'Add <span class="fa fa-plus-circle"></span>', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <?php if ($this->session->userdata('is_level') == 'Super_User' || 'User'):?>
                <form action="<?php echo site_url('gambar/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Search ...">&nbsp;
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('gambar'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search <span class="fa fa-search"></span></button>
                        </span>
                    </div>
                </form>
                <?php endif ?>
            </div>
        </div>
        <div style="margin-top: 8px" id="message" class="alert-success">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
        <table class="table table-bordered table-striped" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
    <th>Nama Gambar</th>
    <th>Gambar</th>
    <th>Added</th>
    <th>Updated</th>
        <th>Uploaded By</th>
    <th>Action</th>
            </tr></thead><?php
            foreach ($gambar_data as $gambar)
            {
                ?>
                <tr>
      <td><?php echo ++$start ?></td>
      <td><?php echo $gambar->nama_gambar ?></td>
      <td><img src="<?php echo base_url() . 'uploads/'.$gambar->gambar  ?>" class="img-thumbnail" width="100" height="100"></td>
      <td><?php echo $gambar->added ?></td>
      <td><?php echo $gambar->updated ?></td>
            <td><?php echo $gambar->nama ?></td>
      <td style="text-align:center" width="200px">
        <?php 
        echo anchor(site_url('gambar/read/'.$gambar->id_gambar),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-eye"></span></button>'); 
        echo '  '; 
        echo anchor(site_url('gambar/update/'.$gambar->id_gambar),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-pencil-square-o"></span></button>'); 
        echo '  '; 
        echo anchor(site_url('gambar/delete/'.$gambar->id_gambar),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-trash"></span></button></span>','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
        ?>
      </td>
    </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Image Archive Total : <?php echo $total_rows ?></a>
                <?php if ($this->session->userdata('is_level') == 'Super_User'):?>
                <?php echo anchor(site_url('gambar/excel'), '<span class="fa fa-file-excel-o"></span>', 'class="btn btn-primary"'); ?>
                <?php endif ?>
      </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
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
