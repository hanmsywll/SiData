<?php
require_once 'connection.php';

// $id_survei = $_GET['id'];
// $sql = "SELECT judul_survei, pertanyaan, jenis_pertanyaan, pilihan, pertanyaan.id_survei 
//         FROM pertanyaan JOIN survei 
//         ON pertanyaan.id_survei = survei.id_survei
//         WHERE pertanyaan.id_survei = $id_survei";

// $result = mysqli_query($koneksi, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $judul_survei = $row['judul_survei'];
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SiData - <?php echo $judul_survei; ?></title>
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
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/LogoSiData.png" alt="">
      </a>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <br><br>
          <p> Judul <?php // echo $judul_survei; ?></p>
        </header>

        <div class="row">
          <center>
            <?php
            // do {
            ?>
              <div class="col-lg-10" data-aos="fade-up" data-aos-delay="200">
                <div class="box">
                  <h3 class="fw-bold" align="left">123 <?php // echo $row['pertanyaan']; ?></h3>
                  <div align="left">
                    <?php
                    // if ($row['jenis_pertanyaan'] == 'text') {
                    //   echo '<input type="text" class="form-control" disabled>';
                    // } elseif ($row['jenis_pertanyaan'] == 'radio') {
                    //   $options = explode(", ", $row['pilihan']);
                    //   foreach ($options as $option) :
                    ?>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" disabled />
                          <label class="form-check-label"> p <?php // echo $option; ?></label>
                        </div>
                    <?php 
                    // endforeach;
                    // } elseif ($row['jenis_pertanyaan'] == 'checkbox') {
                    //   $options = explode(", ", $row['pilihan']);
                    //   foreach ($options as $option) :
                    // ?>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" disabled />
                          <label class="form-check-label"> p <?php // echo $option; ?></label>
                        </div>
                    <?php 
                    // endforeach;
                    // }
                    ?>
                  </div>
                </div>
              </div>
              <br>
            <?php 
        // } while ($row = mysqli_fetch_assoc($result)); ?>
          </center>
          <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary"> <a href="dashboard.php">Kembali ke Dashboard</a></button>
    </div>
        </div>
      </div>

    </section>
    
    <!-- End Values Section -->

    <!-- ... (lanjutan kode HTML) ... -->

  </main>

  <!-- ... (lanjutan kode HTML) ... -->

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

<?php
// } else {
//    echo "Belum ada pertanyaan yang tersimpan untuk quiz ini.";
// }

// mysqli_close($koneksi);
?>