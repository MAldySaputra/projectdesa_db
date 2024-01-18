<?php
// Include database configuration
require '../../../config/db.php';

// Initialize variables
// $id_penduduk = '';
// $nik = '';
// $nama = '';
// $alamat = '';
// $tanggal = '';
// $jenis_kelamin = '';
// $rt = '';
// $rw = '';
// $pekerjaan = '';
// $status = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve values from the form
    $id_penduduk = $_POST['id_penduduk'];
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
    // Validate and sanitize user input (add your validation logic here)

    // Update data in the database using prepared statement
    $updateQuery = "UPDATE tbl_penduduk SET nik='$nik', nama='$nama', alamat='$alamat', tanggal='$tanggal', agama='$agama', jenis_kelamin='$jenis_kelamin', rt='$rt', rw='$rw', pekerjaan='$pekerjaan', status='$status' WHERE id_penduduk='$id_penduduk'";
    $stmt = mysqli_query($db_connect, $updateQuery);

    // Change the type definition string to match the number of variables
    // mysqli_stmt_bind_param($stmt, 'isssssiiiss', $nik, $nama, $alamat, $tanggal, $agama, $jenis_kelamin, $rt, $rw, $pekerjaan, $status, $id_penduduk);
    // mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);

    // Debugging: Add echo or var_dump here
    echo "Data updated successfully.";
    var_dump($_POST);

    // Redirect to the main page after successful update
    header("Location: penduduk");
    exit();
} else {
    // If form is not submitted, fetch existing data based on ID
    if (isset($_GET['id'])) {
        $id_penduduk = $_GET['id'];
        $result = mysqli_query($db_connect, "SELECT * FROM tbl_penduduk WHERE id_penduduk = $id_penduduk");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nik = $row['nik'];
            $nama = $row['nama'];
            $alamat = $row['alamat'];
            $tanggal = $row['tanggal'];
            $agama = $row['agama'];
            $jenis_kelamin = $row['jenis_kelamin'];
            $rt = $row['rt'];
            $rw = $row['rw'];
            $pekerjaan = $row['pekerjaan'];
            $status = $row['status'];
        } else {
            // Redirect to the main page if the ID is not valid
            header("Location: penduduk");
            exit();
        }
    } else {
        // Redirect to the main page if no ID is provided
        header("Location: penduduk");
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
        <h1>Edit Penduduk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../penduduk/penduduk">Data Penduduk</a></li>
                <li class="breadcrumb-item"><a>Edit Penduduk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Penduduk</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_penduduk" class="row g-3">
                    <input type="hidden" name="id_penduduk" value="<?= $id_penduduk ?>">

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
                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= ($pekerjaan !== null) ? $pekerjaan : 'Mahasiswa'; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Status Perkawinan :</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Sudah" <?php if ($status == 'Sudah') echo 'selected'; ?>>Sudah</option>
                            <option value="Belum" <?php if ($status == 'Belum') echo 'selected'; ?>>Belum</option>
                            <option value="Cerai Mati" <?php if ($status == 'Cerai Mati') echo 'selected'; ?>>Cerai Mati</option>
                            <option value="Cerai Hidup" <?php if ($status == 'Cerai Hidup') echo 'selected'; ?>>Cerai Hidup</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="penduduk" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
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
