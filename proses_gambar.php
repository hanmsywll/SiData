<?php
session_start();
$id_pengguna = $_SESSION['id_pengguna'];

if(isset($_FILES["file"])){
    $allowedExts = array("jpg", "jpeg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);

    if ((($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 2000000)
        && in_array($extension, $allowedExts)) {

        // Cek apakah ada error saat unggah
        if ($_FILES["file"]["error"] > 0) {
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
        } else {
            // Pindahkan file yang diunggah ke direktori tujuan
            move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $_FILES["file"]["name"]);
            
            $nama_file = $_FILES["file"]["name"];
            $pengguna['pp'] = $nama_file;
        }
    } else {
        echo "File tidak valid. Pastikan file adalah gambar dengan format JPG, JPEG, atau PNG, dan ukurannya kurang dari 2 MB.";
    }
} else {
    return null;
}


?>