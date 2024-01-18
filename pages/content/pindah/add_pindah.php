<?php
// Include your database configuration file
require '../../../config/db.php';

// Initialize variables
$id_penduduk = '';
$tanggal_pindah = '';
$alasan = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $id_penduduk = $_POST['id_penduduk'];
    $tanggal_pindah = $_POST['tanggal_pindah'];
    $alasan = $_POST['alasan'];

    // Prepare and execute the SQL query
    if (!empty($id_penduduk) && !empty($tanggal_pindah) && !empty($alasan)) {
        $insert_query = "INSERT INTO tbl_pindah (id_penduduk, tanggal_pindah, alasan) VALUES ('$id_penduduk','$tanggal_pindah','$alasan')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: pindah");
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
        <h1>Tambah Pindah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../pindah/pindah">Data Pindah</a></li>
                <li class="breadcrumb-item"><a>Tambah Pindah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Pindah</h5>

        <form action="add_pindah" method="POST" class="row g-3">
            <div class="col-12">
                <label for="id_penduduk" class="form-label">Pindah :</label>
                <select name="id_penduduk" id="id_penduduk" class="form-control" required>
                    <option selected disabled value="">- Pilih Penduduk -</option>
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
                <label for="tanggal_pindah" class="form-label">Tanggal Pindah :</label>
                <input type="date" class="form-control" id="tanggal_pindah" name="tanggal_pindah" value="<?= $tanggal_pindah ?>" required>
            </div>
            <div class="col-12">
                <label for="alasan" class="form-label">Alasan :</label>
                <input type="text" class="form-control" id="alasan" name="alasan" value="<?= $alasan ?>" required>
            </div>
            <div class="text-end">
                <a href="pindah" class="btn btn-secondary">Kembali</a>
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
