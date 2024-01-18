<?php
// Include database configuration
require '../../../config/db.php';

// Initialize variables
$id_kk = '';
$nik = '';
$nama = '';
$alamat = '';
$rt = '';
$rw = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id_kk = $_POST['id_kk'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];

    // Validate and sanitize user input (add your validation logic here)

    // Update data in the database using prepared statement
    $updateQuery = "UPDATE tbl_kk SET nik=?, nama=?, alamat=?, rt=?, rw=? WHERE id_kk=?";
    $stmt = mysqli_prepare($db_connect, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sssssi', $nik, $nama, $alamat, $rt, $rw, $id_kk);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to the main page after successful update
    header("Location: kk");
    exit();
} else {
    // If form is not submitted, fetch existing data based on ID
    if (isset($_GET['id'])) {
        $id_kk = $_GET['id'];
        $result = mysqli_query($db_connect, "SELECT * FROM tbl_kk WHERE id_kk = $id_kk");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nik = $row['nik'];
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $rt = $row['rt'];
            $rw = $row['rw'];
        } else {
            // Redirect to the main page if the ID is not valid
            header("Location: index");
            exit();
        }
    } else {
        // Redirect to the main page if no ID is provided
        header("Location: index");
        exit();
    }
}
?>

<?php
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika belum login, redirect ke halaman login
        header("Location: ../../../login");
        exit();
    }

    // Periksa apakah pengguna memiliki peran super admin atau admin
    if ($_SESSION['role'] !== 'super admin' && $_SESSION['role'] !== 'admin') {
        // Jika bukan super admin atau admin, tampilkan pesan atau redirect ke halaman lain
        header("Location: ../../../login");
        exit();
    }

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..' . $ds . '..') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id="main" class="main">
<div class="pagetitle">
        <h1>Edit Kartu Keluarga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../kartu keluarga/kk">Data Kartu Keluarga</a></li>
                <li class="breadcrumb-item"><a>Edit Kartu Keluarga</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Kartu Keluarga</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_keluarga" class="row g-3">
                    <input type="hidden" name="id_kk" value="<?= $id_kk ?>">

                    <div class="col-12">
                        <label for="nik" class="form-label">No KK :</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nama" class="form-label">Kepala Keluarga :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="rt" class="form-label">RT :</label>
                        <input type="number" class="form-control" id="rt" name="rt" value="<?= $rt ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="rw" class="form-label">RW :</label>
                        <input type="number" class="form-control" id="rw" name="rw" value="<?= $rw ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="kk" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
</main>

<?php
// Don't forget to include the footer
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
