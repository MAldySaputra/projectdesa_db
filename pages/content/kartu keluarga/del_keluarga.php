<?php
// Sertakan konfigurasi database
require '../../../config/db.php';

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil ID Keluarga dari formulir
    $id_kk = $_POST['id_kk'];

    // Hapus data keluarga dari database
    $deleteQuery = "DELETE FROM tbl_kk WHERE id_kk = ?";
    $stmt = mysqli_prepare($db_connect, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $id_kk);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect ke halaman utama setelah penghapusan berhasil
    header("Location: kk");
    exit();
} else {
    // Jika form tidak dikirim, kembali ke halaman utama
    header("Location: kk");
    exit();
}
?>
