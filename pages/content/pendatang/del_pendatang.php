<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan kelas_id tersedia
    if (isset($_POST['id_datang'])) {
        $id_datang = intval($_POST['id_datang']); // Fix variable name here

        // Hapus data kelas berdasarkan ID
        $delete_query = "DELETE FROM tbl_pendatang WHERE id_datang=$id_datang";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: pendatang");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting Pendatang: " . mysqli_error($db_connect));
        }
    } else {
        die("Birth ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
