<?php
// Include your database configuration file
require '../../../config/db.php';

// Initialize variables
$id_penduduk = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $id_penduduk = $_POST['id_penduduk'];

    // Prepare and execute the SQL query
    if (!empty($id_penduduk)) {
        $insert_query = "INSERT INTO tbl_penduduk (id_penduduk) VALUES ('$id_penduduk')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: suket_domisili");
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
        <h1>Surat Keterangan Domisili</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a>Surat Keterangan Domisili</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Surat Keterangan Domisili</h5>

        <form action="../report/cetak_domisili" method="POST" class="row g-3">
            <div class="col-12">
                <label for="id_penduduk" class="form-label">Penduduk :</label>
                <select name="id_penduduk" id="id_penduduk" class="form-control" required>
                    <option selected disabled value="">- Pilih Data -</option>
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
            <div class="text-end">
                <button type="submit" class="btn btn-primary" name="btnCetak" target="_blank">Cetak Surat</button>
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
