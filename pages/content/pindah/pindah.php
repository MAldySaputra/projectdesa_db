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
        <h1>Data Pindah</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a href="../dashboard/dashboard"> Home</a></li>
                <li class="breadcrumb-item">Data Pindah</li>
            </ol>
        </nav>
    </div><!-- Akhir Judul Halaman -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Data Pindah</h5>
                        <p>
                            <a href="add_pindah" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Tambah Pindah</a>
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Penduduk</th>
                                        <th>Tanggal Pindah</th>
                                        <th>Alasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Sertakan konfigurasi database
                                    require '../../../config/db.php';

                                    // Ambil data kelahiran dari database
                                    $pindah = mysqli_query($db_connect, "SELECT * FROM tbl_pindah
                                    JOIN tbl_penduduk ON tbl_pindah.id_penduduk = tbl_penduduk.id_penduduk");

                                    $no = 1;

                                    while ($row = mysqli_fetch_assoc($pindah)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nik']; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['tanggal_pindah']; ?></td>
                                            <td><?= $row['alasan']; ?></td>
                                            <!-- Sesuaikan kolom lain sesuai kebutuhan -->
                                            <td>
                                                <a href="edit_pindah?id=<?= $row['id_pindah']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <form method="POST" action="del_pindah.php">
                                                    <input type="hidden" name="id_pindah" value="<?= $row['id_pindah']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data pindah ini?')">
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
