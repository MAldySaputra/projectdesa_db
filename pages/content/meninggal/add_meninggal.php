<?php
// Include your database configuration file
require '../../../config/db.php';

// Initialize variables
$id_penduduk = '';
$tanggal_meninggal = '';
$sebab = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $id_penduduk = $_POST['id_penduduk'];
    $tanggal_meninggal = $_POST['tanggal_meninggal'];
    $sebab = $_POST['sebab'];

    // Prepare and execute the SQL query
    if (!empty($id_penduduk) && !empty($tanggal_meninggal) && !empty($sebab)) {
        $insert_query = "INSERT INTO tbl_meninggal (id_penduduk, tanggal_meninggal, sebab) VALUES ('$id_penduduk','$tanggal_meninggal','$sebab')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: meninggal");
            exit();
        } else {
            die("Error add : " . mysqli_error($db_connect));
        }

    } else {
        echo "data tidak boleh kosong ";
    }
}
?>


<!-- Include your header file -->
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
        <h1>Tambah Kematian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../meninggal/meninggal">Data Kematian</a></li>
                <li class="breadcrumb-item"><a>Tambah Kematian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Kematian</h5>

        <form action="add_meninggal" method="POST" class="row g-3">
            <div class="col-12">
                <label for="id_penduduk" class="form-label">Penduduk :</label>
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
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <!-- End of Updated HTML Form -->
    </div>
</main>

<!-- Include your footer file -->
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
<!-- The rest of your HTML remains the same -->
