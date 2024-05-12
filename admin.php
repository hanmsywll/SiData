<?php

session_start();
$id_pengguna = $_SESSION['id_pengguna'];
$email = $_SESSION['email'];

if ($email == 'admin@gmail.com') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>SiData</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->


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
        <link href="assets/css/admin.css" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

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
                        <li><a class="nav-link scrollto active" href="admin.php">Dashboard</a></li>
                        <li><a class="nav-link scrollto" href="kelola_survei.php">Kelola Survei</a></li>
                        <?php
                        if (!isset($_SESSION['nama'])) {
                            // Jika tidak ada sesi login, arahkan ke halaman "Anda belum login"
                            header("Location: belumlogin.php");
                            exit();
                        }
                        // check if the user is logged in
                        if (isset($_SESSION['nama'])) {
                            // if logged in, show the username and a dropdown to logout
                            echo '<div class="dropdown me-4">
                                      <a class="getstarted scrollto type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #5c5be5; color: white;">
                                                ' . $_SESSION['nama'] . '
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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

                        <!-- <h2>Our Values</h2> -->
                        <br><br>
                        <p>Dashboard</p>
                    </header>
                    <div class="row">

                        <!-- <div class="box"  style="margin-bottom: 25px;"> -->
                        <!-- <div class="styles_tag_container"  style="float: right;  margin-right: 15px;" >
                <label class="styles_tag_container_kategori"> Jumlah Permintaan Survei </label> <br>
            </div>
          <h3 class="fw-bold" align='left' style="margin-left: 15px;"> <img src="assets/img/acc.svg" style="margin: 10px 20px 15px 15px; padding: 5px; width:55px "> Permintaan Survei </h3> 
          
            
          <div class='box' style="text-align: left; background-color: #ebf7ff;" >
          <h3 class="fw-bold" align='left' style="float: right; margin-right: 15px;"> 
          <a href="#"> <img src="assets/img/centang.svg" style="margin-right: 10px; padding: 5px; width:27px "> </a>
          <a href="#"> <img src="assets/img/x.svg" style="padding: 5px; width:27px "> </h3> </a>
          <div class='fw-bold fs-6' style="text-align: left; margin-top: 15px; margin-bottom: 15px; margin-left: 15px; margin-right: 15px;" >
          Salma Nida Ul Jannah </div>
        </div> -->


                        <!-- </div> -->


                        <?php
                        require_once 'connection.php';

                        $jumlah_pengguna_query = "SELECT COUNT(*) AS total_akun_pengguna FROM pengguna";
                        $result = mysqli_query($koneksi, $jumlah_pengguna_query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $jumlah_pengguna = $row['total_akun_pengguna'];
                        } else {
                            $jumlah_pengguna = 0; // Atur ke 0 jika terjadi kesalahan dalam query
                        }
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" style="height: 60px;  margin-bottom: 15px;">
                                    <p style="font-size: 16px; ">
                                        <img src="assets/img/profile-fill.png" width="17px"
                                            style="margin-left: 10px; margin-right: 10px;"> Pengguna
                                    </p>
                                    <p style="font-size: 20px; font-weight: bold;">
                                        <?php echo $jumlah_pengguna ?> Pengguna
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" style="height: 60px;  margin-bottom: 15px;">
                                    <p style="font-size: 16px; ">

                                        <?php

                                        $jumlah_survei_query = "SELECT COUNT(*) AS total_survei_dibuat FROM survei";
                                        $result = mysqli_query($koneksi, $jumlah_survei_query);

                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);
                                            $jumlah_survei = $row['total_survei_dibuat'];
                                        } else {
                                            $jumlah_survei = 0; // Atur ke 0 jika terjadi kesalahan dalam query
                                        }
                                        ?>

                                        <img src="assets/img/respon.svg" width="18px"
                                            style="margin-left: 10px; margin-right: 10px;"> Survei Dibuat
                                    </p>
                                    <p style="font-size: 20px; font-weight: bold;"><?php echo  $jumlah_survei ?> Postingan</p>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" style="height: 60px;  margin-bottom: 15px;">
                                    <p style="font-size: 16px; ">
                                        <img src="assets/img/respons.svg" width="20px"
                                            style="margin-left: 10px; margin-right: 10px;"> Total Pertanyaan
                                    </p>


                                    <?php

                                    $jumlah_pertanyaan_query = "SELECT COUNT(*) AS total_pertanyaan FROM pertanyaan";
                                    $result = mysqli_query($koneksi, $jumlah_pertanyaan_query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $jumlah_pertanyaan = $row['total_pertanyaan'];
                                    } else {
                                        $$jumlah_pertanyaan = 0; // Atur ke 0 jika terjadi kesalahan dalam query
                                    }
                                    ?>

                                    <p style="font-size: 20px; font-weight: bold;"><?php echo  $jumlah_pertanyaan ?> Pertanyaan</p>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" style="height: 60px;  margin-bottom: 15px;">
                                    <p style="font-size: 16px; ">
                                        <img src="assets/img/coin.svg" width="20px"
                                            style="margin-left: 10px; margin-right: 10px;"> Poin Tertinggi
                                    </p>

                                    <?php

                                    $poin_tertinggi_query = "SELECT MAX(poin) AS poin_tertinggi FROM pengguna;";
                                    $result = mysqli_query($koneksi, $poin_tertinggi_query);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $poin_tertinggi = $row['poin_tertinggi'];
                                    } else {
                                        $poin_tertinggi = 0; // Atur ke 0 jika terjadi kesalahan dalam query
                                    }
                                    ?>
                                    <p style="font-size: 20px; font-weight: bold;"><?php echo $poin_tertinggi ?> Pts</p>

                                </div>
                            </div>
                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5 mx-auto">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <p
                                    style="font-size: 16px; text-align: center; padding-top: 15px; margin-left: 5px; margin-right: 5px;">
                                    Kategori</p>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="myPieChart" style="margin-bottom: 10px; "></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-xl-4 col-lg-5 mx-auto" style="margin-left: 10px; margin-right: 50px;">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <p
                                    style="font-size: 16px; text-align: center; padding-top: 15px; margin-left: 5px; margin-right: 5px;">
                                    Pendaftaran Akun</p>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="myBarChart"
                                            style="margin-bottom: 10px; width: 100%; height: 380px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bar Chart -->
                        <div class="col-xl-4 col-lg-5 mx-auto" style="margin-left: 10px; margin-right: 50px;">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <p
                                    style="font-size: 16px; text-align: center; padding-top: 15px; margin-left: 5px; margin-right: 5px;">
                                    Tipe Pertanyaan Survei</p>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie">
                                        <canvas id="myBarChart2"
                                            style="margin-bottom: 10px; width: 100%; height: 380px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        $kategori_query = "SELECT kategori_survei, COUNT(*) as jumlah_survei
                        FROM survei
                        WHERE kategori_survei IN ('Kesehatan', 'Teknologi', 'Pendidikan')
                        GROUP BY kategori_survei;
                        ";
                        $result = mysqli_query($koneksi, $kategori_query);

                        if ($result) {
                            // Fetch all rows from the result set
                            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        
                            // Extract the data for the chart
                            $kategori_labels = [];
                            $jumlah_survei_data = [];
                        
                            foreach ($rows as $row) {
                                $kategori_labels[] = $row['kategori_survei'];
                                $jumlah_survei_data[] = $row['jumlah_survei'];
                            }
                        } else {
                            // Handle the error
                            $kategori_labels = ['Pendidikan', 'Teknologi', 'Kesehatan'];
                            $jumlah_survei_data = [0, 0, 0];
                        }

                        ?>


                        <!-- Add this script to initialize the chart -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Data for the chart
                            var data = {
                                labels: <?php echo json_encode($kategori_labels); ?>,
                                datasets: [{
                                    data: <?php echo json_encode($jumlah_survei_data); ?>,
                                    backgroundColor: ['#435585', '#818FB4', '#F5E8C7'],
                                    borderWidth: 1
                                }]
                            };

                            // Configuration for the chart
                            var config = {
                                type: 'doughnut',
                                data: data,
                                options: {
                                    borderWidth: 1
                                }
                            };

                            // Initialize the chart
                            var myChart = new Chart(
                                document.getElementById('myPieChart'),
                                config
                            );
                        </script>


                            <?php

                            $query_tahun = "SELECT YEAR(waktu_buatakun) AS tahun, COUNT(*) AS jumlah_users
                                    FROM pengguna
                                    GROUP BY YEAR(waktu_buatakun)";

                            $result = mysqli_query($koneksi, $query_tahun);
                            $data = [];

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $data[] = $row;
                                }
                            } 
                            $jumlah_users_array = array_column($data, 'jumlah_users');

                            ?>


                        <script>
                            // Data for the bar chart
                            
                            var barData = {
                                labels: ['2023', '2024'],
                                datasets: [{
                                    data:  <?php echo json_encode($jumlah_users_array); ?>,
                                    label: 'Jumlah',
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            // Configuration for the bar chart
                            var barConfig = {
                                type: 'bar',
                                data: barData,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            };

                            // Initialize the bar chart
                            var myBarChart = new Chart(
                                document.getElementById('myBarChart'),
                                barConfig
                            );
                        </script>

<?php

$jenis_query = "SELECT jenis_pertanyaan, COUNT(*) as jumlah_pertanyaan
FROM pertanyaan
WHERE jenis_pertanyaan IS NOT NULL
GROUP BY jenis_pertanyaan
";
$result = mysqli_query($koneksi, $jenis_query);

if ($result) {
    // Fetch all rows from the result set
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Extract the data for the chart
    $jenis__pertanyaan_labels = [];
    $jumlah_pertanyaan = [];

    foreach ($rows as $row) {
        $jenis_pertanyaan_labels[] = $row['jenis_pertanyaan'];
        $jumlah_pertanyaan[] = $row['jumlah_pertanyaan'];
    }
} else {
    // Handle the error
    $jenis_pertanyaan_labels[] = ['Text', 'Checkbox', 'Radio Button'];
    $jumlah_pertanyaan = [0, 0, 0];
}

?>


                        <script>
                            // Data for the bar chart
                            var barData = {
                                labels: <?php echo json_encode($jenis_pertanyaan_labels); ?>,
                                datasets: [{
                                    label: 'Jenis Pertanyaan',
                                    data: <?php echo json_encode($jumlah_pertanyaan); ?>,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            // Configuration for the bar chart
                            var barConfig = {
                                type: 'bar',
                                data: barData,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            };

                            // Initialize the bar chart
                            var myBarChart = new Chart(
                                document.getElementById('myBarChart2'),
                                barConfig
                            );
                        </script>



                    </div>

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
                            <p>SiData merupakan Aplikasi Pembuatan, Penyebaran, dan Pengisian Survei Online untuk Penelitian
                                Mahasiswa.</p>
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

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"
            style="background-color: #0474BA;"><i class="bi bi-arrow-up-short"></i></a>
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
        <script src="assets/js/admin.js"></script>



    </body>

    </html>

    <?php
} else {
    header('location:index.php');
    exit;
}