<?php
session_start();
require_once("../../../config/db.php");

// Pastikan pengguna sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login");
    exit();
}

$errors = array(); // Array untuk menyimpan pesan kesalahan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $password_baru = $_POST['password_baru'];
    $ulang_password_baru = $_POST['ulang_password_baru'];

    // Ambil data pengguna dari sesi
    $email = $_SESSION['email'];
    $user = mysqli_query($db_connect, "SELECT * FROM tbl_pengguna WHERE email = '$email'");

    if (mysqli_num_rows($user) > 0) {
        $data = mysqli_fetch_assoc($user);

        // Periksa kecocokan kata sandi saat ini
        if (password_verify($password, $data['password'])) {
            // Pastikan kata sandi baru dan konfirmasi kata sandi baru sesuai
            if ($password_baru !== $ulang_password_baru || empty($password_baru)) {
                $errors[] = "Kata sandi baru dan konfirmasi kata sandi tidak cocok atau kata sandi baru kosong.";
            }

            // Ganti kata sandi dalam basis data
            $hashedNewPassword = password_hash($password_baru, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE tbl_pengguna SET password='$hashedNewPassword' WHERE email='$email'";

            if (empty($errors) && mysqli_query($db_connect, $updateQuery)) {
                // Kata sandi berhasil diperbarui
                $_SESSION['success_message'] = "Kata sandi berhasil diperbarui.";
            } else {
                $errors[] = "Error updating password: " . mysqli_error($db_connect);
            }
        } else {
            $errors[] = "Kata sandi saat ini salah.";
        }
    } else {
        $errors[] = "Pengguna tidak ditemukan.";
    }

    // Periksa apakah ada kesalahan sebelum melakukan pengalihan
    if (!empty($errors)) {
        $_SESSION['change_password_errors'] = $errors;
    }

    // Alihkan kembali ke halaman profil
    header("Location: profile");
    exit();
}

// Tutup koneksi database
mysqli_close($db_connect);
?>
