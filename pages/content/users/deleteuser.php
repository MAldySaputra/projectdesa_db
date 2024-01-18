<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan id_admin tersedia
    if (isset($_POST['id_admin'])) {
        $id_admin = intval($_POST['id_admin']);

        // Hapus data pengguna berdasarkan ID
        $delete_query = "DELETE FROM tbl_pengguna WHERE id_admin=$id_admin";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: datauser");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting user: " . mysqli_error($db_connect));
        }
    } else {
        die("User ID not provided");
    }
} else {
    die("Invalid request method");
}
?>
