<?php
require_once 'connection.php';

$id_survei              = $_POST['id_survei'];
$judul_survei           = $_POST['judul_survei'];
$deskripsi_survei       = $_POST['deskripsi_survei'];

if (isset($_POST['kategori_survei'])) { 
    $kategori_survei=$_POST['kategori_survei'];
    echo "<br>";
    $kategori_survei = implode(", ", $kategori_survei);
}

$kriteria_responden     = $_POST['kriteria_responden'];

$sql = "UPDATE survei 
        SET judul_survei = '$judul_survei',
            deskripsi_survei = '$deskripsi_survei',
            kategori_survei = '$kategori_survei',
            kriteria_responden = '$kriteria_responden'
        WHERE id_survei = $id_survei";

mysqli_query($koneksi, $sql);
header("location: dashboard.php");
?>