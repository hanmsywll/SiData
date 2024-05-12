<?php
session_start();

if (isset($_SESSION['id_pengguna'])) {
  include "connection.php";
  include 'User.php';
  $user = getUserById($_SESSION['id_pengguna'], $koneksi);

  function getUserProfileImageURL($id, $koneksi)
  {
    // Query untuk mendapatkan URL gambar profil dari database
    $query = "SELECT pp FROM pengguna WHERE id_pengguna=$id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      return $row['pp'];
    } else {
      // Handle kesalahan query jika diperlukan
      return null;
    }
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
            <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
            <li><a class="nav-link scrollto" href="#main">Fitur Kami</a></li>
            <li><a href="dashboard.php"> Buat Survei </a></li>
            <li><a class="nav-link scrollto" href="isisurvei.php">Isi Survei</a></li>
            <li><a class="nav-link scrollto" href="peringkat.php">Peringkat</a></li>

            <?php
            // check if the user is logged in
            if (isset($_SESSION['nama'])) {
              // if logged in, show the username and a dropdown to logout
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
              echo '<li><a class="getstarted scrollto" href="login.php">Login</a></li>
                        </ul>';
            }
            ?>

          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div>
    </header><!-- End Header -->



  </body>


  <bodyyy>

    <?php if ($user) { ?>
      <div class="d-flex justify-content-center align-items-center vh-100 height: calc(100vh - 150px);" id="page-content">
        <div class="col-sm-4 bg-c-lite-green user-profile align-items-center">
          <div class="card-block text-center text-white">
            <div class="m-b-25 mt-5">
              <?php
              echo '<img src="images/user.png" class="img-radius" width=250px alt="User-Profile-Image">';
              ?>
            </div>
            <h6 class="f-w-600">
              <?= $user['nama'] ?>
            </h6>
            <p>Mahasiswa</p>
            <i class="mdi mdi-square-edit-outline feather icon-edit m-t-2 f-16"></i>
          </div>
        </div>
        <div class="row container d-flex justify-content-center" style="margin-top: 1px;">
          <div class="col-sm-10 col-md-12 align-items-center">
            <div class="card user-card-full ">
              <div class="row m-l-0 m-r-0">
                <div class="col-sm-8 align-items-center">
                  <div class="card-block">
                    <h3 class="m-b-20 p-b-5 b-b-default f-w-600">Informasi Pengguna</h3>
                    <div class="row">
                      <div class="col-lg-10">
                        <p class="m-b-10 f-w-600">Email</p>
                        <h6 class="text-muted f-w-400">
                          <?= $user['email'] ?>
                        </h6>
                        <p class="m-b-10 f-w-600">Poinmu Sekarang</p>
                        <h6 class="text-muted f-w-400">
                          <?= $user['poin'] ?>
                        </h6>
                        <p class="m-b-10 f-w-600">Bergabung Sejak</p>
                        <h6 class="text-muted f-w-400">
                          <?= date('d-m-Y', strtotime($user['waktu_buatakun'])) ?>
                        </h6>
                          </div>
                        </h6>
                      </div>
                    </div>
                    <div class="m-b-20 m-t-40 p-b-5 f-w-600 <br> <br>">
                      <a href="edit.php" class="btn btn-primary">
                        Edit Profile
                      </a>
                      <a href="logout.php" class="btn btn-danger">
                        Logout
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } else {
      header("Location: login.php");
      exit;
    } ?>
  </bodyyy>
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
            <p>SiData merupakan Aplikasi Pembuatan, Penyebaran, dan Pengisian Survei Online untuk Penelitian Mahasiswa.
            </p>
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

  </html>

<?php } else {
  header("Location: login.php");
  exit;
} ?>