<?php
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan pendatang_id tersedia
    if (isset($_POST['id_penduduk'])) {
        $pendatang_id = intval($_POST['id_penduduk']);

        // Delete related records in tbl_pindah (child table)
        $delete_pindah_query = "DELETE FROM tbl_pindah WHERE id_penduduk=$pendatang_id";
        if (!mysqli_query($db_connect, $delete_pindah_query)) {
            // Handle error jika kueri tidak berhasil
            die("Error deleting related records in tbl_pindah: " . mysqli_error($db_connect));
        }

        // Delete related records in tbl_meninggal (if any)
        $delete_meninggal_query = "DELETE FROM tbl_meninggal WHERE id_penduduk=$pendatang_id";
        if (!mysqli_query($db_connect, $delete_meninggal_query)) {
            // Handle error jika kueri tidak berhasil
            die("Error deleting related records in tbl_meninggal: " . mysqli_error($db_connect));
        }

        // Hapus data pendatang berdasarkan ID
        $delete_query = "DELETE FROM tbl_penduduk WHERE id_penduduk=$pendatang_id";
        if (mysqli_query($db_connect, $delete_query)) {
            // Alihkan ke halaman utama setelah penghapusan
            header("Location: penduduk");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error deleting penduduk " . mysqli_error($db_connect));
        }
    }
}
?>
