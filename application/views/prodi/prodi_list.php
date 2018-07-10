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
                <li class="breadcrumb-item active">List</li>
            </ol>

            <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 mb-1">
                <?php echo anchor(site_url('prodi/create'),'Add <span class="fa fa-plus-circle"></span>', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('prodi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Search ...">&nbsp;
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('prodi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search <span class="fa fa-search"></span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-striped" style="margin-bottom: 10px">
            <thead>
            <tr>
                <th>No</th>
    <th>Nama Prodi</th>
    <th>Fakultas</th>
    <th>Action</th>
            </tr></thead><?php
            foreach ($prodi_data as $prodi)
            {
                ?>
                <tr>
      <td><?php echo ++$start ?></td>
      <td><?php echo $prodi->nama_prodi ?></td>
      <td><?php echo $prodi->nama_fakultas ?></td>
      <td style="text-align:center" width="200px">
        <?php 
        echo anchor(site_url('prodi/read/'.$prodi->id_prodi),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-eye"></span></button>'); 
        echo '  '; 
        echo anchor(site_url('prodi/update/'.$prodi->id_prodi),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-pencil-square-o"></span></button>'); 
        echo '  '; 
        echo anchor(site_url('prodi/delete/'.$prodi->id_prodi),'<button class="btn btn-secondary btn-circle margin" type="button"><span class="fa fa-trash"></span></button>','onclick="javasciprt: return confirm(\'Anda Yakin ?\')"'); 
        ?>
      </td>
    </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    <?php echo anchor(site_url('prodi/excel'), '<span class="fa fa-file-excel-o"></span>', 'class="btn btn-primary"'); ?>
    <?php echo anchor(site_url('prodi/word'), '<span class="fa fa-file-word-o"></span>', 'class="btn btn-primary"'); ?>
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
