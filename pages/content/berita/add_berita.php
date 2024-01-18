<?php
require '../../../config/db.php';

$nama_judul = '';
$deskripsi_judul = '';
$gambar = '';
$tanggal_berita = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_judul = $_POST['nama_judul'];
    $deskripsi_judul = $_POST['deskripsi_judul'];
    $tanggal_berita = $_POST['tanggal_berita'];

    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "image/" . $gambar;

    if (!empty($nama_judul) && !empty($deskripsi_judul) && !empty($gambar) && !empty($tanggal_berita)) {
        move_uploaded_file($gambar_tmp, $gambar_path);

        $insert_query = "INSERT INTO tbl_berita (nama_judul, deskripsi_judul, gambar, tanggal_berita) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($db_connect, $insert_query);
        mysqli_stmt_bind_param($stmt, 'ssss', $nama_judul, $deskripsi_judul, $gambar, $tanggal_berita);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: berita");
            exit();
        } else {
            die("Error add : " . mysqli_error($db_connect));
        }
    } else {
        echo "Data tidak boleh kosong";
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
        <h1>Tambah berita</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item"><a href="../berita/berita">Data Berita</a></li>
                <li class="breadcrumb-item"><a>Tambah Berita</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Tambah Data Berita</h5>

                <!-- Vertical Form -->
                <form action="add_berita" method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-12">
                        <label for="nama_judul" class="form-label">Nama Judul :</label>
                        <input type="text" class="form-control" id="nama_judul" name="nama_judul" value="<?= $nama_judul ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="deskripsi_judul" class="form-label">Deskripsi Judul :</label>
                        <input type="text" class="form-control" id="deskripsi_judul" name="deskripsi_judul" value="<?= $deskripsi_judul ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="gambar" class="form-label">Gambar Uploud :</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="col-12">
                        <label for="tanggal_berita" class="form-label">Tanggal Uploud :</label>
                        <input type="date" class="form-control" id="tanggal_berita" name="tanggal_berita" value="<?= $tanggal_berita ?>" required>
                    </div>
                    <div class="text-end">
                        <a href="berita" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>