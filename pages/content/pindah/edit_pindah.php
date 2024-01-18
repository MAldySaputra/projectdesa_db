<?php
// Include database configuration
require '../../../config/db.php';

// Initialize variables
$id_pindah = ''; // Add this line
$id_penduduk = '';
$tanggal_pindah = '';
$alasan = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id_pindah = $_POST['id_pindah']; // Add this line
    $id_penduduk = $_POST['id_penduduk'];
    $tanggal_pindah = $_POST['tanggal_pindah'];
    $alasan = $_POST['alasan'];

    // Update data in the database using prepared statement
    $updateQuery = "UPDATE tbl_pindah SET id_penduduk=?, tanggal_pindah=?, alasan=? WHERE id_pindah=?";
    $stmt = mysqli_prepare($db_connect, $updateQuery);

    // Change the type definition string to match the number of variables
    mysqli_stmt_bind_param($stmt, 'sssi', $id_penduduk, $tanggal_pindah, $alasan, $id_pindah);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Debugging: Add echo or var_dump here
    echo "Data updated successfully.";
    var_dump($_POST);

    // Redirect to the main page after a successful update
    header("Location: pindah");
    exit();
} else {
    // If the form is not submitted, fetch existing data based on ID
    if (isset($_GET['id'])) {
        $id_pindah = $_GET['id'];
        $result = mysqli_query($db_connect, "SELECT * FROM tbl_pindah WHERE id_pindah = $id_pindah");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_penduduk = $row['id_penduduk'];
            $tanggal_pindah = $row['tanggal_pindah'];
            $alasan = $row['alasan'];
        } else {
            // Redirect to the main page if the ID is not valid
            header("Location: pindah");
            exit();
        }
    } else {
        // Redirect to the main page if no ID is provided
        header("Location: pindah");
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
        <h1>Edit Pindah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../pindah/pindah">Data Pindah</a></li>
                <li class="breadcrumb-item"><a>Edit Pindah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Edit Data Pindah</h5>

                <!-- Vertical Form -->
                <form method="POST" action="edit_pindah" class="row g-3">
                    <input type="hidden" name="id_pindah" value="<?= $id_pindah ?>">

                    <div class="col-12">
                        <label for="id_pindah" class="form-label">Penduduk :</label>
                        <select name="id_penduduk" id="id_penduduk" class="form-control" required>
                            <!-- <option>- Pilh Pindah -</option> -->
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
                        <label for="tanggal_pindah" class="form-label">Tanggal pindah :</label>
                        <input type="date" class="form-control" id="tanggal_pindah" name="tanggal_pindah" value="<?= $tanggal_pindah ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="alasan" class="form-label">alasan :</label>
                        <input type="text" class="form-control" id="alasan" name="alasan" value="<?= $alasan ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="pindah" class="btn btn-secondary">Kembali</a>
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
