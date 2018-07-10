<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>DADS</title>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets');?>/dashboard/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Icons -->
  <link href="<?php echo base_url('assets');?>/dashboard/css/font-awesome.css" rel="stylesheet">
  
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('assets');?>/dashboard/css/style.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5 mb-5">
      <div class="card-header"><center>Daftar Akun</center></div>
      <div class="card-body">
          <?php echo form_open('user/proses_daftar', ''); ?>

          <?php if($this->session->flashdata('pesan') == TRUE): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('pesan'); ?>
          </div>
          <?php endif; ?>

          <div class="form-group">
            <label for="nim">Nim :</label>
            <input class="form-control" id="exampleInputEmail1" type="number" name="nim" aria-describedby="emailHelp" placeholder="Masukkan NIM" required oninvalid="setCustomValidity('Isi NIM anda.')"  oninput="setCustomValidity('')" >
            <?php echo form_error('Nim', '<div class="text-danger"><small>', '</small></div>');?>
          </div>

          <div class="form-group">
            <label for="nama">Nama :</label>
            <input class="form-control" id="exampleInputEmail1" type="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Username" required oninvalid="setCustomValidity('Isi NAMA anda.')"  oninput="setCustomValidity('')">
            <?php echo form_error('Nama', '<div class="text-danger"><small>', '</small></div>');?>
          </div>

          <div class="form-group">
            <label for="email">Email address :</label>
            <input class="form-control" id="exampleInputEmail1" type="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan Email" required oninvalid="setCustomValidity('Isi EMAIL anda.')"  oninput="setCustomValidity('')">
            <?php echo form_error('Email', '<div class="text-danger"><small>', '</small></div>');?>
          </div>
          <div class="form-group">
            <label for="password">Password :</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="password" placeholder="Password Anda" required oninvalid="setCustomValidity('Isi PASSWORD anda.')"  oninput="setCustomValidity('')">
            <?php echo form_error('Password', '<div class="text-danger"><small>', '</small></div>');?>
          </div>
          <div class="form-group">
            <label for="text">Program Studi :</label>
            <?php echo cmb_dinamis('id_prodi', 'prodi', 'nama_prodi', 'id_prodi', '$id_prodi'); ?>
            <?php echo form_error('Password', '<div class="text-danger"><small>', '</small></div>');?>
          </div>
          <a href="<?php echo base_url('');?>"><button type="button" class="btn btn-dark">Back</button></a> &nbsp;
          <button type="submit" class="btn btn-primary">Register</button>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="dist/js/bootstrap.min.js"></script>
  
  <script src="<?php echo base_url('assets');?>/dashboard/js/chart.min.js"></script>
  <script src="<?php echo base_url('assets');?>/dashboard/js/chart-data.js"></script>
  <script src="<?php echo base_url('assets');?>/dashboard/js/easypiechart.js"></script>
  <script src="<?php echo base_url('assets');?>/dashboard/js/easypiechart-data.js"></script>
  <script src="<?php echo base_url('assets');?>/dashboard/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url('assets');?>/dashboard/js/custom.js"></script>
  <script>
    var startCharts = function () {
                var chart1 = document.getElementById("line-chart").getContext("2d");
                window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true,
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc "
                });
            }; 
        window.setTimeout(startCharts(), 1000);
  </script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

</body>
</html>
