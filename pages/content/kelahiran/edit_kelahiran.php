<?php
require '../../../config/db.php';

$id_lahir = '';
$namabayi = '';
$tanggal_lahir = '';
$jenis_kelamin = '';
$id_kk = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lahir = $_POST['id_lahir'];
    $namabayi = $_POST['namabayi'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id_kk = $_POST['id_kk'];

    // Check if the selected id_kk exists in tbl_kk
    $checkKKQuery = "SELECT COUNT(*) FROM tbl_kk WHERE id_kk = ?";
    $checkKKStmt = mysqli_prepare($db_connect, $checkKKQuery);
    mysqli_stmt_bind_param($checkKKStmt, 'i', $id_kk);
    mysqli_stmt_execute($checkKKStmt);
    mysqli_stmt_bind_result($checkKKStmt, $kkCount);
    mysqli_stmt_fetch($checkKKStmt);
    mysqli_stmt_close($checkKKStmt);

    if ($kkCount > 0) {
        $updateQuery = "UPDATE tbl_kelahiran SET namabayi=?, tanggal_lahir=?, jenis_kelamin=?, id_kk=? WHERE id_lahir=?";
        $stmt = mysqli_prepare($db_connect, $updateQuery);

        mysqli_stmt_bind_param($stmt, 'ssssi', $namabayi, $tanggal_lahir, $jenis_kelamin, $id_kk, $id_lahir);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Data updated successfully.";
            header("Location: kelahiran");
            exit();
        } else {
            echo "Failed to update data.";
            // Add additional debugging information if needed
            var_dump($_POST);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid id_kk. The selected KK does not exist.";
        // Add additional debugging information if needed
        var_dump($_POST);
    }
} else {
    if (isset($_GET['id'])) {
        $id_lahir = $_GET['id'];
        $result = mysqli_query($db_connect, "SELECT * FROM tbl_kelahiran WHERE id_lahir = $id_lahir");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $namabayi = $row['namabayi'];
            $tanggal_lahir = $row['tanggal_lahir'];
            $jenis_kelamin = $row['jenis_kelamin'];
            $id_kk = $row['id_kk'];
        } else {
            header("Location: kelahiran");
            exit();
        }
    } else {
        header("Location: kelahiran");
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
        <h1>Edit Kelahiran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../kelahiran/kelahiran">Data Kelahiran</a></li>
                <li class="breadcrumb-item"><a>Edit Kelahiran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Kelahiran</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_kelahiran" class="row g-3">
                    <input type="hidden" name="id_lahir" value="<?= $id_lahir ?>">

                    <div class="col-12">
                        <label for="namabayi" class="form-label">Nama Bayi :</label>
                        <input type="text" class="form-control" id="namabayi" name="namabayi" value="<?= $namabayi ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tanggal_lahir ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="id_kk" class="form-label">Keluarga :</label>
                        <select name="id_kk" id="id_kk" class="form-control" required>
                            <option selected disabled value="">- Pilih KK -</option>
                            <?php
                            // ambil data dari database
                            $hasil = mysqli_query($db_connect, "SELECT id_kk, nik, nama FROM tbl_kk");
                            while ($row = mysqli_fetch_assoc($hasil)) {
                            ?>
                                <option value="<?php echo $row['id_kk'] ?>">
                                    <?php echo $row['nik'] ?>
                                    -
                                    <?php echo $row['nama'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="kelahiran" class="btn btn-secondary">Kembali</a>
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
