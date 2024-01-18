<?php
require '../../../config/db.php';

$nik = '';
$nama = '';
$alamat = '';
$tanggal = '';
$agama = '';
$jenis_kelamin = '';
$rt = '';
$rw = '';
$pekerjaan = '';
$status = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal = $_POST['tanggal'];
    $agama = $_POST['agama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $pekerjaan = $_POST['pekerjaan'];
    $status = $_POST['status'];

    if (!empty($nik) && !empty($nama) && !empty($alamat) && !empty($tanggal) && !empty($agama) && !empty($jenis_kelamin) && !empty($rt) && !empty($rw) && !empty($pekerjaan) && !empty($status)) {
        $insert_query = "INSERT INTO tbl_penduduk (nik, nama, alamat, tanggal, agama, jenis_kelamin, rt, rw, pekerjaan, status) VALUES ('$nik', '$nama', '$alamat', '$tanggal', '$agama', '$jenis_kelamin', '$rt', '$rw', '$pekerjaan', '$status')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: penduduk");
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
        <h1>Tambah Penduduk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../penduduk/penduduk">Data Penduduk</a></li>
                <li class="breadcrumb-item"><a>Tambah Penduduk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Penduduk</h5>

                <!-- Vertical Form -->
                <form action="add_penduduk" method="post" class="row g-3">
                    <div class="col-12">
                        <label for="nik" class="form-label">NIK :</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama Penduduk :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat :</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="tanggal" class="form-label">Tanggal Lahir :</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="agama" class="form-label">Agama :</label>
                        <input type="text" class="form-control" id="agama" name="agama" value="<?= $agama ?>" required>
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
                        <label for="rt" class="form-label">RT :</label>
                        <input type="number" class="form-control" id="rt" name="rt" value="<?= $rt ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="rw" class="form-label">RW :</label>
                        <input type="number" class="form-control" id="rw" name="rw" value="<?= $rw ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="pekerjaan" class="form-label">Pekerjaan :</label>
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $pekerjaan ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Status Perkawinan :</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>- Pilih Status -</option>
                            <option value="Sudah" <?php if ($status == 'Sudah') echo 'selected'; ?>>Sudah</option>
                            <option value="Belum" <?php if ($status == 'Belum') echo 'selected'; ?>>Belum</option>
                            <option value="Cerai Mati" <?php if ($status == 'Cerai Mati') echo 'selected'; ?>>Cerai Mati</option>
                            <option value="Cerai Hidup" <?php if ($status == 'Cerai Hidup') echo 'selected'; ?>>Cerai Hidup</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="penduduk" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
</main>
<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>
