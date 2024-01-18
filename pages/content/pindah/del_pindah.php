<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan kelas_id tersedia
    if (isset($_POST['id_pindah'])) {
        $id_pindah = intval($_POST['id_pindah']);

        // Hapus data kelas berdasarkan ID
        $delete_query = "DELETE FROM tbl_pindah WHERE id_pindah=$id_pindah";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: pindah");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting Pindah: " . mysqli_error($db_connect));
        }
    } else {
        die("Birth ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
