<?php
session_start();
$id_pengguna = $_SESSION['id_pengguna'];

function populateForm(): ?array
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return null;

    $survei = array();
    
    if (isset($_POST['judul_survei'])) {
        $survei['judul_survei'] = $_POST['judul_survei'];
    } else {
        return null;
    }
    
    if (isset($_POST['deskripsi_survei'])) {
        $survei['deskripsi_survei'] = $_POST['deskripsi_survei'];
    } else {
        return null;
    }
    
    if (isset($_POST['kategori_survei'])) {
            $kategori_survei=$_POST['kategori_survei'];
            echo "<br>";
            $survei['kategori_survei'] = implode(", ", $kategori_survei);
    } else {
        return null;
    }    

    if (isset($_POST['kriteria_responden'])) {
        $survei['kriteria_responden'] = $_POST['kriteria_responden'];
    } else {
        return null;
    }

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
                $survei['header_survei'] = $nama_file;
            }
        } else {
            echo "File tidak valid. Pastikan file adalah gambar dengan format JPG, JPEG, atau PNG, dan ukurannya kurang dari 2 MB.";
        }
    } else {
        return null;
    }

    return $survei;
}

function insertSurvei($survei, $id_pengguna): void
{
    require_once('connection.php');
    $insertSurvei= "INSERT INTO survei (tanggal_buat, judul_survei, deskripsi_survei, kategori_survei, kriteria_responden, header_survei, id_pengguna) VALUES 
                                (CURRENT_DATE(), '{$survei['judul_survei']}', '{$survei['deskripsi_survei']}', '{$survei['kategori_survei']}', '{$survei['kriteria_responden']}', '{$survei['header_survei']}', '$id_pengguna');";
    $insertSurveiResult = mysqli_query($koneksi, $insertSurvei);

    if ($insertSurveiResult) {
        // Query berhasil dilakukan
        $cariId = "SELECT * FROM survei ORDER BY id_survei DESC LIMIT 1";   //mencari id yang ditambahkan terbaru
        $result = mysqli_query($koneksi, $cariId);
        if(mysqli_num_rows($result) > 0) {
            while($i = mysqli_fetch_array($result)){
            $id_survei = $i["id_survei"];
            }
        }
        header("location: buat_pertanyaan.php?id=$id_survei");
        echo "Berhasil ditambahkan";
    } else {
        echo "Tidak berhasil";
    };

}

$survei = populateForm();
insertSurvei($survei, $id_pengguna);

// if(isset($_POST["submit"])){
//   if($_FILES["header_survei"]["error"] == 4){
//     echo
//     "<script> alert('Image Does Not Exist'); </script>"
//     ;
//   }
//   else{
//     $fileName = $_FILES["header_survei"]["name"];
//     $fileSize = $_FILES["header_survei"]["size"];
//     $tmpName = $_FILES["header_survei"]["tmp_name"];

//     $validImageExtension = ['jpg', 'jpeg', 'png'];
//     $imageExtension = explode('.', $fileName);
//     $imageExtension = strtolower(end($imageExtension));
//     if ( !in_array($imageExtension, $validImageExtension) ){
//       echo
//       "
//       <script>
//         alert('Invalid Image Extension');
//       </script>
//       ";
//     }
//     else if($fileSize > 1000000){
//       echo
//       "
//       <script>
//         alert('Image Size Is Too Large');
//       </script>
//       ";
//     }
//     else{
//       $newImageName = uniqid();
//       $newImageName .= '.' . $imageExtension;

//       move_uploaded_file($tmpName, 'img/' . $newImageName);
//       $query = "INSERT INTO survei (header_survei) VALUES('$newImageName')";
//       mysqli_query($conn, $query);
//       echo
//       "
//       <script>
//         alert('Successfully Added');
//         document.location.href = 'data.php';
//       </script>
//       ";
//     }
//   }
// }



// $cariId = "SELECT * FROM survei ORDER BY id_survei DESC LIMIT 1";   //mencari id yang ditambahkan terbaru
// $koneksi = new mysqli('localhost', 'root', '', 'sidata');
// $result = mysqli_query($koneksi, $cariId);
// if(mysqli_num_rows($result) > 0) {
//     while($i = mysqli_fetch_array($result)){
//         $id_survei = $i["id_survei"];
//     }
// }
// echo "<div class='col-12 text-center'>
// <a href='buat_pertanyaan.php?id=$id_survei'>
// <button class='btn btn-primary py-3 px-4' type='submit'> Mulai 
// </button> </a>
// </div>";
?>