<?php
session_start();
require_once 'connection.php';

// Fungsi untuk menampilkan pesan alert
function showAlert($message) {
    echo '<script>alert("' . $message . '");</script>';
}

// Periksa apakah formulir login sudah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah pengguna sudah login
    if (isset($_SESSION['email'])) {
        header('location: index.php');
        exit();
    } else {
        // Ambil data dari formulir login
        $email = $_POST['email'];
        $password = $_POST['pasword'];

        // Periksa apakah email ditemukan di database
        $sqlcek = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email = '$email'");
        $cocok = mysqli_fetch_array($sqlcek);

        if ($cocok) {
            // Jika password cocok setelah verifikasi
            if (password_verify($password, $cocok['pasword'])) {
                $_SESSION['email'] = $email;
                $_SESSION['id_pengguna'] = $cocok['id_pengguna'];
                $_SESSION['nama'] = $cocok['nama'];

                if ($email == 'admin@gmail.com'){
                    header('location: admin.php');
                    exit();
                } else{
                    header("location: index.php");
                    exit;    
                }

            } else {
                showAlert('Password yang dimasukkan salah!');
            }
        } else {
            showAlert('Email yang dimasukkan tidak tersedia!');
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="assets/img/LogoSiDataTitle.png" rel="icon">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>SiData - Login</title>
</head>

<body>
<div class="main__container">
    <div class="left__container" style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata1.png'); background-size:cover; "></div>
    
    <div class="right__container" style="background:linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)), url('assets/img/sidata2.png'); background-size:cover; ">
        <form class="login" id="login-form" action='' method='POST'>
            <h1 class="title">Masuk</h1>
            
            <div class="input__container text">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required>
            </div>
            
            <div class="input__container password">
                <label for="pasword">Password</label>
                <input id="pasword" name="pasword" type="password" required>
                <span toggle="#password" class="toggle-password"></span>
            </div>
            
            <div class="login__button">
                <button type="submit" class="login__btn" id="login-btn" value='login'>Masuk</button>
            </div>
            
            <div class="middle__text">
                <p class="middle__textt">atau Masuk dengan</p>
            </div>
            
            <div class="bottom__icons">
                <img class="icons"src="assets/img/icons8_gmail_96px_1.png">
                <img class="icons"src="assets/img/icons8_microsoft_office_2019_96px.png">
            </div>
            
            <div class="middle__text2">
                <p class="pspace">Belum punya akun?</p> 
                <a href="register.php" id="register-trigger">Daftar disini</a>
            </div>
        </form>   
    </div>
</div>
<script src="assets/js/main.js"></script>
</body>
</html>
