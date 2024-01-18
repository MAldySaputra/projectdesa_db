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
        <h1>Data Kelahiran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Kelahiran</li>
            </ol>
        </nav>
    </div><!-- Akhir Judul Halaman -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Kelahiran</h5>
                        <p>
                            <a href="add_kelahiran" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Kelahiran</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bayi</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>NIK</th>
                                        <th>Keluarga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Sertakan konfigurasi database
                                    require '../../../config/db.php';

                                    // Ambil data kelahiran dari database
                                    $kelahiran = mysqli_query($db_connect, "SELECT * FROM tbl_kelahiran
                                    JOIN tbl_kk ON tbl_kelahiran.id_kk = tbl_kk.id_kk");

                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($kelahiran)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['namabayi']; ?></td>
                                            <td><?= $row['tanggal_lahir']; ?></td>
                                            <td><?= $row['jenis_kelamin']; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <!-- Sesuaikan kolom lain sesuai kebutuhan -->
                                            <td>
                                                <a href="edit_kelahiran?id=<?= $row['id_lahir']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <form method="POST" action="del_kelahiran.php">
                                                    <input type="hidden" name="id_lahir" value="<?= $row['id_lahir']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data kelahiran ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </section>
</main><!-- Akhir #main -->

<?php
// Sertakan footer
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
