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
        <h1>Data Kematian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Kematian</li>
            </ol>
        </nav>
    </div><!-- Akhir Judul Halaman -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Kematian</h5>
                        <p>
                            <a href="add_meninggal" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Kematian</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Sebab</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Sertakan konfigurasi database
                                    require '../../../config/db.php';

                                    // Ambil data kelahiran dari database
                                    $meninggal = mysqli_query($db_connect, "SELECT * FROM tbl_meninggal
                                    JOIN tbl_penduduk ON tbl_meninggal.id_penduduk = tbl_penduduk.id_penduduk");


                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($meninggal)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['tanggal_meninggal']; ?></td>
                                            <td><?= $row['sebab']; ?></td>
                                            <!-- Sesuaikan kolom lain sesuai kebutuhan -->
                                            <td>
                                                <a href="edit_meninggal?id=<?= $row['id_meninggal']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <form method="POST" action="del_meninggal.php">
                                                    <input type="hidden" name="id_meninggal" value="<?= $row['id_meninggal']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data kematian ini?')">
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
