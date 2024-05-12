<?php
require_once 'connection.php';

// Fungsi untuk menampilkan pesan alert
function showAlert($message)
{
    echo '<script>alert("' . $message . '");</script>';
}

// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pasword1 = $_POST['pasword'];
    $pasword = password_hash($pasword1, PASSWORD_BCRYPT);
    $pasword2 = $_POST['pasword2'];
    $waktu_buatakun = date('Y-m-d');

    // Validasi email unik
    $checkEmailQuery = "SELECT * FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($koneksi, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        showAlert('Email yang Anda masukkan sudah digunakan');
    } elseif ($pasword1 != $pasword2) {
        showAlert('Password yang Anda masukkan tidak sesuai!');
    } else {
        $defaultPP = 'https://img.icons8.com/bubbles/100/000000/user.png';
        $sql = "INSERT INTO pengguna (nama, email, pasword, pasword2, waktu_buatakun, pp) VALUES ('$nama', '$email', '$pasword', '$pasword2', '$waktu_buatakun', '$defaultPP')";

        if (mysqli_query($koneksi, $sql)) {
            header("location: login.php");
            exit();
        } else {
            showAlert('Terjadi kesalahan saat mendaftar. Silakan coba lagi: ' . mysqli_error($koneksi));
        }

    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="assets/img/LogoSiDataTitle.png" rel="icon">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Responsive Login</title>
</head>
<script>
function myFunction() {
    var x = document.getElementById("pasword");
    var y = document.getElementById("pasword2");

    if (x.type === "password") {
        x.type = "text";
        y.type = "text";
    } else {
        x.type = "password";
        y.type = "password";
    }
}

</script>

<body>
    <div class="main__container">
        <div class="left__container"
            style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata1.png'); background-size:cover; ">
        </div>

        <div class="right__container"
            style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata2.png'); background-size:cover; ">
            <form class="login" id="login-" form action='' method='POST'>
                <h1 class="title">Daftarkan Akun</h1>

                <div class="input__container">
                    <label for="nama">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" required>
                </div>

                <div class="input__container">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required>
                </div>

                <div class="input__container password">
                    <label for="pasword">Pasword</label>
                    <input id="pasword" name="pasword" type="password" required>
                    <span toggle="#pasword" class="toggle-password"></span>
                </div>

                <div class="input__container password">
                    <label for="pasword2">Re-Pasword</label>
                    <input id="pasword2" name="pasword2" type="password" required>
                    <span toggle="#pasword2" class="toggle-password"></span>
                </div>


                <div class="input__container">
                    <input type="checkbox" onclick="myFunction()">Show Password
                </div>

                <div class="login__button">
                    <button type="submit" class="login__btn" id="login-btn">Daftar</button>
                </div>

                <div class="middle__text">
                    <p class="middle__textt">atau Daftar dengan</p>
                </div>

                <div class="bottom__icons">
                    <img class="icons" src="assets/img/icons8_gmail_96px_1.png">
                    <img class="icons" src="assets/img/icons8_microsoft_office_2019_96px.png">
                </div>

                <div class="middle__text2">
                    <p class="pspace">Sudah punya akun?</p>
                    <a href="login.php" id="register-trigger">Masuk disini</a>
                </div>

                <div class="test">
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>

</html>