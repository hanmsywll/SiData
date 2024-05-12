<?php
session_start();

function showAlert($message)
{
    echo '<script>alert("' . $message . '");</script>';
}

// Jika pengguna sudah login
if (isset($_SESSION['email'])) {
    // Jika menerima metode POST dari file lain ke file ini
    if (isset($_POST['nama']) && isset($_POST['email'])) {
        include "connection.php";

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $email_session = $_SESSION['email'];

        // Validasi input
        if (empty($nama)) {
            $em = "Full name is required";
            header("Location: ../edit.php?error=$em");
            exit;
        } else if (empty($email)) {
            $em = "Email is required";
            header("Location: ../edit.php?error=$em");
            exit;
        } else {
            // Handle file upload
            $uploadDir = "../upload/"; // Adjust the upload directory path
            $uploadFile = $uploadDir . basename($_FILES['pp']['name']);

            // Check if a new image file is uploaded
            if (!empty($_FILES['pp']['name'])) {
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                // Validasi jenis file gambar
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
                if (!in_array($imageFileType, $allowedTypes)) {
                    $em = "Invalid image file type. Allowed types: jpg, jpeg, png, gif";
                    header("Location: ../edit.php?error=$em");
                    exit;
                }

                // Upload the file
                if (move_uploaded_file($_FILES['pp']['tmp_name'], $uploadFile)) {
                    // Update database with new profile picture
                    $sql = "UPDATE pengguna SET nama=?, email=?, pp=? WHERE email=?";
                    $stmt = $koneksi->prepare($sql);
                    $stmt->execute([$nama, $email, $_FILES['pp']['name'], $email_session]);

                    showAlert('Profile berhasil diedit!');
                } else {
                    $em = "Error uploading file. Please try again.";
                    header("Location: ../edit.php?error=$em");
                    exit;
                }
            } else {
                // Update database without changing the profile picture
                $sql = "UPDATE pengguna SET nama=?, email=? WHERE email=?";
                $stmt = $koneksi->prepare($sql);
                $stmt->execute([$nama, $email, $email_session]);

                showAlert('Profile berhasil diedit!');
            }

            // Perbarui sesi
            $_SESSION['email'] = $email;
            $_SESSION['nama'] = $nama;

            header("Location: profile.php");
            exit;
        }
    } else {
        header("Location: ../edit.php?error=error");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
