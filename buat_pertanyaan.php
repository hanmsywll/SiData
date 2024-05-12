<?php
        require_once 'connection.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM survei WHERE id_survei=$id";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);    
        session_start();
        $_SESSION['id_survei'] = $data['id_survei'];
        $id = $_SESSION['id_survei'];
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

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <center>
          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <!-- <div class="entry-img">
                <img src="assets/img/blog/isisurvei1.jpg" alt="" class="img-fluid">
              </div> -->

              <h2 class="fw-bold text-center mt-3">Detail Survei</h2>

              <div class="row col-lg-8">
                <form class=" bg-white px-10" action="">

                  <!-- Text input -->
                
                <div data-mdb-input-init class="form-outline mb-4">
                  <p class="fw-bold" align="left">Judul Survei</p>
                  <p align="left"><?php echo $data['judul_survei']?></p>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                <p class="fw-bold" align="left">Pilih Kategori</p>
                <p align="left"><?php echo $data['kategori_survei']?></p>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                <p class="fw-bold" align="left">Deskripsi Survei</p>
                <p align="left"><?php echo $data['deskripsi_survei']?></p>
                </div>

                <div data-mdb-input-init class="form-outline mb-2">
                <p class="fw-bold" align="left">Kriteria Responden</p>
                <p align="left"><?php echo $data['kriteria_responden']?></p>
                </div>
                </form>
              </div>
              </div>

<form class=" bg-white px-10" action='insert_pertanyaan.php' method="post" align="left">
    <input type="hidden" name="id_survei" value="<?php echo $id ?>" placeholder="Id" /> <br>
    <div id="questionsContainer">
    </div>

    <div class="text-center">
        <button class="btn btn-primary" <a onclick="addQuestion()"> <img src="assets/img/add-white.png" width="25">  Tambah Pertanyaan</a></button>
    </div>
    <br>
    <div class="text-end mt-3">
        <button type="button" class="btn btn-secondary"> <a href="dashboard.php">Kembali ke Dashboard</a></button>
        <button type="submit" class="btn btn-primary">Submit Survei</button>
    </div>

</form>

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
<script>
    let questionIndex = 0; // Menyimpan indeks pertanyaan

    function addQuestion() {
        const questionsContainer = document.getElementById('questionsContainer');
        const newQuestion = document.createElement('div');
        newQuestion.innerHTML = `
                <div class="container" data-aos="fade-up">
                    <div class="row">
                        <center>
                            <div class="col-lg-6 entries">
                                <article class="entry entry-single">
                                    <div class="row col-lg-8">
                                        <p align=right>Tipe Soal:
                                            <select name="questions[${questionIndex}][questionType]" onchange="toggleOptions(this)" class="form-select w-50">
                                                <option value="radio">Radio Button</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="text">Text</option>
                                            </select>
                                            <br>
                                            <p align="left">Pertanyaan:
                                                <input type="text" name="questions[${questionIndex}][question]" placeholder="Masukkan pertanyaan disini.." class="form-control" required>
                                                <div class="optionsContainer">
                                                    <!-- Pilihan jawaban akan ditambahkan secara dinamis menggunakan JavaScript -->
                                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-primary" onclick="addOption(this.parentElement)">Tambah Pilihan</button>
                            <br><br>
                            <div class="text-end">
                            <button class="btn" onclick="removeQuestion(this.parentElement.parentElement.parentElement.parentElement)"> Hapus Pertanyaan </button>
                            </div>
                    </div>
                </div>
            </section>
        `;
        questionsContainer.appendChild(newQuestion);
        questionIndex++; // Menambah indeks pertanyaan
    }

    function toggleOptions(select) {
        const optionsContainer = select.parentElement.querySelector('.optionsContainer');
        const addOptionButton = select.parentElement.querySelector('button');

        if (select.value === 'text') {
            optionsContainer.innerHTML = ''; // Hapus semua pilihan jawaban jika tipe pertanyaan adalah teks
            addOptionButton.disabled = true; // Nonaktifkan tombol "Tambah Pilihan"
        } else {
            addOptionButton.disabled = false; // Aktifkan tombol "Tambah Pilihan" untuk tipe pertanyaan selain teks
        }
    }

    function addOption(container) {
        const optionsContainer = container.querySelector('.optionsContainer');
        const questionType = container.querySelector('select').value;

        if (questionType !== 'text') {
            const newOption = document.createElement('div');
            newOption.innerHTML = `
                <align="left">
                <label for="option">Pilihan:</label>
                <input type="${questionType === 'text' ? 'text' : 'text'}" style="border: 1px solid #ced4da; border-radius: 0.25rem;" name="questions[${questionIndex - 1}][options][]" placeholder="Masukkan pilihan" required>
                <button type="button" align=right class="btn btn-danger p-1" onclick="removeOption(this.parentElement)">Hapus</button>
            `;
            optionsContainer.appendChild(newOption);
        }
    }

    function removeOption(option) {
        option.parentNode.removeChild(option);
    }

    function removeQuestion(questionContainer) {
        questionContainer.parentNode.removeChild(questionContainer);
    }
</script>

</body>

</html>

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