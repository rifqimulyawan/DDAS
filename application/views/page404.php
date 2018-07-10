<?php $this->load->view('layout/head') ?>

<body>
	<div class="error-template col-sm-12 mt-3">
	  <h1 class="card-title">Secure mode !</h1>
	  <div class="error-details">
	      <p> Maaf, sepertinya terjadi kesalahan. Halaman tidak ditemukan !</p>
	      <a href="<?php echo base_url();?>" class="btn btn-lg btn-warning">Reload</a>
	  </div>
	</div>
</body>

<?php $this->load->view('layout/js') ?>