<?php 

function getUserById($id_pengguna, $db){
    $sql = "SELECT * FROM `pengguna` WHERE `id_pengguna` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id_pengguna);
    $stmt->execute();

    // Mendapatkan result set dari pernyataan yang dijalankan
    $result = $stmt->get_result();

    // Memeriksa jumlah baris yang ditemukan
    if($result->num_rows == 1){
        // Mengambil data pengguna
        $user = $result->fetch_assoc();
        return $user;
    } else {
        return 0;
    }
}
