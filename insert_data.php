<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sidata";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data gambar dari database
$sql = "SELECT header_survei FROM survei WHERE id_pengguna = ? ORDER BY id_survei DESC LIMIT 1"; // Ganti dengan id_pengguna yang sesuai
$stmt = $conn->prepare($sql);

$id_pengguna = 1; // Ganti dengan id_pengguna yang sesuai
$stmt->bind_param("i", $id_pengguna);
$stmt->execute();

// Bind the result variable
$stmt->bind_result($header_survei);

// Fetch the result
$stmt->fetch();

// Tutup koneksi
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Gambar</title>
</head>
<body>

    <h2>Header Survei Terakhir yang Disimpan</h2>

    <?php
    if (!empty($header_survei)) {
        // Set header untuk menampilkan gambar
        echo '<img src="data:image/*;base64,' . base64_encode($header_survei) . '" alt="Header Survei Terakhir">';
    } else {
        echo "Tidak ada header survei yang tersimpan.";
    }
    ?>

    <br>
    <a href="index.html">Kembali ke Formulir</a>

</body>
</html>
