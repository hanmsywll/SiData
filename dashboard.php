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
  <link href="<link rel=" preconnect href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

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

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php#value">Fitur Kami</a></li>
          <li><a href="dashboard.php" class="nav-link scrollto active"> Buat Survei </a></li>
          <li><a class="nav-link scrollto" href="isisurvei.php">Isi Survei</a></li>
          <li><a class="nav-link scrollto" href="peringkat.php">Peringkat</a></li>
          <?php
          session_start();
          $id_pengguna = $_SESSION['id_pengguna'];
          if (isset($_SESSION['nama'])) {
            echo '<div class="dropdown me-4 ">
                                      <a class=" getstarted scrollto  id="dropdownMenuButton" data-bs-toggle="dropdown"  aria-expanded="false" style="background-color: #ffffff; color: #0474BA;">
                                                <li><hr class="dropdown-divider"></li>
                                                <li><hr class="dropdown-divider"></li>
                                               <img src="assets/img/profile-fill.png" width="20"> &nbsp; ' . $_SESSION['nama'] . '
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="profile.php">Profile<img src="assets/img/profile-stroke.png" width="20"></a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="logout.php">Logout<img src="assets/img/logout.png" width="20"></a></li>
                                            </ul>
                                        </div>';
          } else {
            // if not logged in, show the login button
            header("Location: belumlogin.php");
            exit();}
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  <main id="main">
    <!-- ======= Values Section ======= -->
    <section id="values" class="values"
      style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata4.png'); background-size:cover; ">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <!-- <h2>Our Values</h2> -->
          <br><br>
          <p>Buat Survei</p>
        </header>
        <center>
          <button type='button' class='btn btn-primary'> <a href='buatsurvei_mulai.php'> Klik Disini untuk Buat Survei
              Baru </a> </button> <br><br>
        </center>

        <!-- <p class="mb-4"> Survei yang pernah kamu buat sebelumnya </p> -->

        <div class="row">

          <?php

          require_once 'connection.php';
          $sql = "SELECT survei.id_survei, survei.judul_survei, survei.deskripsi_survei, survei.header_survei, 
        DATE_FORMAT(survei.tanggal_buat, '%d %M %Y') as tgl_buat,
        pengguna.nama, survei.kategori_survei
         FROM survei JOIN pengguna ON survei.id_pengguna = pengguna.id_pengguna 
         WHERE survei.id_pengguna = $id_pengguna
         ORDER BY id_survei DESC";
          $result = mysqli_query($koneksi, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($i = mysqli_fetch_array($result)) {
              $id_survei = $i["id_survei"];
              $judul_survei = $i["judul_survei"];
              $deskripsi_survei = $i["deskripsi_survei"];
              $tgl_buat = $i["tgl_buat"];
              $nama = $i["nama"];
              $kategori_survei = $i["kategori_survei"];

              echo '
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="box" style="background-color: white;">';

        if (isset($i["header_survei"])) {
          $header_survei = $i["header_survei"];
          echo '<img src="images/'.$header_survei.'" class="img-fluid" alt="" width=280px>';
        } else {
          echo '<img src="assets/img/blog/isisurvei1.jpg" class="img-fluid" alt="">';
        }
        
        echo '
            <h3 align="left">' . $judul_survei . '</h3>
            <p align="justify">
                ' . $deskripsi_survei . '
            </p>
            <p align="left">Oleh: ' . $nama . '</p>
            <p align="left">Pada tanggal: ' . $tgl_buat . '</p>
            <div class="styles_tag_container">
                <label class="styles_tag_container_kategori">
                ' . $kategori_survei . '
                </label>
            </div>
            <div class="text-end">';
               echo " <a href='view_jawaban.php?id=$id_survei'> <img src='assets/img/eye-newfill.svg' style='padding: 5px; width:48px '></a>
               <a href='edit_survei.php?id=$id_survei'> <img src='assets/img/edit-newfill.svg' style='padding: 5px; width:40px '></a>";
               ?>
              
               <a href="#" onclick="confirmDelete(<?php echo $id_survei; ?>)">
              <img src='assets/img/delete.svg' style='padding: 5px; width:30px '>
              </a>
              <script>
function confirmDelete(id) {
    var konfirmasi = confirm("Apakah Anda yakin ingin menghapus survei?");
    if (konfirmasi) {
        window.location.href = "hapus_survei.php?id=" + id;
    }
}
</script>


            </div>
        </div>
      </div>
      <?php
            }
          }
          ?>
        </div>

      </div>
      </div>

    </section><!-- End Values Section -->

  </main>
  <!-- End #main -->>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="assets/img/LogoSiData.png" alt="">
              <!-- <span>SiData</span> -->
            </a>
            <p>SiData merupakan Aplikasi Pembuatan, Penyebaran, dan Pengisian Survei Online untuk Penelitian Mahasiswa.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#main">Fitur Kami</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="dashboard.php">Buat Survei</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="isisurvei.php">Isi Survei</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="peringkat.php">Peringkat</a></li>
            </ul>
          </div>

          <!-- <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div> -->

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Hubungi Kami</h4>
            <p>
              Jl. Telekomunikasi <br>
              Bandung, Jawa Barat<br>
              Indonesia <br><br>
              <strong>Phone:</strong> +62 8528 3492 45866<br>
              <strong>Email:</strong> sidata@gmail.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <!-- <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>FlexStart</span></strong>. All Rights Reserved
      </div>
      <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div> -->
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color: #0474BA;"><i class="bi bi-arrow-up-short"></i></a>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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