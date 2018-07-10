<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>DDAS. App - Landing Page</title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('assets');?>/landing/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="<?php echo base_url('assets');?>/landing/style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="<?php echo base_url('assets');?>/landing/css/responsive.css" rel="stylesheet">

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="colorlib-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area animated">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Menu Area Start -->
                <div class="col-12 col-lg-10">
                    <div class="menu_area">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!-- Logo -->
                            <a class="navbar-brand" href="#">DDAS.</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <!-- Menu Area -->
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <ul class="navbar-nav ml-auto" id="nav">
                                    <li class="nav-item active"><a class="nav-link" href="#home">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                                </ul>
                                <div class="sing-up-button d-lg-none">
                                    <a href="<?php echo base_url('user/register') ?>">Daftar Sekarang !</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Signup btn -->
                <div class="col-12 col-lg-2">
                    <div class="sing-up-button d-none d-lg-block">
                        <a href="<?php echo base_url('user/register') ?>">Daftar Sekarang !</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Wellcome Area Start ***** -->
    <section class="wellcome_area clearfix" id="home">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md">
                    <div class="wellcome-heading">
                        <h2>Digital Documents Archive System</h2>
                        <h3>D</h3>
                        <p>Semua file yang anda perlukan, Upload, Simpan, Selesai, Gunakan, Kapanpun dan Dimanapun</p>
                        <div class="get-start-area">
                            <?php if($this->session->flashdata('pesan') == TRUE): ?>
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('pesan'); ?>
                              </div>
                            <?php endif; ?>
                            <?php if($this->session->flashdata('sukses') == TRUE): ?>
                              <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('sukses'); ?>
                              </div>
                            <?php endif; ?>
                            <!-- Form Start -->
                            <form action="<?php echo base_url('user/proses_login') ?>" method="post" class="form-inline">
                                <input type="email" name="email" class="form-control mb-2 mr-1 ml-1" placeholder="Alamat Email Anda">
                                <input type="password" name="password" class="form-control mb-2 mr-1 ml-1" placeholder="Password anda">
                                <input type="submit" class="submit" value="Login">
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- ***** Wellcome Area End ***** -->

    <!-- ***** Special Area Start ***** -->
    <section class="special-area bg-white section_padding_100" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading Area -->
                    <div class="section-heading text-center">
                        <h2>Tentang Aplikasi</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.2s">
                        <div class="single-icon">
                            <i class="ti-mobile" aria-hidden="true"></i>
                        </div>
                        <h4>User Friendly</h4>
                        <p>Sistem dibangun menggunakan template bootstrap V.4 yang responsive sehingga memudahkan akses pada berbagai perangkat.</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="single-icon">
                            <i class="ti-ruler-pencil" aria-hidden="true"></i>
                        </div>
                        <h4>Arsitektur Sistem</h4>
                        <p>Sistem dibuat menggunakan Framework Codeigniter yang membuat fungsi menjadi lebih cepat dan mudah digunakan.</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.6s">
                        <div class="single-icon">
                            <i class="ti-settings" aria-hidden="true"></i>
                        </div>
                        <h4>User Preference</h4>
                        <p>Sistem dibuat dengan menyesuaikan kebutuhan pengguna, yaitu <b>Mahasiswa</b> maupun <b>Dosen</b>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Special Area End ***** -->

    <!-- ***** App Screenshots Area Start ***** -->
    <section class="app-screenshots-area bg-white section_padding_0_100 clearfix" id="screenshot">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2>Screenshot Aplikasi</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- App Screenshots Slides  -->
                    <div class="app_screenshots_slides owl-carousel">
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (1).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (2).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (3).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (4).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (5).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (6).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (7).png" alt="">
                        </div>
                        <div class="single-shot">
                            <img src="<?php echo base_url('assets');?>/landing/img/scr-img/app (1).png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** App Screenshots Area End *****====== -->

    <!-- ***** CTA Area Start ***** -->
    <section class="our-monthly-membership section_padding_50 clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="membership-description">
                        <h2>Daftarkan Akun Sebagai Dosen?</h2>
                        <p><strong>Note :</strong> Bagi Dosen yang ingin mendaftarkan akun harap hubungi Administrator terlebih dahulu untuk membuat akun dengan fitur dosen.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="get-started-button wow bounceInDown" data-wow-delay="0.5s">
                        <a href="#">Daftar?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** CTA Area End ***** -->

    <!-- ***** Contact Us Area Start ***** -->
    <section class="footer-contact-area section_padding_100 clearfix" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2>Kontak Kami Segera!</h2>
                        <div class="line-shape"></div>
                    </div>
                    <div class="footer-text">
                        <p>Silahkan hubungi Administrator untuk dengan mengisi form disamping ini.</p>
                    </div>
                    <div class="address-text">
                        <p><span>Alamat :</span> Jl. HKSN Komplek. AMD Kayutangi Banjarmasin</p>
                    </div>
                    <div class="phone-text">
                        <p><span>Telepon :</span> +62-853-4788-9990</p>
                    </div>
                    <div class="email-text">
                        <p><span>Email:</span> rifqi.mulyawan@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Form Start-->
                    <div class="contact_from">
                        <form action="mailto:rifqi.mulyawan@gmail.com" method="post" enctype="text/plain">
                            <!-- Message Input Area Start -->
                            <div class="contact_input_area">
                                <div class="row">
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Anda" required>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Alamat Email Anda" required>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Pesan Anda *" required></textarea>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <button type="submit" class="btn submit-btn">Kirim Sekarang !</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Message Input Area End -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area End ***** -->

    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-social-icon text-center section_padding_70 clearfix">
        <!-- footer logo -->
        <div class="footer-text">
            <h2>DADS.</h2>
            <p>Digital Archive Documents System | DADS</p>
        </div>
        <!-- social icon-->
        <div class="footer-social-icon">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="active fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        </div>
        <div class="footer-menu">
            <nav>
                <ul>
                    <li><a href="#">Tentang</a></li>
                    <li><a href="#">Syarat &amp; Kondisi</a></li>
                    <li><a href="#">Kebijakan Pribadi</a></li>
                </ul>
            </nav>
        </div>
        <!-- Foooter Text-->
        <div class="copyright-text">
            <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
            <p>Copyright ©2017 Ca. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a> | for DADS. Customized by NJ©</p>
        </div>
    </footer>
    <!-- ***** Footer Area Start ***** -->

    <!-- Jquery-2.2.4 JS -->
    <script src="<?php echo base_url('assets');?>/landing/js/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url('assets');?>/landing/js/popper.min.js"></script>
    <!-- Bootstrap-4 Beta JS -->
    <script src="<?php echo base_url('assets');?>/landing/js/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="<?php echo base_url('assets');?>/landing/js/plugins.js"></script>
    <!-- Slick Slider Js-->
    <script src="<?php echo base_url('assets');?>/landing/js/slick.min.js"></script>
    <!-- Footer Reveal JS -->
    <script src="<?php echo base_url('assets');?>/landing/js/footer-reveal.min.js"></script>
    <!-- Active JS -->
    <script src="<?php echo base_url('assets');?>/landing/js/active.js"></script>
</body>

</html>
