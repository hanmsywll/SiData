<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiData</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/LogoSiDataTitle.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/LogoSiData.png" alt="">
      </a>

        <i class="bi bi-list mobile-nav-toggle"></i>

    </div>
  </header><!-- End Header -->

    <main id="main">
    <section id="blog" class="blog" style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata4.png'); background-size:cover; ">
    
      <div class="containers" data-aos="fade-up" >

        <div class="row">

          <center>

            <article class="entry">

              <!-- <div class="entry-img">
                <img src="assets/img/blog/isisurvei1.jpg" alt="" class="img-fluid">
              </div> -->

              <h2 class="fw-bold text-center mt-3">Buat Survei</h2>

              <div class="row col-lg-8">
                <h3 class="fw-bold text-center mt-3"></h3>
                <form class=" bg-white px-10" action="insert_survei.php" method="POST" enctype="multipart/form-data">
                      <!-- Text input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <p class="fw-bold" align="left">Judul Survei</p>
                      <input type="text" id="judul_survei" name="judul_survei" class="form-control" required>
                    </div>
                    <br>
                    <p class="fw-bold" align="left">Kategori</p>
                    <input class="form-check-input" type="checkbox" name="kategori_survei[]" value="Pendidikan"> Pendidikan &nbsp;
                    <input class="form-check-input" type="checkbox" name="kategori_survei[]" value="Kesehatan"> Kesehatan
                    <input class="form-check-input" type="checkbox" name="kategori_survei[]" value="Teknologi"> Teknologi <br>
                      <br>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <p class="fw-bold" align="left">Deskripsi Survei</p>
                      <textarea class="form-control" id="deskripsi_survei" name="deskripsi_survei" rows="4" required> </textarea>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <p class="fw-bold" align="left">Kriteria Responden</p>
                      <textarea class="form-control" id="kriteria_responden" name="kriteria_responden" rows="4" required> </textarea>
                    </div>

                    <br>

                    <div data-mdb-input-init class="form-outline mb-4">
                      <p class="fw-bold" align="left">Gambar Header</p>
                      <!-- <button type="button" class="btn btn-primary">Upload Gambar</button> -->
                      <label for="file"></label>
                      <input type="file" name="file" id="file" class="form-control"><br>
                      <p style="font-size: small;">Format .jpg atau .png, resolusi 3x2 & maksimal berukuran 2 MB</p>
                    </div>

                    <div class="text-end">
                    <button type="submit" class="btn btn-primary">Buat Survei</button>
                </div>

                </form>

              </div>
              </div>
            </center>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>