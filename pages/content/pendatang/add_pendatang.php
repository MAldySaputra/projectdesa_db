<?php
require '../../../config/db.php';

$nik_pendatang = '';
$nama_pendatang	= '';
$jenis_kelamin = '';
$tanggal_datang = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nik_pendatang = $_POST['nik_pendatang'];
    $nama_pendatang = $_POST['nama_pendatang'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_datang = $_POST['tanggal_datang'];

// ... (Previous code)
    if (!empty($nik_pendatang) && !empty($nama_pendatang) && !empty($jenis_kelamin) && !empty($tanggal_datang)) {
        $insert_query = "INSERT INTO tbl_pendatang (nik_pendatang, nama_pendatang, jenis_kelamin, tanggal_datang) VALUES ('$nik_pendatang', '$nama_pendatang', '$jenis_kelamin', '$tanggal_datang')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: pendatang");
            exit();
        } else {
            die("Error add : " . mysqli_error($db_connect));
        }

    } else {
        echo "Data tidak boleh kosong";
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
        <h1>Tambah Pendatang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../pendatang/pendatang">Data Pendatang</a></li>
                <li class="breadcrumb-item"><a>Tambah Pendatang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Pendatang</h5>

                <!-- Vertical Form -->
                <form action="add_pendatang" method="post" class="row g-3">
                    <div class="col-12">
                        <label for="nik_pendatang" class="form-label">NIK Pendatang :</label>
                        <input type="text" class="form-control" id="nik_pendatang" name="nik_pendatang" value="<?= $nik_pendatang ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nama_pendatang" class="form-label">Nama Pendatang :</label>
                        <input type="text" class="form-control" id="nama_pendatang" name="nama_pendatang" value="<?= $nama_pendatang ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option selected disabled value="">- Pilih Jenis Kelamin -</option>
                            <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_datang" class="form-label">Tanggal Datang :</label>
                        <input type="date" class="form-control" id="tanggal_datang" name="tanggal_datang" value="<?= $tanggal_datang ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="pendatang" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
</main>
<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>
