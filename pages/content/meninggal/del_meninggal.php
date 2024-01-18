<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan id_meninggal tersedia
    if (isset($_POST['id_meninggal'])) {
        $id_meninggal = intval($_POST['id_meninggal']);  // Fix variable name here

        // Hapus data kelas berdasarkan ID
        $delete_query = "DELETE FROM tbl_meninggal WHERE id_meninggal=$id_meninggal";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: meninggal");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting Meninggal: " . mysqli_error($db_connect));
        }
    } else {
        die("Meninggal ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
