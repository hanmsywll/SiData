<?php
require_once 'connection.php';

// Validasi input
$id_survei = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Persiapkan kueri SQL dengan prepared statement
$sql = "SELECT pertanyaan.id_pertanyaan, judul_survei, pertanyaan, jenis_pertanyaan, pilihan, pertanyaan.id_survei 
        FROM pertanyaan JOIN survei 
        ON pertanyaan.id_survei = survei.id_survei
        WHERE pertanyaan.id_survei = ?";

// Persiapkan statement
$stmt = mysqli_prepare($koneksi, $sql);

// Periksa apakah statement berhasil dibuat
if ($stmt) {
    // Bind parameter
    mysqli_stmt_bind_param($stmt, "i", $id_survei);

    // Eksekusi statement
    mysqli_stmt_execute($stmt);

    // Dapatkan hasil
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $judul_survei = htmlspecialchars($row['judul_survei'], ENT_QUOTES, 'UTF-8');
        ?>

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
  <link href="assets/css/style2.css" rel="stylesheet">

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
          <?php
        session_start(); // start the session
        $email = $_SESSION['email'];
        if ($email == 'admin@gmail.com'){
          ?>
          <li><a class="nav-link scrollto" href="admin.php">Dashboard</a></li>
           <li><a class="nav-link scrollto active" href="kelola_survei.php">Kelola Survei</a></li>
  <?php
        }else{
          ?>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto active" href="dashboard.php"> Buat Survei </a></li>
          <li><a class="nav-link scrollto" href="isisurvei.php">Isi Survei</a></li>
          <li><a class="nav-link scrollto" href="peringkat.php">Peringkat</a></li>
          <?php
        }
          // check if the user is logged in
          if (isset($_SESSION['nama'])) {
            // if logged in, show the username and a dropdown to logout
            echo '<div class="dropdown me-4">
                                      <a class="getstarted scrollto type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #0474BA; color: white;">
                                                ' . $_SESSION['nama'] . '
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

  <main id="main">

    <!-- ======= Values Section ======= -->
    <section id="values" class="values">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <br><br>
          <p><?php echo $judul_survei; ?></p>
          <div class="text-end">
          <?php 
          echo "
          <button class='btn btn-secondary mt-4' style='margin-right: 100px;'><a href='view_pertanyaan.php?id=$id_survei'>Lihat Pertanyaan</a></button>" ?> 
        </div>
        </header>

        <div class="row">
        <center>

        <?php
           $responden = "SELECT DISTINCT p.id_pengguna, p.nama AS nama
                          FROM pengguna p
                          JOIN detail_jawaban dj ON p.id_pengguna = dj.id_pengguna
                          JOIN jawaban j ON dj.id_jawaban = j.id_jawaban
                          JOIN pertanyaan pt ON j.id_pertanyaan = pt.id_pertanyaan
                          WHERE pt.id_survei = $id_survei;";

            $nama_responden = mysqli_query($koneksi, $responden);
            $jumlah_responden = mysqli_num_rows($nama_responden);
        ?>

        <div class="col-lg-10" data-aos="fade-up" data-aos-delay="200">
            <div class="box"  style="margin-bottom: 25px;">
            <div class="styles_tag_container"  style="float: right;  margin-right: 15px;" >
                <label class="styles_tag_container_kategori"> Jumlah Responden : <?php echo $jumlah_responden ?></label> <br>
            </div>
          <h3 class="fw-bold" align='left' style="margin-left: 15px;"> <img src="assets/img/responden5.svg" style="margin: 10px 20px 15px 15px; padding: 5px; width:55px "> Responden </h3> 
          
          <?php
            while ($row_responden = mysqli_fetch_assoc($nama_responden)) {
          ?>
                <div class='box' style="text-align: left; background-color: #ebf7ff;">
                <h3 class="fw-bold" align='left' style="float: right; margin-right: 15px;">
                <a href="#">
                <img src="assets/img/delete.svg" style="margin-right: 10px; padding: 5px; width:27px ">
                </a> </h3>
                <div class='fw-bold fs-6' style="text-align: left; margin-top: 15px; margin-bottom: 15px; margin-left: 15px; margin-right: 15px;">
                  <?php 
                          $nama_responden_terpilih = htmlspecialchars($row_responden['nama'], ENT_QUOTES, 'UTF-8');
                          $id_responden = $row_responden['id_pengguna'];
                          echo '<a style="color: black" href="jawaban_individu.php?id_survei=' . $id_survei . '&responden=' . $id_responden . '">' . $nama_responden_terpilih . '</a><br>';
                  ?>
                </div>
               </div>
          <?php } ?>
          

          </div>
          
        </div>
            <?php
            do {
            ?>
              <div class="col-lg-10" data-aos="fade-up" data-aos-delay="200">
                <div class="box">
                  <h3 class="fw-bold fs-6" align="left"><?php echo $row['pertanyaan']; ?></h3>
                  <div align="left">
                    <?php
                      $id_pertanyaan = $row['id_pertanyaan'];

                      $jawaban_query = "SELECT j.isi_jawaban
                                        FROM jawaban j
                                        JOIN pertanyaan p ON j.id_pertanyaan = p.id_pertanyaan
                                        WHERE p.id_pertanyaan = $id_pertanyaan";

                      $jawaban_pertanyaan = mysqli_query($koneksi, $jawaban_query);

                      if ($jawaban_pertanyaan && mysqli_num_rows($jawaban_pertanyaan) > 0) {
                          while ($jawaban_row = mysqli_fetch_assoc($jawaban_pertanyaan)) {
                              echo '<input type="text" class="form-control mb-1" value="' . $jawaban_row['isi_jawaban'] . '" disabled>';
                          }
                      } else {
                          echo "Tidak ada jawaban untuk pertanyaan ini.";
                      }

    
                    
                    // if ($row['jenis_pertanyaan'] == 'text') {
                    //   echo '<input type="text" class="form-control" disabled>';
                    // } elseif ($row['jenis_pertanyaan'] == 'radio') {
                    //   $options = explode(", ", $row['pilihan']);
                    //   foreach ($options as $option) :
                    // ?>

                    <!-- //     <div class="form-check">
                    //       <input class="form-check-input" type="radio" disabled />
                    //       <label class="form-check-label"><?php // echo $option; ?></label>
                    //     </div> -->
                     <?php 
                    // endforeach;
                    // } elseif ($row['jenis_pertanyaan'] == 'checkbox') {
                    //   $options = explode(", ", $row['pilihan']);
                    //   foreach ($options as $option) :
                    ?>
                        <!-- <div class="form-check">
                          <input class="form-check-input" type="checkbox" disabled />
                          <label class="form-check-label"><?php // echo $option; ?></label>
                        </div> -->
                    <?php 
                    // endforeach;
                    // }
                    ?>
                  </div>
                </div>
              </div>
              <br>
            <?php } while ($row = mysqli_fetch_assoc($result)); ?>
          </center>
          <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary"> 
        <?php if ($email == 'admin@gmail.com'){
        echo '<a href="kelola_survei.php">';
        } else {
          echo '<a href="dashboard.php">';
        }
  ?>
              Kembali ke Dashboard</a></button>
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
    } else {
        echo "Belum ada pertanyaan yang tersimpan untuk quiz ini.";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>