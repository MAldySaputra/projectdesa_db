<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan kelas_id tersedia
    if (isset($_POST['id_lahir'])) {
        $id_lahir = intval($_POST['id_lahir']);

        // Hapus data kelas berdasarkan ID
        $delete_query = "DELETE FROM tbl_kelahiran WHERE id_lahir=$id_lahir";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: kelahiran");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting Lahir: " . mysqli_error($db_connect));
        }
    } else {
        die("Birth ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
