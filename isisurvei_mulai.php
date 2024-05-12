<?php

require_once 'connection.php';
$id_survei = $_GET['id'];

$sql = "SELECT judul_survei, deskripsi_survei, header_survei
        FROM survei 
        WHERE id_survei = $id_survei";

$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $judul_survei = $row['judul_survei'];
  $deskripsi_survei = $row['deskripsi_survei'];

}
?>

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
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog"
      style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata4.png'); background-size:cover; ">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <center>
            <div class="col-lg-8 entries">
              <article class="entry" style="background-color: white;">
                <div class="entry-img">
                  <?php if (isset($row["header_survei"])) {
                    $header_survei = $row["header_survei"]; 
                    echo '<img src="images/' . $header_survei . '" class="img-fluid" alt="">';
                  } else {
                    echo '<img src="assets/img/blog/isisurvei1.jpg" class="img-fluid" alt="">';
                  } ?>
                </div>

                <h2 class="entry-title">
                  <?php echo $judul_survei ?>
                </h2>

                <div class="entry-content">
                  <p>
                    <?php echo $deskripsi_survei ?>
                  </p>

                  <div class="text-end">
                    <button type="button" class="btn btn-primary"> <a href=<?php echo "isisurvei_pertanyaan.php?id=$id_survei" ?>>Isi Survei</a></button>
                  </div>
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