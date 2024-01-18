<?php
// Include database configuration
require '../../../config/db.php';

// Initialize variables
// $id_datang = '';
// $nik_pendatang = '';
// $nama_pendatang = '';
// $jenis_kelamin = '';
// $tanggal_datang = '';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve values from the form
    $id_datang = $_POST['id_datang'];
    $nik_pendatang = $_POST['nik_pendatang'];
    $nama_pendatang = $_POST['nama_pendatang'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    // Validate and sanitize user input (add your validation logic here)

    // Validate and format the date
    $tanggal_datang = $_POST['tanggal_datang'];
    if (empty($tanggal_datang) || strtotime($tanggal_datang) === false) {
        // Handle the error, e.g., display a message and don't proceed with the update
        echo "Invalid date format";
        exit();
    }

    // Update data in the database using prepared statement
    $updateQuery = "UPDATE tbl_pendatang SET nik_pendatang='$nik_pendatang', nama_pendatang='$nama_pendatang', jenis_kelamin='$jenis_kelamin', tanggal_datang='$tanggal_datang' WHERE id_datang='$id_datang'";
    $stmt = mysqli_query($db_connect, $updateQuery);

    // Change the type definition string to match the number of variables
    // mysqli_stmt_bind_param($stmt, 'issis', $nik_pendatang, $nama_pendatang, $jenis_kelamin, $tanggal_datang, $id_datang);
    // mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);

    // Debugging: Add echo or var_dump here
    echo "Data updated successfully.";
    var_dump($_POST);

    // Redirect to the main page after successful update
    header("Location: pendatang");
    exit();
} else {
    // If form is not submitted, fetch existing data based on ID
    if (isset($_GET['id'])) {
        $id_datang = $_GET['id'];
        $selectQuery = "SELECT * FROM tbl_pendatang WHERE id_datang = ?";
        $selectStmt = mysqli_prepare($db_connect, $selectQuery);
        mysqli_stmt_bind_param($selectStmt, 'i', $id_datang);
        mysqli_stmt_execute($selectStmt);
        $result = mysqli_stmt_get_result($selectStmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nik_pendatang = $row['nik_pendatang'];
            $nama_pendatang = $row['nama_pendatang'];
            $jenis_kelamin = $row['jenis_kelamin'];
            $tanggal_datang = $row['tanggal_datang'];
        } else {
            // Redirect to the main page if the ID is not valid
            header("Location: pendatang");
            exit();
        }
    } else {
        // Redirect to the main page if no ID is provided
        header("Location: pendatang");
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
        <h1>Edit Pendatang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../pendatang/pendatang">Data Pendatang</a></li>
                <li class="breadcrumb-item"><a>Edit Pendatang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Pendatang</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_pendatang" class="row g-3">
                    <input type="hidden" name="id_datang" value="<?= $id_datang ?>">

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
