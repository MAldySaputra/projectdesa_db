<?php
require '../../../config/db.php';

// Initialize variables
$nik = '';
$nama = '';
$alamat = '';
$rt = '';
$rw = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve values from the form
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];

    // Validate and sanitize user input
    // ...
    if (!empty($nik) && !empty($nama) && !empty($alamat) && !empty($rt) && !empty($rw)) {
        $insert_query = "INSERT INTO tbl_kk (nik, nama, alamat, rt, rw) VALUES ('$nik', '$nama', '$alamat', '$rt', '$rw')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: kk");
            exit();
        } else {
            die("Error add : " . mysqli_error($db_connect));
        }

    } else {
        echo "data tidak boleh kosong ";
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
        <h1>Tambah Kartu Keluarga</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../kartu keluarga/kk">Data Kartu Keluarga</a></li>
                <li class="breadcrumb-item"><a>Tambah Kartu Keluarga</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Kartu Keluarga</h5>

                <!-- Vertical Form -->
                <form action="add_kepala_keluarga" method="post" class="row g-3">
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
                        <input type="text" class="form-control" id="rt" name="rt" value="<?= $rt ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="rw" class="form-label">RW :</label>
                        <input type="text" class="form-control" id="rw" name="rw" value="<?= $rw ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="kk" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
</main>

<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
