<?php
// Include your database configuration file
require '../../../config/db.php';

// Initialize variables
$namabayi = '';
$tanggal_lahir = '';
$jenis_kelamin = '';
$id_kk = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $namabayi = $_POST['namabayi'];
    $tanggal_lahir = $_POST['tanggal'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $id_kk = $_POST['id_kk'];

    // Prepare and execute the SQL query
    if (!empty($namabayi) && !empty($tanggal_lahir) && !empty($jenis_kelamin) && !empty($id_kk)) {
        $insert_query = "INSERT INTO tbl_kelahiran (namabayi, tanggal_lahir, jenis_kelamin, id_kk) VALUES ('$namabayi','$tanggal_lahir','$jenis_kelamin', '$id_kk')";
        if (mysqli_query($db_connect, $insert_query)) {
            header("Location: kelahiran");
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
        <h1>Tambah Kelahiran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../kelahiran/kelahiran">Data Kelahiran</a></li>
                <li class="breadcrumb-item"><a>Tambah Kelahiran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Kelahiran</h5>

        <form action="add_kelahiran" method="POST" class="row g-3">
            <div class="col-12">
                <label for="namabayi" class="form-label">Nama Bayi :</label>
                <input type="text" class="form-control" id="namabayi" name="namabayi" value="<?= $namabayi ?>" required>
            </div>
            <div class="col-12">
                <label for="tanggal" class="form-label">Tanggal Lahir :</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $tanggal_lahir ?>" required>
            </div>
            <div class="col-12">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option selected disabled value="">- Pilih Jenis Kelamin -</option>
                    <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected' ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected' ?>>Perempuan</option>
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
