<?php
// Include database configuration
require '../../../config/db.php';

// Initialize variables
$id_meninggal = '';
$id_penduduk = '';
$tanggal_meninggal = '';
$sebab = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id_meninggal = $_POST['id_meninggal'];
    $id_penduduk = $_POST['id_penduduk'];
    $tanggal_meninggal = $_POST['tanggal_meninggal'];
    $sebab = $_POST['sebab'];

    // Update data in the database using prepared statement
    $updateQuery = "UPDATE tbl_meninggal SET id_penduduk=?, tanggal_meninggal=?, sebab=? WHERE id_meninggal=?";
    $stmt = mysqli_prepare($db_connect, $updateQuery);

    // Change the type definition string to match the number of variables
    mysqli_stmt_bind_param($stmt, 'sssi', $id_penduduk, $tanggal_meninggal, $sebab, $id_meninggal);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Data updated successfully.";
        // Redirect to the main page after successful update
        header("Location: meninggal");
        exit();
    } else {
        echo "Error updating data: " . mysqli_error($db_connect);
    }

    mysqli_stmt_close($stmt);
} else {
    // If form is not submitted, fetch existing data based on ID
    if (isset($_GET['id'])) {
        $id_meninggal = $_GET['id'];
        $result = mysqli_query($db_connect, "SELECT * FROM tbl_meninggal WHERE id_meninggal = $id_meninggal");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_penduduk = $row['id_penduduk'];
            $tanggal_meninggal = $row['tanggal_meninggal'];
            $sebab = $row['sebab'];

        } else {
            // Redirect to the main page if the ID is not valid
            header("Location: meninggal");
            exit();
        }
    } else {
        // Redirect to the main page if no ID is provided
        header("Location: meninggal");
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
        <h1>Edit Kematian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../meninggal/meninggal">Data Kematian</a></li>
                <li class="breadcrumb-item"><a>Edit Kematian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Kematian</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_meninggal" class="row g-3">
                    <input type="hidden" name="id_meninggal" value="<?= $id_meninggal ?>">

                    <div class="col-12">
                        <label for="id_meninggal" class="form-label">Penduduk :</label>
                        <select name="id_penduduk" id="id_penduduk" class="form-control" required>
                            <option selected disabled value="">- Pilh Meninggal -</option>
                            <?php
                            // ambil data dari database
                            $hasil = mysqli_query($db_connect, "SELECT id_penduduk, nik, nama FROM tbl_penduduk");
                            while ($row = mysqli_fetch_assoc($hasil)) {
                            ?>
                                <option value="<?php echo $row['id_penduduk'] ?>">
                                    <?php echo $row['nik'] ?>
                                    -
                                    <?php echo $row['nama'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal :</label>
                        <input type="date" class="form-control" id="tanggal_meninggal" name="tanggal_meninggal" value="<?= $tanggal_meninggal ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="sebab" class="form-label">Sebab :</label>
                        <input type="text" class="form-control" id="sebab" name="sebab" value="<?= $sebab ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="meninggal" class="btn btn-secondary">Kembali</a>
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
