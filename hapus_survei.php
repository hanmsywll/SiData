<?php
session_start();
require_once 'connection.php';

$id = $_GET['id'];

$deleteJawaban = "DELETE FROM jawaban WHERE id_pertanyaan IN (SELECT id_pertanyaan FROM pertanyaan WHERE id_survei = $id)";
mysqli_query($koneksi, $deleteJawaban);

$deletePertanyaan = "DELETE FROM pertanyaan WHERE id_survei = $id";
mysqli_query($koneksi, $deletePertanyaan);

$sql = "DELETE FROM survei WHERE id_survei = $id";
mysqli_query($koneksi, $sql);

if ($_SESSION['email'] == 'admin@gmail.com'){
    header("location: kelola_survei.php");
} else {
    header("location: dashboard.php");
}
?>
