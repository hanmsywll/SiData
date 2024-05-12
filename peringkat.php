<?php
session_start(); 
// Koneksi ke database
require_once 'connection.php';

// Query untuk mendapatkan peringkat, nama, dan total poin dari tabel pengguna
$sql = "SELECT id_pengguna, nama, poin FROM pengguna ORDER BY poin DESC limit 5";
$result = $koneksi->query($sql);

if (isset ($_SESSION["id_pengguna"])) {
$id_pengguna = $_SESSION['id_pengguna'];
$sqll = "SELECT poin FROM pengguna where id_pengguna = $id_pengguna";
$resultt = $koneksi->query($sqll);
if ($resultt->num_rows > 0) {
  $row = mysqli_fetch_assoc($resultt);
  $poin = $row["poin"];}
} else {header("Location: belumlogin.php");
exit();}
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
  <link rel="preconnect" href="https://fonts.googleapis.com">
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
  <!-- Your Custom CSS -->
  <link href="assets/css/custom copy.css" rel="stylesheet">
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
          <li><a href="dashboard.php" class="nav-link scrollto"> Buat Survei </a></li>
          <li><a class="nav-link scrollto" href="isisurvei.php">Isi Survei</a></li>
          <li><a class="nav-link scrollto active" href="peringkat.php">Peringkat</a></li>
          <?php
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
    <bodyy       style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata4.png'); background-size:cover; ">
      <!-- Bagian Informasi Poin Pertama -->
      <div class="user-info" data-aos="fade-up">
        <?php
        if (isset($_SESSION['nama'])) {
          echo '<h2>Halo, ' . $_SESSION['nama'] . '!</h2>';

          // Tambahkan informasi poin atau konten lainnya sesuai kebutuhan
          echo '<p>Total Poin Anda: '.$poin.'</p>';

          // Tambahkan gambar peringkat
          echo '<img src="assets/img/peringkattt.jpg" alt="Peringkat" width="300">';
          echo '<br>';
        }
        ?>
      </div>

      <mainn data-aos="fade-up">
        <div id="headerr">
          <h1><strong>Ranking</strong></h1>
          <button class="btn btn-outline-primary" onclick="shareOnWhatsApp()">
            <img src="assets/img/share-blue.png" width="25" alt="Share">
          </button>
        </div>

        <script>
          function shareOnWhatsApp() {
            var pesanShare = "Sedang mengerjakan skripsi, ikut lomba, atau penelitian? Cari respondenmu di SiData secara mudah!";

            // Gantilah 'SiData' dengan teks yang Anda inginkan untuk muncul pada pesan
            var teksButton = "Cari Responden di SiData";

            // Buat URL untuk diarahkan ke WhatsApp
            var urlWhatsApp = "https://wa.me/?text=" + encodeURIComponent(pesanShare + "\n\n" + teksButton);

            // Buka link WhatsApp
            window.location.href = urlWhatsApp;
          }
        </script>



        <div id="leaderboard">
          <table>
            <tr>
              <th class="number">No</th>
              <th class="name">Nama</th>
              <th class="points">Poin</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
              $rank = 1;
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='number'>";
                if ($rank == 1) {
                  echo $rank;
                } else {
                  echo $rank;
                }
                echo '</td>';
                echo "<td class='name'>" . $row["nama"] . "</td>";
                echo "<td class='points'>" . $row["poin"] . "</td>";
                echo "</tr>";
                $rank++;
              }
            } else {
              echo "<tr><td colspan='3'>No data available</td></tr>";
            }
            ?>

          </table>
        </div>
      </mainn>
    </bodyy>
  </main>

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
</body>

</html>