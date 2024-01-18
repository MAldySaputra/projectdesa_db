<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan kelas_id tersedia
    if (isset($_POST['id_berita'])) {
        $id_berita = intval($_POST['id_berita']); // Fix variable name here

        // Hapus data kelas berdasarkan ID
        $delete_query = "DELETE FROM tbl_berita WHERE id_berita=$id_berita";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: berita");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting Berita: " . mysqli_error($db_connect));
        }
    } else {
        die("Birth ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
