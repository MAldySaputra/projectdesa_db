<!-- edituser.php -->
<?php
require '../../../config/db.php';

// Inisialisasi variabel
// Inisialisasi variabel
$tbl_pengguna = array();
$jabatan_sebelum = '';

// Periksa apakah ID pengguna disediakan dalam URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Ambil detail pengguna berdasarkan ID
    $result = mysqli_query($db_connect, "SELECT * FROM tbl_pengguna WHERE id_admin=$user_id");

    // Pengecekan apakah ada hasil dari kueri
    if ($result) {
        // Pengecekan apakah ada data pengguna ditemukan
        if (mysqli_num_rows($result) > 0) {
            $tbl_pengguna = mysqli_fetch_assoc($result);
            // Akses array offset hanya jika variabel terdefinisi dan merupakan array
            $jabatan_sebelum = isset($tbl_pengguna['jabatan']) ? $tbl_pengguna['jabatan'] : '';
        } else {
            // Handle case when no user data is found
            die("User data not found for ID: $user_id");
        }
    } else {
        // Handle case when there is an error in the query
        die("Error fetching user data: " . mysqli_error($db_connect));
    }

    // Periksa apakah formulir telah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Perbarui detail pengguna
    $jabatan_baru = $_POST['jabatan_baru'];

    // Lakukan validasi untuk memastikan bahwa $user_id memiliki nilai yang valid
    if (!empty($user_id)) {
        $update_query = "UPDATE tbl_pengguna SET jabatan='$jabatan_baru' WHERE id_admin=$user_id";
        if (mysqli_query($db_connect, $update_query)) {
            // Alihkan ke halaman utama setelah pengeditan
            header("Location: datauser?edited=true");
            exit();
        } else {
            // Handle error jika kueri tidak berhasil
            die("Error updating user: " . mysqli_error($db_connect));
        }
    } else {
        die("Invalid user ID: $user_id");
    }
}

} else {
    // Alihkan ke halaman utama jika ID tidak disediakan
    die("User ID not provided");
}

?>
<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna memiliki peran super admin
    if ($_SESSION['role'] !== 'super admin') {
        // Jika bukan super admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login");
        exit();
    }

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..' . $ds . '..'  . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Data Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                    <li class="breadcrumb-item"><a href="../users/datauser">Data Pengguna</a></li>
                    <li class="breadcrumb-item"><a>Edit Data Pengguna</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Edit Data Pengguna</h5>
                    <form method="POST">
                        <div class="col-12">
                            <label for="jabatan_baru" class="form-label">Jabatan :</label>
                            <input type="text" class="form-control" id="jabatan_baru" name="jabatan_baru" value="<?=$jabatan_sebelum?>" required>
                        </div>
                        <div class="text-end">
                            <a href="datauser" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</main>
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>