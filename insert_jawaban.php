<?php
require_once 'connection.php';
session_start();
$id_pengguna = $_SESSION['id_pengguna'];

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai jawaban dari form
    $jawaban = $_POST['jawaban'];

    // Lakukan loop untuk setiap pertanyaan
    foreach ($jawaban as $id_pertanyaan => $isi_jawaban) {
        echo '<br>';
        if (is_array($isi_jawaban['isi_jawaban'])) {
            $isi_jawaban['isi_jawaban'] = implode(", ", $isi_jawaban['isi_jawaban']);
        }

        $id = $isi_jawaban['id_pertanyaan'];
        $isi = $isi_jawaban['isi_jawaban'];

        $sql = "INSERT INTO jawaban (id_pertanyaan, isi_jawaban) VALUES ('$id', '$isi')";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $cari_id = "SELECT id_jawaban FROM jawaban ORDER BY id_jawaban DESC LIMIT 1";
            $result = mysqli_query($koneksi, $cari_id);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_jawaban = $row['id_jawaban'];
                $det = "INSERT INTO detail_jawaban (id_pengguna, id_jawaban) VALUES ('$id_pengguna', '$id_jawaban')";
                $result = mysqli_query($koneksi, $det);
            }

        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }

    $tambah_poin = "SELECT poin FROM pengguna WHERE id_pengguna = $id_pengguna limit 1";
    $result = mysqli_query($koneksi, $tambah_poin);
    $row = mysqli_fetch_assoc($result);
    $poin = $row['poin'] + 10;

    $tambah = "UPDATE pengguna
    SET poin = '$poin'
    WHERE id_pengguna = $id_pengguna
    ";

    mysqli_query($koneksi, $tambah);
    header("location: terimakasih.php");
    // Tutup koneksi database setelah selesai
    mysqli_close($koneksi);

} else {
    // Jika form tidak disubmit, tampilkan pesan kesalahan
    echo "Error: Form tidak disubmit dengan benar.";
}
?>